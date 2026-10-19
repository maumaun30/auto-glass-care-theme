<?php
/**
 * Title: Service page: Ceramic Coating
 * Slug: auto-glass-care/page-ceramic-coating
 * Description: Full ceramic coating page: hero with quote form, reviews, financing, explainer, benefits, vehicles served and call to action.
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
		'title'    => __( 'Ceramic Coating', 'auto-glass-care' ),
		'subtitle' => __( 'Deep gloss and long-lasting protection for your paint', 'auto-glass-care' ),
		'points'   => array(
			__( 'Professional nano-ceramic coatings', 'auto-glass-care' ),
			__( 'Long-lasting gloss & protection', 'auto-glass-care' ),
			__( 'Water-beading, easy-clean finish', 'auto-glass-care' ),
			__( 'UV & chemical resistance', 'auto-glass-care' ),
		),
		'form'     => array(
			'serviceLabel'   => __( 'Coating Package', 'auto-glass-care' ),
			'services'       => implode( "\n", array( __( 'Basic', 'auto-glass-care' ), __( 'Deluxe', 'auto-glass-care' ), __( 'Premier', 'auto-glass-care' ) ) ),
			'vehicle'        => 'single',
			'contactMethods' => __( 'Call, Text, Email', 'auto-glass-care' ),
			'showMessage'    => true,
		),
	)
);

echo agc_section_reviews();
echo agc_section_financing();

echo agc_section_content_image(
	__( 'What Is Ceramic Coating?', 'auto-glass-care' ),
	array(
		__( 'A ceramic coating is a liquid polymer applied by hand that bonds with your factory paint and cures into a hard, glossy protective layer.', 'auto-glass-care' ),
		__( 'Water and dirt slide off the surface, so the car stays cleaner between washes and keeps its shine for years instead of weeks.', 'auto-glass-care' ),
	),
	'service-ceramic-coating.webp'
);

echo agc_section_benefits(
	__( 'Key Benefits Of Ceramic Coating', 'auto-glass-care' ),
	'',
	array(
		array( __( 'Scratch Resistance', 'auto-glass-care' ), __( 'A hard top layer helps resist light marring from washing and everyday use.', 'auto-glass-care' ) ),
		array( __( 'UV Protection', 'auto-glass-care' ), __( 'Helps prevent the oxidation and fading that sun exposure causes over time.', 'auto-glass-care' ) ),
		array( __( 'Chemical Resistance', 'auto-glass-care' ), __( 'Bird droppings, bug splatter and road grime are less likely to etch the paint.', 'auto-glass-care' ) ),
		array( __( 'Easy To Clean', 'auto-glass-care' ), __( 'Water beads up and carries dirt away, so washing takes less time.', 'auto-glass-care' ) ),
		array( __( 'Enhanced Gloss', 'auto-glass-care' ), __( 'Adds depth and clarity that makes the color pop.', 'auto-glass-care' ) ),
	)
);

echo agc_section_checklist_columns(
	__( 'Vehicles We Protect', 'auto-glass-care' ),
	__( 'If it has paint, we can coat it.', 'auto-glass-care' ),
	array(
		__( 'Cars & Sedans', 'auto-glass-care' ),
		__( 'SUVs & Crossovers', 'auto-glass-care' ),
		__( 'Trucks', 'auto-glass-care' ),
		__( 'Sports & Exotic Cars', 'auto-glass-care' ),
		__( 'Luxury Vehicles', 'auto-glass-care' ),
		__( 'Electric Vehicles', 'auto-glass-care' ),
		__( 'Motorcycles', 'auto-glass-care' ),
		__( 'Boats', 'auto-glass-care' ),
		__( 'RVs & Motorhomes', 'auto-glass-care' ),
		__( 'Classic Cars', 'auto-glass-care' ),
	)
);

echo agc_section_content_image(
	__( 'Is Ceramic Coating Worth It?', 'auto-glass-care' ),
	array(
		__( 'For most drivers, yes. Repainting is expensive, and a coating protects the paint you already have from sun, weather and contaminants.', 'auto-glass-care' ),
		__( 'Unlike wax, which wears off in a few months, a professional coating keeps working for years with simple upkeep.', 'auto-glass-care' ),
	),
	'car-orange.webp',
	true
);

echo agc_section_cta( __( 'Get That Showroom Shine', 'auto-glass-care' ), __( 'Call us or request a free quote today.', 'auto-glass-care' ) );
