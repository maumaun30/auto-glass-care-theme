<?php
/**
 * Title: Service page: Window Tinting
 * Slug: auto-glass-care/page-window-tinting
 * Description: Full window tinting page: hero with quote form, reviews, financing, benefits, film info, shades, gallery and call to action.
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
echo agc_section_service_hero(
	array(
		'title'    => __( 'Auto Window Tinting', 'auto-glass-care' ),
		'subtitle' => __( 'Cooler, more private, and installed right the first time', 'auto-glass-care' ),
		'points'   => array(
			__( 'Computer-cut film for a precise fit', 'auto-glass-care' ),
			__( 'Lifetime warranty options', 'auto-glass-care' ),
			/* translators: %d: years of experience */
			sprintf( __( '%d+ years of experience', 'auto-glass-care' ), $agc_years ),
			__( 'Certified film installers', 'auto-glass-care' ),
		),
		'form'     => array(
			'serviceLabel'   => __( 'Service Interested In', 'auto-glass-care' ),
			'services'       => implode(
				"\n",
				array(
					__( 'Front Two Windows', 'auto-glass-care' ),
					__( 'Full Vehicle (side windows & back glass)', 'auto-glass-care' ),
					__( 'Full Windshield', 'auto-glass-care' ),
					__( 'Windshield Visor Strip', 'auto-glass-care' ),
					__( 'Front Two Windows Tint Removal', 'auto-glass-care' ),
					__( 'Full Tint Removal', 'auto-glass-care' ),
				)
			),
			'vehicle'        => 'single',
			'contactMethods' => __( 'Email, Phone', 'auto-glass-care' ),
			'showMessage'    => true,
			'showConsent'    => true,
		),
	)
);

echo agc_section_reviews();
echo agc_section_financing();

echo agc_section_benefits(
	__( 'Why Tint Your Windows?', 'auto-glass-care' ),
	__( 'A quality tint job does much more than change how your car looks.', 'auto-glass-care' ),
	array(
		array( __( 'Heat & UV Protection', 'auto-glass-care' ), __( 'Quality films block nearly all UV and cut cabin heat, so the car stays comfortable on hot days.', 'auto-glass-care' ) ),
		array( __( 'Privacy & Security', 'auto-glass-care' ), __( 'Darker glass keeps belongings out of sight and adds privacy on the road.', 'auto-glass-care' ) ),
		array( __( 'Shatter Resistance', 'auto-glass-care' ), __( 'Window film helps hold broken glass together if a window is hit.', 'auto-glass-care' ) ),
		array( __( 'Interior Protection', 'auto-glass-care' ), __( 'Less sun means less fading and cracking on seats and dashboards.', 'auto-glass-care' ) ),
		array( __( 'Warranty Backed', 'auto-glass-care' ), __( 'Manufacturer warranties cover the film long after you drive away.', 'auto-glass-care' ) ),
	)
);

echo agc_section_content_image(
	__( 'Ceramic & Nano-Technology Films', 'auto-glass-care' ),
	array(
		__( 'Modern ceramic films reject serious heat without needing a dark shade, and they will not interfere with phone, GPS or radio signals.', 'auto-glass-care' ),
		__( 'Ask us to show you the difference side by side when you stop by the shop.', 'auto-glass-care' ),
	),
	'service-window-tinting.webp'
);

echo agc_section_content_image(
	__( 'A Shade For Every Style', 'auto-glass-care' ),
	array(
		__( 'From dark limo shades to nearly clear films, we will help you pick a shade that fits your look, your privacy needs and local tint laws.', 'auto-glass-care' ),
		__( 'Every budget is welcome: we carry several film lines so you can choose the right balance of price and performance.', 'auto-glass-care' ),
	),
	'car-black.webp',
	true
);

echo agc_section_gallery( __( 'Our Recent Work', 'auto-glass-care' ), __( 'Every install is done with precision and care.', 'auto-glass-care' ) );
echo agc_section_cta( __( 'Ready For A Cooler Ride?', 'auto-glass-care' ), __( 'Call us or request a free quote today.', 'auto-glass-care' ) );
