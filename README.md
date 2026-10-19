# Auto Glass Care — WordPress Block Theme

A reusable Full Site Editing (block) theme for auto window tint, glass and detailing shops. It was converted from the Elementor build of [rodztinttouch.com](https://rodztinttouch.com/), keeping the same design, but nothing is tied to one business. Business details live in a settings page, and colors and fonts live in Site Editor → Styles, so the same theme can be rebranded for another shop without code changes.

- WordPress 6.7+ (tested on 7.1), PHP 8.0+
- No build step and no page builder: plain `theme.json`, block templates, and server-rendered custom blocks

## Installation

1. Download `auto-glass-care-<version>.zip` (see [Building a release zip](#building-a-release-zip)).
2. In WordPress, go to **Appearance → Themes → Add New → Upload Theme**, upload the zip, then click **Activate**.
3. Work through [Setting up a new site](#setting-up-a-new-site).

## Setting up a new site

| Where | What to set |
| --- | --- |
| **Appearance → Theme Settings** | Business name, taglines, phone, email, address, hours, service areas, years of experience, copyright start year, social profile URLs, quote form recipient, services list and success message |
| **Appearance → Editor → Styles** | Color palette (accent, highlight, contrast…) and fonts. Changes apply site-wide. |
| **Appearance → Editor → Navigation** | Create the main menu. Until a menu exists, the header lists all published pages alphabetically. |
| **Appearance → Editor → Header → Site Logo block** | Site logo. The bundled logo is shown until you choose one. |
| **Appearance → Editor → Patterns → Header** | Swap the header promo image. The bundled one has the original shop's phone number in the artwork. |
| **Settings → Reading** | Optional. The front page uses the `front-page` template no matter what this is set to. |

The defaults in Theme Settings are the Rodz Tint Touch details, so replace them all when reusing the theme.

## What's included

### Templates

`front-page`, `page` (title banner + breadcrumbs), `page-no-title` (for full-width landing pages), `single`, `index`, `archive`, `search`, `404`, plus the `header` and `footer` template parts.

### Custom blocks (category "Auto Glass Care")

All are dynamic: they are rendered by PHP on each request, so changing Theme Settings updates every page at once.

| Block | Purpose |
| --- | --- |
| **Business Info** | One Theme Settings value (phone, email, address, hours…) with an optional label. Phone, email and address are automatically linked (`tel:`, `mailto:`, Google Maps). |
| **Business Social Links** | Icons for every social URL filled in under Theme Settings |
| **Service Card** | Image card that flips on hover to show a description and link |
| **Quote Form** | Vehicle quote request form (see below) |
| **Copyright** | `© {start year}-{current year} {business name}. {text}` |
| **Breadcrumbs** | Home › parent pages › current page |

### Patterns (category "Auto Glass Care")

Hero / brand intro, Services (flip cards), Get a quote, Service intro with highlights, Customer testimonials (placeholder text to replace with real reviews), Contact details.

### Binding core blocks to Theme Settings

Core Heading, Paragraph, Button and Image blocks can pull their text or link from Theme Settings via the Block Bindings API (source `agc/settings`). In the editor, open the block's **Attributes** panel and connect it to a field, or use markup like:

```html
<!-- wp:heading {"metadata":{"bindings":{"content":{"source":"agc/settings","args":{"key":"tagline"}}}}} -->
```

Available keys: `business_name`, `tagline`, `subtagline`, `phone`, `phone_url`, `email`, `email_url`, `address`, `hours`, `service_areas`, `experience_years`, `social_facebook`, `social_google`, `social_yelp`, `social_instagram`.

## Quote form

- Each submission is saved as a private **Quote Request** (wp-admin menu with a car icon) and emailed to the address in Theme Settings. If that is empty, it goes to the business email, then the site admin email.
- The email's Reply-To is set to the customer's address.
- Spam protection is a hidden honeypot field plus a minimum fill time instead of a nonce, so the form keeps working with full-page caching.
- The site must be able to send mail (e.g. an SMTP plugin). Requests are still saved if sending fails.

## Styling approach

Styles are component-based. There is no global stylesheet.

| Location | Scope |
| --- | --- |
| `theme.json` | Design tokens: palette, fonts, font sizes, spacing, layout widths, element defaults |
| `styles/sections/*.json` | Section styles for Group blocks, shown in the editor as block styles: Top Bar, Nav Bar, Hero, Quote Panel, Footer, Page Title Banner, Info Card |
| `styles/blocks/*.json` | Block styles: Outline Highlight (button), Brand Display / Section Title (heading), Framed (image), Plain / Checklist (list), Review Card (quote) |
| `blocks/<name>/style.css` | Styles for each custom block, loaded only when the block is on the page |
| `assets/css/blocks/<namespace>-<block>.css` | Tweaks to a core block, loaded only when that block is on the page (e.g. `core-navigation.css`) |

## Project structure

```
blocks/       Custom blocks: block.json, render.php, index.js (editor), style.css
inc/          settings.php, bindings.php, blocks.php, quote-form.php, setup.php
patterns/     PHP block patterns (header/footer parts reference these)
parts/        Template parts
templates/    Block templates
styles/       Section and block style variations (theme.json partials)
assets/       Images, component CSS for core blocks, bindings editor script
.dev/         Local Docker environment and release script (excluded from the zip)
```

## Development

There is no build step. Editor scripts are plain JavaScript using the `wp.*` globals. If an editor script starts using a new `wp.*` package, add that package to the block's `index.asset.php`.

### Local WordPress (Docker)

```sh
docker compose -f .dev/compose.yml up -d          # http://localhost:8089
docker compose -f .dev/compose.yml exec -T cli wp core install \
  --url=http://localhost:8089 --title="Auto Glass Care" \
  --admin_user=admin --admin_password='choose-one' --admin_email=you@example.test --skip-email
docker compose -f .dev/compose.yml exec -T cli wp theme activate auto-glass-care
```

The theme folder is mounted read-only, so edits show up on refresh. Run WP-CLI with `docker compose -f .dev/compose.yml exec -T cli wp <command>`, and stop the stack with `docker compose -f .dev/compose.yml down`.

### Building a release zip

```sh
.dev/build-zip.sh   # → dist/auto-glass-care-<version>.zip
```

The version is read from `style.css`. Paths listed in `.distignore` are left out of the zip.

### Conventions

- PHP prefix `agc_` / `AGC_`, block namespace `agc/`, text domain `auto-glass-care`.
- Never hardcode business data. Read it with `agc_get_setting( 'key' )`. To add a setting, add it to `agc_settings_fields()` in `inc/settings.php`.
- Use `theme.json` presets (`var(--wp--preset--color--accent)`) instead of raw colors in CSS.

## License

GNU General Public License v2 or later. The bundled images in `assets/images/` belong to Rodz Tint Touch and should be replaced when the theme is used for another business.
