# WordPress 7.1 Server Compatibility

_DRAFT — hold until WordPress 7.1 ships on 19 August 2026, then verify the TODOs below and publish. Intended for [make.wordpress.org/hosting](https://make.wordpress.org/hosting/), category "Release Compatibility"._

_Keep this file inside `drafts/`. `bin/command.php` builds the handbook manifest with `glob( HOSTING_HANDBOOK_PATH . '/*.md' )` and skips only `README`, `CODE_OF_CONDUCT` and `CONTRIBUTING`, so any other `.md` file at the repository root becomes a published handbook page the next time the manifest is regenerated. Files in this subdirectory are invisible to that glob._

The Hosting Team reviews the compatibility between each WordPress release and the server software it runs on: PHP, MySQL / MariaDB and the web server. This post covers **WordPress 7.1**, released on **19 August 2026**.

Previous compatibility articles:

- [WordPress 7.0 Server Compatibility](TODO-url-once-published)
- [WordPress 6.9 Server Compatibility](https://make.wordpress.org/hosting/2026/05/27/wordpress-6-9-server-compatibility/)
- [WordPress 6.8 Server Compatibility](https://make.wordpress.org/hosting/2025/04/16/wordpress-6-8-server-compatibility/)
- [WordPress 6.7 Server Compatibility](https://make.wordpress.org/hosting/2024/11/05/wordpress-6-7-server-compatibility/)
- [WordPress 6.6 Server Compatibility](https://make.wordpress.org/hosting/2024/07/10/wordpress-6-6-server-compatibility/)

This post focuses on new installations and on the best strategy for upgrading. It is not a discussion of how far backward compatibility reaches.

## Hosting Team recommendations

For a new WordPress 7.1 installation, the recommended minimum versions are:

- **PHP**: 8.4.x, 8.5.x
- **MySQL**: 8.4.x
- **MariaDB**: 10.11.x, 11.4.x, 11.8.x

These recommendations are for **new installations**. They favour the most recent compatible versions rather than the oldest ones that still work.

### Where do the recommendations come from?

The Hosting Team reviews, for each WordPress release, which versions of PHP and of the database engines are still receiving security support from their own upstream projects at the time of the release, and cross-references that against the compatibility work done in WordPress Core. A version that is end-of-life upstream is never recommended, even when WordPress still runs on it.

## WordPress server requirements

WordPress supports older software for backward compatibility. The absolute minimums for WordPress 7.1 are:

- **PHP**: 7.4+
- **MySQL**: 5.5.5+
- **MariaDB**: 5.5.5+

This is unchanged from WordPress 7.0, which raised the minimum PHP version from 7.2.24 to 7.4 and dropped support for PHP 7.2 and 7.3.

The full requirements are documented on the [WordPress Requirements page](https://wordpress.org/about/requirements/).

## WordPress compatibility at the time of release

The following versions are available and receiving security support as of 19 August 2026.

### PHP

| Version | Status at release | End of life |
|---------|-------------------|-------------|
| PHP 8.5 | Active Support    | 2029-12-31  |
| PHP 8.4 | Active Support    | 2028-12-31  |
| PHP 8.3 | Security Support  | 2027-12-31  |
| PHP 8.2 | Security Support  | 2026-12-31  |

PHP 8.2 reaches end of life on 31 December 2026, roughly four months after this release. Hosts should plan migrations for sites still on 8.2.

_TODO: PHP 8.6 was in beta at the time of writing. Confirm before publishing whether 8.6 had a stable release by 19 August 2026 and, if so, what WordPress 7.1's compatibility status with it is._

### MySQL

| Version   | Type | End of life |
|-----------|------|-------------|
| MySQL 9.7 | LTS  | 2034-04-21  |
| MySQL 8.4 | LTS  | 2032-04-30  |

MySQL 8.0 reached end of life on 30 April 2026 and should no longer be used.

### MariaDB

| Version       | Type | End of life |
|---------------|------|-------------|
| MariaDB 12.3  | LTS  | 2029-06-12  |
| MariaDB 11.8  | LTS  | 2028-06-04  |
| MariaDB 11.4  | LTS  | 2029-05-29  |
| MariaDB 10.11 | LTS  | 2028-02-16  |

MariaDB 10.6 reached end of life on 6 July 2026 and is no longer listed.

### Web servers

_TODO: confirm the current stable versions before publishing. The handbook's [Server Environment](https://make.wordpress.org/hosting/handbook/server-environment/) page lists Apache HTTPD 2.4, nginx 1.26 & 1.27, Angie 1.7, LiteSpeed 6.x and OpenLiteSpeed 1.8, but the nginx entries in particular look stale._

## WordPress and PHP

PHP is the language WordPress is written in, and keeping it current matters for both security and performance.

**WordPress 7.1 is fully compatible with PHP 7.4 (1), 8.0 (1), 8.1 (1), 8.2, 8.3, 8.4 and 8.5.**

_(1) These PHP versions are end-of-life and are supported by WordPress for backward compatibility only. Use of supported PHP versions is strongly recommended._

Verify against the Core team's [PHP Compatibility and WordPress Versions](https://make.wordpress.org/core/handbook/references/php-compatibility-and-wordpress-versions/) reference, which is updated for each release.

The Core team retired the ["compatible with exceptions" label in April 2025](https://make.wordpress.org/core/2025/04/09/php-8-support-clarification/) and the ["beta support" label in May 2026](https://make.wordpress.org/core/2026/05/22/php-support-clarification-2026/). Both labels were removed retroactively from all WordPress versions, so this post uses neither.

## Related tickets

_TODO: pull the PHP-keyword ticket list for [Trac milestone 7.1](https://core.trac.wordpress.org/query?milestone=7.1&keywords=~php) and list each entry below._

Use this format exactly — the ticket number alone is the link text, with the description after the link:

```
- [#62061](https://core.trac.wordpress.org/ticket/62061): Prepare for PHP 8.4. _NOTE: Closed / Fixed_
```

Putting the description inside the link text breaks the Trac hovercards on make.wordpress.org. That regression has already been introduced and fixed twice ([#353](https://github.com/WordPress/hosting-handbook/issues/353), [#399](https://github.com/WordPress/hosting-handbook/issues/399)).

The [WordPress 7.1 Field Guide](https://make.wordpress.org/core/2026/08/05/wordpress-7-1-field-guide/) is the starting point for what changed in this release, though it does not cover server requirements directly.

## Upgrading WordPress

For step-by-step upgrade paths from any older WordPress version, see [Upgrading WordPress](https://make.wordpress.org/hosting/handbook/upgrading/) in the Hosting Team handbook.

---

_Questions or corrections? Leave a comment below, or find us in the [#hosting channel](https://wordpress.slack.com/archives/hosting/) of the [WordPress Slack](https://make.wordpress.org/chat/)._
