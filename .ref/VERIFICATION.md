# Verification log

What was checked against source, how, and what was not. The distinction between a verified claim and an assumed one is the reason this directory is worth keeping; this file is where that distinction is recorded.

Add an entry for every pass. Never edit a past entry — append.

---

## 2026-08-16 — initial pass

Citations resolved against `0f38121`.

### Verified by reading source

| Claim | Where | How |
|---|---|---|
| `wp-cli.yml` requires `bin/command.php` and nothing else | [`00-pipeline.md`](00-pipeline.md) §1 | Read the whole file. It is two lines. |
| `gen_all()` warns on `WP_CLI_CONFIG_PATH` then calls `gen_hb_manifest()` | `00-pipeline.md` §1 | Read `bin/command.php:30-38`. |
| The glob is `'/*.md'` at the repository root and does not recurse | `00-pipeline.md` §2 | Read `bin/command.php:52`. |
| The skip list is matched with `in_array( ..., true )` on the exact slug | `00-pipeline.md` §2, `H-02` | Read `bin/command.php:49` and `:54`. |
| Title extraction uses `preg_match( '/^#\s(.+)/', ... )` with no `m` modifier | `00-pipeline.md` §2 | Read `bin/command.php:57-61`. |
| `index` is remapped to the slug `handbook` | `00-pipeline.md` §2, [`10-pages.md`](10-pages.md) §1 | Read `bin/command.php:64`. |
| `parent` is hardcoded `null` and `order` is never written | `H-01` | Read the array literal at `bin/command.php:62-67`. `order` does not appear anywhere in the file. |
| The committed manifest carries curated `parent` and `order` on every entry | `H-01`, `10-pages.md` §1 | Parsed `bin/handbook-manifest.json` and listed both fields for all entries. Every entry has both. |
| Six manifest titles differ from their page's first heading | `H-04` | Parsed the manifest, extracted each page's first `# ` heading with the same regex the generator uses, and compared. The six listed are the complete set of mismatches. |
| **Regenerating drops `order` on every entry, drops `parent` on the five nested pages, and rewrites the six titles** | `H-01`, `H-04` | Ran the generator and diffed its output field by field against the committed manifest. See the execution note below. |
| Only `slug` and `markdown_source` survive a regeneration unchanged | `00-pipeline.md` §4 | Same run. Those two fields matched on all entries; the other three did not. |
| The skip list excludes `AGENTS` and `CLAUDE` from the manifest | `H-02` | Same run. The generated key set was identical to the committed one, and neither slug appeared in the output. |
| The manifest was hand-edited rather than generated | `H-01` | `git log` on `bin/handbook-manifest.json`. Commit subjects include *"updated manifest"*, *"Improved manifest"*, *"manifest learn hosting"*. |
| `CODE_OF_CONDUCT.md` does not exist in this repository | `H-03` | Listed the repository root. The Code of Conduct is linked externally from `CONTRIBUTING.md`. |
| The generator writes with `JSON_PRETTY_PRINT` and escapes forward slashes | `00-pipeline.md` §4 | Read `bin/command.php:69`; confirmed the escaping is present in the committed file. |
| `markdown_source` hardcodes the owner and the `main` branch | `00-pipeline.md` §2 | Read `bin/command.php:65`. |
| The Trac hovercard link format and the change that established it | [`30-style.md`](30-style.md) | Read the diff of PR #387 (issue #353) against `server-environment.md`. Confirmed the before and after forms. |
| Only `[info]`, `[tip]`, and `[alert]` appear in page content | `30-style.md` | Searched every page for bracketed shortcode-shaped tokens. No others found. |
| The contributor `[info]` footer appears on some pages, not all | `30-style.md` | Searched for the footer text; found it on a subset of pages, and confirmed it is the last line where present. |
| Table format: no leading pipe, `----` separator, `/` for discrete versions | `30-style.md` | Read the tables in `compatibility.md` and `server-environment.md`. |
| The Trac query in `server-environment.md` carries one `milestone=` per tracked release | [`20-sources.md`](20-sources.md) | Read the URL in place. |
| The compatibility label retirements and their dates | `20-sources.md` | Read the statement in `server-environment.md` and followed both linked Make posts. |
| Page ordering leaves a gap between `6` and `10` | `10-pages.md` §1 | Read the `order` values from the manifest. |

### Not verified

**The handbook importer.** It runs on make.wordpress.org and is not in this repository. Everything stated about how `bin/handbook-manifest.json` is consumed — that `parent` produces nesting, that `order` sorts the contents menu, that `markdown_source` is re-fetched per import — is inferred from the field names, the manifest's shape, and the structure of the published handbook. It has not been read. If any of it turns out to be wrong, `H-01` and `H-04` need re-evaluating, since both describe consequences on the published side.

**The `WP_CLI_CONFIG_PATH=/dev/null` failure mode.** The warning at `bin/command.php:32-34` is real and was read. The explanation offered for it — a double load of the command file re-declaring the constant at `bin/command.php:13` — is inferred from the file's structure. Not reproduced.

**The set of shortcodes the theme supports.** Only the three in use were confirmed. Whether a fourth would render is unknown; the theme is not in this repository.

**`gen-all` was run, but never against the working repository.** The findings above marked as confirmed by execution come from running `WP_CLI_CONFIG_PATH=/dev/null wp hosting-handbook gen-all` under WP-CLI 2.12.0 inside a throwaway copy of the repository, then comparing its output against the committed manifest. The committed file was never overwritten and the copy was discarded.

Anyone repeating this must do the same. Running the generator in place and then reverting is not equivalent: it leaves a window in which a `git add -A` commits the flattened manifest, which is the exact failure `H-01` describes.

**Cadence claims in [`10-pages.md`](10-pages.md) §2 are judgment, not measurement.** They come from reading each page's content and its history, not from analyzing commit frequency. Treat them as orientation for a new contributor rather than as fact.

### Link checks

Every external URL introduced by this pass was requested. All resolved except two, both of which reject automated requests rather than being broken:

- `core.trac.wordpress.org/ticket/59231` — Trac returns `403` to non-browser clients. The URL form is the one already used throughout `server-environment.md`, and this instance was copied from the PR #387 diff.
- `dev.mysql.com/downloads/mysql/` — returns `403` to non-browser clients. Already linked from `server-environment.md`.

Neither was opened in a browser to confirm the page content is still what the surrounding text claims. **(unverified: reachability was checked; content was not.)**

Internal relative links in `AGENTS.md`, `CLAUDE.md`, and this directory were resolved against the filesystem. All point at files that exist.
