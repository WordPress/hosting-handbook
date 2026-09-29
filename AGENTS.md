# Working on this repository

Guidance for AI coding agents contributing to the WordPress Hosting Team Handbook.

This file is the canonical instruction set. `CLAUDE.md` imports it and adds nothing that contradicts it. If you are a human contributor, [`CONTRIBUTING.md`](/CONTRIBUTING.md) is the friendlier door and covers the same ground for the parts that matter to you.

---

## 1. What this repository is

This repository is the source of the [WordPress Hosting Handbook](https://make.wordpress.org/hosting/handbook/). Merged pull requests are imported into make.wordpress.org and published there. Everything here is documentation written in Markdown for a hosting audience: hosting providers, system administrators, and the people who keep WordPress running in production.

It is not an application. There is no build step, no dependency manifest, and no test suite. The only executable code is a small WP-CLI command that regenerates the handbook's page manifest.

What that means in practice: the risk in this repository is not a broken build, it is publishing something wrong or accidentally reshaping the handbook's navigation. Both failures are silent and both reach a public audience.

---

## 2. Repository facts

| | |
|---|---|
| Default branch | `main` |
| License | GPL-2.0+ |
| Review gate | **Two hosting team members must review before merge** |
| CI | None. There is no test suite and no automated check. |
| Ships how | Merged pull requests are imported into the handbook on make.wordpress.org |
| Discussion | [`#hosting`](https://wordpress.slack.com/archives/hosting/) on [Making WordPress Slack](https://make.wordpress.org/chat/) |

Contributors work from a fork and open pull requests against `main`. Request the two reviewers explicitly; the pull request will not merge without them.

Every pull request needs a description of the *purpose* behind the change, not only its contents. Reviewers here ask for it consistently.

Contributor credit is generated automatically by props-bot, which emits `Co-authored-by:` trailers. Never hand-write a props list and never add those trailers yourself.

---

## 3. Never

Each item links to the section that explains it.

1. **Never add a Markdown file to the repository root without checking the manifest skip list first.** Any root Markdown file outside that list becomes a published handbook page. → [§4](#4-the-publishing-pipeline)
2. **Never run the manifest generator and commit its output without reading the diff.** It does not round-trip the curated fields. → [§4](#4-the-publishing-pipeline)
3. **Never assume a page's manifest title should match its first heading.** Several differ on purpose, because a menu label and a page title are not the same thing. → [§4](#4-the-publishing-pipeline)
4. **Never merge a pull request carrying an asset without also uploading that asset to the handbook media library.** Both steps, not either. → [§7](#7-assets)
5. **Never use a non-reserved example domain or a non-TEST-NET IP address** in handbook content. → [§6](#6-page-conventions)
6. **Never put a ticket's description inside a Trac link's text.** It breaks the hovercards. → [§6](#6-page-conventions)
7. **Never write props or `Co-authored-by:` trailers.** props-bot owns them. → [§2](#2-repository-facts)
8. **Never leave scratch, planning, or working files in the repository.** At the root they get published; anywhere else they end up in a pull request. → [§4](#4-the-publishing-pipeline)
9. **Never publish a page you drafted or substantially rewrote with a model without the disclosure line.** The page says so itself, not only the pull request. → [§6](#6-page-conventions)

---

## 4. The publishing pipeline

Read this section before adding, renaming, or removing any file.

`wp-cli.yml` loads the command in `bin/command.php`, which registers `wp hosting-handbook gen-all`. That command writes `bin/handbook-manifest.json`, and the manifest is what drives the import into make.wordpress.org. A Markdown file that is not in the manifest is not published.

Several properties of the generator matter, and none of them are obvious from the outside:

**The glob only sees the repository root.** Files in subdirectories are invisible to it. That is precisely why `assets/` and `bin/` are safe, and it is the mechanism you should rely on for anything that must live in the repository without being published.

**The skip list is matched on the exact file slug.** It currently excludes `README`, `CODE_OF_CONDUCT`, `CONTRIBUTING`, `AGENTS`, and `CLAUDE`. A file named anything else at the root is a handbook page, whether or not that was the intent. Adding a root file means adding it to the skip list in the same change, or accepting that it will be published.

**The page title comes from the file's first Markdown heading, but the manifest does not always agree with it.** Several pages carry a shorter navigation label than their heading, on purpose. Change a heading and you have changed what the generator would write, which is not necessarily what the menu should say.

**The manifest is hand-maintained, not generated output that happens to be committed.** Most of its fields carry curated values the generator would overwrite: `parent` and `order`, which give the handbook its nested contents menu and its page ordering, and `title`, for the pages whose menu label differs from their heading. Only `slug` and `markdown_source` survive a regeneration untouched. Regenerating and committing the result collapses the nesting, loses the ordering, and rewrites those labels. Nothing reports an error. This is recorded as findings `H-01` and `H-04` in [`.ref/00-pipeline.md`](/.ref/00-pipeline.md), with the source citations and the full list of affected pages.

So the working procedure when the manifest genuinely needs regenerating — a page added, a heading changed, a file renamed — is:

1. Run `WP_CLI_CONFIG_PATH=/dev/null wp hosting-handbook gen-all` from the repository root.
2. Read `git diff bin/handbook-manifest.json` in full.
3. Restore every curated `parent`, `order`, and `title` the generator overwrote, and set them for any new page.
4. Diff again, and expect the only remaining change to be the one you intended.

If the change does not add, rename, or retitle a page, the manifest does not need to move at all. Leave it alone.

---

## 5. Recurring maintenance

Most work in this repository is triggered by something happening outside it. The table below maps the trigger to the page. [`.ref/20-sources.md`](/.ref/20-sources.md) names the source of truth for each fact, and [`.ref/10-pages.md`](/.ref/10-pages.md) lists what changes within each page.

| Trigger | Pages affected |
|---|---|
| A WordPress release ships | `compatibility.md`, `server-environment.md`, `upgrading.md` |
| A server compatibility post is published on the Make blog | `server-environment.md` |
| A new PHP version reaches general availability | `server-environment.md`, `compatibility.md` |
| A PHP version moves to security-only support or reaches end of life | `server-environment.md` |
| The Core team changes a PHP support label | `server-environment.md` |
| A MySQL or MariaDB version reaches end of life | `compatibility.md`, `server-environment.md` |
| The test runner or reporter changes | `tests.md` |
| Team representatives change | `team-reps.md` |
| Periodically, on no trigger at all | Every page, for link rot |

Two habits keep this honest.

Work from the primary source, never from the previous release's row. The compatibility tables describe what was actually available and security-supported when a version shipped, and copying the prior row forward quietly turns a claim about the world into a claim about the table.

Leave an explicit `TODO` when a fact is not knowable yet. A release scheduled but not shipped, a ticket list that has not settled, a post URL that does not exist — mark it and say what is missing. A `TODO` is reviewable. A confident guess is not.

---

## 6. Page conventions

Match the file you are editing. When in doubt, [`.ref/30-style.md`](/.ref/30-style.md) records what is actually used across the handbook.

**Governing style** — the [WordPress Documentation Style Guide](https://make.wordpress.org/docs/style-guide/) and the [External Linking Policy](https://make.wordpress.org/docs/handbook/documentation-team-handbook/external-linking-policy/). Write in English. Keep emoji out of page content, commit messages, and pull request titles.

**Callout shortcodes** — the handbook renders `[info]`, `[tip]`, and `[alert]` wrapped around their content. Those three are the vocabulary in use here. Introducing a fourth means checking that the handbook theme actually renders it.

**Tables** are pipe tables with no leading pipe and a separator row of `----` cells. Match the surrounding table rather than reformatting it.

**Example domains must be reserved**: `example.com`, `example.net`, `example.org`, `example.info`, or `example.biz`. Subdomains of those are fine. **Example IP addresses must come from TEST-NET**: `192.0.2.0/24`, `198.51.100.0/24`, or `203.0.113.0/24`. Nothing else. These are the two rules contributors break most often, and both put real third-party infrastructure into published documentation.

**Trac links use the bare ticket number as the link text**, with the description following outside the link. Putting the description inside the link text breaks the hovercard preview that Trac attaches to those links.

**Prose must not read as model output.** Handbook pages carry WordPress house style. If you are generating or rewriting prose, strip the tells — formulaic openings, hedging stacked on hedging, rhetorical triples, uniform sentence length — and leave the house voice alone. Do not layer a personal writing voice onto handbook pages.

**A page written with AI assistance says so on the page.** Close it with `_Page contents were AI assisted._` on its own line, last in the file, after the contributor footer where there is one. The wording is fixed, and it is deliberately short. This covers a page you drafted or substantially rewrote with a model; it does not cover a typo fix or a version bump made with an assistant open, and adding it to those drains it of meaning. [`.ref/30-style.md`](/.ref/30-style.md) records the placement and where the convention came from.

---

## 7. Assets

Assets are not imported into the handbook automatically. Two things have to happen:

1. Commit the file to `/assets/` in the pull request, so it is tracked here.
2. Before merge, upload it to the [handbook media library](https://make.wordpress.org/hosting/wp-admin/upload.php) and link the uploaded URL from the page.

Both. A page that links to a path inside this repository will render a broken image once published.

---

## 8. The `.ref/` directory

[`.ref/`](/.ref/) is a hand-written reference *about* this repository: how the generator behaves, which page changes on which trigger, and where each recurring fact comes from. It is committed and reviewable. It is not published, because the manifest glob only sees the repository root ([§4](#4-the-publishing-pipeline)).

It exists so that this file can stay short. Anything needing a citation, a line number, or a version-specific detail belongs there.

Two conventions hold throughout it:

- **Every behavioral claim cites a file and line.** Anything not verified against source is marked **(unverified)**.
- **Finding IDs are permanent.** They are numbered `H-01`, `H-02`, and so on. Never renumber them; new findings append. Other documents, and eventually filed issues, refer to them.

Start at [`.ref/README.md`](/.ref/README.md), which carries the read order.

---

## 9. Reference contract

How this file is kept true. Read it before editing this file, and before deciding that something you learned belongs in it.

### What belongs here

Only facts that change on governance timescales: the branch, the license, the review gate, the shape of the publishing pipeline, the prohibitions, and the maintenance triggers. If a statement would go stale on the next WordPress release, it belongs in `.ref/` instead.

### No line numbers, no commit hashes, no counts

Those are the first things to rot, and a wrong citation is worse than an absent one. Anything needing a citation goes in `.ref/`, where `VERIFICATION.md` records when it was last checked against source.

This file may say *the generator skips a short list of root files*. Only `.ref/` may say which line does the skipping.

The single permitted exception is a filed issue or pull request number. Those are permanent.

### Explain each path in one place

A path *described* in two sections will drift in one of them. Explain it where it belongs and refer back from everywhere else. Pointing at a path is fine and expected; restating what it does is not.

### Changes that require editing this file

Make the edit in the same pull request as the change itself:

- The skip list or the glob in `bin/command.php`.
- The fields in `bin/handbook-manifest.json`.
- The review gate, the default branch, or the license.
- A new file at the repository root, or a new tracked directory.
- The asset workflow or the media library requirement.

### Changes that require editing `.ref/` instead

These do not touch this file:

- A new WordPress or PHP release → `.ref/10-pages.md`, `.ref/20-sources.md`
- An external source that moved or was retired → `.ref/20-sources.md`
- A newly observed page convention → `.ref/30-style.md`
- A new finding → append the next `H-nn`; never renumber

### Verify before you cite

Never carry a `file.ext:line` citation forward without reopening the source and confirming it. When you edit `.ref/`, update `.ref/VERIFICATION.md` in the same commit, including what you chose not to check. The distinction between verified and assumed is the entire value of that directory.
