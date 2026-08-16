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

Version | Status at release | End of life
---- | ---- | ----
PHP 8.5 | Active Support | 2029-12-31
PHP 8.4 | Active Support | 2028-12-31
PHP 8.3 | Security Support | 2027-12-31
PHP 8.2 | Security Support | 2026-12-31

PHP 8.1 reached end of life on 31 December 2025 and was no longer supported upstream when WordPress 7.0 shipped.

### MySQL

Version | Type | End of life
---- | ---- | ----
MySQL 9.7 | LTS | 2034-04-21
MySQL 8.4 | LTS | 2032-04-30

MySQL 8.0 reached end of life on 30 April 2026, three weeks before the WordPress 7.0 release. Sites still on MySQL 8.0 should be migrated to 8.4 LTS.

### MariaDB

Version | Type | End of life
---- | ---- | ----
MariaDB 12.2 | — | 2026-05-28
MariaDB 11.8 | LTS | 2028-06-04
MariaDB 11.4 | LTS | 2029-05-29
MariaDB 10.11 | LTS | 2028-02-16
MariaDB 10.6 | LTS | 2026-07-06

MariaDB 10.6 was within weeks of its end-of-life date at the time of the 7.0 release and should not be used for new installations.

### Web servers

The versions below were current and receiving fixes on 20 May 2026.

Software | Version at release | Released
---- | ---- | ----
Apache HTTPD | 2.4.67 | 2026-05-04
nginx | 1.30.1 (stable) / 1.31.0 (mainline) | 2026-05-13
Angie | 1.11.5 | 2026-05-15
LiteSpeed Web Server | 6.3.5 | 2026-03-24
OpenLiteSpeed | 1.9.0.1 (latest) / 1.8.5 (stable) | 2026-04-22 / 2026-01-08

Two of these projects ship a supported branch that is not their newest release, which matters if you would rather not follow every version. nginx maintains a stable branch alongside mainline and retires the previous stable each April, so 1.30 was the conservative choice on the 7.0 release date. OpenLiteSpeed labels 1.8.x stable and 1.9.x latest, and ships both.

The other three do not offer that choice. Apache HTTPD patches only the newest 2.4.x, and Angie and LiteSpeed Web Server each release on a single line, so for those three the current version is the only one receiving fixes.

Check which branch you were on rather than assuming it was current. nginx retired 1.29 on 13 May 2026, a week before WordPress 7.0 shipped, and 1.28 five weeks before that. The 1.26 and 1.27 branches had been end of life for over a year by then.

## WordPress and PHP

PHP is the language WordPress is written in, and keeping it current matters for both security and performance.

**WordPress 7.0 is fully compatible with PHP 7.4 (1), 8.0 (1), 8.1 (1), 8.2, 8.3, 8.4 and 8.5.**

_(1) These PHP versions are end-of-life and are supported by WordPress for backward compatibility only. Use of supported PHP versions is strongly recommended._

The Core team retired the ["compatible with exceptions" label in April 2025](https://make.wordpress.org/core/2025/04/09/php-8-support-clarification/) and the ["beta support" label in May 2026](https://make.wordpress.org/core/2026/05/22/php-support-clarification-2026/). Both labels were removed retroactively from all WordPress versions, so this post uses neither.

## Related tickets

The minimum version bump itself:

- [#62622](https://core.trac.wordpress.org/ticket/62622): Increase the minimum supported version of PHP to 7.4. _NOTE: Closed / Fixed._

PHP 8.5 support:

- [#64322](https://core.trac.wordpress.org/ticket/64322): Media: Adjustments for official HEIF/HEIC support added in PHP 8.5. _NOTE: Closed / Fixed._

Deprecation notices resolved in this release:

- [#64864](https://core.trac.wordpress.org/ticket/64864): Code Modernization: Fix "passing null to non-nullable" deprecation from `previous_posts()`. _NOTE: Closed / Fixed._
- [#64728](https://core.trac.wordpress.org/ticket/64728): Toolbar: Prevent PHP deprecation warning in admin bar when a node is added with a `null` parent. _NOTE: Closed / Fixed._
- [#64928](https://core.trac.wordpress.org/ticket/64928): Code Modernization: Replace the deprecated `auto_detect_line_endings` setting. _NOTE: Closed / Fixed._

Modernization the 7.4 minimum unblocked. [#58874](https://core.trac.wordpress.org/ticket/58874) had been deferred since WordPress 6.8 because the null coalescing operator was not available on every supported version. Dropping PHP 7.2 and 7.3 closed it:

- [#58874](https://core.trac.wordpress.org/ticket/58874): Code Modernization: Consider using the null coalescing operator. _NOTE: Closed / Fixed._
- [#63430](https://core.trac.wordpress.org/ticket/63430): Code Modernization: Replace `isset()` ternary checks with the null coalescing operator. _NOTE: Closed / Fixed._
- [#64488](https://core.trac.wordpress.org/ticket/64488): Code Modernization: Replace `if` statements with the null coalescing operator. _NOTE: Closed / Fixed._
- [#64497](https://core.trac.wordpress.org/ticket/64497): Code Modernization: Utilize the spaceship operator in sort comparison logic. _NOTE: Closed / Fixed._
- [#64773](https://core.trac.wordpress.org/ticket/64773): Code Modernization: Use `str_starts_with()` in `WP_Duotone` class methods. _NOTE: Closed / Fixed._

Worth knowing if you run the servers:

- [#64332](https://core.trac.wordpress.org/ticket/64332): Database: Further correct the MariaDB version check in `wpdb::has_cap()`. _NOTE: Closed / Fixed._
- [#63697](https://core.trac.wordpress.org/ticket/63697): Site Health: Add test and debug data for opcode cache. _NOTE: Closed / Fixed._

## Upgrading WordPress

For step-by-step upgrade paths from any older WordPress version, see [Upgrading WordPress](https://make.wordpress.org/hosting/handbook/upgrading/) in the Hosting Team handbook.

---

_Questions or corrections? Leave a comment below, or find us in the [#hosting channel](https://wordpress.slack.com/archives/hosting/) of the [WordPress Slack](https://make.wordpress.org/chat/)._
