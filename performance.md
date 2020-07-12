# Performance

WordPress is a stable system but depends on the performance of the operating system, web server, PHP and database to function properly. As it is a software running on the server, every time a user arrives it will run completely.

This is why some improvements and changes are recommended to improve the performance of the whole system.

## Caching in WordPress

WordPress by default is 100% dynamic, which means that every time someone accesses it, everything has to be generated completely, which is highly calculated. Some of these elements that can slow down the process are database queries, the execution of PHP itself, calls to external APIs...

This is why it is recommended to cache. This process allows reusing previously calculated results on several occasions following a series of rules, which reduces the consumption of repetitive tasks.

Usually the cache is renewed after a predefined period of time, so that during the time the cache is active the results are quickly returned, as they are usually recovered from disk or memory and do not have to be calculated.

There are many cache layers, and each one can be handled differently. WordPress, in conjunction with system settings and plugins, is able to use them. They are usually called in this order:

- Browser Cache, Local Cache, or Web App Manifest
- CDN (Content Delivery Network)
- Page cache, on web server or proxy
- Page caching, static or by PHP
- Opcode cache
- Cache of objects
- Cache of fragments
- Transient API
- Database cache
- File cache on disk

Each cache system works in a different way, it can be on the same server or on several, it can be in the same domain or in different ones, it can even be a chain of calls. In addition, each cache system may require certain settings that are not enabled by default, such as different storage, RAM, different physical connections, latency times ... this means that the optimization of the cache, in many cases, will also depend on the configuration of the machines that manage them. For example, access to RAM memory is faster than access to an SSD disk which is faster than access to an SATA disk.

### Browser cache

The web browsers we use to visit the sites allow us to store information that may be needed at various times throughout your navigation of the site. Therefore, the first visit to a website will most likely be slower, but subsequently the loading speed will increase, as some of the information is stored.

An example would be to add to the .htaccess file (in the case of using an Apache HTTPD web server) the following content, which forces to store the different types the indicated seconds:

```
<IfModule mod_expires.c>
  ExpiresActive on
  # Others
  ExpiresByType application/pdf A2592000
  ExpiresByType image/x-icon A2592000
  ExpiresByType image/vnd.microsoft.icon A2592000
  ExpiresByType image/svg+xml A2592000
  # Images
  ExpiresByType image/jpg A2592000
  ExpiresByType image/jpeg A2592000
  ExpiresByType image/png A2592000
  ExpiresByType image/gif A2592000
  ExpiresByType image/webp A2592000
  # Media
  ExpiresByType video/ogg A2592000
  ExpiresByType audio/ogg A2592000
  ExpiresByType video/mp4 A2592000
  ExpiresByType video/webm A2592000
  # CSS/JS
  ExpiresByType text/css A2592000
  ExpiresByType text/javascript A2592000
  ExpiresByType application/javascript A2592000
  ExpiresByType application/x-javascript A2592000
  # Fonts
  ExpiresByType application/x-font-ttf A2592000
  ExpiresByType application/x-font-woff A2592000
  ExpiresByType application/font-woff A2592000
  ExpiresByType application/font-woff2 A2592000
  ExpiresByType application/vnd.ms-fontobject A2592000
  ExpiresByType font/ttf A2592000
  ExpiresByType font/woff A2592000
  ExpiresByType font/woff2 A2592000
</IfModule>
```

### CDN – Content Distribution Network

The content distribution networks are designed to reduce latency, response times, when serving content in different geographical areas. If your WordPress project is international, it is certainly a good option for, at least, static content such as JavaScript or CSS as well as images and media content. If your project is quite local, it's best to have a connected infrastructure in that country.

Also, generally, CDNs are also used as a caching layer, since by having the contents and only serving the static ones, they don't have to make calculations and are optimized to serve themselves as quickly as possible. If you work with several cache layers, you have to make sure that it is purged at all levels, because you can clean up at one level, but not at another, and still serve something that has not been invalidated.

### Page Cache

When a request is made for a page, for example the main page of a blog, several processes are executed in PHP, the calculation for the retrieval of the contents in the database is made, personalized configurations are calculated and finally the page is painted on the screen. In many occasions, the contents between a request and another one has not changed so why not showing the information calculated in the first of those two occasions?

The best way to cache data is usually to put a system between the user and the web server. That way the information is requested, served, and then the changes are verified or left the same until the information is invalidated. This intermediate layer can be a proxy, usually managed by tools such as [nginx (reverse proxy)](https://docs.nginx.com/nginx/admin-guide/web-server/reverse-proxy/) or [Varnish Cache](https://varnish-cache.org/) that store a copy of the request and serve it until the system is invalidated manually or automatically when it reaches the expiration time. These systems usually store a copy in memory, so it is served much faster than any other system.

If you don't have such a system, you can always make that copy on the web server itself; it's not the fastest option but it's always better than having to calculate everything. Most caching plugins for WordPress use this system.

In the case of images, scripts, style sheets and similar, it is best to serve them directly if they exist and not to go through processing systems such as PHP.

If you use any of these systems, remember that it is always useful to have a system that invalidates the information, for example, when new information is published on the site. The best thing is that you can use a system that only removes those pages that are affected and not the whole site.

Remember also that there will be pages that should never be cached, as they are different for each user, such as the shopping cart page of an e-commerce, or the payment process and beyond.

Another element to keep in mind when configuring caches is the usual time in which the information will be saved until it is invalidated. For example, a corporate website could cache the information for 1 week, a blog in which it is published infrequently, once a day would be enough but, on the other hand, an e-commerce website could cache it for only 1 hour.

Some interesting plugins to manage the cache could be: [WP Super Cache](https://wordpress.org/plugins/wp-super-cache/), [WP Fastest Cache](https://wordpress.org/plugins/wp-fastest-cache/), [W3 Total Cache](https://wordpress.org/plugins/w3-total-cache/), [Simple Cache](https://wordpress.org/plugins/simple-cache/).


In case you work with systems like nginx or LiteSpeed you have these: [LiteSpeed Cache](https://wordpress.org/plugins/litespeed-cache/), [Nginx Cache](https://wordpress.org/plugins/nginx-cache/).

### Opcode cache

Every time a request comes to your web server, PHP has to execute and calculate everything, but PHP allows an internal operation caching system, which means that a copy of each execution is stored in memory or on disk. If it is active and the same operation is executed again, the system will take advantage of this system to return the calculation much faster, since it does not have to calculate everything completely.

If your hosting provider has it active and configured, you can make use of it, but always taking into account that you may need a plugin to make the invalidation of the contents when necessary, considering `opcache.validate_timestamps` may or may not be configured.

Some plugins that can be useful: [OPcache Reset](https://wordpress.org/plugins/opcache-reset/), [WP OPcache](https://wordpress.org/plugins/flush-opcache/), [OPCache Scripts](https://wordpress.org/plugins/opcache-scripts/).

### Object Cache

It has been possible for many versions of WordPress to store some items in the so-called object cache. These objects are mainly pre-calculated items associated with search queries.

Thanks to this system and with the help of external storage servers such as [memcached](https://memcached.org/) or [Redis](https://redis.io/) we can store the calculated data in systems designed for a very fast reading without having to store them in the database. In this way, the system will not have to execute the calculations again but they will be read directly from a storage.

The interesting thing about this system is that it does not cache the whole calculated page, but only parts of it, which means that in pages that cannot be completely cached, certain parts that do not have to change do so.

Some plugins that can be useful: [Redis Object Cache](https://wordpress.org/plugins/redis-cache/), [WP Redis](https://wordpress.org/plugins/wp-redis/), [WP Memcached Manager](https://wordpress.org/plugins/wp-memcached-manager/).

### Fragment Cache

This type of cache allows you to have cache by parts within the whole of the same page. The best known system is the [ESI (Edge Side Includes)](https://en.wikipedia.org/wiki/Edge_Side_Includes) and, with external systems that support it, would allow to have several cached parts and merge them before offering them to the final client.

With this system, for example, a page of a store could be cached by parts, being able to have a common part and other separate parts, such as the cart that would vary according to each user and would only change if something is added to it.

WordPress does not have this system by default, although it can be partially managed with systems like [LiteSpeed Cache](https://wordpress.org/plugins/litespeed-cache/) or [Varnish Cache](https://varnish-cache.org/).

## PHP in WordPress

Without a doubt, the performance of PHP is basic for the proper functioning of WordPress, since most of the system depends on it. That's why the optimal configuration of PHP in your hosting is essential. PHP is an interpreted language that runs on the server, so the weight of optimization is there.

### PHP Version

No doubt for the good functioning of WordPress we should use PHP 7.x, currently recommended PHP 7.4.x, PHP 7.3.x or PHP 7.2.x. It's known that versions prior to PHP 7.x (i.e. PHP 5.6 and earlier) have a 30% lower performance than the current versions. In addition, a major change was made in PHP 7.1 regarding encryption, so it's recommended to use at least that version.

You should also keep in mind that the version of PHP should correlate with the version of WordPress you have. Very old versions of WordPress will not work with the newer ones now, so it is recommended to update everything in parallel as much as possible.

You should also keep in mind the themes and plugins in use. Although WordPress 5.0 supports versions of PHP 5.2 through PHP 7.3, Plugins do not usually support all versions, so keeping a slightly updated version may mean that well known and used Plugins do not work properly.

Starting with WordPress 5.1, there is more control over which versions of PHP can be used, and developers will report on this, so that recommendations will be made about possible malfunction of any core extensions.

Starting with WordPress 5.2, the number of supported versions will be reduced and PHP 5.6 will be supported up to PHP 7.3.

From WordPress version 5.4 onwards, the possibility of indicating the minimum PHP version in the themes is introduced, so that both themes and Plugins can indicate their compatibility with PHP versions.

### Configuration

PHP is mainly configured according to its configuration file php.ini which is read according to its execution. In addition, it is usually installed and integrated with the web server in its CGI/FastCGI versions or in its [PHP-FPM mode](https://secure.php.net/manual/en/install.fpm.php).

In case you have a high traffic website, you may be interested in the PHP-FPM system.

### Timeouts

The waiting times of PHP have to be in line with those of the web server, so this configuration has to be slightly in line between both systems. For example, it does not make sense to configure PHP to have a time of 120 seconds if the web server has one of 30 seconds.

Each process can take a different waiting time, for example depending on the load of the server, and that is why these waiting times are configured, so that those long processes do not leave other processes blocked until they saturate the system. That is why the choice of the waiting time should be according to the load of the server and the good execution of the processes.

The primary PHP timeout can be set with the max_execution_time directive in php.ini. This limits code execution and not system library calls or SQL queries (except on Windows where it does).

The maximum time allowed for data transfer from the web server to PHP is set with the max_input_time directive in php.ini. This is normally used to limit the time allowed for uploading files. It is important to note that the amount of time is different from max_execution_time and defines the amount of time between the time the web server calls PHP and the start of execution.

### Memory limit

The memory limit used by PHP can be configured in the php.ini directives. However, WordPress allows you to set limits in the configuration file wp-config.php. This way if the server limits are higher, those will be executed, but if the limits set by WordPress are higher, those will be used.

```php
define( 'WP_MEMORY_LIMIT', '128M' );
```

This option declares the amount of memory that WordPress should request to render the front end of the website.

```php
define( 'WP_MAX_MEMORY_LIMIT', '256M' );
```

Since the administration panel (*wp-admin*) usually requires more memory, there is a separate setting for the amount that can be set for logged-in users. This is usually very useful when uploading images (as they are usually processed after the upload). You can set it above the limit on the front to ensure that your administration panel has all the resources it needs.

### File Upload

When uploading media files and other content to WordPress using the administration panel, WordPress uses PHP to process the uploads. PHP settings include limits on the size of files that can be uploaded through PHP and on the size of requests that can be sent to the web server for processing. These will have to be aligned with the server's waiting times.

The limit on the size of individual file uploads can be set using `upload_max_filesize` in `php.ini`. Although there is no set figure, a recommendation that is met in most cases is `32MB`.

The limit on the total size of a request that can be sent from the web server to PHP for processing can be set using the post_max_size directive in php.ini. The value for post_max_size should be greater than or equal to the value for upload_max_filesize.

Keep in mind that post_max_size applies to every PHP request, not just uploads, so it may be important to treat separately if a site processes a lot of other data on each request.

## Task scheduler (Crons)

For WordPress to function properly, a number of tasks must be performed. These tasks are not executed in the foreground, but in the background, so somehow you have to launch something that will execute them. This is why every time a user visits the page the WP-Cron system (wp-cron.php) is launched.

Although this check does not usually consume many resources, if a website has a lot of traffic, the system can be saturated. Similarly, if a site has low traffic, these tasks may not be executed as often as recommended.

In these cases, it is best to disable the crones system by configuring the wp-config.php.

```php
define( 'DISABLE_WP_CRON', true );
```

In this case, you should consider, for example, configuring the server to run it manually using [WP-CLI](https://wp-cli.org/). In this case, its execution is configured every 5 minutes. Unless you have a high traffic site or with high requirements (such as an e-commerce) it should be enough every 5 minutes, but you can reduce the execution to every minute.

```bash
*/5 * * * WP_CLI_PHP=/usr/local/bin/php; SHELL=/bin/bash; /usr/local/bin/wp cron event run --due-now --path=/home/example.com/public_html/ >/dev/null 2>&1
```

In case of not having WP-CLI, it is always possible to make use of the call directly in a public way, although it is recommended for security reasons to limit the calls to the IPs that make the requests (the own machine or the external service that makes the requests).

```bash
*/5 * * * * wget -q -O - https://example.com/wp-cron.php?doing_wp_cron > /dev/null 2>&1
```

A more extreme case, and one that requires some knowledge of PHP and shell programming, might be to create a small piece of PHP code that runs the cron locally, so that it does not have to be accessed externally.

For this we would create a PHP file with the following code (for example named /home/example.com/run-wp-cron.php):

```php
<?php
chdir('/home/example.com/public_html/'); // the absolute path where WordPress is located
include('wp-cron.php');
```

And that we would call from the cron with the following query:

```bash
*/5 * * * /usr/bin/php /home/example.com/run-wp-cron.php > /dev/null 2>&1
```

There are many ways to make the calls corresponding to the scheduled tasks, so it is highly recommended that you talk to your web hosting provider for recommendations.
