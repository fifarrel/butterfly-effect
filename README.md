# Butterfly Effect — Local Dev Setup

This repo contains the custom WordPress theme (`butterfly-theme`) for the site. It does **not** include WordPress core, plugins, or the database — those live in your own local WordPress install. Follow the steps below to get a working copy running on your machine.

## Prerequisites

- [Local by WP Engine](https://localwp.com/) — runs PHP, MySQL, and the web server for you
- [VS Code](https://code.visualstudio.com/) — code editor
- [Git](https://git-scm.com/) — should already be installed if you have GitHub CLI, otherwise install separately
- A GitHub account with access to this repo (ask Finn to add you as a collaborator if you don't have access yet)

## 1. Install Local

Download and install Local from [localwp.com](https://localwp.com/). No configuration needed beyond the installer defaults.

## 2. Create a new WordPress site

1. Open Local → **Create a new site**
2. Name it (e.g. `butterfly-effect`)
3. Use the default PHP/MySQL/WordPress version settings
4. Once created, click **Start site**, then **Admin** to confirm you can log into wp-admin — you should land on a default WordPress site with a stock theme active. That's expected at this point.

## 3. Install VS Code + extensions

Install VS Code, then add these extensions:

- **PHP Intelephense** — PHP autocomplete and type checking
- **WordPress Hooks IntelliSense** — autocomplete for `add_action`/`add_filter` hooks
- **PHP Debug** (optional) — for step-through debugging with Xdebug later

## 4. Locate your site's theme folder

In Local, click the site → **Open Site Folder**. On Windows this is typically:

```
C:\Users\<you>\Local Sites\butterfly-effect\app\public\wp-content\themes\
```

## 5. Clone this repo into the themes folder

Open a terminal in that `themes` folder and run:

```bash
git clone https://github.com/fifarrel/butterfly-effect.git butterfly-theme
```

This pulls the theme code directly into a `butterfly-theme` folder alongside WordPress's default themes.

> If `git push`/`git pull` asks for a password and rejects it, GitHub doesn't accept account passwords over HTTPS anymore. Either install [GitHub CLI](https://cli.github.com/) and run `gh auth login`, or generate a [Personal Access Token](https://github.com/settings/tokens) and use that in place of your password when prompted.

## 6. Activate the theme

In Local, click **Admin** to open wp-admin, then go to **Appearance → Themes**. You should see **butterfly-theme** listed — click **Activate**.

## 7. Open the project in VS Code

File → Open Folder → select the `butterfly-theme` folder (not the whole WordPress install — that keeps your workspace focused on just the code you're editing).

## 8. (Optional) Enable debugging

In the site's `wp-config.php` (in `app/public/`, not in the theme folder), find:

```php
define( 'WP_DEBUG', false );
```

and change it to:

```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', true );
define( 'WP_DEBUG_LOG', true );
```

This surfaces PHP errors on-page and logs them to `wp-content/debug.log`, instead of showing a blank white screen on errors.

## Day-to-day workflow

- Local runs in the background — start the site once, leave it running while you work
- Edit files in VS Code inside `butterfly-theme/`
- Refresh `butterfly-effect.local` in your browser to see changes — no build step needed
- Commit and push changes from inside the `butterfly-theme` folder as normal:

```bash
git add .
git commit -m "your message"
git push
```

- Pull the latest changes before starting work each time:

```bash
git pull
```

## What's NOT in this repo (and why)

- **WordPress core** (`wp-admin/`, `wp-includes/`, etc.) — downloaded fresh by Local when you create the site
- **Plugins** — install directly via wp-admin if/when needed
- **Uploads / media library** — local to each machine, not version controlled
- **Database content** (pages, posts, settings) — lives in each person's local MySQL instance, not in git. If you need to sync actual site content (not just code) between machines, ask Finn — that needs a database export/import rather than git.

## Page templates need a matching WordPress Page

Several top-level pages (Treatments, Training, Permanent Makeup, Smart Skin Survey, etc.) are built as `page-{slug}.php` template files in this theme — e.g. `page-smart-skin-survey.php` is used automatically by WordPress's template hierarchy, but **only once a WordPress Page with the matching slug exists in the database**.

Since database content isn't in git (see above), pulling this repo's code alone is not enough. On each environment (your local site, a teammate's local site, production), you also need to manually create the Page in wp-admin:

1. **Pages → Add New**
2. Give it the matching title (WordPress will auto-generate the slug — check it matches the template filename, e.g. title "Smart Skin Survey" → slug `smart-skin-survey`)
3. Publish it (the content/blocks you add don't matter — the template file fully controls what renders)

Forgetting this step is why a button/link to a new page can work on one machine and 404 on another even though the code is identical.

## Deploying to production

The Local setup above is for development only. Going live means standing up a **separate** WordPress install on real hosting and getting this theme's code onto it — see [What's NOT in this repo](#whats-not-in-this-repo-and-why) above for why WordPress core, plugins, and the database aren't part of this.

### 1. Pick hosting

Any host that runs WordPress (PHP + MySQL) works. Managed WP hosts (WP Engine, Kinsta, etc.) handle server config, SSL, and backups for you; general hosting (a VPS, cPanel) gives more control but more setup work.

### 2. Point the domain

Update the domain's DNS (A record or nameservers, depending on the host) to point at the new hosting. This can take a few hours to propagate.

### 3. Install WordPress on the host

Same idea as [step 2](#2-create-a-new-wordpress-site) locally, but on the live server — most hosts have a one-click WordPress installer, or pre-install it for you.

### 4. Deploy the theme code

Get `butterfly-theme` into the host's `wp-content/themes/` folder. Two options depending on what the host supports:

- **Git-based hosts (SSH access):** `git clone` this repo directly into `wp-content/themes/butterfly-theme` on the server, same as [step 5](#5-clone-this-repo-into-the-themes-folder) locally. On future deploys, `git pull` there to update.
- **Upload-only hosts (no SSH):** zip the `butterfly-theme` folder and upload it via wp-admin → **Appearance → Themes → Add New → Upload Theme**.

### 5. Activate the theme

wp-admin → **Appearance → Themes** → activate **butterfly-theme**.

### 6. Recreate the required Pages

See [Page templates need a matching WordPress Page](#page-templates-need-a-matching-wordpress-page) above — this is a fresh WordPress install, so none of those Pages exist yet. Create each one (About Us, Treatments, Training, Smart Skin Survey, etc.) with the matching slug before pointing the live domain at it.

### 7. Install needed plugins

Whatever you're relying on locally (SEO, forms, caching, security) needs to be installed fresh on the host too — plugins aren't in this repo (see above).

### 8. Turn off debug output

In the live site's `wp-config.php`, make sure debug settings are off (opposite of [step 8](#8-optional-enable-debugging) locally):

```php
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', false );
```

Leaving `WP_DEBUG_DISPLAY` on in production shows PHP errors/warnings directly on the page to visitors.

### 9. Final checks

- Force HTTPS and confirm the SSL certificate is active
- Test the dark mode toggle and the header/footer marble effects render correctly
- Set up a backup schedule if the host doesn't do it automatically
