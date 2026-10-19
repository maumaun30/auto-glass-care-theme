<?php
/**
 * Title: Service page: Clear Bra / Paint Protection Film
 * Slug: auto-glass-care/page-clear-bra
 * Description: Full paint protection film page: hero with quote form, reviews, financing, PPF explainer, packages, benefits and call to action.
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
		'title'    => __( 'Clear Bra Paint Protection Film', 'auto-glass-care' ),
		'subtitle' => __( 'Invisible protection that keeps your paint looking new', 'auto-glass-care' ),
		'points'   => array(
			__( 'Certified film installers', 'auto-glass-care' ),
			__( 'Self-healing film technology', 'auto-glass-care' ),
			__( 'Partial & full coverage packages', 'auto-glass-care' ),
			__( 'Warranty options available', 'auto-glass-care' ),
		),
		'form'     => array(
			'serviceLabel'   => __( 'Package Interest', 'auto-glass-care' ),
			'services'       => implode(
				"\n",
				array(
					__( 'Partial Front', 'auto-glass-care' ),
					__( 'Full Front', 'auto-glass-care' ),
					__( 'Track Package', 'auto-glass-care' ),
					__( 'Full Body', 'auto-glass-care' ),
					__( 'Windshield Protection', 'auto-glass-care' ),
				)
			),
			'vehicle'        => 'single',
			'contactMethods' => __( 'Call, Text, Email', 'auto-glass-care' ),
			'showMessage'    => true,
		),
	)
);

echo agc_section_reviews();
echo agc_section_financing();

echo agc_section_content_image(
	__( 'What Is Paint Protection Film?', 'auto-glass-care' ),
	array(
		__( 'Paint protection film, often called clear bra, is a clear urethane layer applied over painted panels to guard against rock chips, scratches, bug acids and road debris.', 'auto-glass-care' ),
		__( 'Once installed it is practically invisible, and many films heal light swirls on their own with heat from the sun or warm water.', 'auto-glass-care' ),
	),
	'service-clear-bra.webp'
);

echo agc_section_packages(
	__( 'Our PPF Packages', 'auto-glass-care' ),
	array(
		array( __( 'Partial Front', 'auto-glass-care' ), 'service-clear-bra.webp', array( __( 'Partial hood', 'auto-glass-care' ), __( 'Partial front fenders', 'auto-glass-care' ), __( 'Front bumper', 'auto-glass-care' ), __( 'Headlights', 'auto-glass-care' ), __( 'Mirrors', 'auto-glass-care' ) ) ),
		array( __( 'Full Front', 'auto-glass-care' ), 'service-ceramic-coating.webp', array( __( 'Full hood', 'auto-glass-care' ), __( 'Full front fenders', 'auto-glass-care' ), __( 'Front bumper', 'auto-glass-care' ), __( 'Headlights', 'auto-glass-care' ), __( 'Mirrors', 'auto-glass-care' ) ) ),
		array( __( 'Track Package', 'auto-glass-care' ), 'car-orange.webp', array( __( 'Full front coverage', 'auto-glass-care' ), __( 'Mirror caps', 'auto-glass-care' ), __( 'Rocker panels', 'auto-glass-care' ), __( 'Rear impact areas', 'auto-glass-care' ) ) ),
		array( __( 'Full Body', 'auto-glass-care' ), 'car-black.webp', array( __( 'Every painted panel', 'auto-glass-care' ), __( 'Headlights', 'auto-glass-care' ), __( 'Mirrors', 'auto-glass-care' ), __( 'Door cups & edges', 'auto-glass-care' ) ) ),
	)
);

echo agc_section_benefits(
	__( 'Why Choose Paint Protection Film?', 'auto-glass-care' ),
	'',
	array(
		array( __( 'Rock Chip Defense', 'auto-glass-care' ), __( 'Absorbs impacts from gravel and debris before they reach your paint.', 'auto-glass-care' ) ),
		array( __( 'Self-Healing Finish', 'auto-glass-care' ), __( 'Light scratches and swirls fade away with a little heat.', 'auto-glass-care' ) ),
		array( __( 'Protects Resale Value', 'auto-glass-care' ), __( 'Original, chip-free paint is worth more when it is time to sell or trade in.', 'auto-glass-care' ) ),
		array( __( 'Nearly Invisible', 'auto-glass-care' ), __( 'Clean edges and clear film keep the factory look intact.', 'auto-glass-care' ) ),
	)
);

echo agc_section_cta( __( 'Protect Your Paint Today', 'auto-glass-care' ), __( 'Call us or request a free quote for your vehicle.', 'auto-glass-care' ) );
