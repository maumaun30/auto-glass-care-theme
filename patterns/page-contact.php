<?php
/**
 * Title: Contact page
 * Slug: auto-glass-care/page-contact
 * Description: Contact page: business details from Theme Settings and an email contact form.
 * Categories: auto-glass-care, page
 * Keywords: page, starter
 * Block Types: core/post-content
 * Post Types: page
 * Viewport Width: 1400
 *
 * @package AutoGlassCare
 */

$agc_years = (int) agc_get_setting( 'experience_years' );

// phpcs:disable WordPress.Security.EscapeOutput -- section helpers escape their content.
echo agc_section_contact_details();
echo agc_section_contact_form();
