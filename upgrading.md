# Upgrading (old) WordPress

Upgrading WordPress should be a simple task if you maintain and update it over time and adapt each major version to the [requirements of the moment](https://make.wordpress.org/hosting/handbook/server-environment/).

What happens with older versions? WordPress provides security support from WordPress 3.7 to the latest version, WordPress 6.0, each with its own database versions, PHP versions and a series of compatibilities that need to be updated over time. So, what if it is not updated?

On this page you will find some ideas and suggestions on how to upgrade, although you should always check the status and upgrade possibilities of the different resources available. In many cases it will not be possible to upgrade the operating system, include new PHP versions, so you will have to migrate your site to an updated hosting.

Many assumptions will be made in this document, as each case will be different. Before doing any kind of upgrade, please make a backup of all site data.

## WordPress 0.7 - 3.6

Goals:
- WordPress: upgrade to WordPress 6.0.
- PHP: upgrade to PHP 7.4
- SQL: upgrade to MySQL 8.0 / MariaDB 10.5

Losses:
- Content: none


These are the oldest versions of WordPress and the ones that have not been supported for years. In general, we will have to assume some losses, although not of the contents, but probably of some functionality of themes and plugins.

Considering that the goal is to keep the contents, assuming the loss of the rest of the elements, the simplest process is to create a new WordPress (only the files), create a database with a copy of the WordPress to recover, configure the wp-config.php, and follow the update process that will start once the page is visited again.

In this way we will be able to maintain and update the elements of the database and be able to work with these contents in an updated version of WordPress.

A common problem we find in these database restorations is the character encoding type. It is very likely that they are not in UTF8 (but in some ISO or ASCII format), so we will have to make sure that the character encoding is updated correctly.

## WordPress 3.7 - 4.0

Goals
- WordPress: upgrade to WordPress 4.1.
- PHP: upgrade to PHP 5.6
- SQL: upgrade to MySQL 5.6 / MariaDB 10.0





## WordPress 4.1 - 4.9

Goal: upgrade to WordPress 5.0.


## WordPress 5.0 - 5.2

Goal: upgrade to WordPress 5.3.


## WordPress 5.3 - 5.9

Goal: upgrade to WordPress 6.0.



## Changelog

- 2022-07-14: First something... (this is not a real changelog, yet)
- 2022-06-22: Nothing yet!
