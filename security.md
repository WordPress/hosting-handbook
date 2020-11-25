# Security

The goal of the page is to inform users who manage a WordPress site about general security best practices both in terms of environment level items, such as file permissions, as well as application-level items, such as setting up proper user roles, so they have a better foundation for security than setting up WordPress somewhere with no additional configuration.

**The most important thing to do for WordPress security is to keep WordPress itself and all installed plugins and themes up to date. It is also encouraged for users to choose themes and plugins that are actively receiving updates.**

WordPress is committed to providing a secure experience for users. Information about WordPress's official stance on security and a general discussion about WordPress's overall aims for security can be found on [WordPress.org's Security page](https://wordpress.org/about/security/).

This guide borrows heavily from the WordPress Codex's guide on [Hardening WordPress](https://wordpress.org/support/article/hardening-wordpress/). Since it's publicly editable, advice in the codex should be viewed with caution.

Keeping any system, not just WordPress, secure is continuous work. Good security requires careful planning, monitoring, and periodic maintenance.

Security largely consists of reducing risk and planning for recovery. Most security plans focus on minimizing the risk of unauthorized access only, but risk can never be successfully reduced to zero. As long as there is some risk, you must plan for recovery so that if something were to happen, user sites are not completely lost and can be quickly restored to normal operation.

Security is also about more than WordPress. It is also about making sure your hosting environment is secure and your personal online practices and behaviors keep you safe. Good security depends on the technology in use and the people using the technology. Obsolete or out-of-date technology can have bugs or vulnerabilities that can put your WordPress website at risk. People's bad online practices can also put your WordPress website as risk. It is important to make sure that not only do you keep the technology you use up-to-date and maintained but also that employees are using security best practices when using the Internet and when interacting with your hosting platform or customer WordPress sites.

## Throttling Multiple Login Attempts

One of the most common kinds of attacks targeting internet services is brute force login attacks. With this form of attack, a malicious party tries to guess WordPress usernames and passwords. The attacker needs only the URL of a user site to perform an attack. Software is readily available to perform these attacks using botnets, making increasingly complex passwords easier to find.

The best protection against this kind of attack is to set and recommend and/or enforce strong passwords for WordPress users.

It is also recommended for hosts to throttle login attempts at the network and server level when possible. It's helpful to throttle both maximum logins per site over time, and maximum attempts per IP over time across server or infrastructure to mitigate bot password brute-force attacks. This can be done at the plugin level as well, but not without incurring the additional resource utilization caused during these attacks.

### A Note About Usernames

Some WordPress security guides recommend using unique usernames for WordPress administrator accounts. While well-intentioned, WordPress's REST API allows anyone to view many of the users for your WordPress website. You can see this for yourself by sending a request to the endpoint at /wp-json/wp/v2/users.

> The WordPress project doesn’t consider usernames or user IDs to be private or secure information. A username is part of your online identity. It is meant to identify, not verify, who you are saying you are. Verification is the job of the password.

### Two-Factor Authentication

Two-factor authentication, also known as 2FA or two-step authentication, is a login scheme that uses a separate, second form of authentication when a user attempts to log in to a service with two-factor authentication enabled. The exact two-factor authentication setup varies from service to service, but it usually involves entering a code or interacting with an application on a smartphone when attempting to log in to a service. WordPress does not have two-factor authentication by default; however, [there are several plugins that provide two-factor authentication for self-hosted WordPress websites](http://wordpress.org/plugins/tags/two-factor-authentication).

## File System

The setup of your hosting account's file system can have a large impact on the security of WordPress. Setting proper file permissions and ownership is important for ensuring unauthorized users cannot access or modify WordPress's files.

### File Permissions

**This section on file permissions focuses entirely on file permissions on Linux servers. If you are using a Windows server, please consult with your hosting provider or a Windows server administrator for help setting the proper permissions.**

Linux [file permissions](https://en.wikipedia.org/wiki/File_system_permissions) consist primarily of three components -- the permissions the owner of the file or folder has, the permissions members of the group that owns the file or folder have, and the permissions that anyone else has for accessing or modifying the file and folder. The three permission components are usually represented using three numbers in order of the owner's permission level, the group's permission level, and everyone's permission level. _There is technically a fourth component, but that is beyond what we need to know to secure WordPress. It will not be discussed here._

There are three kinds of access each for the user, the group, and everyone else. They are read access, write access, and execute access. Read access lets you read the contents of the file or the directory. Write access lets you modify the file or the directory. And execute access lets you run the file like a program or a script.

#### Numeric Representation of File Permissions

Linux stores these different kinds of access internally as bits (i.e. in binary form). They are commonly represented in human-readable form as the numbers 4 (read access), 2 (write access), and 1 (execute access). These numbers are added together to represent different combinations of the three kinds of access you can have.

#### Symbolic Representation of File Permissions

Some programs will represent the different kinds of access using letters instead of numbers. When using symbols, the kinds of access are still read access, write access, and execute access. Instead of numbers, the kinds of access are represented using "r" (read access), "w" (write access), "x" (execute access). These three letters are combined together (e.g. "rwx", "rw", "wx", etc.) to represent the different combinations of the three kinds of access you can have.

#### Examples of Linux File Permissions

| Symbolic | Numeric | Permissions |
| --- | --- | --- |
| \---------- | 000 | no permissions |
| \-r-------- | 400 | read only for user |
| \-rw------- | 600 | read & write only for user |
| \-rwx------ | 700 | read, write, & execute only for user |
| \-rwxr-xr-x | 755 | read, write, & execute for user, only read & execute for group and everyone else |
| \-rw-r--r-- | 644 | read & write for user, only read for group and everyone else |
| \-rwxrwxrwx | 777 | read, write, and execute for user, group, and everyone else. **Do not use. Security Risk.** |

#### Recommended Default Linux File Permissions

File permissions are going to be different based on needs and server setup. Keep file permissions as restricted as possible, avoiding giving permissions that are not needed. Keep in mind WordPress needs the ability to write to its own files for updates, including automatic security updates.

### User Accounts

WordPress websites should be run as non-privileged users. If possible, separate WordPress websites should be run as separate users in order to isolate WordPress websites from one another. In addition, the web server used to process PHP scripts and requests for WordPress websites should be configured to handle requests as a non-privileged user. The exact configuration of your users and web server will vary depending on your server environment, choice of web server, and the installed web server modules.

### Core and Upload Write Permissions

For automatic security updates to function, PHP must be able to overwrite WordPress' core files. If you do not handle automated updates at the infrastructure level, this is the recommended practice.

Additionally, WordPress stores assets and user uploaded files in a special uploads directory located in `/wp-content/uploads`, by default, within the WordPress root. The uploads directory must be web-accessible in order for user content and uploaded assets to be loaded by a browser. PHP will also need to be able to write to the user's uploads folder for WordPress to handle uploading user content.

## WordPress Users and Roles

WordPress itself defines 5 default types of users (6 if WordPress Multisite is enabled). They are:

*   Super Administrator (If WordPress Multisite is enabled) - a superuser with access to the special WordPress Multisite administration features and all other normal administration features.
*   Administrator (slug: 'administrator') - a superuser for the individual WordPress website with access to all of the administration features in the website.
*   Editor (slug: 'editor') - a user who can publish posts and manage the posts of other users.
*   Author (slug: 'author') - a user who can publish posts and manage the user's own posts.
*   Contributor (slug: 'contributor') - a user who can write and manage the user's own posts but cannot publish them.
*   Subscriber (slug: 'subscriber') - a user who can manage the user's own profile only.

Super Administrators, Administrators, and Editors are all considered "trusted" users, meaning they have capabilities that could be abused to damage or compromise a WordPress site.

When WordPress is first installed, an Administrator account is automatically set up.

Plugins and themes can modify existing, as well as add additional types of, users and capabilities to WordPress beyond the defaults. These additional options are commonly used by plugins and themes to manage the functionality they add to WordPress.

## HTTPS and TLS / SSL

WordPress is fully [compatible with HTTPS when an TLS / SSL certificate](https://make.wordpress.org/support/user-manual/web-publishing/https-for-wordpress/) is installed and available for the web server to use. Support for HTTPS is strongly recommended to help maintain the security of both WordPress logins and site visitors.

## Caching Security

While caching can significantly improve the performance of WordPress websites, caching can expose WordPress websites to new vulnerabilities if the caching providers are not configured correctly. Some common vulnerabilities include but are not limited to websites accessing the cached data for other websites or caching applications serving the wrong cached data or files. Each kind of caching application usually has security settings and configuration to provide a safe environment for enjoying the performance benefits of caching.

### OpCache Security

PHP opcode caching can significantly improve the performance of PHP processing for WordPress websites, as outlined in the Performance section of the WordPress Hosting Handbook. However, when improperly configured PHP opcode caching can enable users to access other users' PHP files without authorization. There are important PHP configuration options for opcode caching that mitigate vulnerabilities such as accessing files without authorization.

#### Validate permission

The following setting makes PHP check that the current user has the necessary permissions to access the cached file. It should be enabled at the root php.ini configuration level to prevent users from accessing other users cached files.  
`opcache.validate_permission = On`

This setting is not enabled by default. It is also only available as of PHP 7.0.14.

#### Validate root

The following setting prevents PHP users from accessing files outside of the chroot'd directory to which they normally would not have access. It should also be added to the root php.ini configuration level to prevent unauthorized access to files.  
`opcache.validate_root = On`

This setting is not enabled by default. It is also only available as of PHP 7.0.14.

#### Restrict API

Normally, any PHP user can access the opcache API for viewing the currently cached files and for managing the PHP opcode cache. With some PHP configurations, however, the PHP opcode cache shares the same memory between all users on the server. Sharing the PHP opcode cache between all users means all users can view and access the PHP opcode cache and can access other users' cached PHP files. Restricting the Opcache API prevents PHP scripts run in unauthorized directories from viewing cached files and interacting with the PHP opcode cache manually from within PHP scripts. The following setting defines the directory path PHP scripts must start with to be able to access the Opcache API.  
`opcache.restrict_api = '/some/folder/path'`

The default value for the setting is `''`, which means there are no restrictions on which PHP scripts can access the Opcache API. This setting should be defined in the root php.ini for your PHP configuration in order to prevent users from overriding it.

### Object Caching Security

There are several solutions for providing database object caching for WordPress. Each comes with its own configuration requirements for providing a secure environment while using database object caching.

#### Redis

Redis is a lightweight, high-performance key-value database server commonly used to cache the results from WordPress database queries. In its default configuration, Redis uses a single database and does not require a username and password to access the database. Redis should also only be accessible from authorized network hosts.

##### Redis databases

Redis provides 16 databases, number 0 to 15 by default. Redis clients should be configured to use different databases instead of the default database (number 0). Redis can be configured to have additional databases, but that is outside the scope of this document.

##### Redis user credentials

If Redis is going to be used for database object caching, the Redis server should be configured to require access credentials.

##### Redis network hosts

The Redis server in its default configuration listens on port 6379. The port can be changed in Redis's configuration, but whatever port is used should be protected by a firewall to prevent unauthorized access.

##### Redis cache key salt

If using Redis for database object caching, using a unique Redis cache key salt will help prevent cache collisions -- when two websites try to cache content using the same key. Cache collisions can result in websites accessing the cached data for other websites and can cause other undesirable and unexpected behaviors. The Redis cache key salt is usually configured through the Redis caching plugin or Redis client used to enable Redis database object caching in WordPress websites.

#### Memcached

Memcached is a memory object caching solution commonly used to provide database object caching for WordPress. One of the most important configuration concerns for memcached is preventing memcached from being accessed by the public internet. Putting memcached servers behind a firewall is one of the most important parts of using memcached securely for WordPress database object caching.

### WordPress Automatic Updates

WordPress has the ability to automatically apply security updates. This should be enabled in almost all cases. The exception is if files are not writeable, outside of `wp-content/uploads`, for security reasons. In this instance, an alternative, expedient, and, preferably, automatic update process should be made available. See [Configuring Automatic Background Updates  
](https://codex.wordpress.org/Configuring_Automatic_Background_Updates)for details on automatic update configuration.

\[info\]If you’re interested in improving this handbook, check the [Github Handbook repo](https://github.com/WordPress/hosting-handbook/), or leave a message in the [#hosting-community channel](https://wordpress.slack.com/archives/hosting-community/) of the official [WordPress Slack](https://make.wordpress.org/chat/).\[/info\]
