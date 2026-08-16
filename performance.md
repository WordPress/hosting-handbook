# Performance

This section will cover the basics on configuring services for performance with WordPress.

## Performance Factors

Several factors can affect the performance of a WordPress site. Those factors include, but are not limited to, the hosting environment, WordPress configuration, software versions, number of images and their file sizes.

### Hosting

The optimization techniques available will depend on the hosting setup.

#### Shared Hosting

This is the most common type of hosting. The site is hosted on a server along with many others. The hosting company manages the web server, so the user has very little control over server settings. In most shared hosting, the user can access the file system of the website root via SFTP and many of the common domain and hosting tasks via a [web hosting control panel](server/control-panel.md).

The areas most relevant to this type of hosting are caching, WordPress configuration, and content offloading.

#### Managed Hosting

Managed hosting is similar to shared hosting, but more locked down to a set of software stacks that the users can run for a particular set of usage scenarios. Hence, the hosting provider manages the software stacks for the users, but with the condition of limiting the software selections. The users typically don't have (or need) to access the file system and manage any tasks via a [web hosting control panel](server/control-panel.md). Some hosting providers will offer more choice in the selection of software or plugins in the upper tier of the hosting plans.

#### Virtual Private Servers and Dedicated Servers

In this hosting scenario, the user has control over their own server: the entire file system, SSH, and the ability to install and configure any software on an independent operating system dedicated to the server. The server might be a dedicated piece of hardware or one of many virtual servers sharing the same physical hardware.

The key thing is control over the server settings. In addition to the areas above, the key areas of interest here are optimizing software and content offloading.

#### Hardware Performance

Hardware capability has a huge impact on site performance. The number of processors, the processor speed, the amount of available memory, disk space, and the disk storage medium are important factors. Hosting providers generally offer higher performance for a higher price.

#### Geographical Distance

The distance between the server and the site's visitors also has an impact on performance. A Content Delivery Network, or CDN, can mirror static files (like images) across various geographic regions so that all site visitors have optimal performance.

#### Server Load

The amount of traffic on the server and how it's configured to handle the load will have a huge impact as well. For example, without a caching solution, performance will slow to a halt as additional page requests come in and stack up, often crashing the web or database server.

If configured properly, most hosting solutions can handle very high traffic amounts. Offloading traffic to other servers can also reduce server load.

Abusive traffic such as login [brute force attacks](security.md#brute-force-attacks), image hotlinking (other sites linking to image files from high traffic pages) or DoS attacks can also increase server load. Identifying and blocking these attacks is critical.

#### Software Version

Making sure the latest software is in use is also important, as software upgrades often fix bugs and enhance performance. Running the latest version of Linux (or Windows), Apache, MySQL/MariaDB, and PHP is essential.

### WordPress Configuration

The theme has a huge impact on the performance of a site. A fast lightweight theme will perform much more efficiently than a heavy graphic-laden inefficient one.

The number of plugins and their performance will also have a huge impact. Deactivating and deleting unnecessary plugins is a significant way to improve performance.

Keeping up with WordPress upgrades is also important.

Making sure the images in posts are optimized for the web can save time and bandwidth, and increase search engine ranking.

### Performance Testing Tools

- Online web page benchmarking tools can test real life website performance from different locations, browsers, and connection speeds.
- The built-in browser developer tools (e.g. Firefox or Chrome) all have performance measurement tools.

## Caching

WordPress has a lot of dynamic functionality, but this comes at a cost. Tasks such as processing PHP, querying the database and collecting information from external APIs all take resources and time.

> Caching saves time for potentially heavy tasks by reusing previously computed results, rather than calculating them for every page view.

Caches typically expire after a certain amount of time and are regenerated so the most recent content is displayed. When items are served from cache they have a faster response time, often coming from memory, and take load off the server.

In a typical page load, various caches might be checked in the following order:

1.  [Local Browser cache](#browser-cache) / Local Storage / Web App Manifest
2.  [Content Delivery Network (CDN)](#content-delivery-network-cdn-cache)
3.  [Full Page Cache](#full-page-cache) (Reverse Proxy - Varnish or NGINX)
4.  [Full Page Cache](#full-page-cache) (File-based Full-page caching with plugins)
5.  [Static Cache](#static-content) (JS, CSS, Images with static caching services, NGINX tryfiles, etc.)
6.  [Opcode Cache](#opcode-cache)
7.  [Object Cache](#object-cache) (wp\_options, transient API)
8.  [Fragment Cache](#fragment-cache) (Database, static files, transient API)

Each caching instance may be a different domain, server, or compute instance, either routed by the local machine, the remote server cluster, or any intermediary computer along the request chain. It is recommended to check with your hosting company for server-side solutions like Varnish and NGINX which usually works faster than plugins and file based full page caching.

Each cache may have any configuration of:  
Data storage: RAM, SSD, or spinning hard drives. Physical connection, or data over network.  
Input/Output latency: Connection from local or remote server motherboard to RAM, Data I/O, or network I/O.

For any given page load, speed and user experience will result from the combined latency of all services, and the order they are processed as users interact with a web application.

(**Example**: CSS; Generated by JavaScript, PHP or pre-processor. Sent over network. Earliest display: Inline script within first HTTP packet of first HTML response. Typical: Loaded by many plugins in many files over many requests. Middle-ground: combined file, cached locally, to CDN, or server RAM or SSD.)

### Caching Plugins

Caching plugins can be easily installed and will cache WordPress posts and pages as static files. These static files are then served to users, reducing the processing load on the server. This can improve performance several hundred times over for fairly static pages. A list of relevant plugins is available by searching for [cache](https://wordpress.org/plugins/search/cache/) in the plugin directory.

When combined with a system-level page cache such as Varnish, this can be quite powerful. If posts and pages have a lot of dynamic content, configuring caching can be more complex.

Some cache plugins integrate support for browser caching and ETag, and some offer integrated support for Memcached, APC and other opcode caching.

### Content Delivery Network (CDN) Cache

Content Delivery Networks are designed to optimize the network latency between servers and visitors from different geographical locations. Data is distributed amongst endpoints and then visitors get served from the endpoint which is closest to them.

In addition to optimizing networking latency, CDNs can act as another layer of static and/or full-page caching running on all those endpoints.

It’s important to make sure that CDNs are working well with all your other caching systems and that it purges caches on all endpoints when you request that from your main server. Otherwise, people in certain areas may get old results which is generally an issue that’s difficult to troubleshoot.

Note, that if you don't have full page caching on the CDN edges, this might increase the TTFB (time to first byte) because the node must fetch the data from the origin server before serving it to the end user. 

### Full Page Cache

In order to display your content, WordPress does a lot of work under the hood, and all those calculations require server resources and time to complete. For starters, the PHP service on the server has to process the request, load WordPress core, your theme PHP files and all PHP scripts coming from your plugins. The majority of those PHP files make requests to your database, too, which adds to the overall resource footprint of your site.

The best way to cache these requests is to use a reverse proxy like NGINX or Varnish which stores the output directly into the server memory or hard disk. That saves a lot of processing power because cached content is served straight out of the reverse proxy without hitting your web server, the PHP service, or your database service at all. If a reverse proxy is not available on your current server setup, you can fallback to storing cached content into your file system. It's slower than reverse proxies and a hit reaches your web server and your PHP service at least once, so it can direct the request to the proper cached file but still - it's much faster than doing all the computing for every request.

Full Page Caching stores the HTML output of a request, but all the CSS, JS, images and font files will have to be loaded separately too. They are handled separately and optimizing them is worth investing the time and effort. Static caching can have great effect on those resources. You can often use the same reverse proxy to static resources in the server memory - CSS, JS, Fonts, Images and serve them directly.

It's important to have the ability to expire caches when necessary to avoid serving visitors old data. When available, selective caching is preferred over purging the entire cache, to avoid the cost of WordPress regenerating every page for the site. Furthermore, it's good practice to exclude certain types of pages from your full page caching completely because they are different for each user. For example, if you have an online store, it's imperative that your cart, checkout and profile pages are completely dynamic. In general, it’s a good idea to exclude all logged in users from the cache because they are supposed to see personalized content. Another important aspect is the default caching period, which can be different for each website depending on how often data is changed.

<img src="https://make.wordpress.org/hosting/files/2018/08/full-page-caching-response-example.png" alt="Full Page Cache Example" style="max-width: 100%; max-height: 100%; object-fit: contain;">

### Browser Cache

Browser caching can help to reduce server load by reducing the number of requests per page. For example, by setting the correct file headers on files that don't change (static files like images, CSS, JavaScript etc.), browsers will then cache these files on the user's computer. This technique allows the browser to check to see if files have changed, instead of simply requesting them. The result is the web server can answer many more 304 responses, confirming that a file is unchanged, instead of 200 responses, which require the file to be sent.

Look into HTTP Cache-Control (specifically `max-age`) and Expires headers, as well as [Entity Tags](https://developer.mozilla.org/docs/Web/HTTP/Headers/ETag) for more information.

### Object Cache

> In 2005, WordPress introduced its internal object cache — a way of automatically storing any data from the database (not just objects) in PHP memory to prevent unnecessary queries. However, out of the box, WordPress will discard all of those objects at the end of the request, requiring them to be rebuilt from scratch for the next page load. In addition to that, you can use persistent object caching mechanisms like Redis or Memcached which, however, require additional plugins (drop-ins) which allow WordPress to use these services.

###### source: [scalewp.io](https://www.scalewp.io/object-caching/)

What does this mean? Think of a standard WordPress homepage displaying the most recent posts. Each of these posts has quite a bit of information associated with it WordPress must look up such as the author, categories, tags, and excerpt.

Support for a persistent object cache gives WordPress, plugins, and themes, a place to store that data for reuse. While these items are cached, PHP execution time is improved while lessening the load on the database. It's particularly helpful in situations where much of the page is difficult to cache from the front-end, like for authenticated traffic or e-commerce applications.

For these reasons, persistent object caching support is commonly offered with managed WordPress hosting.

<img src="https://make.wordpress.org/hosting/files/2018/08/wordpress-object-caching-example.png" alt="Object Cache Example" style="max-width: 100%; max-height: 100%; object-fit: contain;">

> Transients are inherently sped up by caching plugins, where normal Options are not. A memcached plugin, for example, would make WordPress store transient values in fast memory instead of in the database. For this reason, transients should be used to store any data that is expected to expire, or which can expire at any time. Transients should also never be assumed to be in the database, since they may not be stored there at all.

###### source: [WordPress Common APIs Handbook](https://developer.wordpress.org/apis/transients/)

### Opcode Cache

The web server must read, compile, and run each PHP script. An opcode cache stores a compiled copy of each PHP script in memory or on disk. When the web server starts processing PHP scripts for WordPress, the web server checks the opcode cache for a cached copy of the PHP script. If there is a cached copy, the web server can skip straight to running the PHP script using the cached copy instead of having to read and compile the script again. Skipping this reading and compiling PHP scripts can greatly improve the web server's resource usage and enable WordPress to serve many more requests than it might have been able to otherwise. It's particularly helpful for dynamic content and authenticated traffic, where full page caching isn't as effective.

As with any cache, opcode caches can keep changes from taking effect until the cache expires or is purged. With opcode cache specifically, this means older versions of the compiled PHP code will be loaded. When updating plugins, themes, or WordPress core, the appropriate files should be purged from the cache to avoid continuing to load the older versions.

[OPcache](https://www.php.net/manual/en/book.opcache.php) is a PHP extension, bundled with PHP 5.5.0 and later, that acts as a caching mechanism to boost PHP performance. Precompiled script bytecode, low level binary representations of code, are stored in memory, enabling PHP files to be fetched from memory instead of loading and parsing files on each request.

For production WordPress environments, it's recommended that OPcache be enabled for web requests and sized for the site or hosting platform. Important [OPcache runtime configuration](https://www.php.net/manual/en/opcache.configuration.php) settings to review include:

- `opcache.memory_consumption`, which controls the shared memory available to OPcache.
- `opcache.interned_strings_buffer`, which controls the memory available for interned strings (distinct string values stored in memory). WordPress and plugins can reuse many strings, so hosts may need to tune this above their standard PHP default to accommodate larger sites.
- `opcache.max_accelerated_files`, which controls how many scripts can be cached.
- `opcache.validate_timestamps` and `opcache.revalidate_freq`, which control how OPcache checks whether cached PHP files have changed.

If `opcache.validate_timestamps` is disabled, file changes will not be picked up automatically. In that configuration, OPcache must be reset or specific scripts must be invalidated during deployment, or the web server/PHP process must be restarted, so updates to WordPress core, plugins, and themes do not continue serving older compiled code.

During active development, a shorter revalidation interval can reduce confusion when code changes do not appear immediately. In production, a longer interval or manual invalidation can reduce filesystem checks, but it should be paired with a reliable deployment or update process that clears OPcache when files change.

Hosts should also monitor OPcache usage over time. If the cache runs out of memory, reaches the configured script limit, or restarts frequently because of wasted memory, the site may lose some of the performance benefit and spend more time recompiling PHP files.

On shared or multi-user hosting, review the [OpCache Security](security.md#opcache-security) guidance before enabling a shared OPcache configuration.

### Fragment Cache

This caching method allows saving sections of otherwise non-cacheable dynamic website content. It can help especially for sites where the majority of the page is static, but has certain dynamic elements, like a shopping cart, or for membership sites.

In the WordPress context, developers often store parts of the page using the WordPress transients/object cache API. In these cases, providing a persistent object cache will allow that caching to happen outside of the database.

Storing these fragments separately in a front end cache is not natively supported by WordPress, and means both manually configuring the sections of the page to be cached, and configuring your front-end cache, whether it be Nginx, Varnish, or otherwise, to support fragment caching. This is usually an advanced technique, and reserved for sites or hosting platforms with very high dynamic traffic needs.

## Purging / Busting / Clearing Caches

Purging caches is as important as storing them. You have to make sure that all layers of caching are cleared when necessary.

Fragment caching is the temporary storage of expensive or long-running server-side operations to avoid taxing web servers and delayed delivery to visitors. It's become a common practice for operations such as generating Menu markup, Widget markup and slow MySQL or HTTP responses. Core currently uses transients to cache HTTP calls to WordPress.org APIs for updates and events.

Fragment caching is particularly beneficial when appropriately paired with full-page caching. Perhaps there's uniform `<footer>` markup displayed on every page that can be temporarily stored. When the server needs to rebuild static cache files and a fragment is found, it saves the server from running Menu/Widget queries to generate the footer markup on every page.

Significant caution should be exercised blanket caching Core resources. If a site Menu relies on dynamic `.current-menu-item` classes, storing the menu markup in a fragment will "burn" that class in, no longer highlighting the correct page as a user navigates. Any caching of WordPress Core resources should be opt-in and integrate an appropriate flushing mechanism for when users modify the resource.

The Transients API should always be used for fragment caching instead of directly using `wp_cache_*` functions. In environments without a persistent Object Cache, `set_transient()` will store cache values in the database in the `wp_options` table. However, when Object Cache is enabled, `set_transient()` will wrap `wp_cache_set()`.

## Optimizing WordPress

### Minimizing Plugins

The first and easiest way to improve WordPress performance is by looking at the plugins. Deactivate and delete any unnecessary plugins. Try selectively disabling plugins to measure server performance.

If one plugin is significantly affecting performance, look at the plugin documentation, ask for support in the appropriate plugin support forum, or look for alternative plugins with similar feature sets.

### Optimizing Content

*Image files*

- Are there any unnecessary images? (e.g. Can some of the images be replaced with text?)
- Make sure all image files are optimized. Choose the correct format (JPG/PNG/GIF) and compression for each image.
- Consider using a more modern image format like WebP which is smaller in size.

*Total file number and size*

- Can the number of files needed to display the average page be reduced?
- When still using HTTP/1.x, it's recommended to combine multiple files in a single optimized file.
- Minify CSS and JavaScript files.

### Autoloaded Options

Autoloaded options are configuration settings for plugins and themes that are automatically loaded with every page load on WordPress. Each plugin and theme defines their own options and which options are autoloaded. Having too many autoloaded options can slow down a site. Generally, a site's autoloaded options should be kept under 800kb.

By default, autoloaded options are saved in the `wp_options` table. Autoload can be turned off on an option-by-option basis within this table.

If a persistent object cache is in use, options (whether autoloaded or not) load faster and more efficiently.

### Database Tuning

Some [optimization plugins](https://wordpress.org/plugins/search/optimization/) and [database plugins](https://wordpress.org/plugins/search/database/) can help reduce extra clutter in the database.

WordPress can also be instructed to [minimize the number of revisions](https://wordpress.org/documentation/article/revisions/) that it saves of posts and pages.

## Optimizing the Server

### Upgrade Hardware

Paying more for higher service levels at a hosting provider can be very effective. Increasing CPU and memory (RAM) or switching to a host with Solid-State Drives (SSD) or NVMe can make a big difference. Increased number of processors and processor speed will also help. Where possible, try to separate services with different functions, like HTTP and MySQL, on multiple servers or VPS (the servers should ideally be in the same location to reduce latency). On shared hosting, upgrading to a plan with higher resource limits like Disk I/O, IOPS, NPROC and total processes may help if those limits are being reached.

### Optimize Software

Make sure the latest operating system version (e.g. Linux or Windows Server), the latest web server version (e.g. Apache or IIS), database (e.g. MySQL server), and PHP are running.

**DNS**: Don't run a DNS on the WordPress server. Use a commercial DNS service or the domain registrar's free offering. Using an external service can also make switching between backup servers during maintenance or emergencies much easier. It also provides a degree of fault tolerance, and reduces the load on the primary web server.

**Web Server**: The web server can be configured to increase performance. There is a range of techniques, from web server caching to setting cache headers to reduce load per visitor. See [Apache HTTPD](server/httpd.md) and [Nginx](server/nginx.md) for configuration references.

**PHP**: There are various PHP accelerators available which can dramatically improve the performance of PHP files. This will apply to all PHP files, not just the WordPress installation. See [APC](https://www.php.net/manual/book.apcu.php) or [OPcache](https://www.php.net/manual/book.opcache.php). Newer PHP versions will usually include better performance optimization as well.

**MySQL/MariaDB**: A few simple changes to the query cache settings can have a dramatic effect on WordPress performance, because WordPress repeats many queries on every request. With InnoDB being the default storage engine for MySQL, make sure it is in use. InnoDB can be optimized and fine-tuned considerably.

**Other services**: Don't run a mail server on the WordPress server. For contact forms, use a contact form plugin along with an external mailing service. See [Mail](server/mail.md).

### Content Offloading

#### Use a Content Delivery Network (CDN)

Using a CDN can greatly reduce the load on a website. Offloading the searching and delivery of images, JavaScript, CSS and theme files to a CDN is not only faster but takes a great load off the WordPress server's own app stack. A CDN is most effective if used with a WordPress caching plugin. Some newer CDNs will also include Full Page Caching (FPC) or Edge Caching which will cache the entire HTML content of the website.

#### Static Content

Any static files can be offloaded to another server. For example, any static images, JavaScript, or CSS files can be moved to a different server. This is a common technique in very high-performance systems but can also be helpful for smaller sites where a single server is struggling. Moving this content onto different hostnames can also lay the groundwork for multiple servers in the future.

Some web servers are optimized to serve static files and can do so far more efficiently than more complex web servers like Apache, for example [lighttpd](https://www.lighttpd.net/).

[Cloud storage](https://en.wikipedia.org/wiki/Object_storage#Cloud_storage) is a dedicated static file hosting service on a pay-per-usage basis. With no minimum costs, it might be practical for lower traffic sites which are reaching the peak that a shared or single server can handle.

#### Multiple Hostnames

There can also be improvements from splitting static files between multiple hostnames. Most browsers will only make 2 simultaneous requests to a host, so if a page requires 16 files, they will be requested 2 at a time. Spread across 4 hostnames, they will be requested 8 at a time. This can reduce page loading times, but it can increase server load (if the different hostnames are served by the same server) by creating more simultaneous requests.

Offloading images is the easiest and simplest place to start. All image files could be evenly split between three hostnames (`assets1.example.com`, `assets2.example.com`, `assets3.example.com` for example). As traffic grows, these hostnames could be moved to dedicated servers. Avoid picking a hostname at random, as this will affect browser caching and result in more traffic, and may also create excessive DNS lookups which do carry a performance penalty.

Under HTTP/2 and HTTP/3, HTTP pipelining is superseded by multiplexing, so these techniques may no longer be necessary.

#### Feeds

Feeds can easily be offloaded to an external feed service that can handle all the feed traffic and only update the feed from the site every few minutes. This can be a big traffic saver.

### Compression

There are a number of ways to compress files and data on a server so that pages are delivered more quickly to readers' browsers. Some [cache plugins](https://wordpress.org/plugins/search/cache/) integrate support for most of the common approaches to compression.

Some cache plugins support Minify and Tidy to compress and combine style sheets and JavaScript files, as well as output compression such as [zlib](https://zlib.net/).

It's also important to compress media files, namely images.

### Adding Servers

When dealing with very high traffic situations, it may be necessary to employ multiple servers. At this level, all the applicable techniques above should already be in place.

The WordPress database can be moved to a different server and only requires a small change to the config file. Likewise, images and other static files can be moved to alternative servers.

[Load balancers](https://en.wikipedia.org/wiki/Load_balancing_(computing)) can help spread traffic across multiple web servers, but require a higher level of expertise. For multiple database servers, the [HyperDB](https://codex.wordpress.org/HyperDB) class provides a drop-in replacement for the standard [WPDB](https://developer.wordpress.org/reference/classes/wpdb/) class, and can handle multiple database servers in both replicated and partitioned structures. A managed database service in the cloud is another option.

## PHP

PHP (PHP: Hypertext Preprocessor) is a popular programming language on the Internet. PHP turns dynamic content, like that in WordPress, into HTML, CSS, and JavaScript that web browsers can read. WordPress is written primarily in PHP, and a server must have PHP in order for WordPress to be able to run.

As PHP is an interpreted language, its version and configuration has a large impact on how well and whether WordPress will run.

### Version

For the PHP versions supported by each WordPress release, see [Server Environment](server-environment.md#php), which carries the maintained per-release tables, and the [PHP Compatibility and WordPress Versions](https://make.wordpress.org/core/handbook/references/php-compatibility-and-wordpress-versions/) page. Support dates for PHP itself are on [PHP's supported versions page](https://www.php.net/supported-versions.php).

Newer versions of PHP contain both security and performance improvements, while being accompanied by new features and bug fixes, which are not guaranteed to be backwards compatible. Extreme care must be taken when upgrading the version of PHP. While WordPress is compatible with the latest releases of PHP, sites built to use older versions of PHP may not be compatible due to their included plugins and themes.

Running an end-of-life PHP release **may expose sites to security vulnerabilities**, since the PHP group regularly retires support for older versions and those versions are not guaranteed to be updated for security concerns.

When upgrading PHP, it's a good practice to test sites for compatibility before upgrading. Where multiple environments are offered, such as staging and production, the PHP version should be configurable separately for each. This allows users to test a newer version of PHP in their non-production environment and resolve any issues before upgrading the production environment.

There's a useful [WP-CLI command](https://github.com/danielbachhuber/php-compat-command) for performing a general compatibility check, but be aware that it is not 100% accurate.

### Configuration

PHP is primarily configured using a configuration file, `php.ini`, from which PHP reads all of its settings and configuration at runtime. This usually happens through CGI/FastCGI, or a process manager like PHP-FPM.

Some server environments may allow PHP configurations to be customized with other files like the `.htaccess` or `.user.ini` file.

Detailed information about each of these directives is available [in the official PHP documentation](https://www.php.net/manual/en/ini.core.php).

#### Timeouts

There are several timeout settings on a system that limit different aspects of a request. When configuring timeouts, it's important to select values that work well together. For example, it doesn't make sense to have a very high script execution timeout on the PHP service if the web server (e.g. Apache) timeout is lower than that. In such a case, if the request takes longer, it will be killed by the web server no matter what the PHP timeout setting is.

Note that processes take different amounts of time depending on the server load, and those limitations are placed to ensure that the server functions properly. Under high server load, processes may take longer to complete, causing a cascade effect leading to even more server load. It's a matter of balance between giving enough time for scripts to be compiled and ensuring that the server stays within normal loads.

The primary PHP timeout can be set with the [`max_execution_time`](https://www.php.net/manual/en/info.configuration.php#ini.max-execution-time) `php.ini` directive. This limits code execution, and not system library calls or MySQL queries, [except on Windows](https://www.php.net/manual/en/function.set-time-limit.php), where it does.

The maximum time allowed for data transfer from the web server to PHP is specified with the [`max_input_time`](https://www.php.net/manual/en/info.configuration.php#ini.max-input-time) `php.ini` directive. It is usually used to limit the amount of time allowed to upload files. The amount of time is separate from `max_execution_time`, and defines the amount of time between when the web server calls PHP and execution starts.

These timeouts are often configured per server and cannot be modified from a shared hosting account.

#### Memory Limits

The maximum amount of memory that PHP is allowed to use per page render is specified with the [`memory_limit`](https://www.php.net/manual/en/ini.core.php#ini.memory-limit) `php.ini` directive.

In addition to setting memory limits within PHP, WordPress has two memory configuration constants that can be changed in the `wp-config.php` file. WordPress will raise the PHP `memory_limit` to these values if it has permission to do so, but if the `php.ini` specifies higher amounts, WordPress will not lower the amount allowed.

The option `WP_MEMORY_LIMIT` declares the amount of memory WordPress should request for rendering the frontend of the website. WordPress default is 40 MB and WordPress Multisite default is 64 MB.

```
define( 'WP_MEMORY_LIMIT', '128M' );
```

The option `WP_MAX_MEMORY_LIMIT` declares the amount of memory WordPress should request for rendering the backend of the website. WordPress default is 256 MB.

```
define( 'WP_MAX_MEMORY_LIMIT', '256M' );
```

Since the WordPress backend usually requires more memory, there's a separate setting for the amount that can be set for logged in users. This is mainly required for media uploads. It can be set higher than the front end limit to ensure the backend has all the resources it needs. Usually, `WP_MEMORY_LIMIT <= WP_MAX_MEMORY_LIMIT`.

#### File Upload Sizes

When uploading media files and other content to WordPress using the WordPress admin dashboard, WordPress uses PHP to process the uploads. PHP's configuration includes limits on the size of files that can be uploaded through PHP and on the size of requests that can be sent to the web server for processing. These will need to align with the server's timeouts, discussed above.

The limit on the size of individual file uploads can be configured using the [`upload_max_filesize`](https://www.php.net/manual/en/ini.core.php#ini.upload-max-filesize) `php.ini` directive.

The limit on the entire size of a request that can be sent from the web server to PHP for processing can be configured using the [`post_max_size`](https://www.php.net/manual/en/ini.core.php#ini.post-max-size) `php.ini` directive. The value for `post_max_size` must be greater than or equal to the value for `upload_max_filesize`. PHP will not process requests larger in size than the value for `post_max_size`.

Note that `post_max_size` applies to every PHP request and not only uploads, so it may become important to address separately if a site processes a large amount of other data included with the request.

On shared hosting accounts these limits are usually set at the server level and may not be modifiable above a certain value.

#### Replacing WordPress' Cron Triggers

The `wp-cron.php` script is responsible for causing certain tasks to be scheduled and executed automatically. Every time someone visits the website, `wp-cron.php` checks whether it is time to execute a job or not. Even though these checks are small and fast, they consume time and produce load. For this reason, it's worth considering setting the [`DISABLE_WP_CRON` constant](https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#disable-cron-and-cron-timeout) and using an alternative method to trigger WordPress' cron system. Note, however, that the WordPress cron system is designed with performance in mind and requires minimal resources to operate, so it's not mandatory to replace it unless there is a specific need.

## Further Reading

- [WP Object Cache](https://developer.wordpress.org/reference/classes/wp_object_cache/)
- [Core Caching Concepts in WordPress](https://www.tollmanz.com/core-caching-concepts-in-wordpress/)
- [Use Server Cache Control to Improve Performance](https://www.websiteoptimization.com/speed/tweak/cache/)
- [Democratizing Performance by Pascal Birchler, WordCamp Asia 2024](https://wordpress.tv/2024/04/09/democratizing-performance/)
- [High-Performance WordPress by Iliya Polihronov, WordCamp San Francisco 2012](https://wordpress.tv/2012/09/01/iliya-polihronov-high-performance-wordpress/)
