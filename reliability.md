# Reliability

Once your site is up, how do you keep it that way? And what can you do if it goes down? In most cases, the same best practices apply to WordPress as with other web applications, but some differences and recommendations are detailed here.

## Backups

A WordPress site is composed of three (3) main components: Code WordPress core, zero (0) or more plugins, and one (1) or more themes Assets Typically images, documents and other user-upload files. This can also contain plugin or theme cache and/or configuration files as well. Database A set of tables containing your posts, pages, comments, links, settings, and other data.

> Your WordPress database contains user-generated content and configuration, including every post, every comment and every link you have on your website. If your database gets erased or corrupted, you stand to lose everything you have written. There are many reasons why this could happen and not all are things you can control. With a proper backup of your WordPress database and files, you can quickly restore things back to normal.

It's recommended to keep and test regular backups of your WordPress sites using the system-level backup or snapshot infrastructure of your choice. One thing to be aware of is that the code, assets and database change in conjunction with WordPress but may be backed up separately. For this reason, it is a good idea to keep restore points that include backups of code, assets, and database taken at the same point in time. It’s recommended to create restore points before any critical action, e.g. WordPress core update.

## Monitoring

See [Monitoring](https://developer.wordpress.org/advanced-administration/security/monitoring/).

## Version Control

See [Version Control](https://developer.wordpress.org/advanced-administration/debug/version-control/).

## Changelog

- 2023-05-29: Move the Monitoring to the Advanced Administration Handbook.
- 2023-05-29: Move the Version Control to the Advanced Administration Handbook.
- 2021-05-27: Fixing infoboxes
- 2021-02-17: Changelog added
- 2020-11-23: Minor text changes and info-block
- 2020-06-02: Published from Github
