<?php
/**
 * Title: Benefits grid
 * Slug: auto-glass-care/benefits
 * Categories: auto-glass-care, featured
 * Keywords: benefits, features, why, grid
 * Viewport Width: 1400
 *
 * @package AutoGlassCare
 */

// phpcs:ignore WordPress.Security.EscapeOutput -- section helpers escape their content.
echo agc_section_benefits(
	__( 'Why Choose Us?', 'auto-glass-care' ),
	__( 'A short sentence introducing the benefits below.', 'auto-glass-care' ),
	array(
		array( __( 'First Benefit', 'auto-glass-care' ), __( 'Describe the benefit in a sentence or two.', 'auto-glass-care' ) ),
		array( __( 'Second Benefit', 'auto-glass-care' ), __( 'Describe the benefit in a sentence or two.', 'auto-glass-care' ) ),
		array( __( 'Third Benefit', 'auto-glass-care' ), __( 'Describe the benefit in a sentence or two.', 'auto-glass-care' ) ),
	)
);
