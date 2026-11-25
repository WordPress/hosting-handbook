# Staging Environments

Many hosts give customers a staging copy of their site. Customers use the copy to test updates, themes, and plugins before they change the live site. A staging copy shares code and data with the live site, so it can cause problems on the live site if it is not set up correctly.

## Set the environment type

WordPress 5.5 added the `wp_get_environment_type()` function. Themes, plugins, and WordPress itself use it to change behavior per environment. The possible values are `local`, `development`, `staging`, and `production`. If no value is set, the type is `production`.

Set the type with the `WP_ENVIRONMENT_TYPE` constant in `wp-config.php`:

```php
define( 'WP_ENVIRONMENT_TYPE', 'staging' );
```

You can also set a `WP_ENVIRONMENT_TYPE` system environment variable. If both are set, the constant has priority. An invalid value changes the type to `production`.

Set `staging` on every staging copy that you create. Do not copy this setting back to the live site when you push changes from staging to production.

Notes:

- When the type is `local`, Application Passwords are available without HTTPS. Do not use `local` on a server that is reachable from the internet.
- `WP_DEVELOPMENT_MODE` (added in WordPress 6.3) is a different setting. It is for developers who work on core, a plugin, or a theme. It is not the same as the environment type.

## Prevent side effects from the staging copy

A staging copy has the same data as the live site. Without changes, it can:

- Send emails to real customers, for example order or newsletter emails.
- Run scheduled events that call external services, for example payments, subscriptions, or API syncs.
- Be indexed by search engines as duplicate content.

To prevent these problems:

1. Restrict access to the copy with HTTP authentication or another access control. You can also set the "Discourage search engines" option, but it does not restrict access, and search engines do not have to follow it:

   ```
   wp option update blog_public 0
   ```

2. Stop or capture outgoing email, for example with a mail catcher on the staging server.
3. Disable automatic WP-Cron on the copy by setting `DISABLE_WP_CRON` to `true` in `wp-config.php`, and disable any system cron job or external scheduler that calls its `wp-cron.php` or runs its events. Review the scheduled events before you enable cron again.
4. Tell customers to use test or sandbox credentials for payment and other external services.

## Change the URLs

The copy needs its own URL. WordPress stores URLs in the database, also inside serialized data. Do not change the URLs with plain SQL `REPLACE` statements, because this breaks serialized data. Use [`wp search-replace`](https://developer.wordpress.org/cli/commands/search-replace/), which handles serialized data:

```
wp search-replace 'https://example.com' 'https://staging.example.com' --all-tables-with-prefix --dry-run
```

Read the result of the `--dry-run` command first. Then run the command again without `--dry-run`.

## Push changes to production

When customers move changes from staging to production, the live site can lose new data. Orders, comments, and new users that the live site received after the copy was made are not in the staging database.

- Prefer to push files (themes and plugins) only, and not the full database.
- If you push database tables, make a backup of the live site first.
- Tell customers which data the push replaces.

## More information

- [`wp_get_environment_type()`](https://developer.wordpress.org/reference/functions/wp_get_environment_type/) (Code Reference)
- [WordPress environment types](https://make.wordpress.org/core/2020/08/27/wordpress-environment-types/) (Make WordPress Core)
- [Configuring development mode in 6.3](https://make.wordpress.org/core/2023/07/14/configuring-development-mode-in-6-3/) (Make WordPress Core)
