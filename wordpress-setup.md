# WordPress Setup

This page is a setup routine for hosts that install WordPress for their customers, whether by hand, with a script or through a one-click installer. It lists the steps that are **necessary** for a working, secure installation, and the steps that are **recommended** to give the site a good start. Each step links to the handbook page or documentation with the details.

For installing WordPress as a site owner, see [How to install WordPress](https://developer.wordpress.org/advanced-administration/before-install/howto-install/) in the Advanced Administration Handbook.

## Necessary steps

### Prepare the server

- **Meet the requirements.** Use PHP, database and web server versions that WordPress supports and that still receive security fixes upstream. See [Server Environment](https://make.wordpress.org/hosting/handbook/server-environment/) and [Compatibility](https://make.wordpress.org/hosting/handbook/compatibility/) for the current recommendations, and the [WordPress Requirements page](https://wordpress.org/about/requirements/) for the minimums.
- **Isolate each site.** Run each site as its own non-privileged system user, with its own PHP process pool where possible, so one compromised site cannot read or change another. See [User Accounts](https://make.wordpress.org/hosting/handbook/security/#user-accounts) on the Security page.
- **Set up HTTPS before installing.** When the certificate is in place first, WordPress is installed with `https://` URLs and no search-and-replace is needed later. See [HTTPS and TLS / SSL](https://make.wordpress.org/hosting/handbook/security/#https-and-tls-ssl).

### Create the database

- **Create one database and one database user per site.** Do not share database users between sites.
- **Grant privileges on that database only**, never global privileges. WordPress core and plugin updates create and alter tables, so a user limited to `SELECT`, `INSERT`, `UPDATE` and `DELETE` will cause updates to fail.
- **Use the `utf8mb4` character set**, so the database can store every Unicode character, including emoji.

### Install WordPress

- **Download WordPress from WordPress.org** ([wordpress.org/download](https://wordpress.org/download/)) or with `wp core download`, and check the files with `wp core verify-checksums`.
- **Generate unique keys and salts** for every site. `wp config create` does this automatically, or use the [WordPress.org secret key service](https://api.wordpress.org/secret-key/1.1/salt/). Never copy `wp-config.php` from another site.
- **Set file ownership and permissions.** Files should belong to the site's user, and PHP must be able to write to `wp-content/uploads` and, for automatic updates, to the core files. See [File System](https://make.wordpress.org/hosting/handbook/security/#file-system) on the Security page.
- **Create the administrator account with a unique username and a strong password**, and use the customer's real email address so password resets reach them. Avoid usernames like `admin`. See [WordPress Users and Roles](https://make.wordpress.org/hosting/handbook/security/#wordpress-users-and-roles).

### Keep updates working

- **Leave WordPress automatic background updates enabled**, so security releases are applied without waiting for the customer. If your platform keeps core files read-only, provide your own fast update process instead. See [WordPress Automatic Updates](https://make.wordpress.org/hosting/handbook/security/#wordpress-automatic-updates).

## Recommended steps

- **Set the environment type.** Define `WP_ENVIRONMENT_TYPE` in `wp-config.php` as `production`, `staging`, `development` or `local`. Plugins use [`wp_get_environment_type()`](https://developer.wordpress.org/reference/functions/wp_get_environment_type/) to change their behaviour, for example to avoid sending emails from a staging copy. On staging and development sites, also discourage search engines from indexing the site (Settings > Reading).
- **Make sure email is delivered.** WordPress sends password resets and notifications through PHP's `mail()` by default. Configure outgoing mail on the server, or offer an SMTP or transactional email service. See [Email](https://developer.wordpress.org/advanced-administration/server/mail/) in the Advanced Administration Handbook.
- **Run WP-Cron from a system cron job.** By default, scheduled tasks only run when someone visits the site. Set `DISABLE_WP_CRON` to `true` and run due events from the system scheduler, for example every five minutes with `wp cron event run --due-now`. See [Hooking WP-Cron Into the System Task Scheduler](https://developer.wordpress.org/plugins/cron/hooking-wp-cron-into-the-system-task-scheduler/).
- **Set up caching.** Enable an opcode cache, and offer a page cache and a persistent object cache where your platform supports them. See [Performance](https://make.wordpress.org/hosting/handbook/performance/).
- **Set PHP limits that fit WordPress.** Check `memory_limit`, `upload_max_filesize`, `post_max_size` and `max_execution_time`. See [PHP Memory Limit](https://make.wordpress.org/hosting/handbook/server-environment/#php-memory-limit).
- **Schedule backups, and test restoring them.** Back up both the files and the database, and keep copies off the server. See [Reliability](https://make.wordpress.org/hosting/handbook/reliability/).
- **Keep the installation lean.** Remove plugins the customer did not ask for. Keep one default theme installed as a fallback. If your platform adds its own plugins or must-use plugins, tell the customer what they do.
- **Check Site Health.** After setup, open Tools > Site Health in the dashboard and fix any critical issues it reports. See [Site Health screen](https://wordpress.org/documentation/article/site-health-screen/).

## Example: setting up a site with WP-CLI

The commands below show the WordPress part of a setup routine with [WP-CLI](https://developer.wordpress.org/cli/commands/). They assume the system user, the database and HTTPS are already in place, and are run as the site's user in the web root. Replace the example values with your own.

```bash
# Download WordPress and check the files.
wp core download --locale=en_US
wp core verify-checksums

# Create wp-config.php with unique keys and salts. --prompt asks for the database password, so it does not end up in the shell history.
wp config create --dbname=example_db --dbuser=example_user --dbcharset=utf8mb4 --prompt=dbpass

# Mark the environment and hand WP-Cron over to the system scheduler.
wp config set WP_ENVIRONMENT_TYPE production
wp config set DISABLE_WP_CRON true --raw

# Install WordPress. Without --admin_password, a random password is generated and shown once.
wp core install --url=https://example.com --title="Example Site" --admin_user=example-admin --admin_email=owner@example.com

# Remove plugins the customer did not ask for.
wp plugin delete hello
```

Then add a system cron job for the site, running as the site's user:

```bash
*/5 * * * * cd /path/to/wordpress && wp cron event run --due-now --quiet
```

[info]If you're interested in improving this handbook, check the [GitHub Handbook repo](https://github.com/WordPress/hosting-handbook/), or leave a message in the [#hosting channel](https://wordpress.slack.com/archives/hosting/) of the official [WordPress Slack](https://make.wordpress.org/chat/).[/info]
