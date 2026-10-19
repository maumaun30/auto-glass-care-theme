<?php
/**
 * Page sections shared by the section patterns and the full-page patterns.
 *
 * Each function returns block markup for one section; patterns/*.php echo them with
 * starter content. All copy is placeholder text meant to be edited per site.
 *
 * @package AutoGlassCare
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class added to the service hero. Pages containing it skip the title banner (see inc/setup.php).
 */
const AGC_SERVICE_HERO_CLASS = 'agc-service-hero';

function agc_image_url( string $file ): string {
	return AGC_URI . '/assets/images/' . $file;
}

function agc_section_title( string $text, string $align = 'center', int $level = 2 ): string {
	return agc_b_heading( $text, array_filter( array( 'textAlign' => $align, 'level' => 2 === $level ? null : $level, 'className' => 'is-style-section-title' ) ) );
}

function agc_quote_button( string $text = '' ): string {
	return agc_b_button( $text ?: __( 'Get A Free Quote', 'auto-glass-care' ), '#quote' );
}

/**
 * Service hero: title, highlights and call button beside a quote form card.
 *
 * @param array $args {
 *     @type string   $title    Page heading (H1).
 *     @type string   $subtitle Line under the heading.
 *     @type string[] $points   Checklist items.
 *     @type array    $form     agc/quote-form attributes.
 * }
 */
function agc_section_service_hero( array $args ): string {
	$args += array(
		'title'    => '',
		'subtitle' => '',
		'points'   => array(),
		'form'     => array(),
	);

	$left = agc_b_heading( $args['title'], array( 'level' => 1, 'fontSize' => 'xx-large' ) )
		. ( $args['subtitle'] ? agc_b_paragraph( $args['subtitle'], array( 'textColor' => 'gold', 'fontSize' => 'large' ) ) : '' )
		. agc_b_list( $args['points'], array( 'className' => 'is-style-checklist' ) )
		. agc_b_buttons( array( agc_b_button( __( 'Call Us Now', 'auto-glass-care' ), 'bind:phone_url' ) ) );

	$form = agc_b_group(
		agc_b_heading( __( 'Get Your Free Quote', 'auto-glass-care' ), array( 'fontSize' => 'x-large' ) )
		. agc_b_dynamic( 'agc/quote-form', $args['form'] + array( 'submitLabel' => __( 'Get My Custom Quote', 'auto-glass-care' ) ) ),
		array( 'anchor' => 'quote', 'className' => 'is-style-card', 'layout' => array( 'type' => 'default' ) )
	);

	return agc_b_group(
		agc_b_columns(
			array(
				array( $left, array( 'verticalAlignment' => 'center', 'width' => '55%' ) ),
				array( $form, array( 'verticalAlignment' => 'center', 'width' => '45%' ) ),
			),
			array( 'verticalAlignment' => 'center' )
		),
		array(
			'metadata'  => array( 'name' => __( 'Service Hero', 'auto-glass-care' ) ),
			'align'     => 'full',
			'className' => 'is-style-section-hero ' . AGC_SERVICE_HERO_CLASS,
		)
	);
}

/**
 * Rating summary plus testimonial cards (placeholder reviews).
 */
function agc_section_reviews( int $count = 3 ): string {
	$cards = array();
	for ( $i = 0; $i < $count; $i++ ) {
		$cards[] = agc_block_open( 'quote', array( 'className' => 'is-style-review-card' ) )
			. '<blockquote class="wp-block-quote is-style-review-card">'
			. agc_b_paragraph( __( 'Replace with a real customer review: what was done, how it turned out and how the visit went.', 'auto-glass-care' ) )
			. '<cite>' . esc_html__( 'Customer Name', 'auto-glass-care' ) . '</cite></blockquote>'
			. agc_block_close( 'quote' );
	}

	return agc_b_group(
		agc_section_title( __( 'Customer Testimonials', 'auto-glass-care' ) )
		. agc_b_dynamic( 'agc/rating-summary' )
		. agc_b_grid( $cards, '18rem' ),
		array(
			'metadata'  => array( 'name' => __( 'Testimonials', 'auto-glass-care' ) ),
			'align'     => 'full',
			'className' => 'is-style-section-band-surface',
		)
	);
}

function agc_section_financing(): string {
	return agc_b_group(
		agc_b_columns(
			array(
				array(
					agc_b_heading( __( 'Flexible Financing Available', 'auto-glass-care' ), array( 'fontSize' => 'x-large' ) )
					. agc_b_paragraph( __( 'Get the protection you want today and pay over time. Ask about financing when you request your quote.', 'auto-glass-care' ) ),
					array( 'verticalAlignment' => 'center', 'width' => '70%' ),
				),
				array(
					agc_b_buttons(
						array( agc_b_button( __( 'Apply For Financing', 'auto-glass-care' ), 'bind:financing_url' ) ),
						array( 'layout' => array( 'type' => 'flex', 'justifyContent' => 'right' ) )
					),
					array( 'verticalAlignment' => 'center', 'width' => '30%' ),
				),
			),
			array( 'verticalAlignment' => 'center' )
		),
		array(
			'metadata'  => array( 'name' => __( 'Financing', 'auto-glass-care' ) ),
			'align'     => 'full',
			'className' => 'is-style-section-band-accent',
		)
	);
}

/**
 * Grid of benefit cards.
 *
 * @param array $items List of [ title, text ].
 */
function agc_section_benefits( string $title, string $intro, array $items ): string {
	$cards = array();
	foreach ( $items as [ $item_title, $item_text ] ) {
		$cards[] = agc_b_group(
			agc_b_heading( $item_title, array( 'level' => 3, 'textColor' => 'accent', 'fontSize' => 'large' ) )
			. agc_b_paragraph( $item_text ),
			array( 'className' => 'is-style-info-card', 'layout' => array( 'type' => 'default' ) )
		);
	}

	return agc_b_group(
		agc_section_title( $title )
		. ( $intro ? agc_b_paragraph( $intro, array( 'align' => 'center' ) ) : '' )
		. agc_b_grid( $cards, '16rem' )
		. agc_b_buttons( array( agc_quote_button() ), array( 'layout' => array( 'type' => 'flex', 'justifyContent' => 'center' ) ) ),
		array(
			'metadata'  => array( 'name' => __( 'Benefits', 'auto-glass-care' ) ),
			'align'     => 'full',
			'className' => 'is-style-section-band',
		)
	);
}

/**
 * Package cards: image, name, what's included, quote button.
 *
 * @param array $packages List of [ title, image file, string[] items ].
 */
function agc_section_packages( string $title, array $packages ): string {
	$cards = array();
	foreach ( $packages as [ $package_title, $image, $items ] ) {
		$cards[] = agc_b_group(
			agc_b_image( agc_image_url( $image ), $package_title )
			. agc_b_heading( $package_title, array( 'level' => 3, 'fontSize' => 'large' ) )
			. agc_b_list( $items, array( 'className' => 'is-style-checklist' ) )
			. agc_b_buttons( array( agc_quote_button( __( 'Get A Quote', 'auto-glass-care' ) ) ) ),
			array( 'className' => 'is-style-card', 'layout' => array( 'type' => 'default' ) )
		);
	}

	return agc_b_group(
		agc_section_title( $title ) . agc_b_grid( $cards, '15rem' ),
		array(
			'metadata'  => array( 'name' => __( 'Packages', 'auto-glass-care' ) ),
			'align'     => 'full',
			'className' => 'is-style-section-band-surface',
		)
	);
}

/**
 * Text beside an image.
 *
 * @param string[] $paragraphs Body paragraphs.
 * @param string[] $points     Optional checklist under the text.
 */
function agc_section_content_image( string $title, array $paragraphs, string $image, bool $image_first = false, array $points = array() ): string {
	$text = agc_section_title( $title, 'left' );
	foreach ( $paragraphs as $paragraph ) {
		$text .= agc_b_paragraph( $paragraph );
	}
	if ( $points ) {
		$text .= agc_b_list( $points, array( 'className' => 'is-style-checklist' ) );
	}

	$columns = array(
		array( $text, array( 'verticalAlignment' => 'center' ) ),
		array( agc_b_image( agc_image_url( $image ), $title, array( 'className' => 'is-style-framed' ) ), array( 'verticalAlignment' => 'center' ) ),
	);
	if ( $image_first ) {
		$columns = array_reverse( $columns );
	}

	return agc_b_group(
		agc_b_columns( $columns, array( 'verticalAlignment' => 'center' ) ),
		array(
			'metadata'  => array( 'name' => __( 'Text and Image', 'auto-glass-care' ) ),
			'align'     => 'full',
			'className' => 'is-style-section-band',
		)
	);
}

/**
 * Two-column checklist, e.g. vehicle types served.
 */
function agc_section_checklist_columns( string $title, string $intro, array $items ): string {
	$half = (int) ceil( count( $items ) / 2 );

	return agc_b_group(
		agc_section_title( $title )
		. ( $intro ? agc_b_paragraph( $intro, array( 'align' => 'center' ) ) : '' )
		. agc_b_columns(
			array(
				array( agc_b_list( array_slice( $items, 0, $half ), array( 'className' => 'is-style-checklist' ) ), array() ),
				array( agc_b_list( array_slice( $items, $half ), array( 'className' => 'is-style-checklist' ) ), array() ),
			)
		),
		array(
			'metadata'  => array( 'name' => __( 'Checklist', 'auto-glass-care' ) ),
			'align'     => 'full',
			'className' => 'is-style-section-band-surface',
		)
	);
}

function agc_section_gallery( string $title, string $intro ): string {
	$images = array(
		array( agc_image_url( 'car-orange.webp' ), __( 'Finished tint job', 'auto-glass-care' ) ),
		array( agc_image_url( 'car-black.webp' ), __( 'Finished tint job', 'auto-glass-care' ) ),
		array( agc_image_url( 'service-window-tinting.webp' ), __( 'Tint installation', 'auto-glass-care' ) ),
		array( agc_image_url( 'service-clear-bra.webp' ), __( 'Paint protection film installation', 'auto-glass-care' ) ),
		array( agc_image_url( 'service-ceramic-coating.webp' ), __( 'Ceramic coating application', 'auto-glass-care' ) ),
		array( agc_image_url( 'hero-banner.webp' ), __( 'Featured vehicle', 'auto-glass-care' ) ),
	);

	return agc_b_group(
		agc_section_title( $title )
		. ( $intro ? agc_b_paragraph( $intro, array( 'align' => 'center' ) ) : '' )
		. agc_b_gallery( $images ),
		array(
			'metadata'  => array( 'name' => __( 'Gallery', 'auto-glass-care' ) ),
			'align'     => 'full',
			'className' => 'is-style-section-band',
		)
	);
}

function agc_section_cta( string $title, string $text ): string {
	return agc_b_group(
		agc_b_heading( $title, array( 'textAlign' => 'center', 'fontSize' => 'xx-large' ) )
		. agc_b_paragraph( $text, array( 'align' => 'center' ) )
		. agc_b_buttons(
			array(
				agc_b_button( __( 'Call Us Now', 'auto-glass-care' ), 'bind:phone_url' ),
				agc_quote_button(),
			),
			array( 'layout' => array( 'type' => 'flex', 'justifyContent' => 'center' ) )
		),
		array(
			'metadata'  => array( 'name' => __( 'Call To Action', 'auto-glass-care' ) ),
			'align'     => 'full',
			'className' => 'is-style-section-band-accent',
		)
	);
}

function agc_section_contact_details(): string {
	$items = array(
		array( __( 'Visit Us', 'auto-glass-care' ), 'address' ),
		array( __( 'Call Us', 'auto-glass-care' ), 'phone' ),
		array( __( 'Email Us', 'auto-glass-care' ), 'email' ),
		array( __( 'Shop Hours', 'auto-glass-care' ), 'hours' ),
	);

	$cards = array();
	foreach ( $items as [ $label, $field ] ) {
		$cards[] = agc_b_group(
			agc_b_heading( $label, array( 'level' => 3, 'textColor' => 'accent', 'fontSize' => 'large' ) )
			. agc_b_dynamic( 'agc/business-info', array( 'field' => $field ) ),
			array( 'className' => 'is-style-info-card', 'layout' => array( 'type' => 'default' ) )
		);
	}

	return agc_b_group(
		agc_b_grid( $cards, '14rem' ),
		array(
			'metadata'  => array( 'name' => __( 'Contact Details', 'auto-glass-care' ) ),
			'align'     => 'full',
			'className' => 'is-style-section-band',
		)
	);
}

function agc_section_contact_form(): string {
	return agc_b_group(
		agc_section_title( __( 'Send Us A Message', 'auto-glass-care' ) )
		. agc_b_paragraph( __( 'Fill out the form and we will get back to you as soon as we can.', 'auto-glass-care' ), array( 'align' => 'center' ) )
		. agc_b_group(
			agc_b_dynamic( 'agc/quote-form', array( 'variant' => 'contact' ) ),
			array( 'anchor' => 'quote', 'className' => 'is-style-card', 'layout' => array( 'type' => 'default' ) )
		),
		array(
			'metadata'  => array( 'name' => __( 'Contact Form', 'auto-glass-care' ) ),
			'align'     => 'full',
			'className' => 'is-style-section-band-surface',
			'layout'    => array( 'type' => 'constrained', 'contentSize' => '760px' ),
		)
	);
}
