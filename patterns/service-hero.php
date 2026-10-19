<?php
/**
 * Title: Service hero with quote form
 * Slug: auto-glass-care/service-hero
 * Categories: auto-glass-care, banner
 * Keywords: hero, service, form, quote
 * Viewport Width: 1400
 *
 * @package AutoGlassCare
 */

// phpcs:ignore WordPress.Security.EscapeOutput -- section helpers escape their content.
echo agc_section_service_hero(
	array(
		'title'    => __( 'Your Service Name', 'auto-glass-care' ),
		'subtitle' => __( 'A short promise to your customers', 'auto-glass-care' ),
		'points'   => array(
			__( 'First highlight', 'auto-glass-care' ),
			__( 'Second highlight', 'auto-glass-care' ),
			__( 'Third highlight', 'auto-glass-care' ),
		),
		'form'     => array( 'vehicle' => 'single', 'showMessage' => true ),
	)
);
