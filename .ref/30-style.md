# Page conventions

What is actually used across the handbook, so an edit matches the page it lands in rather than introducing a second house style.

The governing documents are the [WordPress Documentation Style Guide](https://make.wordpress.org/docs/style-guide/) and the [External Linking Policy](https://make.wordpress.org/docs/handbook/documentation-team-handbook/external-linking-policy/). Everything below is what this handbook does on top of, or within, those.

---

## Callout shortcodes

Three are in use: `[info]`, `[tip]`, and `[alert]`. They are rendered by the handbook theme on make.wordpress.org, not by Markdown, so they appear as literal text in a GitHub preview and only become callouts once published.

Each is written on a single line, opening tag, content, and closing tag together:

```markdown
[tip]In case only a major version (X.X) is indicated, use its minor (X.X.x) latest version available.[/tip]
```

Roughly how each is used here: `[info]` for context a reader can act on later, `[tip]` for an aside that helps but is not required, `[alert]` for something that will surprise a reader who ignores it.

A fourth shortcode may or may not render. The theme is not in this repository, so introducing one means checking against the published handbook rather than assuming. **(unverified: the set of shortcodes the theme supports is not documented here; the three above are the ones the handbook is known to use.)**

### The contributor footer

Several pages close with the same `[info]` block inviting readers to contribute, linking the GitHub repository and the `#hosting` Slack channel. It is a deliberate convention on longer, outward-facing pages rather than a requirement on every page.

If you add it, copy it verbatim from an existing page. It uses a typographic apostrophe (`’`), and retyping it introduces an inconsistency that is invisible in review.

---

## Tables

Pipe tables with no leading or trailing pipe, and a separator row of `----` cells:

```markdown
WordPress | PHP | MySQL | MariaDB | Launch date
---- | ---- | ---- | ---- | ----
WordPress 6.8 | 8.1 - 8.4 | 8.0 / 8.4 / 9.1 | 10.5 - 10.6 / 10.11 / 11.4 - 11.5 | 2025-04-15
```

Columns are not padded to align, and adding alignment produces a diff across every row for no rendered benefit. Leave the formatting as found.

Two value conventions inside the compatibility tables:

- A contiguous range is written with a hyphen and surrounding spaces: `8.1 - 8.4`.
- Discrete versions are separated by a forward slash: `8.0 / 8.4 / 9.1`. This is how the database columns express several concurrently supported branches rather than a range.

Dates are ISO 8601: `2025-04-15`.

---

## Links

**Trac tickets take the bare ticket number as the link text**, with the description following outside the link:

```markdown
- [#59231](https://core.trac.wordpress.org/ticket/59231): Prepare for PHP 8.3. _NOTE: Closed/Fixed_
```

Not this:

```markdown
- [#59231: Prepare for PHP 8.3.](https://core.trac.wordpress.org/ticket/59231)
```

Trac attaches a hovercard preview to links whose text is a recognizable ticket reference. Wrapping the description into the link text breaks that detection and the preview disappears. The handbook was written the second way originally; it was corrected across `server-environment.md` in **PR #387**, closing **issue #353**. The correct form is now used throughout, and reintroducing the old one is a regression rather than a style preference.

Status annotations follow the description in italics, as `_NOTE: ..._` or `_Note: ..._`. Both cases appear; match the surrounding block.

**Prefer linking to a canonical WordPress destination** — developer.wordpress.org, make.wordpress.org, or the relevant handbook — over a third-party restatement of the same thing. The External Linking Policy governs when an external link is appropriate.

---

## Example values

Both of these are hard requirements, not preferences, and they are the two things contributors get wrong most often. Published documentation containing a real domain or a routable IP address points readers at infrastructure that belongs to someone else.

**Domains must be reserved for documentation**: `example.com`, `example.net`, `example.org`, `example.info`, or `example.biz`. Subdomains of those are fine — `www.example.com`, `staging.example.org`.

**IP addresses must come from TEST-NET**: `192.0.2.0/24`, `198.51.100.0/24`, or `203.0.113.0/24`. Nothing else, and in particular not a private-range address dressed up as an example.

---

## Structure and prose

**Every page begins with a single `# ` heading.** The manifest generator anchors on it (`bin/command.php:57-61`), and a file that does not start with one gets an empty title. Sections below it use `##`, subsections `###`, and the per-version blocks in `server-environment.md` use `####`.

Note that the page's heading and its navigation label are not always the same string — see `H-04` in [`00-pipeline.md`](00-pipeline.md). Changing a heading is a content decision; changing the label is a navigation decision, and they are made in different files.

**Write for hosting providers and system administrators.** The audience runs WordPress at scale and does not need WordPress explained, but does need version numbers, dates, and support windows stated precisely.

**Mark what is not yet known.** A release that has not shipped, a post that has not been published, a ticket list that has not settled: write a `TODO` naming what is outstanding. Reviewers can act on that. A confident-sounding guess reaches publication unchallenged.

**Keep emoji out of page content**, commit messages, and pull request titles.

**Prose must not read as model output.** Handbook pages carry WordPress house style rather than any individual's voice. When generating or rewriting text, strip the usual tells — formulaic openings, stacked hedging, rhetorical triples, sentences of uniform length, summary paragraphs that restate what was just said — and leave the house voice intact. Do not layer a personal writing style onto a handbook page. Pull request descriptions and issue bodies are different; those are a contributor speaking as themselves.

---

## AI assistance disclosure

A page drafted or substantially rewritten with an AI model carries a line saying so, written as its own italic paragraph:

```markdown
_Page contents were AI assisted._
```

It is the last line of the file. On a page that ends with the contributor `[info]` footer it goes after that footer, so the disclosure closes the page rather than interrupting it.

The wording is fixed. It names no model and makes no claim about how much of the page was machine-written, because a longer note invites an argument about degree that a reader does not need in order to calibrate. What the reader needs is that the page was drafted with a model and is worth reading with that in mind.

Scope is the page, not the commit. Drafting a page, or rewriting whole sections of one, puts the line on. A typo fix, a version bump, or a merge conflict resolved with an assistant open does not. Applying it to every incidental edit would leave it on every page and tell a reader nothing.

The convention came from review rather than from a written policy: it was requested on **PR #415**, on the WordPress 7.1 compatibility page, and applied to the already-merged 7.0 page in **PR #424**. **(unverified: whether the Documentation team has a WordPress-wide AI disclosure standard this should match. None was found, but the search was not exhaustive; if one exists, it governs and this section should defer to it.)**
