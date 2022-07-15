# Upgrading (very old) WordPress

Upgrading WordPress should be a simple task if its maintained and updated over time and adapted to each major version with the [requirements of that moment](https://make.wordpress.org/hosting/handbook/server-environment/).

**What happens with older versions?**

WordPress provides security support from WordPress 3.7 to the latest version (WordPress 6.0, __when creating this document__), each with its own database versions, PHP versions and a series of compatibilities that need to be updated over time.

**What if it is not updated?**

On this page there are some ideas and suggestions on how to upgrade. In many cases it will not be possible to upgrade the operating system, include new PHP versions, so will have to migrate WordPress to an updated hosting.

Many assumptions will be made in this document, as each case will be different. Before doing any kind of upgrade, please make a backup of all site data: WordPress files, Database, Certificates and OS / Services configurations.

IMPORTANT: This is a very manual process, not a massive one. There will be probably losses and some updates will be needed after the upgrade.

[tip]In case only a major version (X.X) is indicated, use its minor (X.X.x) latest version available.[/tip]

## Upgrading from WordPress 0.7 - 3.6

Goals:
- WordPress: upgrade to WordPress 6.0
- PHP: upgrade to PHP 7.4
- SQL: upgrade to MySQL 8.0 / MariaDB 10.5

Losses:
- Content: none
- Plugins: all
- Themes: all

These are the oldest versions of WordPress and the ones that have not been supported for years. In general, have to assume some losses, although not of the contents, but probably of some functionality on themes and plugins.

Considering that the goal is to keep the contents and assuming the loss of the rest of the elements, there are some steps.

As with any upgrade, the first thing to do is to make a backup copy.

Create a brand-new WordPress, withoud the database.

Copy the old WordPress files from the "/wp-content/uploads/" content to the new one.

Create a new database with the old database information. The best way is using "mysqldump".

Configure the wp-config.php with all the new data.

Access the "/wp-admin/" page, and follow the upgrading process.

With this way, WordPress will be able to maintain and update the contents in the database and be able to work with these contents in an updated version of WordPress.

A WordPress with the default theme, and all the contents should be available.

A common problem found in these database restorations is the character encoding type. It is very likely that its not in UTF-8 (maybe in an ISO or ASCII "deprecated" format), so make sure that the character encoding is updated correctly.

## Upgrading from WordPress 3.7 - 4.0

Goals
- WordPress: upgrade to WordPress 4.1
- PHP: upgrade to PHP 5.6.20+
- SQL: upgrade to MySQL 5.6 / MariaDB 10.0

Losses:
- Content: none
- Plugins: probably yes
- Themes: probably yes

These WordPress are compatible with PHP versions that are hardly available today. They can range from PHP 5.2 (or even earlier) to PHP 5.5. That is why the main goal will be to go to a version that is still easy to get on many operating systems.

The same will happen with the database. It is very likely that there is a MySQL 5.5 or earlier. Depending on whether want to continue with MySQL or move to MariaDB, choose which way to go and migrate the database to a MySQL 5.6 or MariaDB 10.0.

Note that WP-CLI is not available for PHP versions lower than PHP 5.6.20, so this process still must be done somewhat manually.

As with any upgrade, the first thing to do is to make a backup copy.

Remove all themes that are not active, leaving only the main theme. If there is a child theme active, please, maintain the child and parent.

Install and activate the [Twenty Ten](https://wordpress.org/themes/twentyten/) theme and activate it. This theme works in all sites since WordPress 3.7.

In the same way, delete all deactivated plugins (and, therefore, not working).

Deactivate all left active plugins.

Now, WordPress will have:
-	Core: any version (between WordPress 3.7 and WordPress 4.0)
-	Themes: Twenty Ten is active, and the main theme is deactivated.
-	Plugins: all plugins that should be active are deactivated.

At this point, overwrite the WordPress Core with [WordPress 4.1](https://wordpress.org/wordpress-4.1.zip), available in the [release list](https://wordpress.org/download/releases/). Install WordPress 4.1 major version or, if available and recommended, the latest 4.1.x minor version.

Upgrade the systems up to PHP 5.6.20+ and MySQL 5.6.x or MariaDB 10.0.x. Please, do not install a newest major version.

Access the "/wp-admin/" page, and follow the upgrading process.

WordPress will be able to maintain and update the contents in the database and be able to work with these contents. WordPress, with the default theme and all the contents should be available and working.

A common problem found in these database restorations is the character encoding type. It is very likely that its not in UTF-8 (maybe in an ISO or ASCII "deprecated" format), so make sure that the character encoding is updated correctly.

Proceed to the next step, which is upgrade to WordPress 4.9 from WordPress 4.1.

## Upgrading from WordPress 4.1 - 4.8

Goals
- WordPress: upgrade to WordPress 4.9
- PHP: upgrade to PHP 7.2
- SQL: maintain or upgrade to MySQL 5.6 / MariaDB 10.0

Losses:
- Content: none
- Plugins: probably yes
- Themes: probably yes

__If you don't have PHP 5.6.20+ configured yet, do it. Chances are that everything will still work normally.__

From WordPress 4.1 and PHP 5.6.20+, you can continue with the manual update process, or start using [WP-CLI](https://wp-cli.org/), the tool to run WordPress commands directly via console, something that can easy the process.

As with any upgrade, the first thing to do is to make a backup copy.

Remove all themes that are not active, leaving only the main theme. If there is a child theme active, please, maintain the child and parent.

Install and activate the [Twenty Ten](https://wordpress.org/themes/twentyten/) theme and activate it. This theme works in all sites since WordPress 3.7.

In the same way, delete all deactivated plugins (and, therefore, not working).

Now, WordPress will have:
-	Core: any version (between WordPress 4.1 and WordPress 4.8)
-	Themes: Twenty Ten is active, and the main theme is deactivated.
-	Plugins: all plugins that should be active are deactivated.

At this point, overwrite the WordPress Core with [WordPress 4.9](https://wordpress.org/wordpress-4.9.zip), available in the [release list](https://wordpress.org/download/releases/). Install WordPress 4.9 major version or, if available and recommended, the latest 4.9.x minor version.

Upgrade the systems up to PHP 7.2 and, if they are not already, to MySQL 5.6.x or MariaDB 10.0.x. Please, do not install a newest major version.

Access the "/wp-admin/" page, and follow the upgrading process.

WordPress will be able to maintain and update the contents in the database and be able to work with these contents. WordPress, with the default theme and all the contents should be available and working.

A common problem found in these database restorations is the character encoding type. It is very likely that its not in UTF-8 (maybe in an ISO or ASCII "deprecated" format), so make sure that the character encoding is updated correctly.

Proceed to the next step, which is upgrade to WordPress 5.3 from WordPress 4.9.

## WordPress 4.9 - 5.2

Goals
- WordPress: upgrade to WordPress 5.3
- PHP: upgrade to PHP 7.4
- SQL: maintain or upgrade to MySQL 8.0 / MariaDB 10.3

Losses:
- Content: none
- Plugins: probably no
- Themes: probably no

__If you don't have PHP 7.2 configured yet, do it. Chances are that everything will still work normally.__







## WordPress 5.3 - 5.9

Goals
- WordPress: upgrade to WordPress 6.0
- PHP: upgrade to PHP 7.4
- SQL: maintain or upgrade to MySQL 8.0 / MariaDB 10.5

Losses:
- Content: none
- Plugins: probably no
- Themes: probably no

__If you don't have PHP 7.4 configured yet, do it. Chances are that everything will still work normally.__






## Changelog

- 2022-07-14: First something... (this is not a real changelog, yet)
- 2022-06-22: Nothing yet!
