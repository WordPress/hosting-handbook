# HTTP Security Headers

HTTP response headers tell the browser how to treat a site. Some headers lower the risk of common attacks, for example clickjacking and MIME-type confusion. Hosts can set these headers in the web server for all sites, or let customers set them per site.

## Headers that WordPress sends

WordPress sends some security headers on its own. Know these before you add server-level headers, so that a response does not get two different values for one header.

| Header | Value | Where | WordPress function |
|---|---|---|---|
| `X-Frame-Options` | `SAMEORIGIN` | Admin screens and the login screen | `send_frame_options_header()` |
| `Referrer-Policy` | `strict-origin-when-cross-origin` (filter: `admin_referrer_policy`) | Admin screens and the login screen | `wp_admin_headers()` |
| `X-Content-Type-Options` | `nosniff` | Some responses, for example REST API and admin-ajax responses | `send_nosniff_header()` |

## Recommended headers

These headers are safe for most WordPress sites:

- **`Strict-Transport-Security` (HSTS)**: tells the browser to use only HTTPS for the domain. Send it only when the full site works over HTTPS. Start with a short `max-age`, then increase it. Add `includeSubDomains` only when all subdomains support HTTPS. Add `preload` only when you are sure, because removal from the [preload list](https://hstspreload.org/) is slow.
- **`X-Content-Type-Options: nosniff`**: stops the browser from guessing the content type. This is important for sites that accept uploads.
- **`Referrer-Policy: strict-origin-when-cross-origin`**: the same value that WordPress uses on admin screens.
- **`X-Frame-Options: SAMEORIGIN`**, or the CSP `frame-ancestors` directive: stops other sites from showing the site in a frame. Some customers embed their site on purpose, so make this setting optional.

## Headers that need care

- **`Content-Security-Policy` (CSP)**: a strict policy can break the block editor, themes, and plugins that use inline scripts or third-party resources. Do not set one CSP for all customer sites. Start with `Content-Security-Policy-Report-Only`, read the reports, then enforce the policy per site.
- **`Permissions-Policy`**: can block browser features, for example camera or geolocation. Some plugins need these features.
- **`X-XSS-Protection`**: do not add this header. It is non-standard, and MDN recommends `Content-Security-Policy` instead.

## Server examples

Nginx:

```nginx
add_header Strict-Transport-Security "max-age=31536000" always;
add_header X-Content-Type-Options "nosniff" always;
add_header Referrer-Policy "strict-origin-when-cross-origin" always;
```

The `always` parameter adds the header to error responses too. Nginx inherits `add_header` directives from a parent block only when the current block has no `add_header` directives. If a `location` block has its own `add_header`, repeat the security headers in that block.

Apache (requires `mod_headers`):

```apache
Header always set Strict-Transport-Security "max-age=31536000"
Header always set X-Content-Type-Options "nosniff"
Header always set Referrer-Policy "strict-origin-when-cross-origin"
```

## Notes for hosts

- After a change, examine the response headers of the home page, an admin screen, and a REST API request. Make sure that no header appears two times with different values.
- If you set headers at the platform level, document them, and tell customers how to change them per site.

## More information

- [OWASP Secure Headers Project](https://owasp.org/www-project-secure-headers/)
- [Strict-Transport-Security](https://developer.mozilla.org/en-US/docs/Web/HTTP/Reference/Headers/Strict-Transport-Security) (MDN)
- [Content-Security-Policy-Report-Only](https://developer.mozilla.org/en-US/docs/Web/HTTP/Reference/Headers/Content-Security-Policy-Report-Only) (MDN)
- [Nginx `add_header`](https://nginx.org/en/docs/http/ngx_http_headers_module.html)
- [Apache `mod_headers`](https://httpd.apache.org/docs/current/mod/mod_headers.html)
