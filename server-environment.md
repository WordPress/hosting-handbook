# Environment

WordPress will run in a minimum server environment. However, WordPress doesn't run optimally on the minimum system requirements. This section will cover the _recommended_ server environment for WordPress to run more effectively.

## Recommended Servers

WordPress recommends using one of these servers:

*   Apache 2.4 or higher
*   NGINX 1.14 or higher

## PHP

### PHP Version

PHP `7.3` or greater is highly encouraged but WordPress will run on older versions. Please note, however, that versions of PHP lower than `7.2` have reached end-of-life status (EOL) and are no longer receiving security updates. For this reason, PHP versions lower than `7.2` are not recommended.

### PHP Extensions

WordPress core makes use of PHP extensions. If the preferred extension is missing WordPress will either have to do more work to do the task the module helps with or, in the worst case, will remove functionality. Therefore the PHP extensions listed below are recommended.

*   curl - Performs remote request operations.
*   dom - Used to validate Text Widget content and to automatically configuring IIS7+.
*   exif - Works with metadata stored in images.
*   fileinfo - Used to detect mimetype of file uploads.
*   hash - Used for hashing, including passwords and update packages.
*   json - Used for communications with other servers.
*   mbstring - Used to properly handle UTF8 text.
*   mysqli - Connects to MySQL for database interactions.
*   libsodium - Validates Signatures and provides securely random bytes.
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

WordPress stores content, configuration, and other information inside of a database. The database for a WordPress website is where all of the WordPress website's user-defined data is stored. WordPress is primarily designed to use a MySQL or MySQL-related database server; WordPress officially only supports MySQL or MariaDB, a drop-in replacement for MySQL.

### MySQL

MySQL is a widely used relational database server. MySQL comes in both open-source and commercial distributions. Either distribution should work with MySQL. The commercial distribution has additional features not found in the open-source distribution; however, WordPress does not require or use the additional features. It is designed to run on either the open-source or the commercial distribution.

### MariaDB

MariaDB is a drop-in replacement for MySQL supported by WordPress. It's a fork of the open-source distribution of MySQL. MariaDB was originally created to maintain a more open-source version of MySQL, but it has grown into its own relational database server alternative to MySQL with features and changes not found in MySQL. Despite its differences, MariaDB is still a fully compatible replacement for MySQL and can generally seamlessly replace MySQL.

### Percona

Percona server is a drop-in replacement for MySQL, focused on performance. Although it's a drop-in replacement for MySQL, WordPress does not officially support Percona.

### Recommended Versions

WordPress recommends the following versions for your Database:

*   MySQL 5.6 or greater
*   MariaDB 10.1 or greater
