# WordPress 7.1 Server Compatibility

The Hosting Team reviews the compatibility between each WordPress release and the server software it runs on: PHP, MySQL / MariaDB and the web server. This post covers **WordPress 7.1**, released on **19 August 2026**.

Previous compatibility articles:

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

Version | Status at release | End of life
---- | ---- | ----
PHP 8.5 | Active Support | 2029-12-31
PHP 8.4 | Active Support | 2028-12-31
PHP 8.3 | Security Support | 2027-12-31
PHP 8.2 | Security Support | 2026-12-31

PHP 8.2 reaches end of life on 31 December 2026, roughly four months after this release. Hosts should plan migrations for sites still on 8.2.

### MySQL

Version | Type | End of life
---- | ---- | ----
MySQL 9.7 | LTS | 2034-04-21
MySQL 8.4 | LTS | 2032-04-30

MySQL 8.0 reached end of life on 30 April 2026 and should no longer be used.

### MariaDB

Version | Type | End of life
---- | ---- | ----
MariaDB 12.3 | LTS | 2029-06-12
MariaDB 11.8 | LTS | 2028-06-04
MariaDB 11.4 | LTS | 2029-05-29
MariaDB 10.11 | LTS | 2028-02-16

MariaDB 10.6 reached end of life on 6 July 2026 and is no longer listed.

### Web servers

The versions below are current and receiving fixes at the 7.1 release.

Software | Version at release | Released
---- | ---- | ----
Apache HTTPD | 2.4.68 | 2026-06-08
nginx | 1.30.4 (stable) / 1.31.3 (mainline) | 2026-07-15
Angie | 1.12.1 | 2026-07-17
LiteSpeed Web Server | 6.3.6 | 2026-07-10
OpenLiteSpeed | 1.9.2 (latest) / 1.8.5 (stable) | 2026-08-06 / 2026-01-08

Two of these projects ship a supported branch that is not their newest release, which matters if you would rather not follow every version. nginx maintains a stable branch alongside mainline and retires the previous stable each April, so 1.30 is the conservative choice. OpenLiteSpeed labels 1.8.x stable and 1.9.x latest, and ships both.

The other three do not offer that choice. Apache HTTPD patches only the newest 2.4.x, and Angie and LiteSpeed Web Server each release on a single line, so for those three the current version is the only one receiving fixes.

Anything older than the versions above has stopped receiving fixes. nginx 1.26 and 1.27 went end of life in April and June 2025, and 1.28 and 1.29 followed in April and May 2026.

## WordPress and PHP

PHP is the language WordPress is written in, and keeping it current matters for both security and performance.

**WordPress 7.1 is fully compatible with PHP 7.4 (1), 8.0 (1), 8.1 (1), 8.2, 8.3, 8.4 and 8.5.**

_(1) These PHP versions are end-of-life and are supported by WordPress for backward compatibility only. Use of supported PHP versions is strongly recommended._

Verify against the Core team's [PHP Compatibility and WordPress Versions](https://make.wordpress.org/core/handbook/references/php-compatibility-and-wordpress-versions/) reference, which is updated for each release.

The Core team retired the ["compatible with exceptions" label in April 2025](https://make.wordpress.org/core/2025/04/09/php-8-support-clarification/) and the ["beta support" label in May 2026](https://make.wordpress.org/core/2026/05/22/php-support-clarification-2026/). Both labels were removed retroactively from all WordPress versions, so this post uses neither.

## Related tickets

Worth knowing if your servers are missing extensions:

- [#65342](https://core.trac.wordpress.org/ticket/65342): Charset: Polyfill `mb_ord()` and `mb_chr()`. _NOTE: Closed / Fixed._
- [#65143](https://core.trac.wordpress.org/ticket/65143): Code Modernization: Add a polyfill for `clamp()`. _NOTE: Closed / Fixed._

Modernization using functions from newer PHP versions, all of which WordPress polyfills so they stay safe on the 7.4 minimum:

- [#65408](https://core.trac.wordpress.org/ticket/65408): Code Modernization: Replace `strpos()` with `str_contains()`. _NOTE: Closed / Fixed._
- [#65403](https://core.trac.wordpress.org/ticket/65403): Code Modernization: Simplify node retrieval using the null coalescing operator. _NOTE: Closed / Fixed._
- [#65637](https://core.trac.wordpress.org/ticket/65637): Code Modernization: Avoid returning values in constructors. _NOTE: Closed / Fixed._
- [#65519](https://core.trac.wordpress.org/ticket/65519): Adoption of `array_any()` and `array_all()` across core.
- [#65598](https://core.trac.wordpress.org/ticket/65598): Adoption of `array_first()` and `array_last()`.
- [#64897](https://core.trac.wordpress.org/ticket/64897): Coding standards work for the 7.1 cycle, covering the null coalescing and `str_contains()` conversions.

The [WordPress 7.1 Field Guide](https://make.wordpress.org/core/2026/08/05/wordpress-7-1-field-guide/) is the starting point for what changed in this release, though it does not cover server requirements directly.

## Upgrading WordPress

For step-by-step upgrade paths from any older WordPress version, see [Upgrading WordPress](https://make.wordpress.org/hosting/handbook/upgrading/) in the Hosting Team handbook.

---

_Questions or corrections? Leave a comment below, or find us in the [#hosting channel](https://wordpress.slack.com/archives/hosting/) of the [WordPress Slack](https://make.wordpress.org/chat/)._
