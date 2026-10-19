<?php
/**
 * Title: Package cards
 * Slug: auto-glass-care/packages
 * Categories: auto-glass-care, featured
 * Keywords: packages, pricing, coverage, cards
 * Viewport Width: 1400
 *
 * @package AutoGlassCare
 */

// phpcs:ignore WordPress.Security.EscapeOutput -- section helpers escape their content.
echo agc_section_packages(
	__( 'Our Packages', 'auto-glass-care' ),
	array(
		array( __( 'Basic', 'auto-glass-care' ), 'service-clear-bra.webp', array( __( 'Included item', 'auto-glass-care' ), __( 'Included item', 'auto-glass-care' ) ) ),
		array( __( 'Standard', 'auto-glass-care' ), 'service-ceramic-coating.webp', array( __( 'Included item', 'auto-glass-care' ), __( 'Included item', 'auto-glass-care' ), __( 'Included item', 'auto-glass-care' ) ) ),
		array( __( 'Premium', 'auto-glass-care' ), 'service-window-tinting.webp', array( __( 'Included item', 'auto-glass-care' ), __( 'Included item', 'auto-glass-care' ), __( 'Included item', 'auto-glass-care' ), __( 'Included item', 'auto-glass-care' ) ) ),
	)
);
