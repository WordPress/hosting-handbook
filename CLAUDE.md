@AGENTS.md

# Claude Code notes

`AGENTS.md` above is the source of truth for this repository. Everything below is an addition to it, never a replacement.

- **Prefer the file tools over shell equivalents.** Read, Glob, and Grep instead of `cat`, `find`, and piped `grep`.
- **Do not create scratch, planning, or note files inside the clone.** A Markdown file at the repository root becomes a published handbook page, and a file anywhere else ends up in the pull request. Keep working notes outside the repository.
- **Read `.ref/00-pipeline.md` before proposing that anyone regenerate the manifest.** The generator drops the curated `parent` and `order` fields, so a regeneration that looks routine will flatten the handbook navigation.
- **Handbook prose carries WordPress house style.** Strip AI tells from anything you draft, but do not apply a personal writing voice to handbook pages. Pull request and issue text is a different matter and can be written in the contributor's own voice.
- **This repository has no test suite.** `php -l bin/command.php` is the only mechanical check available, and it only covers the one PHP file. Everything else is verified by reading.
