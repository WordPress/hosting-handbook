# Reliability

Once your site is up, how do you keep it that way? And what can you do if it goes down? In most cases, the same best practices apply to WordPress as with other web applications, but some differences and recommendations are detailed here.

## Backups

A WordPress site is composed of three (3) main components: Code WordPress core, zero (0) or more plugins, and one (1) or more themes Assets Typically images, documents and other user-upload files. This can also contain plugin or theme cache and/or configuration files as well. Database A set of tables containing your posts, pages, comments, links, settings, and other data.

> Your WordPress database contains user-generated content and configuration, including every post, every comment and every link you have on your website. If your database gets erased or corrupted, you stand to lose everything you have written. There are many reasons why this could happen and not all are things you can control. With a proper backup of your WordPress database and files, you can quickly restore things back to normal.

It's recommended to keep and test regular backups of your WordPress sites using the system-level backup or snapshot infrastructure of your choice. One thing to be aware of is that the code, assets and database change in conjunction with WordPress but may be backed up separately. For this reason, it is a good idea to keep restore points that include backups of code, assets, and database taken at the same point in time. It’s recommended to create restore points before any critical action, e.g. WordPress core update.

## Monitoring

Site monitoring systems and services can notify you when your site isn't working properly. They can often correct any minor issues, or help you to do so before they become major issues.

### Uptime Monitoring

Uptime monitoring is traditionally done at the server level or by checking one or more URLs on the site at regular intervals to make sure they are responding properly. A combination of internal and external uptime monitoring is ideal for users, and there exist a variety of software and services to handle this for you.

### Performance Monitoring

While a site's services may be responding, to a user, a site being "up" means more than this to them. Performance monitoring is similar to uptime monitoring, but also takes note of certain metrics that could indicate trouble. Metrics like "page load time" and "slowest average transactions" should be monitored and reported regularly to help keep you ahead of performance issues. Monitoring slow logs for problematic queries or requests can also help keep user sites stable. MySQL, PHP-FPM, and others provide options to capture these for monitoring.

### Performance Profiling

It is best practice to use performance profiling tools, such as New Relic, AppDynamics or Tideways, to diagnose the performance bottlenecks of your website and infrastructure. These tools will give you insight such as slow performing functions, external HTTP requests, slow database queries and more that are causing poor performance.

## Version Control

Version control is a way of tracking the changes made to files over time by different people, such as the code for a website or another application. It allows people to track the revision history of code and to revert or apply changes easily via the command line. It is also a good way to debug your website if something goes wrong, as you can quickly restore to a previous state of the site's code without restoring from a full backup.

A lot of WordPress hosts offer version control but there are third-party services and self hosted options as well.

\[info\]If you’re interested in improving this handbook, check the [Github Handbook repo](https://github.com/WordPress/hosting-handbook/), or leave a message in the [#hosting-community channel](https://wordpress.slack.com/archives/hosting-community/) of the official [WordPress Slack](https://make.wordpress.org/chat/).\[/info\]

## Changelog

- 2021-02-17: Changelog added.
- 2020-11-23: Minor text changes and info-block.
- 2020-06-02: Published from Github.
