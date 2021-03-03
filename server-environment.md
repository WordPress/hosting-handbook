# Server Environment

Although WordPress can work in almost any environment, even very minimal ones, it must be acknowledged that it does not work completely well in these. That's why here we are going to make some minimum recommendations of the environment in which it would work most effectively.

## Web Server

The web server is the software dedicated to run the files of the website and where users come to consult them, mainly through the Web.

There are many web servers and, generally, any that support the execution of PHP files should be able to work with WordPress.

When it comes to the server, web, WordPress officially supports:

* [Apache HTTPD](https://httpd.apache.org/) 2.4.x
* [nginx](https://nginx.org/) 1.19.x / 1.18.x

Also, checked or used by hosting companies and developers:

* [LiteSpeed Web Server](https://www.litespeedtech.com/products/litespeed-web-server) 5.4.x / 5.3.x
* [OpenLiteSpeed](https://openlitespeed.org/) 1.7.x / 1.6.x

_WordPress may work with older versions, but we recommend only versions that are stable and supported._

Remember that if you have a website running in production, it is recommended to use the latest stable version of each of the web servers (mainly for security, rather than functionality), but not alpha, beta or candidate (RC) versions.

## PHP

PHP is a programming language on which WordPress code is based. This language runs on the server and it is important to keep it up to date, both for security and functionality.

WordPress supports many versions of PHP, some even obsolete, but as a general rule you should use only those with security or stable support.

Officially the WordPress core supports from PHP 7.0 to PHP 7.4. However, not all themes or plugins are supported.

When it comes to PHP, WordPress works best with the following versions:

* [PHP 7.4](https://www.php.net/ChangeLog-7.php#PHP_7_4).x
* [PHP 7.3](https://www.php.net/ChangeLog-7.php#PHP_7_3).x
* [PHP 7.2](https://www.php.net/ChangeLog-7.php#PHP_7_2).x

WordPress does work with PHP 5.6.20+. Versions prior to PHP 7.2 are not recommended because it doesn't have support of any kind, and only use PHP 7.2.x if you have the latest version, since it only has security support.

### PHP Extensions

WordPress core makes use of PHP extensions. If the preferred extension is missing WordPress will either have to do more work to do the task the module helps with or, in the worst case, will remove functionality. Therefore the PHP extensions listed below are recommended.

*   curl - Performs remote request operations.
*   dom - Used to validate Text Widget content and to automatically configure IIS7+.
*   exif - Works with metadata stored in images.
*   fileinfo - Used to detect mimetype of file uploads.
*   hash - Used for hashing, including passwords and update packages.
*   json - Used for communications with other servers.
*   mbstring - Used to properly handle UTF8 text.
*   mysqli - Connects to MySQL for database interactions.
*   sodium - Validates Signatures and provides securely random bytes.
*   openssl - Permits SSL-based connections to other hosts.
*   pcre - Increases performance of pattern matching in code searches.
*   imagick - Provides better image quality for media uploads. See [WP\_Image\_Editor is incoming!](https://make.wordpress.org/core/2012/12/06/wp_image_editor-is-incoming/) for details. Smarter image resizing (for smaller images) and PDF thumbnail support, when Ghost Script is also available.
*   xml - Used for XML parsing, such as from a third-party site.
*   zip - Used for decompressing Plugins, Themes, and WordPress update packages.

For the sake of completeness, below is a list of the remaining PHP modules WordPress _may_ use in certain situations or if other modules are unavailable. These are fallbacks or optional and not necessarily needed in an optimal environment, but installing them won't hurt.

*   filter – Used for securely filtering user input.
*   gd - If Imagick isn't installed, the GD Graphics Library is used as a functionally limited fallback for image manipulation.
*   iconv - Used to convert between character sets.
*   mcrypt - Generates random bytes when `libsodium` and `/dev/urandom` aren't available.
*   simplexml - Used for XML parsing.
*   xmlreader - Used for XML parsing.
*   zlib - Gzip compression and decompression.

These extensions are used for file changes, such as updates and plugin/theme installation, when files aren't writeable on the server.

*   ssh2
*   ftp
*   sockets (For when the ftp extension is unavailable)

The priority of the transports are Direct file IO, SSH2, FTP PHP Extension, FTP implemented with Sockets, and FTP implemented through PHP alone.

### System Packages

*   ImageMagick - Required by Imagick extension
*   Ghost Script - Enables Imagick/ImageMagick to generate PDF thumbnails for the media library. See [Enhanced PDF Support in WordPress 4.7](https://make.wordpress.org/core/2016/11/15/enhanced-pdf-support-4-7/) for details.

## Database

For data storage, WordPress uses systems compatible with MySQL.

Officially supported by WordPress:

* [MariaDB](https://mariadb.org/) 10.4.x / 10.3.x / 10.2.x / 10.1.x
* [MySQL](https://dev.mysql.com/downloads/mysql/) 8.0.x / 5.7.x

Checked or used by hosting companies and developers:

* [Amazon Aurora](https://aws.amazon.com/rds/aurora/)
* [Amazon RDS for MariaDB](https://aws.amazon.com/rds/mariadb/)
* [Amazon RDS for MySQL](https://aws.amazon.com/rds/mysql/)
* [Google Cloud SQL](https://cloud.google.com/sql/)
* [Percona MySQL Server](https://www.percona.com/software/mysql-database) 8.0.x / 5.7.x

The use of these versions is recommended, both for performance and security reasons, although previous versions usually work without problems.

## How do I know which version I have?

If you have WordPress 5.2+, the WordPress Admin already has tools with that information in the `Site Health` section (at `Tools` in the menu).

If you have an older version, you can activate the `Site Health` section installing the WordPress Community Plugin called [Health Check & Troubleshooting](https://wordpress.org/plugins/health-check/) (more [help for this plugin](https://make.wordpress.org/support/handbook/appendix/troubleshooting-using-the-health-check/)).

\[info\]If you’re interested in improving this handbook, check the [Github Handbook repo](https://github.com/WordPress/hosting-handbook/), or leave a message in the [#hosting-community channel](https://wordpress.slack.com/archives/hosting-community/) of the official [WordPress Slack](https://make.wordpress.org/chat/).\[/info\]

## Changelog

- 2021-02-17: Changelog added.
- 2020-11-23: Minor text changes and info-block.
- 2020-07-16: Updated webserver versions and vendors. Updated PHP versions. Updated SQL versions and vendors. Added: How do I know which version I have?. Updated libsodium to sodium.
- 2020-06-02: Published from Github.
