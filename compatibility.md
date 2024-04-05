# WordPress Compatibility

The relationship between WordPress, PHP and MySQL / MariaDB is very close, and it is very important that the versions of these technologies match for proper operation. The following matrix is focused on information for hosting companies and sysadmins.

[tip]If you are a developer, you will also be interested in the [PHP Compatibility and WordPress Versions](https://make.wordpress.org/core/handbook/references/php-compatibility-and-wordpress-versions/) document from the Core team.[/tip]

## WordPress, PHP, MySQL / MariaDB versions

This table shows the versions available (and security supported) at the time of the WordPress release. It does not mean that WordPress provided 100% full support for those versions (but usually does).

WordPress | PHP | MySQL | MariaDB | Launch date
---- | ---- | ---- | ---- | ----
WordPress 6.5 | 8.1 - 8.3 | 8.0 - 8.3 | 10.4-10.6 + 10.11 + 11.0-11.3 | 2024-04-02
WordPress 6.4 | 8.0 - 8.2 | 8.0 - 8.2 | 10.4-10.6 + 10.10-11.1 | 2023-11-07
WordPress 6.3 | 8.0 - 8.2 | 5.7 - 8.1 | 10.4-10.6 + 10.9-11.0 | 2023-08-08
WordPress 6.2 | 8.0 - 8.2 | 5.7 - 8.0 | 10.3 - 10.11 | 2023-03-28
WordPress 6.1 | 7.4 - 8.1 | 5.7 - 8.0 | 10.3 - 10.6 | 2022-11-01
WordPress 6.0 | 7.4 - 8.1 | 5.7 - 8.0 | 10.3 - 10.6 | 2022-05-24
WordPress 5.9 | 7.4 - 8.1 | 5.7 - 8.0 | 10.2 - 10.6 | 2022-01-25
WordPress 5.8 | 7.3 - 8.0 | 5.7 - 8.0 | 10.2 - 10.6 | 2021-07-20
WordPress 5.7 | 7.3 - 8.0 | 5.7 - 8.0 | 10.2 - 10.5 | 2021-03-09
WordPress 5.6 | 7.3 - 8.0 | 5.7 - 8.0 | 10.2 - 10.5 | 2020-12-08
WordPress 5.5 | 7.2 - 7.4 | 5.7 - 8.0 | 10.2 - 10.5 | 2020-08-11
WordPress 5.4 | 7.2 - 7.4 | 5.6 - 8.0 | 10.2 - 10.4 | 2020-03-31
WordPress 5.3 | 7.2 - 7.4 | 5.6 - 8.0 | 10.2 - 10.4 | 2019-11-12
WordPress 5.2 | 7.1 - 7.3 | 5.6 - 8.0 | 10.1 - 10.3 | 2019-05-07
WordPress 5.1 | 7.1 - 7.3 | 5.6 - 8.0 | 10.1 - 10.3 | 2019-02-21
WordPress 5.0 | 7.1 - 7.3 | 5.6 - 8.0 | 10.1 - 10.3 | 2018-12-06
WordPress 4.9 | 7.0 - 7.2 | 5.5 - 5.7 | 10.0 - 10.2 | 2017-11-15
WordPress 4.8 | 5.6 - 7.1 | 5.5 - 5.7 | 10.0 - 10.2 | 2017-06-08
WordPress 4.7 | 5.6 - 7.1 | 5.5 - 5.7 | 5.5 - 10.1 | 2016-12-06
WordPress 4.6 | 5.6 - 7.0 | 5.5 - 5.7 | 5.5 - 10.1 | 2016-08-16
WordPress 4.5 | 5.6 - 7.0 | 5.5 - 5.7 | 5.5 - 10.1 | 2016-04-12
WordPress 4.4 | 5.5 - 7.0 | 5.5 - 5.7 | 5.5 - 10.1 | 2015-12-08
WordPress 4.3 | 5.5 - 5.6 | 5.5 - 5.6 | 5.5 - 10.0 | 2015-08-18
WordPress 4.2 | 5.4 - 5.6 | 5.5 - 5.6 | 5.5 - 10.0 | 2015-04-23
WordPress 4.1 | 5.4 - 5.6 | 5.5 - 5.6 | 5.5 - 10.0 | 2014-12-17
WordPress 4.0 | 5.4 - 5.6 | 5.5 - 5.6 | 5.5 - 10.0 | 2014-09-04
WordPress 3.9 | 5.3 - 5.5 | 5.5 - 5.6 | 5.5 - 10.0 | 2014-04-16
WordPress 3.8 | 5.3 - 5.5 | 5.5 - 5.6 | 5.5 | 2013-12-12
WordPress 3.7 | 5.3 - 5.5 | 5.5 - 5.6 | 5.5 | 2013-10-24

## Server requirements

This table gives you a snapshot of how WordPress has changed its minimum requirements over time, especially when it comes to PHP and database versions.

WordPress | PHP | MySQL | MariaDB
---- | ---- | ---- | ----
WordPress 6.5+ | 7.0+ | 5.5.5+ | 5.5.5+
WordPress 6.3+ | 7.0+ | 5.0.15+ | 5.5+
WordPress 5.2+ | 5.6.20+ | 5.0.15+ | 5.5+
WordPress 3.2+ | 5.2.4+ | 5.0.15+ | 5.5+
WordPress 2.9+ | 4.3+ | 4.1.2+ | 
WordPress 2.5+ | 4.3+ | 4.0+ | 
WordPress 2.1+ | 4.2+ | 4.0+ | 
WordPress 2.0+ | 4.2+ | 3.23.23+ | 

## Changelog

- 2024-04-05: Updated to WordPress 6.5
- 2023-11-11: Updated to WordPress 6.4
- 2023-10-04: Updated to WordPress 6.4 (beta), and checked the MariaDB versions (and gaps)
- 2023-08-09: Added [Server requirements](https://codex.wordpress.org/Template:Server_requirements)
- 2023-08-09: Update for WordPress 6.3
- 2023-04-03: Minor grammatical fixes
- 2023-02-17: Updated with WordPress 6.2 beta information
- 2022-11-16: Updated with WordPress 6.1 information; improved table visualization
- 2022-06-06: [Delete MariaDB 10.2](https://core.trac.wordpress.org/ticket/55791)
- 2022-06-02: Published from Github
