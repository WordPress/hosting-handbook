# The publishing pipeline

How a Markdown file in this repository becomes a page on make.wordpress.org, and the places that process behaves in ways a contributor would not predict.

Citations resolve against the commit named in [`README.md`](README.md).

---

## 1. The chain

```
wp-cli.yml
  └─ requires bin/command.php
       └─ registers `wp hosting-handbook gen-all`
            └─ calls gen_hb_manifest()
                 └─ globs *.md at the repository root
                      └─ writes bin/handbook-manifest.json
                           └─ consumed by the handbook importer
```

`wp-cli.yml:1-2` declares a single `require` of `bin/command.php`. That file defines `HOSTING_HANDBOOK_PATH` as the repository root (`bin/command.php:13`) and registers the `hosting-handbook` command namespace at `bin/command.php:74`.

`gen_all()` (`bin/command.php:30`) does two things: it warns when `WP_CLI_CONFIG_PATH` is not `/dev/null` (`bin/command.php:32-34`), then calls `gen_hb_manifest()` (`bin/command.php:36`). There is nothing else in the command. `gen-all` and `gen-hb-manifest` are effectively the same operation, and the plural name is historical.

The `WP_CLI_CONFIG_PATH=/dev/null` warning exists because `wp-cli.yml` in this repository loads `bin/command.php`. Without the override, WP-CLI can load the command file twice — once from the local config and once from the target installation — and the `define()` at `bin/command.php:13` would then be re-declared. Running with the override is the documented invocation in [`CONTRIBUTING.md`](/CONTRIBUTING.md), and the warning is the only thing enforcing it. **(unverified: the double-load failure mode is inferred from the file's structure, not reproduced.)**

The final step is outside this repository. `bin/handbook-manifest.json` is read by the importer running on make.wordpress.org, which creates and updates handbook pages from it. **(unverified: the importer is not in this repository. Everything below about how the manifest is consumed is inferred from the manifest's own shape and from the published handbook's structure.)**

---

## 2. What `gen_hb_manifest()` actually does

`bin/command.php:45-71`.

| Step | Line | Behavior |
|---|---|---|
| Collect candidates | `52` | `glob( HOSTING_HANDBOOK_PATH . '/*.md' )` |
| Derive the slug | `53` | `basename( $file, '.md' )` — the filename, minus the extension |
| Skip non-pages | `54-56` | `in_array( $slug, $skip, true )` against the list at `bin/command.php:49` |
| Derive the title | `57-61` | `preg_match( '/^#\s(.+)/', $contents, $matches )` — the file's first `# ` heading |
| Remap the index slug | `64` | `index` becomes `handbook`; every other slug passes through |
| Build the source URL | `65` | Hardcoded to `github.com/wordpress/hosting-handbook/blob/main/<slug>.md` |
| Set the parent | `66` | Hardcoded `null` |
| Write the file | `69` | `json_encode( $manifest, JSON_PRETTY_PRINT )` to `bin/handbook-manifest.json` |

Four consequences worth stating plainly.

**The glob pattern is root-only.** `'/*.md'` does not recurse. Files under `assets/`, `bin/`, `.ref/`, or any other subdirectory are invisible to it. This is the mechanism that lets this very directory exist in the repository without being published.

**The slug is the filename.** Renaming a file changes its published URL. There is no redirect mechanism here; the old URL becomes the importer's problem.

**The title is the first heading.** `preg_match` without the `m` modifier anchors `^` to the start of the subject string, so this matches only if the file *begins* with a `# ` heading. Every current page does. A file starting with front matter, a comment, or a blank line would silently get an empty title.

**The `markdown_source` URL hardcodes both the organization and the branch.** It is lowercase `wordpress` rather than `WordPress` — GitHub is case-insensitive on the owner segment, so this resolves. It hardcodes `main`, so the field would be wrong on any repository whose default branch differs.

---

## 3. Findings

### `H-01` — regenerating the manifest flattens the handbook navigation

**Severity: high. This damages the published handbook and produces no error.**

The committed `bin/handbook-manifest.json` carries two fields per entry that `gen_hb_manifest()` never writes:

- `parent` — set on the pages nested under `get-involved`. The generator hardcodes `null` at `bin/command.php:66`.
- `order` — set on every entry, and ranging from `-1` on `index` upward. The generator does not emit this key at all; it is absent from the array constructed at `bin/command.php:62-67`.

So the committed manifest cannot have been produced by the current generator. It is hand-curated, and the commit history for that file records exactly that, with subjects such as *"updated manifest"* and *"Improved manifest"*.

The failure follows directly. [`CONTRIBUTING.md`](/CONTRIBUTING.md) instructs a contributor who adds or retitles a page to run `wp hosting-handbook gen-all`. Doing so, and committing the result, rewrites every entry with a null parent and no order.

Running the generator against a throwaway copy of the repository confirms the scope precisely:

- **`order` is lost on every entry**, without exception. The importer has nothing left to sort by.
- **`parent` is lost on the five pages nested under `get-involved`** — `team-projects`, `contributor-day`, `team-reps`, `documentation`, and `team-updates`. They become top-level pages.
- Six titles are rewritten as well; that is `H-04` below.

So the handbook's contents menu loses both its nesting and its ordering, five pages surface at the top level, and six menu labels change. The command reports `Success:` and exits zero.

**Mitigation, until this is fixed in the generator:** regenerate, then read `git diff bin/handbook-manifest.json` in full and restore every curated `parent`, `order`, and `title` by hand before committing. When no page has been added, renamed, or retitled, do not run the generator at all.

Do this in a throwaway copy of the repository rather than in place. Regenerating in the working tree and reverting afterwards leaves a window in which `git add -A` commits the flattened manifest, which is this finding's failure mode rather than a defense against it.

**A fix belongs in `gen_hb_manifest()`**, reading the existing manifest before the loop and carrying `parent`, `order`, and `title` forward per slug. That is a behavioral change to a generator and deserves its own pull request and its own discussion; it is deliberately not bundled with the change that introduced this document.

### `H-02` — any new root Markdown file is published without warning

**Severity: medium. Recoverable, but publicly visible first.**

The glob at `bin/command.php:52` takes every Markdown file at the repository root, and the skip list at `bin/command.php:49` is the only thing standing between a file and publication. Matching is on the exact slug via `in_array( ..., true )` at `bin/command.php:54`, so it is case-sensitive and exact — `Agents.md` would not match the `AGENTS` entry.

A contributor adding notes, a plan, a draft, or a template at the root creates a handbook page the next time anyone regenerates the manifest. The page inherits whatever the file's first heading says.

**Mitigation:** put anything that is not a handbook page in a subdirectory, where the glob cannot reach it. Add it to the skip list only when it genuinely has to live at the root, as `AGENTS.md` and `CLAUDE.md` do because agent tooling looks for them there.

### `H-03` — the skip list names a file that does not exist

**Severity: none. Recorded so the next reader does not go looking.**

`CODE_OF_CONDUCT` appears in the skip list at `bin/command.php:49`, but no `CODE_OF_CONDUCT.md` exists in this repository. The Code of Conduct is linked from [`CONTRIBUTING.md`](/CONTRIBUTING.md) as an external page on make.wordpress.org instead.

The entry is harmless and worth keeping — if the file is ever added, the skip already covers it.

### `H-04` — six manifest titles are shortened for navigation and would be overwritten

**Severity: medium. Compounds `H-01`.**

`title` looks like a generated field — `bin/command.php:57-61` extracts it from the page's first `# ` heading — but the committed manifest disagrees with the source pages in six places. The manifest carries a shorter label suited to a contents menu, while the page keeps a fuller heading:

| slug | manifest `title` | page's first heading |
|---|---|---|
| `index` | Hosting Handbook | WordPress Hosting Team Handbook |
| `team-projects` | Team Projects | Hosting Projects |
| `compatibility` | Compatibility | WordPress Compatibility |
| `upgrading` | Upgrading | Upgrading WordPress |
| `tests` | PHPUnit Tests | Tests |
| `sustainability` | Sustainability | Sustainability for Hosts |

The remaining entries match exactly.

The divergence is consistent enough to read as deliberate: in five of the six the manifest label is the shorter one, trimming a qualifier the page heading needs but the menu does not. `tests` runs the other way, disambiguating a page titled simply *Tests*.

So `title` joins `parent` and `order` as a field the committed manifest curates and the generator would overwrite. Regenerating rewrites all three at once: the nesting collapses, the ordering is lost, and six menu labels change. Treat the whole manifest as hand-maintained, not as generated output that happens to be committed.

**Mitigation:** the same as `H-01` — diff the regenerated file in full and restore curated values before committing. A generator fix should carry `title` forward alongside `parent` and `order`, or the six labels will need re-applying on every run.

---

## 4. The manifest schema

One object per slug. Fields, in the order the generator writes them:

| Field | Written by | Meaning |
|---|---|---|
| `title` | generator, then **hand-corrected** | Navigation label. Defaults to the page's first `# ` heading; six entries override it (`H-04`). |
| `slug` | generator | Published URL segment. `index` is remapped to `handbook`. |
| `markdown_source` | generator | Raw GitHub URL the importer fetches content from |
| `parent` | **hand-curated** | Slug of the parent page, or `null` for a top-level page |
| `order` | **hand-curated** | Sort position within the parent. Lower sorts first; `index` uses `-1`. |

Only `slug` and `markdown_source` survive a regeneration unchanged. The other three all need review afterwards.

`parent` refers to the manifest **key**, not the remapped `slug`. Every nested page currently uses `get-involved`, which is the same in both.

The generator writes with `JSON_PRETTY_PRINT` and no `JSON_UNESCAPED_SLASHES`, so URLs in the output carry escaped forward slashes (`https:\/\/github.com\/...`). The committed file matches that escaping. Preserve it; reformatting the file produces a large and meaningless diff.

---

## 5. When the manifest actually needs regenerating

Only these three cases:

- A page was added.
- A page's file was renamed, which changes its slug and its published URL.
- A page's first `# ` heading changed, which changes its title.

Editing a page's body does not touch the manifest, because none of the generated fields depend on body content. **(unverified: that the importer re-fetches body content from `markdown_source` on each run is inferred from the field's presence and name; the importer is not in this repository.)**
