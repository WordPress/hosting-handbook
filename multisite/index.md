# WordPress Multisite / Network

WordPress Multisite is a feature of WordPress that enables you to create several instances of WordPress managed within one installation. You need to have rewrites enabled to use multisite. Check the [server requirements](#server-requirements) for details.

One can use a multisite for a variety of purposes. Multisite is, for example, used by business sites that share some resources, such as the theme or plugins, and have different content for their regions.

The content in a Multisite has its own unique tables in the database, only the user table is shared between the instances.

You can create a multisite that works with subdirectories ("path-based") or use domains or subdomains ("domain-based"). For how to map the domains, see [Domain Mapping](#domain-mapping).

## Do You Really Need a Network?

The sites in a multisite network are separate, very much like the separate blogs at WordPress.com. They are not _interconnected_ like things in other kinds of networks (even though plugins can create various kinds of interconnections between the sites). If you plan on creating sites that are strongly interconnected, that share data, or share users, then a multisite network might not be the best solution.

For example, if all you want is for different collections of web pages to look very different, then you can probably achieve what you want in a single site by using a plugin to switch themes, templates, or stylesheets.

For another example, if all you want is for different groups of users to have access to different information, then you can probably achieve what you want in a single site by using a plugin to switch capabilities, menus, and link URLs.

## Types of Multisite Network

You can choose between several different types of multisite network depending on how you want your network to handle URLs, and on whether it will allow end users to create new sites on demand.

Different types of network have different server requirements, which are described in [Server Requirements](#server-requirements) below. If you do not have full control over your server then certain types of multisite network might not be available to you. For example, you might not have full control over your server because you use a shared hosting environment. In that case you will have to negotiate the requirements with whoever operates the hosting environment.

The sites in a network have different URLs. You can choose one of two ways for the URL to specify the site:

* Each site has a different _subdomain_. For example: `site1.example.com`, `site2.example.com`.
* Each site has a different _path_. For example: `example.com/site1`, `example.com/site2`

Additionally, you can map domains like `example1.com`, `example2.com`, etc, however a plugin is suggested. You can make the changes directly in the network settings, but it's considered advanced administration.

[![Administration managing sites screen](https://i0.wp.com/wordpress.org/support/files/2018/11/sites-edit-site_4.7.png?fit=612%2C235&ssl=1)](https://i0.wp.com/wordpress.org/support/files/2018/11/sites-edit-site_4.7.png?fit=612%2C235&ssl=1)

You can also choose whether or not to allow end users to create new sites on demand. Domain-based on-demand sites are normally only possible using subdomains like `site1.example.com` and `site2.example.com`. Path-based on-demand sites are also possible.

The multisite installation process uses different terminology. A _sub-domain install_ creates a domain-based network, even though you might use separate mapped domains, and not subdomains, for your sites. A _sub-directory install_ creates a path-based network, even though it does not use file system directories. If you want to use a _sub-domain_ install, you must install WordPress in the root of your webpath (i.e. `example.com`) however it does _not_ need to be installed in the root (i.e. `/public_html/`) if you choose to run WordPress from its own directory.

After the multisite network installation is complete, WordPress uses the terminology _domain_ and _path_ for each site's domain and path in the Network Admin user interface. A super admin (that is, a multisite network administrator) can edit sites' domain and path settings, although it is unusual to do this to established sites because it changes their URLs.

Plugins can extend the options available and help with administration. Search the [Plugin Directory](https://wordpress.org/plugins/search/multisite/) for 'multisite'.

## Admin Requirements

To create a multisite network you must be the administrator of a WordPress installation, and you normally need access to the server's file system so that you can edit files and create a directory. For example, you could access the server's file system using FTP, or using the File Manager in cPanel, or in some other way.

You do not necessarily need any knowledge of WordPress development, PHP, HTML, CSS, server administration or system administration, although knowledge of these things might be useful for troubleshooting or for customizing your multisite network after installation.

## Server Requirements

When you are planning a network, it can sometimes be helpful to use a development server for initial testing. However, setting up a development server that exactly matches your production server is not always possible, and transferring an entire network to a production server may not be easy. A test site on your production server is sometimes a more useful way to test your planned network.

In all cases, you will need to make sure your server can use the more complex `.htaccess` (or `nginx.conf` or `web.config`) rules that Multisite requires.

Multisite requires `mod_rewrite` to be loaded on the Apache server, support for it in [`.htaccess`](../server/httpd.md) files, and `Options FollowSymLinks` either already enabled or at least not permanently disabled. If you have access to the server configuration, then you could use a `Directory` section instead of a `.htaccess` file. Also make sure that your `httpd.conf` file is set for `AllowOverride` to be `All` or `Options All` for the vhost of the domain.

Some server requirements depend on the type of multisite network you want to create, as follows.

### Domain-based

Also known as 'Subdomain' installs, a domain-based network uses URLs like `https://subsite.example.com`.

A domain-based network maps different domain names to the same directory in the server's file system where WordPress is installed. You can do this in various ways, for example:

* by configuring wildcard subdomains
* by configuring virtual hosts, specifying the same document root for each
* by creating addon domains or subdomains in cPanel or in a similar web hosting control panel

On-demand domain-based sites require the wildcard subdomains method. You can create additional sites manually in the same network using other methods.

Whichever methods you use, you will need to configure your DNS (to map the domain name to the server's IP address) and server (to map the domain name to the WordPress installation directory). WordPress will then map the domain name to the site.

WordPress _should_ be run from the root of your webfolder (i.e. `public_html`) for subdomains to work correctly. Making subdomains work from a non-root directory requires experience with virtual hosts and redirects.

For examples of how to configure wildcard subdomains on various systems, see [Configuring Wildcard Subdomains](../server/subdomains-wildcard.md).

External links:

* [Wildcard DNS record](https://en.wikipedia.org/wiki/Wildcard_DNS_record) (Wikipedia)
* [Apache Virtual Host](https://httpd.apache.org/docs/2.0/en/vhosts/) (Apache HTTP Server documentation)

### Path-based

Also known as 'Subfolder' or 'Subdirectory' installs, a path-based network uses URLs like `https://example.com/subsite`.

If you are using pretty permalinks in your site already, then a path-based network will work as well, and you do not need any of the other information in this section. That said, be aware that your main site will use the following URL pattern for posts: `https://example.com/blog/[postformat]/`

At this time, you **cannot** remove the blog slug without manual configuration to the network options in a non-obvious place. It's not recommended.

## WordPress Settings Requirements

When you install a multisite network you start from an existing WordPress installation. If it is a fresh install with its own domain name, then you do not need to read this section. If it is an established site, or not reachable using just a domain name, then the following requirements apply to allow it to be converted to a multisite network.

### Be Aware

[Giving WordPress its own directory](../server/wordpress-in-directory.md) works with Multisite as of 3.5, however you must make the 'own directory' changes before you activate Multisite.

While it's not recommended to use www in your domain URL, if you chose to do so and plan to use _subdomains_ for multisite, make sure that **both** the site address and the WordPress address are the same. Also keep in mind some hosts will default to showing this sort of URL:

[![Site address setting without www](https://i0.wp.com/wordpress.org/support/files/2018/11/no-www.png?fit=474%2C215&ssl=1)](https://wordpress.org/documentation/files/2018/11/no-www.png)

For this, and many other reasons, we do not suggest you use www in your domain name whenever possible. If you plan on changing them to `example.com` or `www.example.com`, do so _before_ you begin the rest of the setup for multisite, as changing the domain name after the fact is more complicated.

### Restrictions

You **cannot create a network** in the following cases:

* "WordPress address (URL)" uses a port number other than ':80', ':443'.

You _cannot choose **Sub-domain** Install_ (for a domain-based network) in the following cases:

* The WordPress URL contains a path, not just a domain. (That is, WordPress is not installed in a document root, or you are not using the URL of that document root.)
* "WordPress address (URL)" is `localhost`.
* "WordPress address (URL)" is an IP address such as 127.0.0.1.

(Note that you can create a domain-based network on your local machine for testing purposes by using your hosts file to map some other hostnames to the IP address 127.0.0.1, so that you never have to use the hostname `localhost`.)

You _cannot choose **Sub-directory** Install_ (for a path-based network) if your existing WordPress installation has been set up for more than a month, due to issues with existing permalinks. See [Switching network types](https://developer.wordpress.org/advanced-administration/multisite/administration/#switching-network-types) for more information.

_See `wp-admin/network.php` for more detail._

## Domain Mapping

WordPress multisite subsites may be mapped to a non-network top-level domain. This means a site created as `subsite1.networkdomain.com` can be mapped to show as `example.com`. This also works for subdirectory sites, so `networkdomain.com/subsite1` can also appear at `example.com`. Before setting up domain mapping, make sure your network has been correctly set up, and subsites can be created without issues.

In WordPress 4.5+, domain mapping is a native feature. Before WordPress 4.5, it required a domain mapping plugin.

### Map Domains in DNS

Make sure all the domains you want to use are already mapped to your **DNS** server. The additional domains should be parked upon the master domain.

### Install SSL Certificates

Install SSL for the primary domain and use **Server Name Indication** (SNI) for all other domains. Every domain should have SSL installed to ensure encrypted admin login.

### Update WordPress

In the network admin dashboard, click on Sites to show the listing of all the subsites, and then click on edit for the subsite you want to map to.

In the Site Address (URL) field, enter the full URL to the domain name you're mapping, `https://example.com`, and click save.

### Edit wp-config.php

If you get an error about cookies being blocked when you try to log in to your network subsite (or log in fails with no error message), open your `wp-config.php` file and add this line after the other code you added to create the network:

```
define( 'COOKIE_DOMAIN', $_SERVER['HTTP_HOST'] );
```

## Migrating Existing Sites into a Network

This section explains how to migrate multiple WordPress installs into a WordPress multisite install. You can migrate sites that use their own domain names, as well as sites that use a subdomain on your primary domain.

It assumes that you are hosting WordPress on a server using cPanel. If you are using another solution to manage your server, you'll have to adapt these instructions.

### Back Up Your Site

Generate a full site backup in cPanel. It might also help to copy all the files on the server via FTP, so that you can easily access the files for plugins and themes, which you'll need in a later step. See [Backups](../reliability.md#backups).

### Export from Your Existing WordPress Installs

In each of your existing WordPress installations, go to Tools > Export in WordPress. Download the WXR files that contain all your posts and pages for each site. See the instructions on the [Tools Export Screen](https://wordpress.org/documentation/article/tools-export-screen/).

Make sure that your export file actually has all the posts and pages. You can verify this by looking at the last entry of the exported file using a text editor. The last entry should be the most recent post.

Some plugins can conflict with the export process, generating an empty file, or a partially complete file. To be on the safe side, you should probably disable all plugins before doing the exports.

It's also a good idea to first delete all quarantined spam comments as these will also be exported, making the file unnecessarily large.

Note: widget configuration and blog/plugin settings are NOT exported in this method. If you are migrating within a single hosting account, make note of those settings at this stage, because when you delete the old domain, they will disappear.

### Install WordPress and Activate Multisite

Install WordPress, then activate multisite in the install. This involves editing `wp-config.php` a couple of times. You need to use the subdomain, not the subdirectory, option. See [Create A Network](create-network.md).

### Create Sites for Each Site You Want to Import

Create sites for each of the sites you want to host at separate domains. For example, `importedsite.example.com`.

Note: choose the name carefully, because changing it causes admin redirection issues. This is particularly important if you are migrating a site within the same hosting account.

### Import WXR Files for Each Site

Go to the backend of each site, and import the exported WXR file. Map the authors to the proper users, or create new ones. Be sure to check the box that will pull in photos and other attachments.

Note: if you choose to import images from the source site into the target site, make sure they have been uploaded into the right place and are displayed correctly in the respective post or page.

### Copy Theme and Plugin Files

Before you start, check that your plugins will work in the network installation. If a plugin is not supported, do not install it. Find suitable alternatives for it by searching for the plugin's function with "multisite".

Copy the theme and plugin files from your old WordPress installs to their respective directories in the new `wp-content`. You can activate themes for the network, or you can go to Superadmin > Sites, then click edit on the site you want, and enable a given theme for just that site.

Note: if you are using a child theme, copy both parent and child themes to the new site.

### Edit WordPress Configuration Settings for Each Site

Edit the configuration settings, widgets, and so on for each site. By the end of this step, each site should look exactly as it did before, only with the URL `subdomain.example.com` or `example.com/subsite` rather than its correct, final URL.

### Potential Problems

**Limitations of PHP configuration.** You may run into trouble with the PHP configuration on your host. There are two potential problems. One is that PHP's `upload_max_filesize` will be too small for the WXR file. The other is that the PHP memory limit might be too small for importing all the posts.

There are a couple of ways to solve it. One is to raise the limits, even temporarily. The other is to put a `php.ini` file in the `/wp-admin/` and `/wp-includes/` directories that raises the limits (`php.ini` files are not recursive, so it has to be in those directories). Something like a 10 MB upload limit and a 128 MB memory limit should work. See [PHP](../performance.md#php) for the directives involved.

**Converting add-on domains to parked domains.** Deleting add-on domains in cPanel and replacing them with parked domains will also delete any domain forwarders and e-mail forwarders associated with those domains. Be aware of this, so that you can restore those forwarders once you've made the switch.

**Limitations of importing users.** Importing content this way does not carry users across cleanly. Users are generated during the import, but roles and additional information do not come with them.

**Losing settings.** If the old site is no longer available and you find you have forgotten to copy some setting, or you want to make sure you have configured everything correctly, the [Internet Archive Wayback Machine](https://archive.org/web/) may have a copy of the site, or some part of it, archived.

## Related

* [Create A Network](create-network.md)
* [Multiple WordPress Instances](../server-environment.md#multiple-wordpress-instances)
* [Multisite Network Administration](https://developer.wordpress.org/advanced-administration/multisite/administration/)
