# WordPress 7.0 Server Compatibility

_DRAFT — not yet published. Intended for [make.wordpress.org/hosting](https://make.wordpress.org/hosting/), category "Release Compatibility". See `drafts/README.md` before moving this file._

The Hosting Team reviews the compatibility between each WordPress release and the server software it runs on: PHP, MySQL / MariaDB and the web server. This post covers **WordPress 7.0**, released on **20 May 2026**.

_This post is published retrospectively. WordPress 7.0 shipped in May 2026 and the compatibility review was not posted at the time, so the versions below describe the software landscape as it stood at the 7.0 release date rather than today. Hosts running 7.0 today should also read the WordPress 7.1 Server Compatibility post._

Previous compatibility articles:

- [WordPress 6.9 Server Compatibility](https://make.wordpress.org/hosting/2026/05/27/wordpress-6-9-server-compatibility/)
- [WordPress 6.8 Server Compatibility](https://make.wordpress.org/hosting/2025/04/16/wordpress-6-8-server-compatibility/)
- [WordPress 6.7 Server Compatibility](https://make.wordpress.org/hosting/2024/11/05/wordpress-6-7-server-compatibility/)
- [WordPress 6.6 Server Compatibility](https://make.wordpress.org/hosting/2024/07/10/wordpress-6-6-server-compatibility/)

This post focuses on new installations and on the best strategy for upgrading. It is not a discussion of how far backward compatibility reaches.

## Hosting Team recommendations

For a new WordPress 7.0 installation, the recommended minimum versions are:

- **PHP**: 8.4.x, 8.5.x
- **MySQL**: 8.4.x
- **MariaDB**: 10.11.x, 11.4.x, 11.8.x

These recommendations are for **new installations**. They favour the most recent compatible versions rather than the oldest ones that still work.

### Where do the recommendations come from?

The Hosting Team reviews, for each WordPress release, which versions of PHP and of the database engines are still receiving security support from their own upstream projects at the time of the release, and cross-references that against the compatibility work done in WordPress Core. A version that is end-of-life upstream is never recommended, even when WordPress still runs on it.

## WordPress server requirements

WordPress supports older software for backward compatibility. The absolute minimums for WordPress 7.0 are:

- **PHP**: 7.4+
- **MySQL**: 5.5.5+
- **MariaDB**: 5.5.5+

**WordPress 7.0 raised the minimum required PHP version from 7.2.24 to 7.4**, dropping support for PHP 7.2 and PHP 7.3. This is the first minimum-PHP increase since WordPress 6.6. Hosts still offering PHP 7.2 or 7.3 as a default should move those sites before upgrading them to 7.0.

The full requirements are documented on the [WordPress Requirements page](https://wordpress.org/about/requirements/).

## WordPress compatibility at the time of release

The following versions were available and receiving security support on 20 May 2026.

### PHP

| Version | Status at release | End of life |
|---------|-------------------|-------------|
| PHP 8.5 | Active Support    | 2029-12-31  |
| PHP 8.4 | Active Support    | 2028-12-31  |
| PHP 8.3 | Security Support  | 2027-12-31  |
| PHP 8.2 | Security Support  | 2026-12-31  |

PHP 8.1 reached end of life on 31 December 2025 and was no longer supported upstream when WordPress 7.0 shipped.

### MySQL

| Version   | Type       | End of life |
|-----------|------------|-------------|
| MySQL 9.7 | LTS        | 2034-04-21  |
| MySQL 8.4 | LTS        | 2032-04-30  |

MySQL 8.0 reached end of life on 30 April 2026, three weeks before the WordPress 7.0 release. Sites still on MySQL 8.0 should be migrated to 8.4 LTS.

### MariaDB

| Version      | Type | End of life |
|--------------|------|-------------|
| MariaDB 12.2 | —    | 2026-05-28  |
| MariaDB 11.8 | LTS  | 2028-06-04  |
| MariaDB 11.4 | LTS  | 2029-05-29  |
| MariaDB 10.11| LTS  | 2028-02-16  |
| MariaDB 10.6 | LTS  | 2026-07-06  |

MariaDB 10.6 was within weeks of its end-of-life date at the time of the 7.0 release and should not be used for new installations.

### Web servers

_TODO: confirm the current stable versions at the 7.0 release date before publishing. The handbook's [Server Environment](https://make.wordpress.org/hosting/handbook/server-environment/) page lists Apache HTTPD 2.4, nginx 1.26 & 1.27, Angie 1.7, LiteSpeed 6.x and OpenLiteSpeed 1.8, but the nginx entries in particular look stale._

## WordPress and PHP

PHP is the language WordPress is written in, and keeping it current matters for both security and performance.

**WordPress 7.0 is fully compatible with PHP 7.4 (1), 8.0 (1), 8.1 (1), 8.2, 8.3, 8.4 and 8.5.**

_(1) These PHP versions are end-of-life and are supported by WordPress for backward compatibility only. Use of supported PHP versions is strongly recommended._

The Core team retired the ["compatible with exceptions" label in April 2025](https://make.wordpress.org/core/2025/04/09/php-8-support-clarification/) and the ["beta support" label in May 2026](https://make.wordpress.org/core/2026/05/22/php-support-clarification-2026/). Both labels were removed retroactively from all WordPress versions, so this post uses neither.

## Related tickets

_TODO: pull the PHP-keyword ticket list for [Trac milestone 7.0](https://core.trac.wordpress.org/query?milestone=7.0&keywords=~php) and list each entry below._

Use this format exactly — the ticket number alone is the link text, with the description after the link:

```
- [#62061](https://core.trac.wordpress.org/ticket/62061): Prepare for PHP 8.4. _NOTE: Closed / Fixed_
```

Putting the description inside the link text breaks the Trac hovercards on make.wordpress.org. That regression has already been introduced and fixed twice ([#353](https://github.com/WordPress/hosting-handbook/issues/353), [#399](https://github.com/WordPress/hosting-handbook/issues/399)).

## Upgrading WordPress

For step-by-step upgrade paths from any older WordPress version, see [Upgrading WordPress](https://make.wordpress.org/hosting/handbook/upgrading/) in the Hosting Team handbook.

---

_Questions or corrections? Leave a comment below, or find us in the [#hosting channel](https://wordpress.slack.com/archives/hosting/) of the [WordPress Slack](https://make.wordpress.org/chat/)._
