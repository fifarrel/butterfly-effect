# Going Live — butterflyeffect.ie

This site is currently only running locally (Local by Flywheel). This is the
checklist for whoever moves it onto real hosting and connects it to the
`butterflyeffect.ie` domain. The site is simple — one custom theme, **zero
plugins**, no contact-form backend, no database-driven booking (booking runs
entirely on Versum, an external service) — so there isn't much that can go
wrong, but a few steps below are easy to miss and will break things quietly
if skipped.

## 0. Easiest path: Local's built-in "Connect" / push-to-host feature

If the hosting provider is one Local supports pushing to directly (e.g. WP
Engine, Flywheel, or a generic SFTP/SSH "Custom" connection), use Local's own
**Connect** feature (in the Local app, open this site → **Connect** tab) to
push the site live. It handles the file upload, database export/import, and
the domain search-replace (step 4 below) automatically in one step. If the
host isn't supported this way, follow the manual steps below.

## 1. Point the domain at the new host

- Get the new host's nameservers or IP address from whoever is hosting the
  site.
- In the domain registrar for `butterflyeffect.ie`, either point the
  nameservers at the host, or add an `A` record for `@` (and `www`) to the
  host's IP. DNS changes can take up to 24–48 hours to fully propagate.
- **Do not touch the domain's existing `MX` records** unless email hosting is
  also moving — `info@butterflyeffect.ie` is a live mailbox used throughout
  the site (contact page, footer, privacy policy, terms). Changing
  nameservers wholesale can silently break incoming email if the new host
  doesn't recreate the same MX records — confirm with whoever manages email
  before switching nameservers, or move only the `A`/`www` records instead.

## 2. Set up hosting

- Any standard PHP/MySQL WordPress host works — no special requirements.
  PHP 8.0+ recommended. No plugins are installed, so there's nothing extra
  to install on the host besides WordPress itself.
- Create the production database and a database user on the host; note the
  database name, username, password and host.

## 3. Move the files and database

- Upload the whole WordPress install — this theme lives at
  `wp-content/themes/butterfly-theme` inside the site's root (`app/public`
  in this Local site) — to the host.
- Export the database from Local (Local app → this site → **Database** tab →
  Adminer/phpMyAdmin → export) and import it into the new production
  database.
- **Do not upload the local `wp-config.php` as-is** — create a new one on
  the host (most hosts generate one for you, or copy
  `wp-config-sample.php` from the WordPress root and fill it in) with:
  - The host's real `DB_NAME`, `DB_USER`, `DB_PASSWORD`, `DB_HOST`.
  - **Freshly generated** `AUTH_KEY` / `SECURE_AUTH_KEY` / etc. — get new
    ones from https://api.wordpress.org/secret-key/1.1/salt/ rather than
    reusing the ones from local development.
  - `define( 'WP_ENVIRONMENT_TYPE', 'production' );` — the local
    `wp-config.php` was updated so `WP_DEBUG`/error display turns off
    automatically once this is set to anything other than `local` or
    `development`, so visitors never see raw PHP errors. Carry the same
    logic over into the production `wp-config.php`.

## 4. Fix URLs left over from local development

Local's dev URL (`http://butterfly-effect.local`) is baked into the database
wherever content was written or images were uploaded through wp-admin
(media library URLs, any links typed into page content). This theme's own
code doesn't hardcode that local URL anywhere, only the **database content**
does, so it needs a find-and-replace across the DB:

- If using Local's Connect feature (step 0), this is done for you.
- Otherwise, use WP-CLI if available on the host:
  `wp search-replace 'http://butterfly-effect.local' 'https://butterflyeffect.ie'`
  (run once for `http://` and once for `https://` variants of the old URL if
  unsure which was used), or use a plugin such as **Better Search Replace**
  temporarily, since none is installed by default.

## 5. Turn on HTTPS

- Enable SSL on the new host (most offer free Let's Encrypt certificates).
- In **Settings → General**, set both "WordPress Address" and "Site
  Address" to `https://butterflyeffect.ie`.

## 6. Let the site be found

- **Settings → Reading**: make sure **"Discourage search engines from
  indexing this site"** is UNCHECKED. Local dev sites often have this
  checked by default — if it's still on after go-live, Google will not
  index the site at all.
- **Settings → Permalinks**: click **Save Changes** once (no need to change
  anything). This regenerates the rewrite rules for the new server and is
  what the 29 treatment pages under `/treatments/` rely on to resolve
  correctly (see `README.md` in this same folder).

## 7. Verify content before announcing launch

- `README.md` (in this same theme folder) lists every treatment page slug.
  Several of them still contain `XXX` placeholders for missing prices and
  descriptions — search this theme folder for `XXX` and fill in real content
  before the site is publicly promoted.
- Confirm a `permanent-makeup` page exists and loads (linked from the
  Treatments page, but not part of the virtual-page system the other 29
  treatments use — it needs an actual WordPress Page).

## 8. Click-through test on the live domain

- Home → Treatments → a few individual treatment pages → Book Now (should
  open Versum) → Contact Us → About Us → Training pages.
- Check the mobile menu, the footer social links, and the `tel:`/`mailto:`
  links.
- View page source on a couple of pages and confirm `<title>` and the meta
  description look right (no leftover local URLs, no "XXX").

## Optional, not blocking launch

- No analytics is installed (no Google Analytics/GTM, no Search Console
  verification tag). Add these once launched if wanted.
- No caching or security plugin is installed; consider adding one once live,
  since none is required for the site to function.
- No SEO plugin is installed on purpose — `functions.php`
  (`butterfly_seo_page_data()`) is the single source of truth for every
  page's `<title>` and meta description. If a plugin like Yoast or Rank Math
  is added later, it will likely conflict with this (duplicate meta tags) —
  either skip it or remove the corresponding code in `functions.php`.
