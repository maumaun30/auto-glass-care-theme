<?php
/**
 * Block Bindings source "agc/settings": connect core blocks (paragraph, heading, button,
 * image) to Theme Settings so their text/links follow the settings page.
 *
 * Usage in markup:
 * <!-- wp:heading {"metadata":{"bindings":{"content":{"source":"agc/settings","args":{"key":"tagline"}}}}} -->
 *
 * @package AutoGlassCare
 */

defined( 'ABSPATH' ) || exit;

/**
 * Keys that may be bound, with labels for the editor's field picker.
 */
function agc_bindable_fields(): array {
	return array(
		'business_name'    => __( 'Business name', 'auto-glass-care' ),
		'tagline'          => __( 'Tagline', 'auto-glass-care' ),
		'subtagline'       => __( 'Secondary tagline', 'auto-glass-care' ),
		'phone'            => __( 'Phone', 'auto-glass-care' ),
		'phone_url'        => __( 'Phone link (tel:)', 'auto-glass-care' ),
		'email'            => __( 'Email', 'auto-glass-care' ),
		'email_url'        => __( 'Email link (mailto:)', 'auto-glass-care' ),
		'address'          => __( 'Address', 'auto-glass-care' ),
		'hours'            => __( 'Hours', 'auto-glass-care' ),
		'service_areas'    => __( 'Service areas', 'auto-glass-care' ),
		'experience_years' => __( 'Years of experience', 'auto-glass-care' ),
		'social_facebook'  => 'Facebook URL',
		'social_google'    => 'Google Business URL',
		'social_yelp'      => 'Yelp URL',
		'social_instagram' => 'Instagram URL',
	);
}

function agc_bindable_value( string $key ): ?string {
	if ( ! array_key_exists( $key, agc_bindable_fields() ) ) {
		return null;
	}

	return match ( $key ) {
		'phone_url' => agc_phone_url( (string) agc_get_setting( 'phone' ) ),
		'email_url' => 'mailto:' . antispambot( (string) agc_get_setting( 'email' ) ),
		default     => (string) agc_get_setting( $key ),
	};
}

add_action(
	'init',
	function () {
		register_block_bindings_source(
			'agc/settings',
			array(
				'label'              => __( 'Theme Settings', 'auto-glass-care' ),
				'get_value_callback' => function ( array $source_args ) {
					return agc_bindable_value( (string) ( $source_args['key'] ?? '' ) );
				},
			)
		);
	}
);

/**
 * Editor side of the binding source: shows current values in the canvas and lists fields.
 */
add_action(
	'enqueue_block_editor_assets',
	function () {
		$values = array();
		foreach ( agc_bindable_fields() as $key => $label ) {
			$values[ $key ] = array(
				'label' => $label,
				'value' => agc_bindable_value( $key ),
			);
		}

		wp_enqueue_script(
			'agc-bindings',
			AGC_URI . '/assets/js/bindings.js',
			array( 'wp-blocks', 'wp-i18n' ),
			AGC_VERSION,
			true
		);
		wp_add_inline_script( 'agc-bindings', 'window.agcSettingsFields = ' . wp_json_encode( $values ) . ';', 'before' );
	}
);
