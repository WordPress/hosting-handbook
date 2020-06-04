# Security

## What we understand by security

Is WordPress safe? Yes, but with conditions. The first and biggest is that you keep everything up to date. This means that all the parts that WordPress is affected by must be kept safe, as far as possible.

In this sense we have three parts where security is important: web hosting, software (WordPress and add-ons), and users. Without a doubt, if you can't manage the hosting part, what you must have is your *WordPress*, *plugins* and *themes* updated to the latest version, always.

Here we will focus on the hosting part, although we will also give you tips and tricks for the rest of the elements. And remember: security is a continuous element and has to be reviewed quite often.

When we talk about security we must emphasize that we are mainly talking about prevention measures that allow reducing the risk and planning in case a recovery is needed. This means that the aim is to reduce the possibilities of unauthorized access, although bearing in mind that there is no such thing as zero risk. That is why there is the second part, recovery planning so that, if necessary, the recovery of the website is as simple and the restoration as immediate as possible.

## Automatic updates

WordPress, by default, incorporates a system of automatic updates, but it is a minimum to avoid major disasters and that over time ceases to be effective.

### WordPress Core

There are 3 options when it comes to automatically upgrading or not upgrading the WordPress core: no upgrade, upgrade only minor versions, or upgrade everything, even major versions. It is recommended that you at least upgrade to the smaller versions, which is what the system does by default. This means that if you have version 5.0.1, it will automatically upgrade to 5.0.2, and then to 5.0.3, but it will not upgrade to 5.1.

To configure these automatic updates, it is best to add a series of codes in the configuration file of wp-config.php.

#### 100% automatic core update

You have to add in the file wp-config.php the following line:

```php
define('WP_AUTO_UPDATE_CORE', true);
```

##### Core update for minor versions only (recommended)

You have to add in the file wp-config.php the following line. When there are major updates you should update it by hand.

```php
define('WP_AUTO_UPDATE_CORE', 'minor');
```

##### Disable automatic updates

You have to add in the file wp-config.php the following line. Unless you do very intensive maintenance, this option is not recommended.

```php
define('WP_AUTO_UPDATE_CORE', false);
```

#### Plugins, themes and translations

The decision to have plugins, themes and translations done automatically is not trivial and requires important decision making. The main problem you may encounter is that, due to these automatic updates, the site may stop working.

In case you want to set everything up automatically, you can (we recommend) do it through a must-use plugin. These plugins, unlike a normal plugin, will run yes or no in WordPress and cannot be disabled from the admin panel.

The content of the Plugin would be as follows:

```php
defined('ABSPATH') or die('Bye bye!');
add_filter('auto_update_core', '__return_true');
add_filter('auto_update_plugin', '__return_true');
add_filter('auto_update_theme', '__return_true');
add_filter('auto_update_translation', '__return_true');
add_filter('auto_core_update_send_email', '__return_true');
```

From WordPress version 5.5 onwards, a system is included that allows you to decide which Plugins and Themes you want to update automatically so that the update work is much lighter and you don't have to resort to the custom Plugin system.

#### Disabling all updates

In case you want to perform the updates manually or with other different systems, as could be the WP-CLI, and even if you have an installation that for some reason you cannot or should not update, you can include in the wp-config.php a line that will prevent the updates that are not done by alternative methods.

```php
define('AUTOMATIC_UPDATER_DISABLED', true);
```

## Secure HTTP and TLS

WordPress works via the HTTP protocol (websites), and can do so via both HTTP and HTTPS (secure), being fully compatible.

Since it's easy to set up HTTPS these days, and since it offers many advantages if you're using a modern web server, you'll also get HTTP/2.0 (or HTTP/3.0) enabled by default. You simply need a TLS 1.2 or TLS 1.3 certificate. If you don't know how to get a certificate, you always have the option to use [Let's Encrypt](https://letsencrypt.org/). Once you have it installed, make sure it works by [running a scan](https://www.ssllabs.com/ssltest/).

### Secure Administration Access

If for some reason you don't want your whole site to be over HTTPS, you can always at least make the private part of the administration panel require a minimum of security. In this case, you can add the lines of code in the wp-config.php so that when accessing the login screen (*wp-login*) or the administration panel (*wp-admin*) the use of HTTPS is forced.

```php
define('FORCE_SSL_LOGIN', true);
define('FORCE_SSL_ADMIN', true);
```

### Insecure requests

If you come from a legacy or very old website where there are internal calls to HTTP, you can try to search all sites for both themes and plugins and database to update the http:// by https://, or you can use an internal technology that allows to increase the security of all requests automatically.

This configuration has to be done at the web server level, and for example, it could be added in the .htaccess if you use Apache HTTPD, with the following content.

```
Header set Content-Security-Policy: upgrade-insecure-requests;
```

## File system

Your hosting account file system settings can have a big impact on the security of WordPress. It is important to set proper file ownership and permissions to ensure that WordPress files cannot be accessed or modified by unauthorized users.

### File Permissions

*NOTE: This section on file permissions focuses entirely on permissions on Linux servers.*

File and folder permissions in Linux have 2 main elements: the owner and the actions allowed.

When we talk about the owner we have 3 parts, the owner itself, the group it belongs to, and the rest. Depending on the configuration of your web server you will have to take into account and give the necessary permissions accordingly. In this case we are going to deal with the owner (necessary for WordPress actions) and the group and the rest (necessary for users to be able to visit the website).

When we talk about the allowed actions we're checking if they can be read, written or executed.

If we put this combination together, as a rule, we'll give read/write/execute permissions to the owners in folders, read/write permissions to the owners in files. On the other hand, we will give read/execute permissions to the folders and read permissions to the files. This is summarized in:

- Folders: 755
- Files: 644

Can we be restrictive on some elements, for safety's sake? Yes, for example, the file that contains keys and more data is wp-config.php; in this case, this file is only accessible by the owner of the site, but it does not have to be accessible from outside. This is why, this particular file, could be given 600 permissions.

Still, check with your provider about these settings, as they may vary depending on the web server, operating system and other factors.

### User accounts

Operating systems allow you to create users. Each user has the possibility to access one or another place depending on whether they are allowed to or not.

In the case of WordPress, a user can be the owner of one or many sites, but in case there is an undue access, the fact that a user has many WordPress can jeopardize the rest. This is why it usually happens that when they hack one, they usually hack all of them.

If possible, it is highly recommended that WordPress installations be done with different users who only have access to one WordPress.

### Core and Media Writing Permissions

For WordPress to work properly, it is necessary that PHP allows access to files and can write, especially if you have automatic updates or want WordPress itself to manage everything possible.

In addition, installations usually have the `/wp-content/uploads/` folder configured by default as a storage for files uploaded through the Media area of the system. For the system to work, PHP must be able to write to this folder.

### Execution permissions for PHP

To increase the security, and taking into account that by default in the "uploads" folder there are no PHP files, we can state that it is the folder that has more possibility of attacks, since plugins and other systems upload elements there. If by any chance you manage to upload some kind of script there that could be executed from the outside, you could block its execution.

In this case, for example, you can add in that folder /wp-content/uploads/ a .htaccess file with the following content:

```
<Files ~ ".+\.php">
  Deny from All
</Files>
```

## Users

In general, when we talk about security, one of the most important factors is the users. This is something that is often difficult to control, since you cannot (usually) force them to do what you would like (such as setting a password with uppercase, lowercase, symbols, numbers and 36 characters). Still, there are always some recommendations to avoid being the weakest link in security.

### User Roles

In WordPress, by default, there are 5 user roles:

- Administrator / SuperAdministrator: as the name suggests, you have permissions for everything.
- Editor: can fully manage the editorial part of the site.
- Author: you can create, publish, and manage your own content.
- Contributor: you can create and manage your contents, but not publish them.
- Subscriber: you can manage your data and profile.

Administrators and Editors must be people you trust on the platform, taking into account that an Administrator must have minimum knowledge of all WordPress, since they can alter settings that compromise the system.

The best thing is to have only administrator users who really need it, and as a rule, work only with users at the Editor level and below.

We must also take into account that WordPress can openly allow the registration of users, so we should never allow these new users to have a higher level than Author.

### Username

Usernames are public data that identify you, but not because they are public, they are less secure. For example, it's very easy for you to know my email address, my Twitter account or my name, but that doesn't make access to my email or Twitter less secure.

By default, WordPress can display through the APIs the identifiers and usernames.

### Secure passwords

WordPress by default generates secure passwords for users both when it generates them automatically and when it suggests them to users.

If a password is not very secure, it will automatically inform you and tell you to check a field to confirm that you agree to it, at your own risk.

### Second Authentication Factor (2FA)

In any case, to avoid possible data leakage or the use of basic passwords, the use and obligation of a [second authentication factor](https://en.wikipedia.org/wiki/Multi-factor_authentication) is highly recommended.

In this case, after entering the username and password in the login screen, you will be asked for a second code to be generated in a specific way.

You may be interested in the [Two Factor](https://wordpress.org/plugins/two-factor/) plugin for managing authentication by mail, OTP and other systems.

## Security in the cache

While caching can significantly improve the performance of WordPress websites, caching can leave sites exposed to vulnerabilities if caching providers are not properly configured. Some common vulnerabilities include, but are not limited to, websites accessing cached data for other websites or caching applications serving bad data or files. Each application typically has settings to provide a secure environment and to enjoy the performance benefits of caching.

### Opcache Security

The PHP Opcode can significantly improve the performance of PHP processing, however, when misconfigured it can allow users to access other users' PHP files without authorization. There are important PHP configuration options for opcode caching that mitigate vulnerabilities such as unauthorized file access.

#### Access validation

The following configuration causes PHP to check that the current user has the necessary permissions to access the cache file. It must be enabled at the root level of php.ini to prevent users from accessing other users' cached files.

```
opcache.validate_permission = on
```

This setting is not activated by default. Available as of PHP 7.0.14.

#### Root validation

The following configuration prevents PHP users from accessing files outside the chrooted directory that they would not normally have access to. It should also be added to the root level of php.ini to prevent unauthorized access to files.

```
opcache.validate_root = on
```

This setting is not activated by default. Available as of PHP 7.0.14.

#### API Restriction

Normally any PHP user can access the Opcache API to view the currently cached files and to manage the PHP opcode cache. However, with some PHP configurations, the PHP opcode cache shares the same memory among all users on the server.

Restricting the Opcache API prevents PHP scripts from running in directories that are not authorized to view cached files and interact with the PHP opcode cache manually from within the PHP scripts. The following configuration defines the directory path with which PHP scripts must start in order to access the opcache API.

```
opcache.restrict_api = '/some/folder/path
```


The default value for the configuration is `"` (*nothing*), which means that there are no restrictions on which PHP scripts can access the Opcache API. This setting must be defined in the php.ini root of your PHP configuration to prevent users from overriding it.

### Object Caching Security

#### Redis

In its default configuration Redis uses a single database and does not require a username and password to access the database. Redis should be accessible only from authorized network hosts.

##### Databases

Redis provides 16 databases, (number 0 to 15 by default). Redis clients must be configured to use different databases instead of the default database (number 0).

##### Credentials

If Redis is to be used for caching database objects, the Redis server must be configured to require access credentials.

##### Port

The Redis server in its default configuration listens on port 6379. The port can be changed in the Redis configuration, but any port used must be protected by a firewall to prevent unauthorized access.

##### Random key

If you use Redis for caching database objects, the use of a single Redis cache key will help avoid cache collisions when two websites try to cache content using the same key. Cache collisions can result in Web sites accessing cached data from other Web sites and can cause other unexpected behavior.

The random key is usually set through the Redis cache plugin used to enable object caching. Also, can be configured on the wp-config.php.

```php
define( 'WP_CACHE_KEY_SALT', random_thing_here' );
```

#### Memcached

Memcached is a memory object caching solution.

One of the most important configuration concerns for memcached is preventing memcached from being accessed through the public Internet. Putting memcached servers behind a firewall is one of the most important parts of using memcached securely for caching WordPress database objects.