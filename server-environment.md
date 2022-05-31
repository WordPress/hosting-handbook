# Server Environment

Although WordPress can work in almost any environment, even very minimal ones, it must be acknowledged that it does not work completely well in these. That's why here we are going to make some minimum recommendations of the environment in which it would work most effectively when considering that most WordPress websites use third party plugins and themes which commonly introduce additional server-level requirements.


## Web Server

The web server is piece of software that accepts user web requests and serves them the appropriate result. There are many different web servers that run on different operation systems. Generally, if your web server supports and executes PHP files, it should be able to work with WordPress.

The two most popular ones that are recommended are:

* [Apache HTTPD](https://httpd.apache.org/) 2.4
* [nginx](https://nginx.org/) 1.22


Others are used by hosting companies and developers and are known to work well too:

* [LiteSpeed Web Server](https://www.litespeedtech.com/products/litespeed-web-server) 6.0 / 5.4
* [OpenLiteSpeed](https://openlitespeed.org/) 1.7

_Those are the latest versions at the time of writing this document. Always keep your web server up-to-date to ensure best performance!_

## PHP

PHP is a programming language on which WordPress code is based. This language runs on the server and it is important to keep it up to date, both for security and functionality.

WordPress supports many versions of PHP, some even obsolete, we recommend running PHP version 7.4 or higher:

* [PHP 7.4](https://www.php.net/ChangeLog-7.php#PHP_7_4)
* [PHP 8.0](https://www.php.net/ChangeLog-8.php#PHP_8_0)*
* [PHP 8.1](https://www.php.net/ChangeLog-8.php#PHP_8_1)*

_IMPORTANT: WordPress 6.0 has beta support for PHP 8.0 and PHP 8.1. If used some of these versions may get some Warnings._

Versions prior to PHP 7.4 are not maintained by the PHP Community, although they may receive security updates from operating systems distributions. Security support for PHP 7.3 ended in 2021-12-06 which means that even if there are security problems with it, official versions won't be released. Keeping your PHP to the latest stable version is important for WordPress speed and security.

### PHP Extensions

WordPress core makes use of various PHP extensions when they're available. If the preferred extension is missing WordPress will either have to do more work to do the task the module helps with or, in the worst case, will remove functionality.

The PHP extensions listed below are required for a WordPress site to work.

* [json](https://www.php.net/manual/en/book.json.php) - Used for communications with other servers and processing data in JSON format.
* One of either [mysqli](https://www.php.net/manual/en/book.mysqli.php), or [mysqlnd](https://www.php.net/manual/en/book.mysqlnd.php) - Connects to MySQL for database interactions.

The PHP extensions listed below are highly recommended in order to allow WordPress to operate optimally and to maximise compatibility with many popular plugins and themes.

*   [curl](https://www.php.net/manual/en/book.curl.php) - Performs remote request operations.
*   [dom](https://www.php.net/manual/en/book.dom.php) - Used to validate Text Widget content and to automatically configure IIS7+.
*   [exif](https://www.php.net/manual/en/book.exif.php) - Works with metadata stored in images.
*   [fileinfo](https://www.php.net/manual/en/book.fileinfo.php) - Used to detect mimetype of file uploads.
*   [hash](https://www.php.net/manual/en/book.hash.php) - Used for hashing, including passwords and update packages.
*   [imagick](https://www.php.net/manual/en/book.imagick.php) - Provides better image quality for media uploads. See [WP\_Image\_Editor](https://developer.wordpress.org/reference/classes/wp_image_editor/) for details. Smarter image resizing (for smaller images) and PDF thumbnail support, when Ghost Script is also available.
*   [mbstring](https://www.php.net/manual/en/book.mbstring.php) - Used to properly handle UTF8 text.
*   [openssl](https://www.php.net/manual/en/book.openssl.php) - Permits SSL-based connections to other hosts.
*   [pcre](https://www.php.net/manual/en/book.pcre.php) - Increases performance of pattern matching in code searches.
*   [xml](https://www.php.net/manual/en/book.xml.php) - Used for XML parsing, such as from a third-party site.
*   [zip](https://www.php.net/manual/en/book.zip.php) - Used for decompressing Plugins, Themes, and WordPress update packages.

For the sake of completeness, below is a list of the remaining PHP modules WordPress _may_ use in certain situations or if other modules are unavailable. These are fallbacks or optional and not necessarily needed in an optimal environment, but installing them won't hurt.

*   [bc](https://www.php.net/manual/en/book.bc.php) - For arbitrary precision mathematics, which supports numbers of any size and precision up to 2147483647 decimal digits.
*   [filter](https://www.php.net/manual/en/book.filter.php) – Used for securely filtering user input.
*   [image](https://www.php.net/manual/en/book.image.php) - If Imagick isn't installed, the GD Graphics Library is used as a functionally limited fallback for image manipulation.
*   [iconv](https://www.php.net/manual/en/book.iconv.php) - Used to convert between character sets.
*   [intl](https://www.php.net/manual/en/book.intl.php) - Enable to perform locale-aware operations including but not limited to formatting, transliteration, encoding conversion, calendar operations, conformant collation, locating text boundaries and working with locale identifiers, timezones and graphemes.
*   [simplexml](https://www.php.net/manual/en/book.simplexml.php) - Used for XML parsing.
*   [sodium](https://www.php.net/manual/en/book.sodium.php) - Validates Signatures and provides securely random bytes.
*   [xmlreader](https://www.php.net/manual/en/book.xmlreader.php) - Used for XML parsing.
*   [zlib](https://www.php.net/manual/en/book.zlib.php) - Gzip compression and decompression.

These extensions are used for file changes, such as updates and plugin/theme installation, when files aren't writeable on the server.

*   [ssh2](https://www.php.net/manual/en/book.ssh2.php) - Provide access to resources (shell, remote exec, tunneling, file transfer) on a remote machine using a secure cryptographic transport.
*   [ftp](https://www.php.net/manual/en/book.ftp.php) - Implement client access to files servers speaking the File Transfer Protocol (FTP).
*   [sockets](https://www.php.net/manual/en/book.sockets.php) - Implements a low-level interface to the socket communication functions based on the popular BSD sockets.

The priority of the transports are Direct file IO, SSH2, FTP PHP Extension, FTP implemented with Sockets, and FTP implemented through PHP alone.

### System Packages

*   [ImageMagick](https://imagemagick.org/) - Required by Imagick extension
*   [Ghost Script](https://www.ghostscript.com/) - Enables Imagick/ImageMagick to generate PDF thumbnails for the media library. See [Enhanced PDF Support in WordPress 4.7](https://make.wordpress.org/core/2016/11/15/enhanced-pdf-support-4-7/) for details.

## Database

For data storage, WordPress uses systems compatible with MySQL.

Officially recommended by WordPress are 

* [MySQL](https://dev.mysql.com/downloads/mysql/) 8.0 / 5.7
* [MariaDB](https://mariadb.org/) 10.6 / 10.5 / 10.4 / 10.3 / 10.2

Other MySQL servers that are known to perform well are:

* [Percona MySQL Server](https://www.percona.com/software/mysql-database) 8.0
* [Amazon Aurora](https://aws.amazon.com/rds/aurora/)
* [Amazon RDS for MariaDB](https://aws.amazon.com/rds/mariadb/)
* [Amazon RDS for MySQL](https://aws.amazon.com/rds/mysql/)
* [Azure Database for MySQL](https://azure.microsoft.com/services/mysql/)
* [Google Cloud MySQL](https://cloud.google.com/sql/mysql)
* [DigitalOcean MySQL](https://www.digitalocean.com/products/managed-databases-mysql)
* [IBM Cloud Databases for MySQL](https://www.ibm.com/cloud/databases-for-mysql)
* [MySQL HeatWave](https://www.oracle.com/mysql/)

Although WordPress may run on older versions, it is recommended to use these or newer ones for security and performance reasons.

## How do I know which version I have?

If you have WordPress 5.2+, the WordPress Admin already has tools with that information in the `Site Health` section (at `Tools` in the menu).

If you have an older version, you can activate the `Site Health` section installing the WordPress Community Plugin called [Health Check & Troubleshooting](https://wordpress.org/plugins/health-check/) (more [help for this plugin](https://make.wordpress.org/support/handbook/appendix/troubleshooting-using-the-health-check/)).

[info]If you’re interested in improving this handbook, check the [Github Handbook repo](https://github.com/WordPress/hosting-handbook/), or leave a message in the [#hosting-community channel](https://wordpress.slack.com/archives/hosting-community/) of the official [WordPress Slack](https://make.wordpress.org/chat/).[/info]

## Changelog

- 2022-05-13: Update for WordPress 6.0 and stable software versions; updated deprecated PHP versions and extensions.
- 2021-05-27: Fixing infoboxes
- 2021-05-07: Updated versions and extensions. [PHP 7.3 bump based on Trac](https://meta.trac.wordpress.org/changeset/10960).
- 2021-05-05: Updated the imagick (WP\_Image\_Editor) link.
- 2021-05-05: Updated versions (webserver, PHP, SQL).
- 2021-02-17: Changelog added.
- 2020-11-23: Minor text changes and info-block.
- 2020-07-16: Updated webserver versions and vendors. Updated PHP versions. Updated SQL versions and vendors. Added: How do I know which version I have?. Updated libsodium to sodium.
- 2020-06-02: Published from Github.
