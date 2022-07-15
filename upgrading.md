# Upgrading (old) WordPress

Upgrading WordPress should be a simple task if you maintain and update it over time and adapt each major version to the [requirements of the moment](https://make.wordpress.org/hosting/handbook/server-environment/).

What happens with older versions? WordPress provides security support from WordPress 3.7 to the latest version, WordPress 6.0, each with its own database versions, PHP versions and a series of compatibilities that need to be updated over time. So, what if it is not updated?

On this page you will find some ideas and suggestions on how to upgrade, although you should always check the status and upgrade possibilities of the different resources available. In many cases it will not be possible to upgrade the operating system, include new PHP versions, so you will have to migrate your site to an updated hosting.

Many assumptions will be made in this document, as each case will be different. Before doing any kind of upgrade, please make a backup of all site data.

## WordPress 0.7 - 3.6

Goals:
- WordPress: upgrade to WordPress 6.0
- PHP: upgrade to PHP 7.4
- SQL: upgrade to MySQL 8.0 / MariaDB 10.5

Losses:
- Content: none
- Plugins: all
- Themes: all

These are the oldest versions of WordPress and the ones that have not been supported for years. In general, we will have to assume some losses, although not of the contents, but probably of some functionality of themes and plugins.

Considering that the goal is to keep the contents, assuming the loss of the rest of the elements, the simplest process is to create a new WordPress (only the files), create a database with a copy of the WordPress to recover, configure the wp-config.php, and follow the update process that will start once the page is visited again.

In this way we will be able to maintain and update the elements of the database and be able to work with these contents in an updated version of WordPress.

A common problem we find in these database restorations is the character encoding type. It is very likely that they are not in UTF8 (but in some ISO or ASCII format), so we will have to make sure that the character encoding is updated correctly.

## WordPress 3.7 - 4.0

Goals
- WordPress: upgrade to WordPress 4.1
- PHP: upgrade to PHP 5.6
- SQL: upgrade to MySQL 5.6 / MariaDB 10.0

Losses:
- Content: none
- Plugins: probably
- Themes: probably

These WordPress are compatible with PHP versions that are hardly available to anyone today. They can range from PHP 5.2 (or even earlier) to PHP 5.5. That's why our main goal will be to go to a version that is still easy to get on many operating systems and hosting.

The same will happen with the database. It is very likely that there is a MySQL 5.5 or earlier. Depending on whether we want to continue with MySQL or move to MariaDB, we will have to choose which way to go and migrate the database to a MySQL 5.6 or MariaDB 10.0.

Note that WP-CLI is not available for versions lower than PHP 5.6, so this process still must be done somewhat manually.

As with any upgrade, the first thing to do is to make a backup copy.

We will remove all themes that are not active, leaving only the main theme. Once we have it, we will install and activate the [Twenty Ten](https://wordpress.org/themes/twentyten/) theme to leave a theme that works from WordPress 3.7 to the latest version.

In the same way, we will eliminate all those plugins that are deactivated (and, therefore, not working). Active plugins that remain there, will be deactivate.

At this time, we will have:
-	Core: any version (between WordPress 3.7 and WordPress 4.0)
-	Themes: Twenty Ten is active and the site theme is deactivated.
-	Plugins: all plugins that should be active, deactivated.

At this point we can overwrite the WordPress Core with the [WordPress 4.1 download](https://wordpress.org/wordpress-4.1.zip), available in the [release list](https://wordpress.org/download/releases/).

We upgraded to PHP 5.6 and MySQL 5.6 / MariaDB 10.0.

We will visit the website, access the WP-Admin and update the site with the automatic update process.

We can now proceed to the next step, which is to upgrade from WordPress 4.1 to 4.9.

## WordPress 4.1 - 4.9

Goal: upgrade to WordPress 5.0.


## WordPress 5.0 - 5.2

Goal: upgrade to WordPress 5.3.


## WordPress 5.3 - 5.9

Goal: upgrade to WordPress 6.0.



## Changelog

- 2022-07-14: First something... (this is not a real changelog, yet)
- 2022-06-22: Nothing yet!
