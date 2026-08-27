# Sources of truth

Where each recurring fact in the handbook comes from. Use these, not the previous release's row.

The handbook makes claims about software this project does not control — PHP support windows, database lifecycles, WordPress release dates. Every one of those claims has an authoritative source, and copying a value forward from the row above turns a statement about the world into a statement about the table. That is how a compatibility matrix drifts without anyone noticing.

---

## WordPress

| Fact | Source |
|---|---|
| Release dates and the current schedule | [make.wordpress.org/core](https://make.wordpress.org/core/) |
| Minimum PHP and database requirements per release | The release announcement and Field Guide on [make.wordpress.org/core](https://make.wordpress.org/core/) |
| Which PHP versions a release is compatible with | [PHP Compatibility and WordPress Versions](https://make.wordpress.org/core/handbook/references/php-compatibility-and-wordpress-versions/), Core team handbook |
| Server compatibility posts | [Release Compatibility category](https://make.wordpress.org/hosting/category/release-compatibility/) on the Hosting blog |

The Core handbook's PHP compatibility page is the authority for compatibility *claims*. The handbook's job in `server-environment.md` is to restate them for a hosting audience, not to reach its own conclusion.

Compatibility labels have changed twice and both changes were applied retroactively to every WordPress version. The Core team retired ["compatible with exceptions" in April 2025](https://make.wordpress.org/core/2025/04/09/php-8-support-clarification/) and ["beta support" in May 2026](https://make.wordpress.org/core/2026/05/22/php-support-clarification-2026/). Do not reintroduce either label, and treat any older handbook text still carrying one as stale.

---

## PHP

| Fact | Source |
|---|---|
| Active support, security-only, and end-of-life dates | [php.net/supported-versions.php](https://www.php.net/supported-versions.php) |
| Release contents and version anchors | `php.net/ChangeLog-8.php#PHP_8_x` |

PHP versions move through three states, and `server-environment.md` labels them: *Active Support*, then *Security Support*, then end of life. Each version gets roughly two years of active support and one further year of security fixes, but the published dates are what count — read them rather than calculating.

The per-version links in `server-environment.md` use the changelog anchor form, one per minor version. When a new minor version appears, the anchor follows the same pattern.

Two consequences of a version transitioning:

- The label in every `#### WordPress X.Y` block that mentions it becomes wrong. A single PHP transition therefore touches several blocks, not one.
- The prose in "Notes for Hosts and Developers" and "About PHP" needs revisiting, since both make recommendations relative to what is currently supported.

End-of-life versions that WordPress still runs on are marked in the handbook with a footnote saying they are supported for backward compatibility only. Keep that footnote attached whenever such a version is listed.

---

## Databases

| Fact | Source |
|---|---|
| MySQL versions and support status | [dev.mysql.com/downloads/mysql](https://dev.mysql.com/downloads/mysql/) and Oracle's lifecycle policy |
| MariaDB versions and maintenance windows | [mariadb.org](https://mariadb.org/) |

Both projects run several supported branches at once, which is why the compatibility table's database columns list multiple versions separated by `/` rather than a single range. Only long-term-support releases belong in the recommendations on `server-environment.md`; short-term releases reach end of life faster than the handbook is revised.

---

## Trac

| Fact | Source |
|---|---|
| PHP-related tickets for a release | `core.trac.wordpress.org/query?milestone=<version>&keywords=~php` |

`server-environment.md` embeds a longer form of that query in its "WordPress versions" introduction, carrying an explicit `milestone=` parameter for each tracked release plus `Future Release`. **Adding a release means adding its milestone to that query string.** It is the edit most often missed, because the URL is long enough that reviewers skim it.

The per-version ticket lists in each `#### WordPress X.Y` block are compiled from the same query, narrowed to one milestone. Link text is the bare ticket number; see [`30-style.md`](30-style.md) for why.

Tickets that moved or closed without landing are annotated in place rather than removed — the note that a ticket was deferred is often the useful part for a host reading the page later.

---

## Timing

A WordPress release and its server compatibility post do not land together. The release ships first; the post follows, sometimes by weeks.

That gap is the reason for placeholders. When the compatibility table can be filled from the release but the post URL does not exist yet, mark it explicitly and say what is outstanding:

```markdown
- [WordPress X.Y Server Compatibility](TODO-url-once-published)
```

The same applies to a ticket list that has not settled, or a compatibility statement that has not been confirmed. A `TODO` survives review and gets fixed. A plausible guess does not get caught.
