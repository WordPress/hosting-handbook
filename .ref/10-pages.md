# Page inventory

Every published page, its place in the navigation, how often it actually changes, and what changes inside it.

Navigation values are read from `bin/handbook-manifest.json`. Cadence is a judgment from the file's history and its content, not a rule.

---

## 1. Navigation

| Key | Menu label | Parent | Order |
|---|---|---|---|
| `index` | Hosting Handbook | — | -1 |
| `get-involved` | Get Involved | — | 1 |
| `team-projects` | Team Projects | `get-involved` | 1 |
| `contributor-day` | Contributor Day | `get-involved` | 2 |
| `team-reps` | Team Reps | `get-involved` | 3 |
| `documentation` | Documentation | `get-involved` | 4 |
| `team-updates` | Monthly Hosting Team Updates | `get-involved` | 5 |
| `server-environment` | Server Environment | — | 2 |
| `compatibility` | Compatibility | — | 3 |
| `upgrading` | Upgrading | — | 4 |
| `tests` | PHPUnit Tests | — | 5 |
| `learn-hosting` | Learn Hosting | — | 6 |
| `performance` | Performance | — | 10 |
| `reliability` | Reliability | — | 11 |
| `sustainability` | Sustainability | — | 12 |
| `security` | Security | — | 13 |

`index` publishes at the slug `handbook` rather than `index`; the remap happens at `bin/command.php:64`. Every other key publishes under its own name.

The gap between order `6` and order `10` leaves room to insert a page in the upper group without renumbering the lower one. Preserve it.

Six of these labels differ from the page's own first heading. That is deliberate and is documented as `H-04` in [`00-pipeline.md`](00-pipeline.md).

---

## 2. Cadence

| Cadence | Pages |
|---|---|
| **Every WordPress release** | `compatibility`, `server-environment`, `upgrading` |
| **Every PHP release or support transition** | `server-environment`, `compatibility` |
| **On an external event** | `tests`, `team-reps`, `team-updates`, `contributor-day` |
| **Rarely, on their own merits** | `index`, `get-involved`, `documentation`, `team-projects`, `learn-hosting`, `performance`, `reliability`, `sustainability`, `security` |

The first two rows are where nearly all the recurring work lands, and `server-environment.md` absorbs most of it. It is by a wide margin the longest page in the handbook.

---

## 3. The release-driven pages

### `compatibility.md`

Two tables, both of which grow by one row per WordPress release.

**"WordPress, PHP, MySQL / MariaDB versions"** — one row per WordPress version, newest first, with columns for PHP, MySQL, MariaDB, and launch date. The page states what this table means and it is easy to get wrong: these are the versions *available and security-supported at the time of that WordPress release*, not the versions WordPress was tested against or claims to support. Build the row from the release date and the vendors' support calendars in [`20-sources.md`](20-sources.md). Do not copy the previous row forward.

**"Server requirements"** — WordPress's *minimum* PHP, MySQL, and MariaDB versions. This only gains a row when a release actually raises a minimum, which is infrequent. Rows are labeled `WordPress X.Y+` and remain correct until superseded.

### `server-environment.md`

The page with the most moving parts. Five regions change on their own triggers.

**"Quick recommendations"** — a reverse-chronological list of links to the *WordPress X.Y Server Compatibility* posts on the Make blog. A new entry is added when the post is published, which is often after the release itself. Until the URL exists, the entry carries a placeholder rather than a guess.

**Web server versions** — a list of known-good versions for Apache, nginx, LiteSpeed, and OpenLiteSpeed, followed by an italic line naming the WordPress version it was current for. That trailing line is easy to miss and goes stale silently.

**The Trac search link** — the introduction to "WordPress versions" carries a long `core.trac.wordpress.org/query?...` URL with a `milestone=` parameter repeated once per tracked release. Each release adds a milestone to that query string. It is the single most-overlooked edit on this page.

**Per-version PHP blocks** — one `#### WordPress X.Y` block per release, newest first. Each lists the PHP versions with their support status at that time, an italic note on the minimum requirement, an italic statement of full compatibility, a footnote marking end-of-life versions supported for backward compatibility only, and a nested list of PHP-related Trac tickets.

**"Notes for Hosts and Developers" and "About PHP"** — the recommendations and support-window prose. These track the PHP release calendar rather than the WordPress one, and they are what goes stale when a version moves to security-only support or reaches end of life.

### `upgrading.md`

Guidance for upgrading across WordPress version ranges, organized into sections spanning several releases each. The final section carries an open-ended range that widens with each release, so most releases require only extending that range. A new section is warranted when the upgrade path itself changes.

---

## 4. The event-driven pages

**`tests.md`** documents the PHPUnit Test Runner and the reporting bot, and is the canonical setup documentation for hosts joining the distributed test program. It changes when the runner or reporter changes, not on the WordPress release cycle. Its content describes software maintained in other repositories, so verify against those before editing.

**`team-reps.md`** lists the current team representatives and the team's organization and onboarding process. It changes when representatives change.

**`team-updates.md`** documents how the monthly team update is generated and published. It changes when that process changes, not monthly.

**`contributor-day.md`** is used at WordCamp contributor days and changes when the onboarding flow does.

---

## 5. Adding a page

1. Create the file at the repository root. The filename becomes the published URL, so choose it as a permanent slug.
2. Start the file with a `# ` heading. The generator anchors on it, and a file that does not begin with one gets an empty title.
3. Regenerate the manifest, then follow the restore procedure in [`00-pipeline.md`](00-pipeline.md) — the generator will have overwritten curated values on every *other* entry as well as adding yours.
4. Set the new entry's `parent` and `order` by hand. Neither is generated.
5. Link the page from wherever a reader would look for it. The contents menu is generated from the manifest, but in-page cross-links are not.
