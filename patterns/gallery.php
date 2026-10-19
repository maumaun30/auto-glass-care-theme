<?php
/**
 * Title: Recent work gallery
 * Slug: auto-glass-care/gallery
 * Categories: auto-glass-care, gallery
 * Keywords: gallery, work, photos, portfolio
 * Viewport Width: 1400
 *
 * @package AutoGlassCare
 */

// phpcs:ignore WordPress.Security.EscapeOutput -- section helpers escape their content.
echo agc_section_gallery( __( 'Our Recent Work', 'auto-glass-care' ), __( 'Replace these photos with your own finished jobs.', 'auto-glass-care' ) );
