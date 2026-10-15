# WordPress 7.2 Server Compatibility

The Hosting Team reviews the compatibility between each WordPress release and the server software it runs on: PHP, MySQL / MariaDB and the web server. This post covers **WordPress 7.2**, scheduled for release on **9 December 2026**.

Previous compatibility articles:

- [WordPress 7.1 Server Compatibility](https://make.wordpress.org/hosting/handbook/compatibility/version/7-1/)
- [WordPress 7.0 Server Compatibility](https://make.wordpress.org/hosting/handbook/compatibility/version/7-0/)
- [WordPress 6.9 Server Compatibility](https://make.wordpress.org/hosting/2026/05/27/wordpress-6-9-server-compatibility/)
- [WordPress 6.8 Server Compatibility](https://make.wordpress.org/hosting/2025/04/16/wordpress-6-8-server-compatibility/)
- [WordPress 6.7 Server Compatibility](https://make.wordpress.org/hosting/2024/11/05/wordpress-6-7-server-compatibility/)

This post focuses on new installations and on the best strategy for upgrading. It is not a discussion of how far backward compatibility reaches.

## Hosting Team recommendations

For a new WordPress 7.2 installation, the recommended minimum versions are:

- **PHP**: 8.4.x, 8.5.x
- **MySQL**: 8.4.x
- **MariaDB**: 10.11.x, 11.4.x, 11.8.x

These recommendations are for **new installations**. They favour the most recent compatible versions rather than the oldest ones that still work.

PHP 8.6 is not yet part of the recommendation. It is released only three weeks before WordPress 7.2, and the Core test suite was still being brought up to date for it during the 7.2 cycle (see the WordPress and PHP section below).

### Where do the recommendations come from?

The Hosting Team reviews, for each WordPress release, which versions of PHP and of the database engines are still receiving security support from their own upstream projects at the time of the release, and cross-references that against the compatibility work done in WordPress Core. A version that is end-of-life upstream is never recommended, even when WordPress still runs on it.

## WordPress server requirements

WordPress supports older software for backward compatibility. The absolute minimums for WordPress 7.2 are:

- **PHP**: 7.4+
- **MySQL**: 5.5.5+
- **MariaDB**: 5.5.5+

This is unchanged from WordPress 7.0 and 7.1, confirmed against `$required_php_version` and `$required_mysql_version` in `src/wp-includes/version.php` on trunk.

The full requirements are documented on the [WordPress Requirements page](https://wordpress.org/about/requirements/).

## WordPress compatibility at the time of release

The following versions are available and receiving security support as of 9 December 2026.

### PHP

Version | Status at release | End of life
---- | ---- | ----
PHP 8.6 | Active Support | 2030-12-31
PHP 8.5 | Active Support | 2029-12-31
PHP 8.4 | Active Support | 2028-12-31
PHP 8.3 | Security Support | 2027-12-31
PHP 8.2 | Security Support | 2026-12-31

PHP 8.6 was released on 19 November 2026. Two changes happen on 31 December 2026, three weeks after this release: PHP 8.2 reaches end of life, and PHP 8.4 moves from active support to security-only support. Hosts should finish migrating sites off PHP 8.2 before the end of the year.

### MySQL

Version | Type | End of life
---- | ---- | ----
MySQL 26.7 | Innovation | when the next Innovation release ships
MySQL 9.7 | LTS | 2034-04-21
MySQL 8.4 | LTS | 2032-04-30

MySQL moved to calendar versioning after 9.7, so the first Innovation release after it is 26.7, released in July 2026. Innovation releases are only supported until the next one ships, so they are listed for completeness but are not recommended for new installations.

### MariaDB

Version | Type | End of life
---- | ---- | ----
MariaDB 13.0 | — | when MariaDB 13.1 is released
MariaDB 12.3 | LTS | 2029-06-12
MariaDB 11.8 | LTS | 2028-06-04
MariaDB 11.4 | LTS | 2029-05-29
MariaDB 10.11 | LTS | 2028-02-16

MariaDB 13.0 is a rolling release. It stops receiving fixes as soon as the next rolling release ships, so it is listed for completeness but is not recommended for new installations. MariaDB 12.3 LTS is the newest long-term release.

### Web servers

The versions below are current and receiving fixes at the 7.2 release.

Software | Version at release | Released
---- | ---- | ----
Apache HTTPD | 2.4.68 | 2026-06-08
nginx | 1.30.5 (stable) / 1.31.6 (mainline) | 2026-09-15
Angie | 1.12.2 | 2026-09-18
LiteSpeed Web Server | 6.3.7 | 2026-09-23
OpenLiteSpeed | 1.9.3 (latest) / 1.8.5 (stable) | 2026-09-30 / 2026-01-08

nginx and OpenLiteSpeed each maintain a supported branch that is not their newest release. nginx keeps a stable branch alongside mainline, so 1.30 is the conservative choice. OpenLiteSpeed labels 1.8.x stable and 1.9.x latest, and ships both.

Apache HTTPD patches only the newest 2.4.x, and Angie and LiteSpeed Web Server each release on a single line, so for those three the current version is the only one receiving fixes.

## WordPress and PHP

PHP is the language WordPress is written in, and keeping it current matters for both security and performance.

**WordPress 7.2 is fully compatible with PHP 7.4 (1), 8.0 (1), 8.1 (1), 8.2, 8.3, 8.4 and 8.5.**

_(1) These PHP versions are end-of-life and are supported by WordPress for backward compatibility only. Use of supported PHP versions is strongly recommended._

The PHPUnit test suite started running against PHP 8.6 during the 7.2 cycle ([#65904](https://core.trac.wordpress.org/ticket/65904)). Those test jobs were allowed to fail while the remaining compatibility issues were addressed. Check the Core team's [PHP Compatibility and WordPress Versions](https://make.wordpress.org/core/handbook/references/php-compatibility-and-wordpress-versions/) reference for the current PHP 8.6 status before offering it to customers.

The Core team retired the ["compatible with exceptions" label in April 2025](https://make.wordpress.org/core/2025/04/09/php-8-support-clarification/) and the ["beta support" label in May 2026](https://make.wordpress.org/core/2026/05/22/php-support-clarification-2026/). Both labels were removed retroactively from all WordPress versions, so this post uses neither.

### PHP 8.6 and mbstring regular expressions

PHP 8.6 deprecates all `mbstring` regular expression functions, including the `mb_ereg*()` family and `mb_split()`, and they are due to be removed in PHP 9.0. The library behind them, Oniguruma, is no longer maintained. See the [PHP RFC](https://wiki.php.net/rfc/eol-oniguruma) for details.

WordPress Core does not use these functions outside its test suite, which was updated in [#66137](https://core.trac.wordpress.org/ticket/66137). Plugins and themes that still call them will log deprecation notices on PHP 8.6. The PECL package `mb_onig` keeps the functions available for code that cannot be updated yet. The recommended replacement is the PCRE functions with the `/u` modifier.

## Related tickets

Deprecations in PHP 8.5 and 8.6:

- [#65904](https://core.trac.wordpress.org/ticket/65904): Build/Test Tools: Run PHPUnit tests against PHP 8.6. _NOTE: Closed / Fixed._
- [#66137](https://core.trac.wordpress.org/ticket/66137): Tests: Replace deprecated `mb_split()` with `preg_split()`. _NOTE: Closed / Fixed._
- [#65965](https://core.trac.wordpress.org/ticket/65965): Code Modernization: Replace `socket_set_timeout()` usage in the Snoopy library, deprecated in PHP 8.5. _NOTE: Closed / Fixed._

Modernization using functions from newer PHP versions, all of which WordPress polyfills so they stay safe on the 7.4 minimum:

- [#65773](https://core.trac.wordpress.org/ticket/65773): Code Modernization: Use `array_key_first()` for an array's first key. _NOTE: Closed / Fixed._
- [#65818](https://core.trac.wordpress.org/ticket/65818): Code modernization work for the 7.2 cycle, including adoption of `array_find()`, `array_find_key()`, `array_all()` and `is_iterable()`.
- [#65823](https://core.trac.wordpress.org/ticket/65823): Adoption of the null coalescing assignment operator (`??=`) for default values.

## Upgrading WordPress

For step-by-step upgrade paths from any older WordPress version, see [Upgrading WordPress](https://make.wordpress.org/hosting/handbook/upgrading/) in the Hosting Team handbook.

---

_Questions or corrections? Leave a comment below, or find us in the [#hosting channel](https://wordpress.slack.com/archives/hosting/) of the [WordPress Slack](https://make.wordpress.org/chat/)._

_Page contents were AI assisted._
