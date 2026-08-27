@AGENTS.md

# Claude Code notes

`AGENTS.md` above is the source of truth for this repository. Everything below is an addition to it, never a replacement.

- **Prefer the file tools over shell equivalents.** Read, Glob, and Grep instead of `cat`, `find`, and piped `grep`.
- **Do not create scratch, planning, or note files inside the clone.** A Markdown file at the repository root becomes a published handbook page, and a file anywhere else ends up in the pull request. Keep working notes outside the repository.
- **Read `.ref/00-pipeline.md` before proposing that anyone regenerate the manifest.** The generator drops the curated `parent` and `order` fields, so a regeneration that looks routine will flatten the handbook navigation.
- **Handbook prose carries WordPress house style.** Strip AI tells from anything you draft, but do not apply a personal writing voice to handbook pages. Pull request and issue text is a different matter and can be written in the contributor's own voice.
- **Mark the page when you draft it.** A handbook page you write or substantially rewrite ends with `_Page contents were AI assisted._` as its last line. Stripping the tells does not remove the need to say so, and the two rules are not in tension: the page reads as house style *and* discloses how it was produced. Small edits do not need it — `AGENTS.md` §6 draws the line and `.ref/30-style.md` covers placement.
- **This repository has no test suite.** `php -l bin/command.php` is the only mechanical check available, and it only covers the one PHP file. Everything else is verified by reading.
