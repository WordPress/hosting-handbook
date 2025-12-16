# Upgrading WordPress

Upgrading WordPress should be a simple task if it's maintained and updated over time and adapted to each major version with the [requirements of that moment](https://make.wordpress.org/hosting/handbook/server-environment/).

**What happens with older versions?**

As a courtesy, the WordPress project makes an effort to provide security support from WordPress 4.7 to the latest version. However, backporting patches is not always possible and therefore versions of WordPress prior to the very latest version are _not officially supported_ as a result.

Each version has its own supported database versions, PHP versions, and a series of compatibilities that need to be updated over time.

**What if it is not updated?**

On this page there are some ideas and suggestions on how to upgrade. In many cases it will not be possible to upgrade the operating system, include new PHP versions, so you will have to migrate WordPress to an updated hosting.

Many assumptions will be made in this document, as each case will be different. Before doing any kind of upgrade, please make a backup of all site data: WordPress files, Database, Certificates and OS / Services configurations.

IMPORTANT: This is a very manual process, not a massive one. There will probably be losses and some updates will be needed after the upgrade.

[tip]In case only a major version (X.X) is indicated, use its minor (X.X.x) latest version available.[/tip]

## Using WP-CLI for upgrades

If WP-CLI is available on your hosting environment, some parts of the upgrade process can be simplified. Always make sure you have a full backup of the files and the database before running any commands.

For the latest and complete list of `wp core` commands and options, please refer to the official WP-CLI documentation:

https://developer.wordpress.org/cli/commands/core/


## Upgrading from WordPress 0.7 - 3.6 (by migration)

Goals:
- WordPress: upgrade to WordPress 6.2
- PHP: upgrade to PHP 7.4
- SQL: upgrade to MySQL 8.0 / MariaDB 10.11

Losses:
- Content: none
- Plugins: all
- Themes: all

These are the oldest versions of WordPress and the ones that have not been supported for years. In general, have to assume some losses, although not of the contents, but probably of some functionality on themes and plugins.

Considering that the goal is to keep the contents and assuming the loss of the rest of the elements, there are some steps.

As with any upgrade, the first thing to do is to make a backup copy. The best way to upgrade from WP < 3.6 is to perform a content migration. 

1. Create a brand-new WordPress, without the database.
2. Copy the old WordPress files from the "/wp-content/uploads/" content to the new one.
3. Create a new database with the old database information. The best way is using "mysqldump".
4. Configure the wp-config.php with all the new data.
5. Access the "/wp-admin/" page, and follow the upgrading process.

This way, WordPress will be able to maintain and update the contents in the database and be able to work with these contents in an updated version of WordPress.

A WordPress with the default theme, and all the contents should now be available.

Character Encoding commonly presents technical hiccups when restoring a database. It is possible that backup data is not encoded in UTF-8 and instead may be in an ISO or ASCII "deprecated" format. Make sure that the character encoding is updated correctly upon restoring a database! More information on [converting Character Sets in a WordPress database can be found here](https://codex.wordpress.org/Converting_Database_Character_Sets).

---

## Upgrading from WordPress 3.7 - 4.0

Goals:
- WordPress: upgrade to WordPress 4.1
- PHP: upgrade to PHP 5.6.20+
- SQL: upgrade to MySQL 5.6 / MariaDB 10.0

Losses:
- Content: none
- Plugins: probably yes
- Themes: probably yes

WordPress Versions <= 4.0 are compatible with PHP versions that are hardly available today. They can range from PHP 5.2 (or even earlier) to PHP 5.5.

WP-CLI does not work below PHP 5.6.20, so this update must be manual.

Follow these steps:
- Back up everything
- Remove unused themes
- Activate Twenty Ten
- Delete deactivated plugins
- Deactivate all active plugins

Then overwrite the WordPress Core with WordPress 4.1.

Upgrade PHP to 5.6.20+ and SQL to MySQL 5.6 / MariaDB 10.0.

Access `/wp-admin/` and complete the upgrade.

Proceed next to WordPress 4.9 upgrade.

---

## Upgrading from WordPress 4.1 - 4.8

Goals:
- WordPress: upgrade to WordPress 4.9
- PHP: upgrade to PHP 7.2
- SQL: maintain or upgrade to MySQL 5.6 / MariaDB 10.0

Losses:
- Content: none
- Plugins: probably yes
- Themes: probably yes

Follow the cleanup process again:
- Remove unused themes
- Activate Twenty Ten
- Delete unused plugins

Overwrite WordPress core with WordPress 4.9.  
Upgrade PHP to 7.2.

Proceed next to WordPress 5.3 upgrade.

---

## WordPress 4.9 - 5.2

Goals:
- WordPress: upgrade to WordPress 5.3
- PHP: upgrade to PHP 7.4
- SQL: upgrade to MySQL 8.0 / MariaDB 10.3

Losses:
- Content: none
- Plugins: probably no
- Themes: probably no

Major notes:
- WordPress 4.9 was the last Classic Editor version.
- WordPress 5.0+ fully supports Classic Editor content.

Follow the same cleanup steps:
- Activate Twenty Ten  
- Deactivate plugins  
- Replace core with WordPress 5.3  

Then upgrade PHP to 7.4 and SQL to MySQL 8.0 / MariaDB 10.3.

---

## WordPress 5.3 - 6.2

Goals:
- WordPress: upgrade to WordPress 6.2
- PHP: upgrade to PHP 7.4
- SQL: upgrade to MySQL 8.0 LTS / MariaDB 10.11 LTS

Losses:
- Content: none
- Plugins: no
- Themes: no

Upgrade normally. Everything should work.

---

## WordPress 6.3 - 6.8

Goals:
- WordPress: upgrade to WordPress 6.8
- PHP: upgrade to PHP 8.1
- SQL: upgrade to MySQL 8.0 LTS / MariaDB 10.11 LTS

Losses:
- Content: none
- Plugins: no
- Themes: no

PHP changes:
- WP 6.3 dropped PHP 5.6  
- WP 6.6 dropped PHP 7.0 & 7.1  
- WP 6.6 requires PHP 7.2.24+  

Upgrade normally. Everything should work fine.