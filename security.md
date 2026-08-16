# Security

The goal of the page is to inform users who manage a WordPress site about general security best practices both in terms of environment level items, such as file permissions, as well as application-level items, such as setting up proper user roles, so they have a better foundation for security than setting up WordPress somewhere with no additional configuration.

**The most important thing to do for WordPress security is to keep WordPress itself and all installed plugins and themes up to date. It is also encouraged for users to choose themes and plugins that are actively receiving updates.**

WordPress is committed to providing a secure experience for users. Information about WordPress's official stance on security and a general discussion about WordPress's overall aims for security can be found on [WordPress.org's Security page](https://wordpress.org/about/security/).

This guide borrows heavily from the WordPress Codex's guide on [Hardening WordPress](https://wordpress.org/support/article/hardening-wordpress/). Since it's publicly editable, advice in the codex should be viewed with caution.

Keeping any system, not just WordPress, secure is continuous work. Good security requires careful planning, monitoring, and periodic maintenance.

Security largely consists of reducing risk and planning for recovery. Most security plans focus on minimizing the risk of unauthorized access only, but risk can never be successfully reduced to zero. As long as there is some risk, you must plan for recovery so that if something were to happen, user sites are not completely lost and can be quickly restored to normal operation.

Security is also about more than WordPress. It is also about making sure your hosting environment is secure and your personal online practices and behaviors keep you safe. Good security depends on the technology in use and the people using the technology. Obsolete or out-of-date technology can have bugs or vulnerabilities that can put your WordPress website at risk. People's bad online practices can also put your WordPress website at risk. It is important to make sure that not only do you keep the technology you use up-to-date and maintained but also that employees are using security best practices when using the Internet and when interacting with your hosting platform or customer WordPress sites.

## Brute Force Attacks

One of the most common kinds of attacks targeting internet services is brute force login attacks. With this form of attack, a malicious party tries to guess WordPress usernames and passwords. The attacker needs only the URL of a user site to perform an attack. Software is readily available to perform these attacks using botnets, making increasingly complex passwords easier to find.

Because these attempts are automated and often distributed, even unsuccessful attacks can overwhelm a site with requests. This is not unique to WordPress — every web application that exposes a login surface can be targeted — but WordPress's popularity makes it a common focus.

The best protection against this kind of attack is to set and recommend and/or enforce strong passwords for WordPress users.

It is also recommended for hosts to throttle login attempts at the network and server level when possible. It's helpful to throttle both maximum logins per site over time, and maximum attempts per IP over time across server or infrastructure to mitigate bot password brute-force attacks. This can be done at the plugin level as well, but not without incurring the additional resource utilization caused during these attacks.

### Key Defenses at a Glance

- **Use strong, unique passwords and a password manager.**
- **Enable two-factor authentication (2FA)** for all administrator accounts (use a plugin or your identity provider; WordPress core does not include 2FA).
- **Consider passkeys (WebAuthn)** via a reputable plugin for phishing-resistant login.
- **Rate-limit login attempts** at the edge (WAF/CDN) or the web server.
- **Put a CAPTCHA/turnstile on login** to slow bots (e.g., Cloudflare Turnstile, reCAPTCHA).
- **Protect or disable XML-RPC** if you don't need it; otherwise restrict and rate-limit it.
- **Keep WordPress core, themes, and plugins up to date.**
- **Monitor and alert** on authentication anomalies; ban abusive IPs temporarily.
- Prefer **edge/WAF protections** (Cloudflare, Sucuri, host-provided WAF) so bad traffic is blocked before it reaches your server.

> Tip: Obscuring the login URL can reduce noise but should not be your only defense.

### A Note About Usernames

Some WordPress security guides recommend using unique usernames for WordPress administrator accounts. While well-intentioned, WordPress's REST API allows anyone to view many of the users for your WordPress website. You can see this for yourself by sending a request to the endpoint at /wp-json/wp/v2/users.

> The WordPress project doesn’t consider usernames or user IDs to be private or secure information. A username is part of your online identity. It is meant to identify, not verify, who you are saying you are. Verification is the job of the password.

### WordPress-Level Protections

#### Enforce Strong Passwords

WordPress shows a strength meter when changing passwords. Encourage unique, long passwords (or passphrases) and the use of password managers. Avoid dictionary words and personal info.

#### Two-Factor Authentication

Two-factor authentication, also known as 2FA or two-step authentication, is a login scheme that uses a separate, second form of authentication when a user attempts to log in to a service with two-factor authentication enabled. The exact two-factor authentication setup varies from service to service, but it usually involves entering a code or interacting with an application on a smartphone when attempting to log in to a service. WordPress does not have two-factor authentication by default; however, [there are several plugins that provide two-factor authentication for self-hosted WordPress websites](https://wordpress.org/plugins/tags/two-factor-authentication).

Enable 2FA for all administrators and privileged users, using a reputable plugin or your identity provider (TOTP app, hardware key, SMS fallback).

#### Passkeys (WebAuthn)

Passkeys provide phishing-resistant, passwordless login using platform authenticators (Face ID/Touch ID, Windows Hello, security keys). Add via a maintained plugin that supports WebAuthn/Passkeys and enroll at least two authenticators per admin.

#### Application Passwords (for Integrations)

For API access by trusted apps/services, use **Application Passwords** (introduced in WordPress 5.6). They scope access and can be revoked without changing your user password.

#### Limit Login Attempts (App Layer)

If your host/CDN doesn't rate-limit at the edge, a security plugin can throttle login attempts. Note that app-level plugins still execute within PHP and thus consume some resources under heavy attack; prefer edge or server-level throttling when possible.

#### XML-RPC Considerations

`xmlrpc.php` is a frequent brute-force target (especially the `system.multicall` method). If you don't use XML-RPC, disable it. If you do (e.g., Jetpack, mobile apps), restrict it (WAF rules) and rate-limit aggressively.

### Server, Proxy and WAF Protections

> These examples require server or proxy access and may vary by environment. Test in staging before applying to production.

#### Apache

**Block or rate-limit abusive login attempts** (examples require appropriate modules such as `mod_rewrite`, `mod_authz_host`, or third-party tools like ModSecurity or mod_evasive).

**Deny by IP (Apache 2.4+):**

```apache
# wp-login.php: allow specific IPs only
<Files "wp-login.php">
    Require ip 203.0.113.15 203.0.113.16
</Files>
```

**Send 401/403 to a static error page:**

```apache
ErrorDocument 401 /401.html
ErrorDocument 403 /403.html
```

> Consider ModSecurity rulesets (e.g., OWASP CRS) to detect and block brute-force patterns at the server layer.

#### Nginx

**Rate-limit login and XML-RPC:**

```nginx
# Define a shared zone for rate limiting
limit_req_zone $binary_remote_addr zone=logins:10m rate=10r/m;

server {
    # ...

    location = /wp-login.php {
        limit_req zone=logins burst=20 nodelay;
        include fastcgi_params;
        # pass to PHP-FPM or upstream as usual
    }

    location = /xmlrpc.php {
        limit_req zone=logins burst=20 nodelay;
        include fastcgi_params;
        # pass to PHP-FPM or upstream as usual
    }
}
```

**Deny by IP:**

```nginx
location = /wp-login.php {
    allow 203.0.113.15;
    allow 203.0.113.16;
    deny all;
    # pass to PHP-FPM or upstream as usual
}
```

**Custom error pages:**

```nginx
error_page 401 /401.html;
error_page 403 /403.html;
```

#### Caddy (v2)

**Password-protect `/wp-login.php` with Basic Auth:**

```caddyfile
# Hash passwords first: `caddy hash-password`
basicauth /wp-login.php {
    user1 JDJhJDEw$example-hash-value...
    # add more users as needed (one per line)
}
```

> Caddy requires **hashed** passwords in the Caddyfile.

**Limit access to `/wp-login.php` by IP:**

```caddyfile
@blacklist {
    not client_ip forwarded 203.0.113.15 203.0.113.16
    path /wp-login.php
}
respond @blacklist "Forbidden" 403 {
    close
}
```

**Return 401 for `/wp-admin/*` and serve a custom error page:**

```caddyfile
@wpadmin path /wp-admin/*
respond @wpadmin "Unauthorized" 401

handle_errors {
    @need401 status 401
    rewrite @need401 /401.html
    file_server
}
```

**Deny "no-referrer" POSTs to login/comments (optional, use with caution):**

```caddyfile
# Legitimate clients or privacy tools may omit Referer; test before enforcing.
@protected path_regexp protected (wp-comments-post|wp-login)\.php$
@no_referer {
    not header Referer https://{host}*
    method POST
}
abort @no_referer
```

> Using `abort` immediately drops the connection, which is efficient for bots.

For more Caddy discussion and rationale, see [Using Caddy to deter brute force attacks in WordPress](https://caddy.community/t/using-caddy-to-deter-brute-force-attacks-in-wordpress/13579).

#### Windows IIS

**Restrict WP Admin by IP using `web.config`:**

```xml
<location path="wp-admin">
  <system.webServer>
    <security>
      <ipSecurity allowUnlisted="false">
        <add ipAddress="203.0.113.15" allowed="true" />
        <add ipAddress="203.0.113.16" allowed="true" />
      </ipSecurity>
    </security>
  </system.webServer>
</location>
```

**Custom 401 page:**

```xml
<system.webServer>
  <httpErrors errorMode="Custom">
    <remove statusCode="401" />
    <error statusCode="401" path="/401.html" responseMode="File" />
  </httpErrors>
</system.webServer>
```

### Host and CDN WAF Protections

A managed WAF (Cloudflare, Sucuri, or your hosting provider) can:

- Filter known bad IPs and automated login attempts at the edge.
- Enforce bot management, challenge-pages, and login-specific rules.
- Apply **rate limits** to `/wp-login.php` and `/xmlrpc.php` globally.
- Add **CAPTCHA/turnstile** challenges for suspicious requests.

> Advantage: traffic is blocked before reaching your server, preserving resources during high-volume attacks.

### Additional Hardening and Operational Tips

- **Do not use the username `admin`.** Create a separate admin account and demote or remove legacy users.
- **Limit administrator count;** use least-privilege roles for day-to-day work.
- **Audit logs** for failed logins and enumerate sources; temporarily block abusive IPs (e.g., Fail2ban).
- **Avoid permanent country blocklists.** They can block legitimate users and are difficult to maintain.
- **Ensure HTTPS everywhere** to protect credentials in transit.
- **Backups:** Maintain tested, offline-capable backups and rehearse restore procedures.

### See Also

- [Hardening WordPress](security/hardening.md) for a fuller treatment of vulnerability classes and hardening measures
- WordPress.com: [Brute Force Attack Protection](https://developer.wordpress.com/docs/platform-features/brute-force-attack-protection/)
- WordPress Core: [Application Passwords (integration guide)](https://make.wordpress.org/core/2020/11/05/application-passwords-integration-guide/)
- [Using Caddy to deter brute force attacks in WordPress](https://caddy.community/t/using-caddy-to-deter-brute-force-attacks-in-wordpress/13579) (community thread)

### Legacy Techniques to Avoid

Older guidance often recommended heavy `.htaccess` rewrites, country IP blocklists, or BasicAuth over the entire `/wp-admin` directory. Today these measures are either unreliable, break AJAX-based plugins, or degrade user experience. Prefer **edge-level WAF**, **2FA**, **passkeys**, and **targeted rate-limiting** instead. When you do apply server-level blocks, scope them narrowly (e.g., `/wp-login.php`, `/xmlrpc.php`) and document exceptions your site needs (mobile apps, Jetpack, SSO).

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

WordPress itself defines 5 default types of users (6 if [WordPress Multisite](multisite/create-network.md) is enabled). They are:

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

WordPress is fully compatible with HTTPS when an TLS / SSL certificate is installed and available for the web server to use. Support for HTTPS is strongly recommended to help maintain the security of both WordPress logins and site visitors.

HTTPS is an encrypted communication protocol — essentially, a more secure way of browsing the web, since you get a private channel directly between your browser and the web server. That's why most major sites use it.

If a site's using HTTPS, you'll see a little padlock icon in the address field, just as in the screenshot below:

![Screenshot of the "secure site" padlock icon](https://wordpress.org/documentation/files/2019/03/image.png)

Here are the most common reasons you might want to use HTTPS on your own site:

**Faster.** One might think that HTTPS would make your site slower, since it takes some time to encrypt and decrypt all data. But a lot of efficiency improvements to HTTP are only available when you use HTTPS. As a result, HTTPS will actually make your site faster for almost all visitors.

**Trust.** Users find it easier to trust a secure site. While they don't necessarily know their traffic is encrypted, they do know the little padlock icon means a site cares about their privacy. Tech people will know that any servers between your computer and the web server won't be able to see the information flowing forth and back, and won't be able to change it.

**Payment security.** If you sell anything on your site, users want to know their payment information is secure. HTTPS, and the little padlock, assure that their information travels safely to the web server.

**Search Engine Optimization.** Many search engines will add a penalty to web sites that don't use HTTPS, thus making it harder to reach the best spots in search results.

**Your good name.** Have you noticed that some websites have the text "not secure" next to their address?

That happens when your web browser wants you to know a site is NOT using HTTPS. Browsers want you to think (rightly!) that site owners who can't be bothered using HTTPS (it's free in many cases) aren't worth your time and certainly not your money.

In turn, you don't want browsers suggesting you might be that kind of shady site owner yourself.

### Administration Over HTTPS

To easily enable (and enforce) WordPress administration over SSL, there are two constants that you can define in your site's [wp-config.php](https://wordpress.org/documentation/article/editing-wp-config-php/) file. It is not sufficient to define these constants in a plugin file; they must be defined in your `wp-config.php` file. You must also already have SSL configured on the server and a (virtual) host configured for the secure server before your site will work properly with these constants set to true.

**Note:** `FORCE_SSL_LOGIN` was deprecated in [Version 4.0](https://wordpress.org/documentation/wordpress-version/version-4-0/). Please use `FORCE_SSL_ADMIN`.

#### To Force HTTPS Logins and HTTPS Admin Access

The constant `FORCE_SSL_ADMIN` can be set to true in the `wp-config.php` file to force all logins **and** all admin sessions to happen over SSL.

```
define( 'FORCE_SSL_ADMIN', true );
```

#### Using a Reverse Proxy

If WordPress is hosted behind a reverse proxy that provides SSL, but is hosted itself without SSL, these options will initially send any requests into an infinite redirect loop. To avoid this, you may configure WordPress to recognize the `HTTP_X_FORWARDED_PROTO` header (assuming you have properly configured the reverse proxy to set that header).

```
define( 'FORCE_SSL_ADMIN', true );
// in some setups HTTP_X_FORWARDED_PROTO might contain
// a comma-separated list e.g. http,https
// so check for https existence
if( strpos( $_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false )
	$_SERVER['HTTPS'] = 'on';
```

#### Passing Headers Through a Proxy

When you're using a proxy pass redirection, you transmit the request to a host of your networks but don't transmit the headers linked to it. However some headers are needed by WordPress to make it able to do some redirections. In order to transmit them you need to add some lines to your redirection.

For instance, with Nginx you need to have these lines:

```
location / {
	proxy_pass http://your_host_name:your_port;
	proxy_set_header Host $host:$server_port;
	proxy_set_header X-Real-IP $remote_addr;
	proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
	proxy_set_header X-Forwarded-Host $server_name;
	proxy_set_header X-Forwarded-Proto $scheme;
	proxy_redirect off;
}
```

The variables like `$variable` are automatically managed by the reverse proxy.

## Display Errors

`display_errors` is a directive found in PHP, found in the php.ini file. With this option, PHP determines whether or not errors should be printed directly on the page.

### Why display_errors needs to be disabled

According to [PHP documentation](https://www.php.net/manual/en/errorfunc.configuration.php#ini.display-errors), it should never be enabled on production environments or live sites.

While `display_errors` may provide useful information in debugging scenarios, there are potential security issues that need to be taken into account if it is activated. [See OWASP article about improper error handling.](https://owasp.org/www-community/Improper_Error_Handling)

However, some hosting companies have `display_errors` enabled by default. This may be due to a misconfiguration, such as trying to disable it by using a configuration that does not work in hosting environments where for example PHP is not running as a module, but with PHP FastCGI Process Manager (PHP-FPM).

### How to disable display_errors

Check your hosting control panel to disable `display_errors` or reach out to your hosting provider.

If your PHP is running as Apache module, you may be able to disable `display_errors` with the following `.htaccess` configuration:

`<IfModule mod_php8.c> php_flag display_errors off </IfModule>`

If your server uses FastCGI/PHP-FPM, it may be possible disable the `display_errors` by ensuring that a `.user.ini` file with the following content:

`display_errors = 0`

If these examples do not work for you, or if you need more instructions, please reach out to your hosting provider.

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

WordPress has the ability to automatically apply security updates. This should be enabled in almost all cases. The exception is if files are not writable, outside of `wp-content/uploads`, for security reasons. In this instance, an alternative, expedient, and, preferably, automatic update process should be made available. See [Configuring Automatic Background Updates  
](https://developer.wordpress.org/advanced-administration/upgrade/upgrading/#configuring-automatic-background-updates) for details on automatic update configuration.

[info]If you’re interested in improving this handbook, check the [Github Handbook repo](https://github.com/WordPress/hosting-handbook/), or leave a message in the [#hosting channel](https://wordpress.slack.com/archives/hosting/) of the official [WordPress Slack](https://make.wordpress.org/chat/).[/info]


# Responsible Disclosure

Responsible disclosure means the following: if you encounter a security breach (or a weak spot) concerning the WordPress core software, we would like to hear about this as soon as possible. The WordPress community takes security bugs seriously. We appreciate your efforts to responsibly disclose your findings, and will make every effort to acknowledge your contributions.

To report a security issue, please visit the [WordPress HackerOne](https://hackerone.com/wordpress) program and file a ticket there.

If you encounter security issues or insecure recommendations in the hosting documentation, we would like you to raise an issue in the [hosting-handbook Github repository](https://github.com/WordPress/hosting-handbook/issues/).
