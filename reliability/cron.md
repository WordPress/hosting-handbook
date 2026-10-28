# WP-Cron and System Cron

WordPress uses WP-Cron to run scheduled tasks. Examples are scheduled posts, update checks, and many plugin tasks. WP-Cron is not a real system scheduler. It runs only when a request comes to the site.

## How WP-Cron works

On each request, WordPress checks for due events. If an event is due, WordPress sends a non-blocking loopback request to `wp-cron.php`, which runs the events. A lock (the `doing_cron` transient) stops parallel runs. The lock lasts for `WP_CRON_LOCK_TIMEOUT` seconds (60 by default).

Since WordPress 6.9, WordPress starts this loopback request on the `shutdown` action, after the page is sent. In older versions, the request started before the page was sent, and it increased the Time To First Byte (TTFB).

This design has known limits for hosts:

- If a site gets few visits, events run late.
- If a site gets many visits, the cron check runs on many requests.
- If the server blocks loopback requests (firewall, DNS, Basic Auth, or no local route to the domain), events do not run.
- Long events run inside a web request, so web server and PHP-FPM time limits apply.

Site Health shows "A scheduled event is late" or "A scheduled event has failed" when events do not run on time. It also has a loopback request test.

## Run WP-Cron from the system scheduler

For most hosting platforms, a system scheduler gives more reliable results. Use these steps:

1. Add this line to `wp-config.php`, above the "That's all, stop editing!" line:

   ```php
   define( 'DISABLE_WP_CRON', true );
   ```

   This constant stops WordPress from starting cron on page requests. It does not stop the events. Scheduled events still run when the system scheduler calls them.

2. Add a system cron job that runs the due events. With [WP-CLI](https://developer.wordpress.org/cli/commands/cron/event/run/), use:

   ```
   */5 * * * * cd /path/to/wordpress && wp cron event run --due-now --quiet
   ```

   If WP-CLI is not available, request `wp-cron.php` over HTTP:

   ```
   */5 * * * * curl -s -o /dev/null https://example.com/wp-cron.php?doing_wp_cron
   ```

3. Run the job as the same system user that owns the site files. Do not run it as `root`.

An interval of 1 to 5 minutes is common. Select the interval from the needs of the site. A WooCommerce store, for example, can need a shorter interval than a brochure site.

## Multisite

Each site in a network has its own cron events. One `wp cron event run` call runs the events of one site only. To run the events of all sites, loop over the sites:

```
wp site list --field=url | xargs -I {} wp cron event run --due-now --url={} --quiet
```

## Notes for hosts

- If you set `DISABLE_WP_CRON` for customers, always add the system cron job. Without it, no scheduled events run.
- Tell customers when you change the cron setup, so they know where their scheduled tasks run.
- On staging copies, consider disabling the cron job. Scheduled events on a copy can send emails or call external APIs.
- `wp cron test` (WP-CLI) checks that WP-Cron can spawn through a loopback request.

## More information

- [Hooking WP-Cron Into the System Task Scheduler](https://developer.wordpress.org/plugins/cron/hooking-wp-cron-into-the-system-task-scheduler/) (Plugin Handbook)
- [wp cron](https://developer.wordpress.org/cli/commands/cron/) (WP-CLI commands)
