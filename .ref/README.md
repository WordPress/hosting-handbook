# `.ref/` — a reference about this repository

This directory is a hand-written analytical reference **about** the WordPress Hosting Handbook repository. It describes how the publishing pipeline behaves, which pages change on which trigger, and where each recurring fact comes from.

It is committed and reviewable, but it is **not published**. The manifest generator only globs Markdown files at the repository root, so nothing in a subdirectory can become a handbook page. See [`00-pipeline.md`](00-pipeline.md).

It exists so that [`AGENTS.md`](/AGENTS.md) can stay short. That file holds rules; this directory holds the evidence for them.

---

## Read order

| Document | Covers |
|---|---|
| [`00-pipeline.md`](00-pipeline.md) | How `gen-all` builds the manifest, and the findings that follow from it |
| [`10-pages.md`](10-pages.md) | Every page: parent, order, update cadence, and what specifically changes |
| [`20-sources.md`](20-sources.md) | The external source of truth behind every recurring update |
| [`30-style.md`](30-style.md) | Shortcodes, tables, links, and example values as actually used |
| [`VERIFICATION.md`](VERIFICATION.md) | What was checked against source, and what was not |

Read `00-pipeline.md` first. It is the only document describing behavior that can silently damage the published handbook.

---

## Conventions

These are the two rules that make this directory worth keeping. Preserve them.

**Every behavioral claim cites a file and a line.** Written as `file.ext:line`, resolved against the commit named in the freshness table below. A claim that has not been verified against source is marked **(unverified)** in place. There is no third category: either it was read, or it is labeled.

**Finding IDs are permanent.** Findings are numbered `H-01`, `H-02`, and so on, and are defined in the document where they are first described. Never renumber and never reuse a retired number. New findings append. Other documents refer to them by ID, and they may end up quoted in filed issues.

Two further habits:

- **Line numbers rot before anything else.** Never carry a citation forward without reopening the file. When you re-verify, record the pass in [`VERIFICATION.md`](VERIFICATION.md).
- **Record what you did not check.** An unchecked assumption that is labeled costs a reader nothing. An unchecked assumption presented as fact costs them the whole document.

---

## Freshness

| | |
|---|---|
| Citations resolved against | `0f38121` |
| Last full verification pass | 2026-08-16 |

When the repository moves, re-verify the citations here rather than editing `AGENTS.md`. `AGENTS.md` deliberately contains no line numbers, so ordinary code movement does not invalidate it. See the reference contract in [`AGENTS.md` §9](/AGENTS.md#9-reference-contract) for which changes belong where.
