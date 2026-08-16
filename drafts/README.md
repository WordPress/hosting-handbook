# Drafts

Working drafts of posts destined for [make.wordpress.org/hosting](https://make.wordpress.org/hosting/), not handbook pages.

**Do not move these files to the repository root.** `bin/command.php` builds the handbook manifest with `glob( HOSTING_HANDBOOK_PATH . '/*.md' )` and skips only `README`, `CODE_OF_CONDUCT`, and `CONTRIBUTING`. Any other `.md` file at the root becomes a published handbook page the next time the manifest is regenerated. Files inside this subdirectory are invisible to that glob.

Once a draft is published, replace the `TODO-url-once-published` placeholder in the "Quick recommendations" list at the top of `server-environment.md` with the real post URL.
