# Contributing

Thank you for considering contributing to the [WordPress Hosting Team Handbook](https://make.wordpress.org/hosting/handbook/)! If you're unsure of anything, know that you're 💯 welcome to submit an issue or pull request on any topic. The worst that can happen is that you'll be politely directed to the best location to ask your question or to change something in your pull request. We appreciate any sort of contribution and don't want a wall of rules to get in the way of that.

As with all WordPress projects, we want to ensure a welcoming environment for everyone. With that in mind, all contributors are expected to follow our [Code of Conduct](/CODE_OF_CONDUCT.md).

All WordPress projects are [licensed under the GPLv2+](/LICENSE), and all contributions to this project will be released under the GPLv2+ license. You maintain copyright over any contribution you make, and by submitting a pull request, you are agreeing to release that contribution under the GPLv2+ license.

This document covers the technical details around setup, and submitting your contribution to this project.

## Making Edits

Pull requests are welcome! 

Please feel free to do [using the "Edit" button](https://help.github.com/en/github/managing-files-in-a-repository/editing-files-in-another-users-repository) next to one of the Handbook pages, or by [forking and cloning the repo](https://git-scm.com/book/en/v2/GitHub-Contributing-to-a-Project).

Either way, please include a description of the purpose behind the change so that it's easy for folks to review.

Any edit should have at least one review from a hosting team member before being merged.

## Assets in Pages

Assets like images are not automatically imported into the handbook. Please include them in PRs within the `/assets/` directory in the repo for tracking.

If you are merging a PR with assets, please upload these to the [handbook's media library](https://make.wordpress.org/hosting/wp-admin/upload.php) before merge, and link to the uploaded media directly.

## Generating Manifest

When a new page is added to the handbook, or if a page's title or path has been changed during a PR, re-generating the manifest manually is currently required so that it can be imported to the handbook.

There's an included WP-CLI command to take care of this. To run it, from the cloned handbook repo:
- Check if you have wp-cli installed already by running `wp` or `which wp`
- If you need it, install WP-CLI using the [instructions from WP-CLI.org](https://wp-cli.org/#Installing) or your favorite package manager.
- Run `wp hosting-handbook gen-all`.

The manifest should get created inside the repo, in `/bin/handbook-manifest.json`.
