# WP-CLI

[WP-CLI](https://wp-cli.org/) is the command-line interface for WordPress. It lets hosts and support teams check, maintain and repair a site from the server without logging in to the dashboard. This page lists the commands that are most useful for hosting work. For every command and option, see the official [WP-CLI command reference](https://developer.wordpress.org/cli/commands/).

For upgrading WordPress core with WP-CLI, see [Upgrading](https://make.wordpress.org/hosting/handbook/upgrading/).

[warning]Always take a full backup of the files and the database before running commands that change a site. Several commands on this page (`db import`, `search-replace`, `plugin update`) cannot be undone.[/warning]

## Running WP-CLI on a server

- **Run commands as the site's user, not as root.** Running as root can leave files owned by root that the web server cannot write to later. Use `sudo -u <site-user> wp <command>` rather than `--allow-root`.
- **Point WP-CLI at the right site.** Use `--path=/path/to/wordpress` when you are not in the WordPress directory. On multisite, add `--url=https://site.example.com` to run a command against a single site.
- **Check the environment first.** `wp --info` shows the WP-CLI version, the PHP binary and version, and the configuration WP-CLI is using. The PHP version used on the command line can differ from the one used by the web server.

```bash
wp --info
wp cli version
wp cli update
```

`wp cli update` only works when WP-CLI was installed as a Phar file. If it was installed through a package manager, update it there.

## Site health and integrity

```bash
wp core version --extra
wp core verify-checksums
wp plugin verify-checksums --all
```

`verify-checksums` compares files against the official release from WordPress.org, so modified or injected files show up. Plugin checksums are only available for plugins hosted on WordPress.org.

## Plugins and themes

```bash
wp plugin list
wp plugin list --update=available
wp plugin update --all --dry-run
wp plugin update --all
wp theme list
wp theme update --all
```

Run `--dry-run` first to see what would be updated without changing anything.

When a plugin breaks a site and the dashboard is not reachable, deactivate plugins from the command line to find the cause:

```bash
wp plugin deactivate --all
wp plugin activate <plugin-slug>
```

To start WP-CLI without loading plugins or themes, for example when a fatal error stops every command, add `--skip-plugins` and `--skip-themes`:

```bash
wp plugin list --skip-plugins --skip-themes
```

## Database

```bash
wp db check
wp db size --human-readable
wp db size --tables
wp db export backup.sql
wp db import backup.sql
```

`wp db export` and `wp db import` use the database credentials in `wp-config.php`. Store exports outside the web root, and delete them when they are no longer needed.

## Migrations and domain changes

```bash
wp search-replace 'https://old.example.com' 'https://new.example.com' --skip-columns=guid --dry-run
wp search-replace 'https://old.example.com' 'https://new.example.com' --skip-columns=guid
```

`search-replace` handles serialized data correctly, which a plain SQL `REPLACE()` does not. Always run it with `--dry-run` first and check the number of replacements. The `guid` column should not be changed on an existing site.

## Caches, rewrites and cron

```bash
wp cache flush
wp transient delete --expired
wp rewrite flush
wp cron test
wp cron event list
wp cron event run --due-now
```

`wp cache flush` clears the object cache. It does not clear a page cache or a CDN, which usually have their own commands or controls.

`wp cron test` checks whether WP-Cron can be triggered over HTTP. If you disable WP-Cron with `DISABLE_WP_CRON` and run it from a system cron job, `wp cron event run --due-now` is a common way to do that.

## Maintenance mode

```bash
wp maintenance-mode status
wp maintenance-mode activate
wp maintenance-mode deactivate
```

## Users and security

```bash
wp user list --role=administrator
wp user reset-password <user>
wp user session destroy <user> --all
wp config shuffle-salts
```

After a compromise, list the administrator accounts and remove any that should not be there, reset passwords, and destroy existing sessions. `wp config shuffle-salts` replaces the keys and salts in `wp-config.php`, which logs every user out. See the [Security](https://make.wordpress.org/hosting/handbook/security/) page for more.

## Configuration and options

```bash
wp config list
wp config get WP_DEBUG
wp option get siteurl
wp option get home
```

`wp config list` shows the constants and variables defined in `wp-config.php`, and `wp config get` shows a single one. Be careful when sharing the output of `wp config list`, because it includes database credentials and keys.

## Media

```bash
wp media regenerate --only-missing
```

Regenerates missing thumbnail sizes, for example after a theme change or a migration. Without `--only-missing`, every thumbnail is regenerated, which can take a long time on large sites.

## Multisite

```bash
wp site list
wp plugin list --url=https://site.example.com
```

Most commands accept `--url` to target one site in a network.

[info]If you're interested in improving this handbook, check the [GitHub Handbook repo](https://github.com/WordPress/hosting-handbook/), or leave a message in the [#hosting channel](https://wordpress.slack.com/archives/hosting/) of the official [WordPress Slack](https://make.wordpress.org/chat/).[/info]
