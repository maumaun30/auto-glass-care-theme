# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

WordPress block (FSE) theme "Auto Glass Care", built to be reused across shop websites. The repo root is the theme root. Requires WP 6.7+, PHP 8.0+.

## No build step
- Editor JS is plain browser JS using `window.wp` globals (`wp.element.createElement`, not JSX). Each block's `index.asset.php` lists its script dependencies by hand, so update it when an editor script starts using a new `wp.*` package.
- Never add npm/webpack tooling unless asked.

## Reusability rules
- Business data (name, phone, email, address, hours, socials, quote services) must come from `agc_get_setting( $key )` (`inc/settings.php`). Never hardcode it. A new setting goes into `agc_settings_fields()`, which drives defaults, sanitizing and the admin form. Expose it to Block Bindings by adding it to `agc_bindable_fields()` (`inc/bindings.php`).
- Colors and fonts come from `theme.json` presets (`var(--wp--preset--color--accent)` and so on). No raw hex values in block CSS.
- PHP prefix: `agc_` / `AGC_`. Block namespace: `agc/`. Text domain: `auto-glass-care`.

## Styles are component-based (no global stylesheet)
- Custom block CSS lives in `blocks/<name>/style.css`, wired in through `block.json`.
- CSS for a core block goes in `assets/css/blocks/<namespace>-<block>.css` (e.g. `core-group.css`). It is auto-registered with `wp_enqueue_block_style`, so it only loads when that block is on the page.
- Section looks and block styles are theme.json partials: `styles/sections/*.json` and `styles/blocks/*.json` (each has `blockTypes` + `slug`). They appear as `is-style-<slug>`.
- Gotcha: `file:./` image URLs inside `styles/` partials are NOT resolved by WP. Put background images in the `assets/css/blocks/*.css` file instead, using relative `url()`.
- Gotcha: never name a palette slug `text`, `background` or `link`. The generated `.has-text-color` class collides with core's marker class and recolors everything.

## Blocks and patterns
- Custom blocks in `blocks/*/` are dynamic: `render.php` + `save: () => null`, and the editor previews them through `ServerSideRender`.
- Patterns are PHP (`patterns/*.php`) so they can use `AGC_URI` and the settings. `parts/header.html` and `parts/footer.html` only reference the `auto-glass-care/header` and `auto-glass-care/footer` patterns.
- Hand-written block markup must match core's saved HTML exactly (class lists, `is-resized` and so on), or the editor flags it as "invalid block".

## Local testing
- `docker compose -f .dev/compose.yml up -d` starts WordPress on http://localhost:8089 with the theme mounted read-only.
- WP-CLI: `docker compose -f .dev/compose.yml exec -T cli wp <command>`.
- After changes, lint with `php -l` and curl the main routes. Treat any `Warning`/`Fatal` in the output as a failure.
- `.dev/*.sql` dumps are gitignored. `.distignore` keeps `.dev/` and `CLAUDE.md` out of release zips.
