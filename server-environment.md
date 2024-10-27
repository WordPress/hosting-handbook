# Server Environment

Although WordPress can work in almost any environment, even very minimal ones, it must be acknowledged that it does not work completely well in these. That's why here we are going to make some minimum recommendations of the environment in which it would work most effectively when considering that most WordPress websites use third party plugins and themes which commonly introduce additional server-level requirements.

## WordPress Environment recommendations

Quick recommendations:

- [WordPress 6.6 Server Compatibility](https://make.wordpress.org/hosting/2024/07/10/wordpress-6-6-server-compatibility/)
- [WordPress 6.5 PHP Compatibility](https://make.wordpress.org/hosting/2024/04/05/wordpress-6-5-php-compatibility/)
- [WordPress 6.4 PHP Compatibility](https://make.wordpress.org/hosting/2023/11/16/wordpress-6-4-php-compatibility/)
- [WordPress 6.3 PHP Compatibility](https://make.wordpress.org/hosting/2023/10/11/wordpress-6-3-php-compatibility/)

All the post published are available at:

- [Release Compatibility](https://make.wordpress.org/hosting/category/release-compatibility/)

## Web Server

The web server is piece of software that accepts user web requests and serves them the appropriate result. There are many different web servers that run on different operation systems. Generally, if your web server supports and executes PHP files, it should be able to work with WordPress.

The two most popular ones that are recommended are:

- [Apache HTTPD](https://httpd.apache.org/) 2.4
- [nginx](https://nginx.org/) 1.26

Others are used by hosting companies and developers and are known to work well too:

- [Angie](https://angie.software/en/) 1.7
- [LiteSpeed Web Server](https://www.litespeedtech.com/products/litespeed-web-server) 6.3 / 6.2 / 6.1 / 6.0 / 5.4
- [OpenLiteSpeed](https://openlitespeed.org/) 1.8 / 1.7

_Those are the latest versions at the time of writing this document, for WordPress 6.6. Always keep your web server up-to-date to ensure best performance!_

## PHP

PHP is a programming language on which WordPress code is based. This language runs on the server and it is important to keep it up to date, both for security and functionality.

WordPress supports many versions of PHP, some even obsolete ([PHP Compatibility and WordPress Versions](https://make.wordpress.org/core/handbook/references/php-compatibility-and-wordpress-versions/)), for hosting companies we recommend:

### WordPress versions

#### WordPress 6.7

- [PHP 8.1](https://www.php.net/ChangeLog-8.php#PHP_8_1)
- [PHP 8.2](https://www.php.net/ChangeLog-8.php#PHP_8_2)
- [PHP 8.3](https://www.php.net/ChangeLog-8.php#PHP_8_3)

_IMPORTANT: WordPress 6.7 is **compatible with exceptions** with PHP 8.0, PHP 8.1, PHP 8.2, and **beta compatible** with PHP 8.3, and PHP 8.4._

_What "compatible with exceptions" mean?_

- PHP 8.0
  - [**#48689**: Filesystem WP_Filesystem_FTPext and WP_Filesystem_SSH2 when connect fails.](https://core.trac.wordpress.org/ticket/48689) An investigation is underway as to why on some occasions the access to the files returns some type of error. _NOTE: Has a patch._
  - [**#49728**: Prepare for the internal functions throwing TypeError or ValueError exceptions on unexpected types/values.](https://core.trac.wordpress.org/ticket/49728) Internal functions will throw an exception if the function call arguments are of a type that is not expected. _NOTE: Has a patch._
  - [**#51019**: convert_smilies() fails on large tags.](https://core.trac.wordpress.org/ticket/51019) The function fails when dealing with large HTML tags, particularly when an image with a large data URL is included in the post content. _NOTE: Has a patch, but moved to WordPress 6.8._
  - [**#55121**: classic widgets with no settings won't show up in 5.9.](https://core.trac.wordpress.org/ticket/55121) Classic widgets with no settings do not appear correctly in WordPress 5.9 and above. This is due to changes in how widgets are handled in the block editor, causing compatibility problems with older widget setups. _NOTE: Has a patch, but moved to WordPress 6.3._
  - [**#55257**: map_deep() function incompatibility with incomplete objects in PHP 8.0+.](https://core.trac.wordpress.org/ticket/55257) The function becomes incompatible with incomplete objects when running on PHP 8.0 or higher. _NOTE: Has a patch, but moved to Future Release._
  - [**#59649**: Named parameters. WordPress does not support named parameters.](https://core.trac.wordpress.org/ticket/59649) PHP 8.0 supports optionally calling functions and class methods by specifying the parameter name, instead of calling them on the order of parameters that they are declared. PHP, and many other programming languages, support positional parameters: The caller passes the parameters in the same order the function/method declares its parameters. _NOTE: Moved to WordPress 6.8._
  - [**#60745**: WP_Query::parse_query() does not handle invalid query arg values.](https://core.trac.wordpress.org/ticket/60745) The function does not properly handle invalid query argument values. This results in PHP fatal errors when unintended data types, like arrays, are passed where scalars are expected. _NOTE: Has a patch, but moved to WordPress 6.8._

- PHP 8.1
  - Not all "passing null to non-nullable" issues have been found. In PHP, you can tell a function exactly what type of information it should accept. If you tell a function to expect a certain type of information, and you give it nothing at all (null is like saying "nothing"), then PHP gets confused and gives an error. This problem happens when someone accidentally gives a function "nothing" when the function wasn't designed to handle "nothing".
  - [**#53465**: htmlentities() needs the default value of the flags parameter explicitly set.](https://core.trac.wordpress.org/ticket/53465) According to [htmlentities()](https://www.php.net/manual/en/function.htmlentities.php), the default for flags for PHP 8.1 was "changed from `ENT_COMPAT` to `ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401`". All use cases for this functionality in Core are being investigated. _NOTE: Has a patch._
  - [**#57579**: Replace most strip_tags() with wp_strip_tags().](https://core.trac.wordpress.org/ticket/57579) Proposes optimizing how block templates are handled by minimizing unnecessary filesystem calls during their loading process. _NOTE: Has a patch, but moved to Future Release._
  - [**#57580**: Avoid errors from null parameters in add_submenu_page().](https://core.trac.wordpress.org/ticket/57580) A deprecated error caused by the `wp_normalize_path()` function when null is passed as an argument. This issue occurs primarily due to plugins incorrectly passing null in the `add_submenu_page()` function. _NOTE: Has a patch, but moved to Future Release._
  - [**#61179**: Deprecated messages about passing null in widgets.php](https://core.trac.wordpress.org/ticket/61179) Addresses a deprecated message issue in `widgets.php`. _NOTE: Has a patch, but moved to WordPress 6.7._

- PHP 8.2
  - [**#55603**: utf8_{encode|decode} deprecation](https://core.trac.wordpress.org/ticket/55603) with pending decision on requiring a PHP extension. _NOTE: Has a patch, but moved to WordPress 6.8._
  - [**#56034**: Unknown dynamic properties'](https://core.trac.wordpress.org/ticket/56034) deprecation. _NOTE: Moved to Future Release._
  - [**#57304**: Add SensitiveParameter attribute to DB connection and login variables.](https://core.trac.wordpress.org/ticket/57304) This enhancement aims to protect sensitive data in case of errors, making it less likely to be exposed in logs or bug reports. _NOTE: Moved to WordPress 6.7._
  - [**#60875**: Handler proposal for known dynamic properties that are initialized and set late only when getting its value.](https://core.trac.wordpress.org/ticket/60875) Handling dynamic properties that are initialized only when accessed. Since PHP 8.2 deprecates dynamic (non-declared) properties, the proposal aims to pre-declare these properties while retaining the current design where they are lazily initialized. _NOTE: Moved to WordPress 6.8._
  - [**#61154**: Fix the 'attributes' dynamic property in WP_Block.](https://core.trac.wordpress.org/ticket/61154) Fixing the 'attributes' dynamic property in the `WP_Block` class. _NOTE: Has a patch, but moved to WordPress 6.8._
  - [**#61890**: Handle WP_Term dynamic properties for PHP 8.2](https://core.trac.wordpress.org/ticket/61890). Handling of dynamic properties in the `WP_Term` class to ensure compatibility. _NOTE: Has a patch, but moved to WordPress 6.8._

_What "beta" mean?_

- PHP 8.3
  - Deprecation notices. A deprecation notice is not an error, but rather an indicator of where additional work is needed for compatibility before PHP 9.0. With a deprecation notice, the PHP code will continue to work and nothing is broken.
  - [**#59231**: Prepare for PHP 8.3.](https://core.trac.wordpress.org/ticket/59231). _NOTE: Has a patch, but moved to WordPress 6.7._
  - [**#59232**: Introduce #[Override] attribute to mark overloaded methods](https://core.trac.wordpress.org/ticket/59232) This attribute helps prevent coding errors by making it clear when a method is overloaded. It also assists with refactoring, debugging, and catching potential breaking changes in the parent class. _NOTE: Has a patch, but moved to Future Release._
  - [**#59233**: Improve error handling for unserialize()](https://core.trac.wordpress.org/ticket/59233). `maybe_unserialize()` function could still be confronted by data with trailing bytes. _NOTE: Moved to Future Release._
  - [**#59654**: PHP 8.x: various compatibility fixes for WordPress 6.7](https://core.trac.wordpress.org/ticket/59654). This ticket acts as a central hub for smaller patches that fix specific PHP 8.x failures. It continues the work from previous releases, ensuring that WordPress maintains compatibility with newer PHP versions like PHP 8.0, 8.1, 8.2, and upcoming versions like PHP 8.3. _NOTE: Moved to WordPress 6.7._

- PHP 8.4
  - Deprecation notices. A deprecation notice is not an error, but rather an indicator of where additional work is needed for compatibility before PHP 9.0. With a deprecation notice, the PHP code will continue to work and nothing is broken.
  - [**#62061**: Prepare for PHP 8.4.](https://core.trac.wordpress.org/ticket/62061). _NOTE: Has a patch._

_Other related tickets_

- PHP
  - [**#51525**: Add new functions apply_filters_single_type() and apply_filters_ref_array_single_type().](https://core.trac.wordpress.org/ticket/51525)
  - [**#54183**: Tests: decide on how to handle deprecations in PHPUnit](https://core.trac.wordpress.org/ticket/54183)
  - [**#54537**: Tests: Enable PHP version check once PHP 8.0 compatibility is achieved.](https://core.trac.wordpress.org/ticket/54537)
  - [**#58874**: Code Modernization: Consider using the null coalescing operator.](https://core.trac.wordpress.org/ticket/58874)
  - [**#59234**: Introduce a `wp_json_decode()` function, including validation when available](https://core.trac.wordpress.org/ticket/59234)

#### WordPress 6.6

- [PHP 8.1](https://www.php.net/ChangeLog-8.php#PHP_8_1)
- [PHP 8.2](https://www.php.net/ChangeLog-8.php#PHP_8_2)
- [PHP 8.3](https://www.php.net/ChangeLog-8.php#PHP_8_3)

_IMPORTANT: WordPress 6.6 is **compatible with exceptions** with PHP 8.1, and PHP 8.2, and **beta compatible** with PHP 8.3._

_What "compatible with exceptions" means?_

- PHP 8.1
  - _Not all "passing null to non-nullable" issues have been found._ In PHP, you can tell a function exactly what type of information it should accept. If you tell a function to expect a certain type of information, and you give it nothing at all (null is like saying "nothing"), then PHP gets confused and gives an error. This problem happens when someone accidentally gives a function "nothing" when the function wasn't designed to handle "nothing".
  - [`_htmlentities()` needs the default value of the flags parameter explicitly set_](https://core.trac.wordpress.org/ticket/53465). According to[ htmlentities()](https://www.php.net/manual/en/function.htmlentities.php), the default for flags for PHP 8.1 was "changed from ENT_COMPAT to ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401". All use cases for this functionality in WordPress Core are being investigated. NOTE: Has a patch, but moved to WordPress 6.7.
  - [_Replace most `strip_tags()` with `wp_strip_tags()`_](https://core.trac.wordpress.org/ticket/57579).
There are rare occasions when the `strip_tags()` function is passed a null value, which generates a warning that the string is deprecated. NOTE: Has a patch.
  - [_Update `is_serialized` function to accept `Enums`_](https://core.trac.wordpress.org/ticket/53299). `Enums` are not backwards compatible with older PHP versions. NOTE: Has a patch, but moved to WordPress 6.7.

- PHP 8.2
  - [_`utf8_{encode|decode}` deprecation_](https://core.trac.wordpress.org/ticket/55603) with pending decision on requiring a PHP extension. NOTE: Has a patch, but moved to WordPress 6.7.
  - [_Unknown dynamic properties'_](https://core.trac.wordpress.org/ticket/56034) deprecation. NOTE: Moved to WordPress 6.7.

_What "beta" means?_

- PHP 8.3
  - _Deprecation notices_. A deprecation notice is not an error, but rather an indicator of where additional work is needed for compatibility before PHP 9.0. With a deprecation notice, the PHP code will continue to work and nothing is broken.
  - [_Improve error handling for `unserialize()`_](https://core.trac.wordpress.org/ticket/59233). `maybe_unserialize()` function could still be confronted by data with trailing bytes. NOTE: Moved to WordPress 6.7.

#### WordPress 6.5

- [PHP 8.1](https://www.php.net/ChangeLog-8.php#PHP_8_1)
- [PHP 8.2](https://www.php.net/ChangeLog-8.php#PHP_8_2)
- [PHP 8.3](https://www.php.net/ChangeLog-8.php#PHP_8_3)

_IMPORTANT: WordPress 6.5 is **compatible with exceptions** with PHP 8.0, PHP 8.1, and PHP 8.2, and **beta compatible** with PHP 8.3._

_What "compatible with exceptions" means?_

- PHP 8.0
	- [Named parameters](https://core.trac.wordpress.org/ticket/59649). WordPress does not support named parameters.
	- [Filesystem WP_Filesystem_FTPext and WP_Filesystem_SSH2 when connect fails](https://core.trac.wordpress.org/ticket/48689).

- PHP 8.1
	- Not all "passing null to non-nullable" issues have been found.
	- [htmlentities() et al needs the default value of the flags parameter explicitly set](https://core.trac.wordpress.org/ticket/53465).
	- [Replace most strip_tags() with wp_strip_tags()](https://core.trac.wordpress.org/ticket/57579).

- PHP 8.2
	- [utf8_{encode|decode} deprecation](https://core.trac.wordpress.org/ticket/55603) with pending decision on requiring a PHP extension.
	- [Unknown dynamic properties](https://core.trac.wordpress.org/ticket/56034) deprecations.

_What "beta" means?_

- PHP 8.3
	- Deprecation notices: A deprecation notice is not an error, but rather an indicator of where additional work is needed for compatibility before PHP 9.0. With a deprecation notice, the PHP code will continue to work and nothing is broken.

#### WordPress 6.4

- [PHP 8.1](https://www.php.net/ChangeLog-8.php#PHP_8_1)
- [PHP 8.2](https://www.php.net/ChangeLog-8.php#PHP_8_2)

_IMPORTANT: WordPress 6.4 is **compatible with exceptions** with PHP 8.0, PHP 8.1, and PHP 8.2, and **beta compatible** with PHP 8.3._

_What "compatible with exceptions" means?_

- PHP 8.0
	- [Named parameters](https://core.trac.wordpress.org/ticket/59649). WordPress does not support named parameters.
	- [Filesystem WP_Filesystem_FTPext and WP_Filesystem_SSH2 when connect fails](https://core.trac.wordpress.org/ticket/48689).

- PHP 8.1
	- Not all "passing null to non-nullable" issues have been found.
	- [htmlentities() et al needs the default value of the flags parameter explicitly set](https://core.trac.wordpress.org/ticket/53465).
	- [Replace most strip_tags() with wp_strip_tags()](https://core.trac.wordpress.org/ticket/57579).

- PHP 8.2
	- [utf8_{encode|decode} deprecation](https://core.trac.wordpress.org/ticket/55603) with pending decision on requiring a PHP extension.
	- [Unknown dynamic properties](https://core.trac.wordpress.org/ticket/56034) deprecations.

_What "beta" means?_

- PHP 8.3
	- Deprecation notices: A deprecation notice is not an error, but rather an indicator of where additional work is needed for compatibility before PHP 9.0. With a deprecation notice, the PHP code will continue to work and nothing is broken.

#### WordPress 6.3

- [PHP 8.1](https://www.php.net/ChangeLog-8.php#PHP_8_1)
- [PHP 8.2](https://www.php.net/ChangeLog-8.php#PHP_8_2)

_IMPORTANT: WordPress 6.3 is **compatible with exceptions** with PHP 8.0 and PHP 8.1, and **beta compatible** with PHP 8.2._

_What "compatible with exceptions" means?_

- PHP 8.0
	- Named parameters. WordPress does not support named parameters.
	- [Filesystem WP_Filesystem_FTPext and WP_Filesystem_SSH2 when connect fails](https://core.trac.wordpress.org/ticket/48689).

- PHP 8.1
	- [htmlentities() et al needs the default value of the flags parameter explicitly set](https://core.trac.wordpress.org/ticket/53465).
	- [Replace most strip_tags() with wp_strip_tags()](https://core.trac.wordpress.org/ticket/57579).
	- [unregister_setting() for unknown setting](https://core.trac.wordpress.org/ticket/57674).

_What "beta" means?_

- PHP 8.2
	- Deprecation notices: A deprecation notice is not an error, but rather an indicator of where additional work is needed for compatibility before PHP 9.0. With a deprecation notice, the PHP code will continue to work and nothing is broken.

### About PHP

PHP 8.1 is maintained by the PHP Community only as _Security fix only_ starting 2022-11-26. Keeping your PHP to the latest stable version is important for WordPress speed and security.

Versions prior to PHP 8.1 are not maintained by the PHP Community, although they may receive security updates from operating systems distributions.

End of life PHP versions:

- PHP 8.3: 2027-12-31
- PHP 8.2: 2026-12-31
- PHP 8.1: 2025-12-31
- PHP 8.0: 2023-11-26 _last release: 8.0.30_
- PHP 7.4: 2022-11-28 _last release: 7.4.33_
- PHP 7.3: 2021-12-06 _last release: 7.3.33_
- PHP 7.2: 2020-11-30 _last release: 7.2.34_
- PHP 7.1: 2019-12-01 _last release: 7.1.33_
- PHP 7.0: 2019-01-10 _last release: 7.0.33_
- PHP 5.6: 2018-12-31 _last release: 5.6.40_
- PHP 5.5: 2016-07-21 _last release: 5.5.38_
- PHP 5.4: 2015-09-03 _last release: 5.4.45_
- PHP 5.3: 2014-08-14 _last release: 5.3.29_
- PHP 5.2: 2011-01-06 _last release: 5.2.17_
- PHP 5.1: 2006-08-24 _last release: 5.1.6_
- PHP 5.0: 2005-09-05 _last release: 5.0.5_
- PHP 4.4: 2008-08-07 _last release: 4.4.9_
- PHP 4.3: 2005-03-31 _last release: 4.3.11_
- PHP 4.2: 2002-09-06 _last release: 4.2.3_
- PHP 4.1: 2002-03-12 _last release: 4.1.2_
- PHP 4.0: 2001-06-23 _last release: 4.0.6_

### PHP Extensions

WordPress core makes use of various PHP extensions when they're available. If the preferred extension is missing WordPress will either have to do more work to do the task the module helps with or, in the worst case, will remove functionality. All the extensions are for installations with PHP >= 7.4.

The PHP extensions listed below are _required_ for a WordPress site to work.

- [json](https://www.php.net/manual/en/book.json.php) (bundled in >=8.0.0) - Used for communications with other servers and processing data in JSON format.
- One of either [mysqli](https://www.php.net/manual/en/book.mysqli.php) (bundled in >=5.0.0), or [mysqlnd](https://www.php.net/manual/en/book.mysqlnd.php) - Connects to MySQL for database interactions.

The PHP extensions listed below are _highly recommended_ in order to allow WordPress to operate optimally and to maximise compatibility with many popular plugins and themes.

- [curl](https://www.php.net/manual/en/book.curl.php) (PHP >= 7.3 requires libcurl >= 7.15.5; PHP >= 8.0 requires libcurl >= 7.29.0 ; PHP >= 8.4 requires libcurl >= 7.61.0) - Performs remote request operations.
- [dom](https://www.php.net/manual/en/book.dom.php) (requires libxml) - Used to validate Text Widget content and to automatically configure IIS7+.
- [exif](https://www.php.net/manual/en/book.exif.php) (requires php-mbstring) - Works with metadata stored in images.
- [fileinfo](https://www.php.net/manual/en/book.fileinfo.php) (bundled in PHP) - Used to detect mimetype of file uploads.
- [hash](https://www.php.net/manual/en/book.hash.php) (bundled in PHP >=5.1.2) - Used for hashing, including passwords and update packages.
- [igbinary](https://www.php.net/manual/en/book.igbinary.php) - Increases performance as a drop in replacement for the standard PHP serializer.
- [imagick](https://www.php.net/manual/en/book.imagick.php) (requires ImageMagick >= 6.2.4) - Provides better image quality for media uploads. See [WP\_Image\_Editor](https://developer.wordpress.org/reference/classes/wp_image_editor/) for details. Smarter image resizing (for smaller images) and PDF thumbnail support, when Ghost Script is also available.
- [intl](https://www.php.net/manual/en/book.intl.php) (PHP >= 7.4.0 requires ICU >= 50.1) - Enable to perform locale-aware operations including but not limited to formatting, transliteration, encoding conversion, calendar operations, conformant collation, locating text boundaries and working with locale identifiers, timezones and graphemes.
- [mbstring](https://www.php.net/manual/en/book.mbstring.php) - Used to properly handle UTF8 text.
- [openssl](https://www.php.net/manual/en/book.openssl.php) (PHP 7.1-8.0 requires OpenSSL >= 1.0.1 / < 3.0; PHP >= 8.1 requires OpenSSL >= 1.0.2 / < 4.0; PHP >= 8.4 requires OpenSSL >= 1.1.1 / < 4.0) - SSL-based connections to other hosts.
- [pcre](https://www.php.net/manual/en/book.pcre.php) (bundled in PHP >= 7.0 recommended PCRE 8.10) - Increases performance of pattern matching in code searches.
- [xml](https://www.php.net/manual/en/book.xml.php) (requires libxml) - Used for XML parsing, such as from a third-party site.
- [zip](https://www.php.net/manual/en/book.zip.php) (requires libzip >= 0.11; recommended libzip >= 1.6) - Used for decompressing Plugins, Themes, and WordPress update packages.

The PHP extensions listed below are _recommended_ to allow some WordPress cache (if necessary). APCu, Memcached, and Redis are alternatives of which only one needs to be used.

- [apcu](https://www.php.net/manual/en/book.apcu.php) – In-memory key-value store for PHP (former APC stripped of opcode caching).
- [memcached](https://www.php.net/manual/en/book.memcached.php) (requires libmemcached >= 1.0.0) - memcached is a high-performance, distributed memory object caching system, generic in nature, but intended for use in speeding up dynamic web applications by alleviating database load.
- [opcache](https://www.php.net/manual/en/book.opcache.php) - PHP can be configured to preload scripts into the opcache when the engine starts. 
- [redis](https://pecl.php.net/package/redis) - PHP extension for interfacing with Redis.


The PHP extensions listed below are _optional_ to imrpove some WordPress functionality.

- [timezonedb](https://pecl.php.net/package/timezonedb) - Timezone Database to be used with PHP's date and time functions

For the sake of completeness, below is a list of the remaining PHP modules WordPress _may_ use in certain situations or if other modules are unavailable. These are fallbacks or optional and not necessarily needed in an optimal environment, but installing them won't hurt.

- [bc](https://www.php.net/manual/en/book.bc.php) - For arbitrary precision mathematics, which supports numbers of any size and precision up to 2147483647 decimal digits.
- [filter](https://www.php.net/manual/en/book.filter.php) - Used for securely filtering user input.
- [image](https://www.php.net/manual/en/book.image.php) (requires libgd >= 2.1.0; requires zlib >= 1.2.0.4; optional freetype2) - If Imagick isn't installed, the GD Graphics Library is used as a functionally limited fallback for image manipulation.
- [iconv](https://www.php.net/manual/en/book.iconv.php) (requires libiconv/POSIX) - Used to convert between character sets.
- [shmop](https://www.php.net/manual/en/book.shmop.php) - Shmop is an easy to use set of functions that allows PHP to read, write, create and delete Unix shared memory segments.
- [simplexml](https://www.php.net/manual/en/book.simplexml.php) (requires libxml) - Used for XML parsing.
- [sodium](https://www.php.net/manual/en/book.sodium.php) - (bundled in PHP >=7.2.0; requires libsodium >= 1.0.8) - Validates Signatures and provides securely random bytes.
- [xmlreader](https://www.php.net/manual/en/book.xmlreader.php) (requires libxml) - Used for XML parsing.
- [zlib](https://www.php.net/manual/en/book.zlib.php) (requires zlib >= 1.2.0.4) - Gzip compression and decompression.

These extensions are used for file changes, such as updates and plugin/theme installation, when files aren't writeable on the server.

- [ssh2](https://www.php.net/manual/en/book.ssh2.php) (requires OpenSSL and libssh >= 1.2; recommended libssh >= 1.2.9) - Provide access to resources (shell, remote exec, tunneling, file transfer) on a remote machine using a secure cryptographic transport.
- [ftp](https://www.php.net/manual/en/book.ftp.php) - Implement client access to files servers speaking the File Transfer Protocol (FTP).
- [sockets](https://www.php.net/manual/en/book.sockets.php) - Implements a low-level interface to the socket communication functions based on the popular BSD sockets.

The priority of the transports are Direct file IO, SSH2, FTP PHP Extension, FTP implemented with Sockets, and FTP implemented through PHP alone.

### System Packages

- [curl](https://curl.se/) (recommended >= 8.4)
- [Ghost Script](https://www.ghostscript.com/) (recommended Ghost Script >= 10.0)- Enables Imagick/ImageMagick to generate PDF thumbnails for the media library. See [Enhanced PDF Support in WordPress 4.7](https://make.wordpress.org/core/2016/11/15/enhanced-pdf-support-4-7/) for details.
- [ImageMagick](https://imagemagick.org/) (recommended ImageMagick >= 7.1) - Required by Imagick extension.
- [OpenSSL](https://www.openssl.org/) (recommended >= 3.0)
- [WebP](https://developers.google.com/speed/webp/)
- [AVIF](https://aomediacodec.github.io/av1-avif/)

## Database

For data storage, WordPress uses systems compatible with MySQL.

Officially recommended by WordPress are:

- [MySQL](https://dev.mysql.com/downloads/mysql/) 8.0 LTS, 8.4 LTS
- [MariaDB](https://mariadb.org/) 10.6 LTS, 10.11 LTS, 11.4 LTS

End of life MySQL versions:

- MySQL 9.1: n/d
- MySQL 9.0: 2024-10-15
- MySQL 8.4: 2032-04-30
- MySQL 8.3: n/d
- MySQL 8.2: n/d
- MySQL 8.1: 2023-10-25 _last release: 8.1.0_
- MySQL 8.0: 2026-04-30
- MySQL 5.7: 2023-10-31 _last release: 5.7.44_
- MySQL 5.6: 2021-02-28 _last release: 5.6.51_
- MySQL 5.5: 2018-12-31 _last release: 5.5.63_

End of life mariaDB versions:

- MariaDB 11.5: n/d
- MariaDB 11.4: 2029-05-29
- MariaDB 11.3: 2024-05-29 _last release: 11.3.2_
- MariaDB 11.2: 2024-11-21 _last release: 11.2.4_
- MariaDB 11.1: 2024-08-21 _last release: 11.1.6_
- MariaDB 11.0: 2024-06-07 _last release: 11.0.6_
- MariaDB 10.11: 2028-02-16
- MariaDB 10.10: 2023-11-17 _last release: 10.10.7_
- MariaDB 10.9: 2023-08-22 _last release: 10.9.8_
- MariaDB 10.8: 2023-05-20 _last release: 10.8.8_
- MariaDB 10.7: 2023-02-09 _last release: 10.7.8_
- MariaDB 10.6: 2026-07-06
- MariaDB 10.5: 2025-06-24
- MariaDB 10.4: 2024-06-18 _last release: 10.4.34_
- MariaDB 10.3: 2023-05-25 _last release: 10.3.39_
- MariaDB 10.2: 2022-05-22 _last release: 10.2.44_
- MariaDB 10.1: 2020-10-17 _last release: 10.1.48_
- MariaDB 10.0: 2019-03-31 _last release: 10.0.38_
- MariaDB 5.5: 2020-04-11 _last release: 5.5.68_

Other MySQL servers that are known to perform well are:

- [Percona MySQL Server](https://www.percona.com/software/mysql-database)
- [Amazon Aurora](https://aws.amazon.com/rds/aurora/)
- [Amazon RDS for MariaDB](https://aws.amazon.com/rds/mariadb/) 10.11
- [Amazon RDS for MySQL](https://aws.amazon.com/rds/mysql/) 8.0
- [Azure Database for MySQL](https://azure.microsoft.com/products/mysql/)
- [Google Cloud MySQL](https://cloud.google.com/sql/mysql) 8.0
- [DigitalOcean MySQL](https://www.digitalocean.com/products/managed-databases-mysql)
- [IBM Cloud Databases for MySQL](https://www.ibm.com/cloud/databases-for-mysql) 8.0
- [MySQL HeatWave](https://www.oracle.com/mysql/)

Although WordPress may run on older versions, it is recommended to use these or newer ones for security and performance reasons.

## How do I know which version I have?

If you have WordPress 5.2+, the WordPress Admin already has tools with that information in the `Site Health` section (at `Tools` in the menu).

If you have an older version, you can activate the `Site Health` section installing the WordPress Community Plugin called [Health Check & Troubleshooting](https://wordpress.org/plugins/health-check/) (more [help for this plugin](https://make.wordpress.org/support/handbook/appendix/troubleshooting-using-the-health-check/)).

[info]If you’re interested in improving this handbook, check the [Github Handbook repo](https://github.com/WordPress/hosting-handbook/), or leave a message in the [#hosting channel](https://wordpress.slack.com/archives/hosting/) of the official [WordPress Slack](https://make.wordpress.org/chat/).[/info]

## Changelog

- 2024-09-17: Added minimum version of curl and openssl for PHP 8.4 extension.
- 2024-07-04: Up-to-date for WordPress 6.6 compatibility.
- 2024-04-06: Up-to-date for WordPress 6.5 compatibility.
- 2023-11-11: Up-to-date. Added some EOL for databases and PHP. WordPress 6.4 compatibility. Added more information about system packages.
- 2023-10-04: Up-to-date. Added some EOL for databases and PHP. Explanation about BETA and EXCEPTIONS for WordPress 6.3.
- 2023-09-07: Added shmop PHP extension.
- 2023-08-02: Updated for WordPress 6.3 and up-to-date everything.
- 2023-06-08: Added PHP igbinary extension.
- 2023-05-27: Updated PHP extensions requirements and cache extensions.
- 2023-04-19: MariaDB fixed with [LTS versions](https://mariadb.org/about/#maintenance-policy)
- 2023-02-17: Updated LiteSpeed Web Server. Updates for WordPress 6.2 beta and PHP >= 7.4.
- 2022-11-16: Updated WordPress 6.0 / WordPress 6.1, PHP compatibility information and other versions
- 2022-06-22: Added PHP extensions requirements and cache extensions
- 2022-06-06: [Delete MariaDB 10.2](https://core.trac.wordpress.org/ticket/55791)
- 2022-05-13: Update for WordPress 6.0 and stable software versions; updated deprecated PHP versions and extensions
- 2021-05-27: Fixing infoboxes
- 2021-05-07: Updated versions and extensions. [PHP 7.3 bump based on Trac](https://meta.trac.wordpress.org/changeset/10960)
- 2021-05-05: Updated the imagick (WP\_Image\_Editor) link
- 2021-05-05: Updated versions (webserver, PHP, SQL)
- 2021-02-17: Changelog added
- 2020-11-23: Minor text changes and info-block
- 2020-07-16: Updated webserver versions and vendors. Updated PHP versions. Updated SQL versions and vendors. Added: How do I know which version I have?. Updated libsodium to sodium
- 2020-06-02: Published from Github
