<?php
/**
 * Quote form submissions: stored as private "Quote Requests" and emailed to the shop.
 *
 * Uses a honeypot + minimum fill time instead of a nonce so the form keeps working
 * behind full-page caching.
 *
 * @package AutoGlassCare
 */

defined( 'ABSPATH' ) || exit;

const AGC_QUOTE_POST_TYPE = 'agc_quote';
const AGC_QUOTE_MIN_SECONDS = 3;

/**
 * Submitted fields: name => [label, sanitizer, required].
 */
function agc_quote_fields(): array {
	return array(
		'service'        => array( __( 'Service', 'auto-glass-care' ), 'sanitize_text_field', true ),
		'vehicle_make'   => array( __( 'Vehicle make', 'auto-glass-care' ), 'sanitize_text_field', false ),
		'vehicle_model'  => array( __( 'Vehicle model', 'auto-glass-care' ), 'sanitize_text_field', false ),
		'vehicle_year'   => array( __( 'Vehicle year', 'auto-glass-care' ), 'sanitize_text_field', false ),
		'first_name'     => array( __( 'First name', 'auto-glass-care' ), 'sanitize_text_field', true ),
		'last_name'      => array( __( 'Last name', 'auto-glass-care' ), 'sanitize_text_field', false ),
		'phone'          => array( __( 'Phone', 'auto-glass-care' ), 'sanitize_text_field', true ),
		'email'          => array( __( 'Email', 'auto-glass-care' ), 'sanitize_email', true ),
		'contact_method' => array( __( 'Preferred contact method', 'auto-glass-care' ), 'sanitize_text_field', false ),
		'mailing_list'   => array( __( 'Join mailing list', 'auto-glass-care' ), 'sanitize_text_field', false ),
		'message'        => array( __( 'Message', 'auto-glass-care' ), 'sanitize_textarea_field', false ),
	);
}

add_action(
	'init',
	function () {
		register_post_type(
			AGC_QUOTE_POST_TYPE,
			array(
				'labels'          => array(
					'name'          => __( 'Quote Requests', 'auto-glass-care' ),
					'singular_name' => __( 'Quote Request', 'auto-glass-care' ),
				),
				'public'          => false,
				'show_ui'         => true,
				'menu_icon'       => 'dashicons-car',
				'supports'        => array( 'title' ),
				'capability_type' => 'post',
				'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
				'map_meta_cap'    => true,
			)
		);
	}
);

add_action( 'admin_post_nopriv_agc_quote', 'agc_handle_quote' );
add_action( 'admin_post_agc_quote', 'agc_handle_quote' );

function agc_handle_quote(): void {
	$redirect = wp_validate_redirect( wp_unslash( $_POST['agc_redirect'] ?? '' ), home_url( '/' ) ) ?: home_url( '/' ); // phpcs:ignore WordPress.Security.NonceVerification, WordPress.Security.ValidatedSanitizedInput
	$started  = absint( $_POST['agc_started'] ?? 0 ); // phpcs:ignore WordPress.Security.NonceVerification

	$is_bot = ! empty( $_POST['agc_website'] ) || ( time() - $started ) < AGC_QUOTE_MIN_SECONDS; // phpcs:ignore WordPress.Security.NonceVerification
	if ( $is_bot ) {
		// Pretend success so bots learn nothing.
		agc_quote_redirect( $redirect, 'sent' );
	}

	$data = array();
	foreach ( agc_quote_fields() as $key => [ $label, $sanitize, $required ] ) {
		$value = call_user_func( $sanitize, wp_unslash( $_POST[ $key ] ?? '' ) ); // phpcs:ignore WordPress.Security.NonceVerification, WordPress.Security.ValidatedSanitizedInput
		if ( $required && '' === $value ) {
			agc_quote_redirect( $redirect, 'error' );
		}
		$data[ $key ] = $value;
	}

	if ( ! is_email( $data['email'] ) ) {
		agc_quote_redirect( $redirect, 'error' );
	}

	$title = trim( $data['first_name'] . ' ' . $data['last_name'] ) . ' — ' . $data['service'];

	$post_id = wp_insert_post(
		array(
			'post_type'   => AGC_QUOTE_POST_TYPE,
			'post_status' => 'private',
			'post_title'  => $title,
			'meta_input'  => array( '_agc_quote' => $data ),
		)
	);

	$lines = array();
	foreach ( agc_quote_fields() as $key => [ $label ] ) {
		if ( '' !== $data[ $key ] ) {
			$lines[] = $label . ': ' . $data[ $key ];
		}
	}

	$to   = agc_get_setting( 'quote_email' ) ?: agc_get_setting( 'email' ) ?: get_option( 'admin_email' );
	$sent = wp_mail(
		$to,
		/* translators: %s: customer name and service */
		sprintf( __( 'New quote request: %s', 'auto-glass-care' ), $title ),
		implode( "\n", $lines ),
		array( 'Reply-To: ' . $data['email'] )
	);

	agc_quote_redirect( $redirect, ( $post_id || $sent ) ? 'sent' : 'error' );
}

function agc_quote_redirect( string $url, string $status ): void {
	wp_safe_redirect( add_query_arg( 'agc_quote', $status, $url ) . '#quote' );
	exit;
}

add_action(
	'add_meta_boxes_' . AGC_QUOTE_POST_TYPE,
	function () {
		add_meta_box(
			'agc-quote-details',
			__( 'Request details', 'auto-glass-care' ),
			function ( WP_Post $post ) {
				$data = (array) get_post_meta( $post->ID, '_agc_quote', true );
				echo '<table class="widefat striped"><tbody>';
				foreach ( agc_quote_fields() as $key => [ $label ] ) {
					printf( '<tr><th>%s</th><td>%s</td></tr>', esc_html( $label ), nl2br( esc_html( $data[ $key ] ?? '' ) ) );
				}
				echo '</tbody></table>';
			},
			null,
			'normal',
			'high'
		);
	}
);
