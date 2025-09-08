# Server Environment

Although WordPress can work in almost any environment, some environments are more optimal for functionality and performance while others are less so. Below are a few minimum recommendations for server environment configurations within which WordPress operates most efficiently, with consideration for WordPress websites that use third party plugins and themes which commonly introduce additional server-level requirements.

## WordPress Environment recommendations

Quick recommendations:

- [WordPress 6.8 Server Compatibility](https://make.wordpress.org/hosting/2025/04/16/wordpress-6-8-server-compatibility/)
- [WordPress 6.7 Server Compatibility](https://make.wordpress.org/hosting/2024/11/05/wordpress-6-7-server-compatibility/)
- [WordPress 6.6 Server Compatibility](https://make.wordpress.org/hosting/2024/07/10/wordpress-6-6-server-compatibility/)
- [WordPress 6.5 PHP Compatibility](https://make.wordpress.org/hosting/2024/04/05/wordpress-6-5-php-compatibility/)
- [WordPress 6.4 PHP Compatibility](https://make.wordpress.org/hosting/2023/11/16/wordpress-6-4-php-compatibility/)
- [WordPress 6.3 PHP Compatibility](https://make.wordpress.org/hosting/2023/10/11/wordpress-6-3-php-compatibility/)

All published posts on compatibility are available at:

- [Release Compatibility](https://make.wordpress.org/hosting/category/release-compatibility/)

## Web Server

A web server is piece of software that receives and accepts web requests from website visitor computers, then returns the appropriate web data back to the user. There are many different types of pieces of web server software that run on different operating systems. Generally, if your web server supports and executes PHP files, it should be able to work with WordPress.

The two most common pieces of web server software, and the ones recommended for WordPress, are:

- [Apache HTTPD](https://httpd.apache.org/) 2.4
- [nginx](https://nginx.org/) 1.26 & 1.27

Additional software used by web hosting companies and developers that are known to work well with WordPress are:

- [Angie](https://angie.software/en/) 1.7
- [LiteSpeed Web Server](https://www.litespeedtech.com/products/litespeed-web-server) 6.3 / 6.2 / 6.1 / 6.0 / 5.4
- [OpenLiteSpeed](https://openlitespeed.org/) 1.8 / 1.7

_Those are the latest versions at the time of writing this document, for WordPress 6.8. Always keep your web server up-to-date to ensure best performance!_

## PHP

PHP is a programming language on which WordPress code is based. This language runs on the server and it is important to keep it up to date, both for security and functionality.

WordPress supports many versions of PHP, some even obsolete ([See PHP Compatibility and WordPress Versions](https://make.wordpress.org/core/handbook/references/php-compatibility-and-wordpress-versions/)). For hosting companies, the following is recommended:

### WordPress versions

Below are details on specific WordPress versions, PHP compatibility for that version and development tickets related to PHP compatibility at the time of release. Tickets related to PHP compatibility can be found at any time by [Searching WordPress Trac](https://core.trac.wordpress.org/query?status=accepted&status=assigned&status=closed&status=new&status=reopened&status=reviewing&keywords=~php&keywords=~php80&keywords=~php81&keywords=~php82&keywords=~php83&keywords=~php88&milestone=6.7&milestone=6.8&milestone=Future+Release&group=resolution&col=id&col=summary&col=owner&col=type&col=priority&col=component&col=version&order=priority).

#### WordPress 6.8

- [PHP 8.1](https://www.php.net/ChangeLog-8.php#PHP_8_1) (Security Support)
- [PHP 8.2](https://www.php.net/ChangeLog-8.php#PHP_8_2) (Active Support)
- [PHP 8.3](https://www.php.net/ChangeLog-8.php#PHP_8_3) (Active Support)
- [PHP 8.4](https://www.php.net/ChangeLog-8.php#PHP_8_4) (Candidate Support)

_IMPORTANT: WordPress 6.8 is **fully compatible** with PHP 7.2 (1), 7.3 (1), 7.4 (1), 8.0(1), 8.1, and 8.2 and **beta compatible** with PHP 8.3, and PHP 8.4._ _As of the WordPress 6.8 release in April 2025, the term 'compatible with exceptions' is no longer used._

_What does “beta compatible” or "beta support" mean?_

'Beta compatible' or 'beta support' means that WordPress Core is actively working towards full compatibility with that PHP version, but there may still be some issues that are in the process of being resolved. Below are tickets outlining known issues regarding beta support for PHP 8.3 and 8.4. More information on when a PHP version goes from [beta to fully supported](https://make.wordpress.org/core/2025/04/09/php-8-support-clarification/) is documented by the core team.

- PHP 8.3
  - When using a 'Beta Compatible' PHP version, Deprecation notices may be seen in error logs, wp-admin or on-page. A deprecation notice is not an error, but is an indicator that the code being cited in the notice will be changed in future PHP versions. With a deprecation notice, the PHP code will continue to work, and nothing is broken.
  - [#59231: Prepare for PHP 8.3.](https://core.trac.wordpress.org/ticket/59231). _NOTE: Closed/Fixed_
  - [#59232: Introduce #[Override] attribute to mark overloaded methods](https://core.trac.wordpress.org/ticket/59232) This attribute helps prevent coding errors by making it clear when a method is overloaded. It also assists with refactoring, debugging, and catching potential breaking changes in the parent class. _NOTE: Has a patch, but moved to Future Release._
  - [#59233: Improve error handling for unserialize()](https://core.trac.wordpress.org/ticket/59233). maybe_unserialize() function could still be confronted by data with trailing bytes. _NOTE: Moved to Future Release._

- PHP 8.4
  - Deprecation notices.  A deprecation notice is not an error, but is an indicator that the code being cited in the notice will be changed in future PHP versions. With a deprecation notice, the PHP code will continue to work, and nothing is broken.
  - [#62061: Prepare for PHP 8.4.](https://core.trac.wordpress.org/ticket/62061). _NOTE: Closed/Fixed_

- Other PHP Related Tickets 
  - [#51525: Add new functions apply_filters_single_type() and apply_filters_ref_array_single_type().](https://core.trac.wordpress.org/ticket/51525). _Note: Moved to Future Release._
  - [#54183: Tests: decide on how to handle deprecations in PHPUnit](https://core.trac.wordpress.org/ticket/54183). _Note: Moved to Future Release._
  - [#54537: Tests: Enable PHP version check once PHP 8.0 compatibility is achieved.](https://core.trac.wordpress.org/ticket/54537). _Note: Moved to Future Release._
  - [#58874: Code Modernization: Consider using the null coalescing operator.](https://core.trac.wordpress.org/ticket/58874). _Note: Moved to Future Release._
  - [#59234: Introduce a wp_json_decode() function, including validation when available](https://core.trac.wordpress.org/ticket/59234). _Note: This ticket has been closed and won’t be moving forward._


#### WordPress 6.7

- [PHP 8.1](https://www.php.net/ChangeLog-8.php#PHP_8_1)
- [PHP 8.2](https://www.php.net/ChangeLog-8.php#PHP_8_2)
- [PHP 8.3](https://www.php.net/ChangeLog-8.php#PHP_8_3)

_IMPORTANT: WordPress 6.7 is **compatible with exceptions** with PHP 8.0, PHP 8.1, PHP 8.2, and **beta compatible** with PHP 8.3, and PHP 8.4._

_What does 'compatible with exceptions' mean?_

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

_What does "beta" mean?_

- PHP 8.3
  - Deprecation notices. A deprecation notice is not an error, but is an indicator that the code being cited in the notice will be changed in future php versions. With a deprecation notice, the PHP code will continue to work and nothing is broken.
  - [**#59231**: Prepare for PHP 8.3.](https://core.trac.wordpress.org/ticket/59231). _NOTE: Has a patch, but moved to WordPress 6.7._
  - [**#59232**: Introduce #[Override] attribute to mark overloaded methods](https://core.trac.wordpress.org/ticket/59232) This attribute helps prevent coding errors by making it clear when a method is overloaded. It also assists with refactoring, debugging, and catching potential breaking changes in the parent class. _NOTE: Has a patch, but moved to Future Release._
  - [**#59233**: Improve error handling for unserialize()](https://core.trac.wordpress.org/ticket/59233). `maybe_unserialize()` function could still be confronted by data with trailing bytes. _NOTE: Moved to Future Release._
  - [**#59654**: PHP 8.x: various compatibility fixes for WordPress 6.7](https://core.trac.wordpress.org/ticket/59654). This ticket acts as a central hub for smaller patches that fix specific PHP 8.x failures. It continues the work from previous releases, ensuring that WordPress maintains compatibility with newer PHP versions like PHP 8.0, 8.1, 8.2, and upcoming versions like PHP 8.3. _NOTE: Moved to WordPress 6.7._

- PHP 8.4
  - Deprecation notices. A deprecation notice is not an error, but is an indicator that the code being cited in the notice will be changed in future php versions. With a deprecation notice, the PHP code will continue to work and nothing is broken.
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

_What does 'compatible with exceptions' mean?_

- PHP 8.1
  - _Not all "passing null to non-nullable" issues have been found._ In PHP, you can tell a function exactly what type of information it should accept. If you tell a function to expect a certain type of information, and you give it nothing at all (null is like saying "nothing"), then PHP gets confused and gives an error. This problem happens when someone accidentally gives a function "nothing" when the function wasn't designed to handle "nothing".
  - [`_htmlentities()` needs the default value of the flags parameter explicitly set_](https://core.trac.wordpress.org/ticket/53465). According to[ htmlentities()](https://www.php.net/manual/en/function.htmlentities.php), the default for flags for PHP 8.1 was "changed from ENT_COMPAT to ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401". All use cases for this functionality in WordPress Core are being investigated. NOTE: Has a patch, but moved to WordPress 6.7.
  - [_Replace most `strip_tags()` with `wp_strip_tags()`_](https://core.trac.wordpress.org/ticket/57579).
There are rare occasions when the `strip_tags()` function is passed a null value, which generates a warning that the string is deprecated. NOTE: Has a patch.
  - [_Update `is_serialized` function to accept `Enums`_](https://core.trac.wordpress.org/ticket/53299). `Enums` are not backwards compatible with older PHP versions. NOTE: Has a patch, but moved to WordPress 6.7.

- PHP 8.2
  - [_`utf8_{encode|decode}` deprecation_](https://core.trac.wordpress.org/ticket/55603) with pending decision on requiring a PHP extension. NOTE: Has a patch, but moved to WordPress 6.7.
  - [_Unknown dynamic properties'_](https://core.trac.wordpress.org/ticket/56034) deprecation. NOTE: Moved to WordPress 6.7.

_What does "beta" mean?_

- PHP 8.3
  - _Deprecation notices_. A deprecation notice is not an error, but is an indicator that the code being cited in the notice will be changed in future php versions. With a deprecation notice, the PHP code will continue to work and nothing is broken.
  - [_Improve error handling for `unserialize()`_](https://core.trac.wordpress.org/ticket/59233). `maybe_unserialize()` function could still be confronted by data with trailing bytes. NOTE: Moved to WordPress 6.7.

#### WordPress 6.5

- [PHP 8.1](https://www.php.net/ChangeLog-8.php#PHP_8_1)
- [PHP 8.2](https://www.php.net/ChangeLog-8.php#PHP_8_2)
- [PHP 8.3](https://www.php.net/ChangeLog-8.php#PHP_8_3)

_IMPORTANT: WordPress 6.5 is **compatible with exceptions** with PHP 8.0, PHP 8.1, and PHP 8.2, and **beta compatible** with PHP 8.3._

_What does 'compatible with exceptions' mean?_

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

_What does "beta" mean?_

- PHP 8.3
	- Deprecation notices: A deprecation notice is not an error, but is an indicator that the code being cited in the notice will be changed in future php versions. With a deprecation notice, the PHP code will continue to work and nothing is broken.

#### WordPress 6.4

- [PHP 8.1](https://www.php.net/ChangeLog-8.php#PHP_8_1)
- [PHP 8.2](https://www.php.net/ChangeLog-8.php#PHP_8_2)

_IMPORTANT: WordPress 6.4 is **compatible with exceptions** with PHP 8.0, PHP 8.1, and PHP 8.2, and **beta compatible** with PHP 8.3._

_What does 'compatible with exceptions' mean?_

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

_What does "beta" mean?_

- PHP 8.3
	- Deprecation notices: A deprecation notice is not an error, but is an indicator that the code being cited in the notice will be changed in future php versions. With a deprecation notice, the PHP code will continue to work and nothing is broken.

#### WordPress 6.3

- [PHP 8.1](https://www.php.net/ChangeLog-8.php#PHP_8_1)
- [PHP 8.2](https://www.php.net/ChangeLog-8.php#PHP_8_2)

_IMPORTANT: WordPress 6.3 is **compatible with exceptions** with PHP 8.0 and PHP 8.1, and **beta compatible** with PHP 8.2._

_What does 'compatible with exceptions' mean?_

- PHP 8.0
	- Named parameters. WordPress does not support named parameters.
	- [Filesystem WP_Filesystem_FTPext and WP_Filesystem_SSH2 when connect fails](https://core.trac.wordpress.org/ticket/48689).

- PHP 8.1
	- [htmlentities() et al needs the default value of the flags parameter explicitly set](https://core.trac.wordpress.org/ticket/53465).
	- [Replace most strip_tags() with wp_strip_tags()](https://core.trac.wordpress.org/ticket/57579).
	- [unregister_setting() for unknown setting](https://core.trac.wordpress.org/ticket/57674).

_What does "beta" mean?_

- PHP 8.2
	- Deprecation notices: A deprecation notice is not an error, but is an indicator that the code being cited in the notice will be changed in future php versions. With a deprecation notice, the PHP code will continue to work and nothing is broken.

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

WordPress core makes use of various PHP extensions when they're available. If the preferred extension is missing, WordPress will either have to do more work to do the task the module helps with, or in the worst case, will remove functionality. All the extensions are for installations with PHP >= 7.4.

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


The PHP extensions listed below are _optional_ to improve some WordPress functionality.

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

### Officially recommended versions

Below are the officially recommended Long Term Support versions of [MySQL](https://dev.mysql.com/downloads/mysql/) and [MariaDB](https://mariadb.org/).

| Software  | Version    | EOL Date          |
|-----------|------------|-------------------|
| MySQL     | 8.4 LTS    | April 2032        |
| MySQL     | 8.0 LTS    | April 2026        |
| MariaDB   | 11.8 LTS   | June 2030         |
| MariaDB   | 11.4 LTS   | May 29, 2029      |
| MariaDB   | 10.11 LTS  | February 16, 2028 |
| MariaDB   | 10.6 LTS   | July 6, 2026      |

### End of life MySQL versions

The following versions of MySQL have reached their end of life (EOL) and are no longer supported by the MySQL community. **It is highly recommended to upgrade to a supported version for security and performance reasons.**

| Version | Initial GA Release | Final Release             | EOL Date          |
|---------|--------------------|---------------------------|-------------------|
| 9.2*    | January 21, 2025   | 9.2.0 (January 21, 2025)  | April 15, 2025    |
| 9.1*    | October 15, 2024   | 9.1.0 (October 15, 2024)  | January 21, 2025  |
| 9.0*    | July 1, 2024       | 9.0.1 (July 23, 2024)     | October 15, 2024  |
| 8.3*    | January 16, 2024   | 8.3.0 (January 16, 2024)  | July 1, 2024      |
| 8.2*    | October 25, 2023   | 8.2.0 (October 25, 2024)  | January 16, 2024  |
| 8.1*    | July 18, 2023      | 8.1.0 (July 18, 2023)     | October 25, 2023  |
| 5.7     | October 21, 2015   | 5.7.44 (October 25, 2023) | October 21, 2023  |
| 5.6     | February 5, 2013   | 5.6.51 (January 20, 2021) | February 5, 2021  |
| 5.5     | December 3, 2010   | 5.5.62 (October 22, 2018) | December 3, 2018  |
| 5.1     | November 14, 2008  | 5.1.73 (December 3, 2013) | December 31, 2013 |
| 5.0     | October 19, 2005   | 5.0.96 (March 21, 2012)   | March 21, 2012    |

### End of life MariaDB versions

The following versions of MariaDB have reached their end of life (EOL) and are no longer supported by the MariaDB community. **It is highly recommended to upgrade to a supported version for security and performance reasons.**

| Version | Initial GA Release | Final Release               | EOL Date          |
|---------|--------------------|-----------------------------|-------------------|
| 11.5    | August 15, 2024    | 11.5.2 (August 15, 2024)    | November 21, 2024 |
| 11.3    | February 19, 2024  | 11.3.2 (February 19, 2024)  | May 16, 2024      |
| 11.2    | November 21, 2023  | 11.2.6 (November 4, 2024)   | November 21, 2024 |
| 11.1    | August 21, 2023    | 11.1.6 (August 14, 2024)    | August 21, 2024   |
| 11.0    | June 7, 2023       | 11.0.6 (May 17, 2024)       | June 6, 2024      |
| 10.10   | November 17, 2022  | 10.10.7 (November 14, 2023) | November 17, 2023 |
| 10.9    | August 22, 2022    | 10.9.8 (August 14, 2023)    | August 22, 2023   |
| 10.8    | May 21, 2022       | 10.8.8 (May 10, 2023)       | May 20, 2023      |
| 10.7    | February 14, 2022  | 10.7.8 (February 6, 2023)   | February 9, 2023  |
| 10.5    | June 24, 2020      | 10.8.8 (May 10, 2023)       | June 24, 2025     |
| 10.4    | June 16, 2019      | 10.4.34 (May 17, 2024)      | June 18, 2024     |
| 10.3    | May 25, 2018       | 10.3.39 (May 10, 2023)      | May 25, 2023      |
| 10.2    | May 23, 2017       | 10.2.44 (May 21, 2022)      | May 23, 2022      |
| 10.1    | October 17, 2015   | 10.1.48 (November 4, 2020)  | October 17, 2020  |
| 10.0    | March 31, 2014     | 10.0.38 (January 31, 2019)  | March 31, 2019    |
| 5.5     | April 11, 2012     | 5.5.68 (May 12, 2020)       | April 11, 2020    |
| 5.3     | February 29, 2012  | 5.3.12 (January 30, 2013)   | March 1, 2017     |
| 5.2     | November 10, 2010  | 5.2.14 (January 30, 2013)   | November 10, 2015 |
| 5.1     | February 1, 2010   | 5.1.67 (January 30, 2013)   | February 1, 2015  |


### Innovation Releases

In addition to Long Term Support versions, both MariaDB and MySQL have "innovation releases". These releases have much shorter support periods (typically 2-6 months at most) and are intended for users who need access to the latest features.

Innovation releases are generally production-ready from a quality and stability perspective and safe to use. However, using these releases in production is **not recommended** because:
- any new features included in innovation releases are subject to change in the future.
- support (including security fixes) is limited to a short period of time measured in months, not years.

As a way to catch problems with new features that will land in upcoming LTS versions, WordPress Core tests against actively supported innovation releases. However, the project does not recommend these versions for general use.

#### MySQL Innovation Releases

| Version  | Initial GA Release | Final Release            | EOL Date         |
|----------|--------------------|--------------------------|------------------|
| **9.3*** | April 15, 2025     |                          | July 2025        |
| 9.2      | January 21, 2025   | 9.2.0 (January 21, 2025) | April 15, 2025   |
| 9.1      | October 15, 2024   | 9.1.0 (October 15, 2024) | January 21, 2025 |
| 9.0      | July 1, 2024       | 9.0.1 (July 23, 2024)    | October 15, 2024 |
| 8.3      | January 16, 2024   | 8.3.0 (January 16, 2024) | July 1, 2024     |
| 8.2      | October 25, 2023   | 8.2.0 (October 25, 2024) | January 16, 2024 |
| 8.1      | July 18, 2023      | 8.1.0 (July 18, 2023)    | October 25, 2023 |

`*` Indicates the current innovation release.

#### MariaDB Innovation/Short-Term Releases
 
The MariaDB project has decided to retire the concept of innovation releases, replacing them with the concept of "rolling GA releases". This will start with the 12.0 release.

Previously MariaDB referred to these releases as "short-term releases".

| Version | Release Type | Initial GA Release | Final Release               | EOL Date          |
|---------|--------------|--------------------|-----------------------------|-------------------|
| 11.5    | Innovation   | August 15, 2024    | 11.5.2 (August 15, 2024)    | November 21, 2024 |
| 11.3    | Innovation   | February 19, 2024  | 11.3.2 (February 19, 2024)  | May 16, 2024      |
| 11.2    | Short-term   | November 21, 2023  | 11.2.6 (November 4, 2024)   | November 21, 2024 |
| 11.1    | Short-term   | August 21, 2023    | 11.1.6 (August 14, 2024)    | August 21, 2024   |
| 11.0    | Short-term   | June 7, 2023       | 11.0.6 (May 17, 2024)       | June 6, 2024      |
| 10.10   | Short-term   | November 17, 2022  | 10.10.7 (November 14, 2023) | November 17, 2023 |
| 10.9    | Short-term   | August 22, 2022    | 10.9.8 (August 14, 2023)    | August 22, 2023   |
| 10.8    | Short-term   | May 21, 2022       | 10.8.8 (May 10, 2023)       | May 20, 2023      |
| 10.7    | Short-term   | February 14, 2022  | 10.7.8 (February 6, 2023)   | February 9, 2023  |

### Other MySQL servers

While WordPress does not regularly test against these MySQL servers, they are known to perform well.

- [Percona MySQL Server](https://www.percona.com/software/mysql-database)
- [Amazon Aurora](https://aws.amazon.com/rds/aurora/)
- [Amazon RDS for MariaDB](https://aws.amazon.com/rds/mariadb/)
- [Amazon RDS for MySQL](https://aws.amazon.com/rds/mysql/)
- [Azure Database for MySQL](https://azure.microsoft.com/products/mysql/)
- [Google Cloud MySQL](https://cloud.google.com/sql/mysql)
- [DigitalOcean MySQL](https://www.digitalocean.com/products/managed-databases-mysql)
- [IBM Cloud Databases for MySQL](https://www.ibm.com/cloud/databases-for-mysql)
- [MySQL HeatWave](https://www.oracle.com/mysql/)

Although WordPress may run on older versions, it is recommended to use these or newer ones for security and performance reasons.

## How do I know which version I have?

If you have WordPress 5.2+, the WordPress Admin already has tools with that information in the `Site Health` section (at `Tools` in the menu).

If you have an older version, you can activate the `Site Health` section installing the WordPress Community Plugin called [Health Check & Troubleshooting](https://wordpress.org/plugins/health-check/) (more [help for this plugin](https://make.wordpress.org/support/handbook/appendix/troubleshooting-using-the-health-check/)).

[info]If you’re interested in improving this handbook, check the [Github Handbook repo](https://github.com/WordPress/hosting-handbook/), or leave a message in the [#hosting channel](https://wordpress.slack.com/archives/hosting/) of the official [WordPress Slack](https://make.wordpress.org/chat/).[/info]