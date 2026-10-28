# Contributing

Thank you for your interest in contributing to the [WordPress Hosting Team Handbook](https://make.wordpress.org/hosting/handbook/)! If you're unsure of anything, please know that you're 💯 welcome to [submit an Issue](https://github.com/WordPress/hosting-handbook/issues) or [Pull Request](https://github.com/WordPress/hosting-handbook/pulls) on any topic. The worst that can happen is that you'll be politely directed to the best location to ask your question or to change something in your Pull Request. All contributions are valuable, and a wall of rules could get in the way of that.

As with all WordPress projects, it is a priority to ensure a welcoming environment for everyone. With that in mind, all contributors are expected to follow our [Code of Conduct](https://make.wordpress.org/handbook/community-code-of-conduct/).

All WordPress projects are [licensed under the GPLv2+](/LICENSE), and all contributions to this project will be released under the GPLv2+ license. You maintain copyright over any contribution you make, and by submitting a Pull Request, you are agreeing to release that contribution under the GPLv2+ license.

This document covers the technical details around setup and submitting your contribution to this project.

## Making Edits

Pull Requests are welcome!

Please feel free to start a Pull Request (PR) by [using the "Edit" button](https://help.github.com/en/github/managing-files-in-a-repository/editing-files-in-another-users-repository) next to one of the Handbook pages, or by [forking and cloning the repo](https://git-scm.com/book/en/v2/GitHub-Contributing-to-a-Project) (check the [Forks](https://github.com/WordPress/hosting-handbook/network/members)).

All documentation is written in plain text using the Markdown format. Don't worry about any specific flavor of Markdown it's checked and cleaned before generating it to HTML.

Either way, please include a description of the purpose behind the change so that it's easy for folks to review.

Any edit requires a review from two hosting team members before being merged. Reviews can be requested in the upper right of the Pull Request form.

### Merge requirements

The following rules apply to all Hosting team repositories, as announced in [Increased security on Hosting team repositories](https://make.wordpress.org/hosting/2026/09/30/increased-security-on-hosting-team-repositories/):

- Two approvals are required before a Pull Request can be merged.
- Change requests must be marked as resolved.
- New pushes must be reviewed and approved again before merging.
- All checks and tests must pass, with only green check marks in the results.
- New GitHub accounts have a 24-hour wait before they can interact with the repositories.

## Assets in Pages

Assets such as images are not automatically imported into the Handbook. Because of that, assets must be included in Pull Requests within the `/assets/` directory in the repo for tracking.

If you are merging a Pull Request with assets, please upload the assets to the [WordPress Hosting Handbook's media library](https://make.wordpress.org/hosting/wp-admin/upload.php) before merge, and link to the uploaded media directly.

## Review Checklist

Before approving or merging a Pull Request, check that:

- **Facts link to a source.** Version numbers, dates and requirements (PHP, MySQL / MariaDB, web servers) link to a primary source, such as the upstream project, the Core handbook or a Trac ticket.
- **Core changes match the Core team's documentation.** Statements about how WordPress Core behaves or what it requires should agree with the [PHP Compatibility and WordPress Versions](https://make.wordpress.org/core/handbook/references/php-compatibility-and-wordpress-versions/) reference and the [WordPress Requirements page](https://wordpress.org/about/requirements/). If they disagree, or you are unsure, ask in the [#core channel](https://wordpress.slack.com/archives/core/) before merging.
- **Security guidance has been reviewed by someone with security experience.** Ask for a reviewer in the [#hosting channel](https://wordpress.slack.com/archives/hosting/) when a change touches the Security page or other security advice. Never describe an unfixed vulnerability in an issue or Pull Request. Report it as described in the [Security Policy](/.github/SECURITY.md).
- **The manifest is up to date.** New, renamed or moved pages need a regenerated `bin/handbook-manifest.json` (see [Generating Manifest](#generating-manifest)).
- **AI use is disclosed.** Follow the [Hosting Team AI Policy](https://make.wordpress.org/hosting/2026/08/26/hosting-team-ai-policy/), for example with an `AI Assisted` note in the Pull Request description.
- **The Pull Request links its issue.** Use `Fixes #123` in the description so the issue closes when the Pull Request is merged.

## Generating Manifest

When a new page is added to the Handbook, or if a page's title or path has been changed during a Pull Request, re-generating the manifest manually is currently required so that it can be imported to the handbook.

There's an included WP-CLI command to take care of this. To run it, from the cloned handbook repo:

- Check if you have WP-CLI installed already by running `wp` or `which wp`
- If you need it, install WP-CLI using the [instructions from WP-CLI.org](https://wp-cli.org/#Installing) or your favorite package manager.
- Run `wp hosting-handbook gen-all`.

The manifest should get created inside the repo, in `/bin/handbook-manifest.json`.

Pages in the repository root and in sub-directories (such as `version/`) are included, and each page's title is taken from the `# Heading` on its first line. For pages already in the manifest, the `slug`, `parent` and `order` values are kept as they are. New pages are added at the end with the file name as their slug (the directory name for a sub-directory's `index.md`) and the next free `order` under their parent; review and adjust these by hand if needed. Pages whose files have been deleted are removed from the manifest.

If you move a page to a different directory, update its `parent` in the manifest by hand, as the existing value is kept.
