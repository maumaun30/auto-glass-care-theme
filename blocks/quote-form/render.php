<?php
/**
 * Quote Form block. Posts to admin-post.php (see inc/quote-form.php).
 *
 * Variants: "quote" (service + vehicle + contact details) and "contact" (name, email, subject, message).
 *
 * @var array $attributes Block attributes.
 * @package AutoGlassCare
 */

$agc_status   = sanitize_key( wp_unslash( $_GET['agc_quote'] ?? '' ) ); // phpcs:ignore WordPress.Security.NonceVerification
$agc_uid      = wp_unique_id( 'agc-quote-' );
$agc_variant  = 'contact' === ( $attributes['variant'] ?? '' ) ? 'contact' : 'quote';
$agc_redirect = ( is_singular() && ! is_front_page() ) ? get_permalink() : home_url( '/' );
$agc_required = agc_form_required_fields( $agc_variant );

$agc_services = array_values( array_filter( array_map( 'trim', preg_split( '/\R/', (string) ( $attributes['services'] ?? '' ) ) ) ) );
if ( ! $agc_services ) {
	$agc_services = agc_quote_services();
}

$agc_methods = array_values( array_filter( array_map( 'trim', explode( ',', (string) ( $attributes['contactMethods'] ?? '' ) ) ) ) );

$agc_label = static function ( string $id, string $text, bool $required ): string {
	return sprintf(
		'<label for="%1$s">%2$s%3$s</label>',
		esc_attr( $id ),
		esc_html( $text ),
		$required ? '<span class="agc-quote-form__required" aria-hidden="true">*</span>' : ''
	);
};

$agc_field = static function ( string $name, string $label, string $type = 'text', string $autocomplete = '', bool $full = false ) use ( $agc_uid, $agc_required, $agc_label ): string {
	$id       = $agc_uid . '-' . $name;
	$required = in_array( $name, $agc_required, true );
	return sprintf(
		'<p class="agc-quote-form__field%1$s">%2$s<input id="%3$s" name="%4$s" type="%5$s"%6$s%7$s></p>',
		$full ? ' is-full' : '',
		$agc_label( $id, $label, $required ),
		esc_attr( $id ),
		esc_attr( $name ),
		esc_attr( $type ),
		$required ? ' required' : '',
		$autocomplete ? ' autocomplete="' . esc_attr( $autocomplete ) . '"' : ''
	);
};

$agc_choices = static function ( string $name, string $legend, array $options, string $checked ): string {
	$html = sprintf( '<fieldset class="agc-quote-form__field agc-quote-form__choices"><legend>%s</legend>', esc_html( $legend ) );
	foreach ( $options as $option ) {
		$html .= sprintf(
			'<label><input type="radio" name="%1$s" value="%2$s"%3$s> %4$s</label>',
			esc_attr( $name ),
			esc_attr( $option ),
			checked( $option, $checked, false ),
			esc_html( $option )
		);
	}
	return $html . '</fieldset>';
};

$agc_textarea = static function ( string $name, string $label ) use ( $agc_uid, $agc_required, $agc_label ): string {
	$id       = $agc_uid . '-' . $name;
	$required = in_array( $name, $agc_required, true );
	return sprintf(
		'<p class="agc-quote-form__field is-full">%1$s<textarea id="%2$s" name="%3$s" rows="4"%4$s></textarea></p>',
		$agc_label( $id, $label, $required ),
		esc_attr( $id ),
		esc_attr( $name ),
		$required ? ' required' : ''
	);
};
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'is-variant-' . $agc_variant ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<?php if ( 'sent' === $agc_status ) : ?>
		<p class="agc-quote-form__notice is-success" role="status"><?php echo esc_html( agc_get_setting( 'quote_success' ) ); ?></p>
	<?php elseif ( 'error' === $agc_status ) : ?>
		<p class="agc-quote-form__notice is-error" role="alert"><?php esc_html_e( 'Please fill in all required fields with a valid email and try again.', 'auto-glass-care' ); ?></p>
	<?php endif; ?>

	<form class="agc-quote-form__form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="agc_quote">
		<input type="hidden" name="agc_form" value="<?php echo esc_attr( $agc_variant ); ?>">
		<input type="hidden" name="agc_redirect" value="<?php echo esc_url( $agc_redirect ); ?>">
		<input type="hidden" name="agc_started" value="<?php echo esc_attr( (string) time() ); ?>">
		<p class="agc-quote-form__hp" aria-hidden="true">
			<label for="<?php echo esc_attr( $agc_uid ); ?>-website">Website</label>
			<input id="<?php echo esc_attr( $agc_uid ); ?>-website" type="text" name="agc_website" tabindex="-1" autocomplete="off">
		</p>

		<?php
		// phpcs:disable WordPress.Security.EscapeOutput -- the field helpers escape their output.
		if ( 'contact' === $agc_variant ) :
			echo $agc_field( 'first_name', __( 'First Name', 'auto-glass-care' ), 'text', 'given-name' );
			echo $agc_field( 'email', __( 'Email', 'auto-glass-care' ), 'email', 'email' );
			echo $agc_field( 'subject', __( 'Subject', 'auto-glass-care' ), 'text', '', true );
			echo $agc_textarea( 'message', __( 'Message', 'auto-glass-care' ) );
		else :
			?>
			<p class="agc-quote-form__field is-full">
				<?php echo $agc_label( $agc_uid . '-service', $attributes['serviceLabel'] ?: __( 'Select A Service', 'auto-glass-care' ), true ); ?>
				<select id="<?php echo esc_attr( $agc_uid ); ?>-service" name="service" required>
					<option value=""><?php esc_html_e( 'Select Service', 'auto-glass-care' ); ?></option>
					<?php foreach ( $agc_services as $agc_service ) : ?>
						<option value="<?php echo esc_attr( $agc_service ); ?>"><?php echo esc_html( $agc_service ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<?php
			if ( 'split' === $attributes['vehicle'] ) {
				echo $agc_field( 'vehicle_make', __( 'Vehicle Make', 'auto-glass-care' ) );
				echo $agc_field( 'vehicle_model', __( 'Vehicle Model', 'auto-glass-care' ) );
				echo $agc_field( 'vehicle_year', __( 'Vehicle Year', 'auto-glass-care' ) );
			} elseif ( 'single' === $attributes['vehicle'] ) {
				echo $agc_field( 'vehicle', __( 'Vehicle Year, Make & Model', 'auto-glass-care' ), 'text', '', true );
			}
			echo $agc_field( 'first_name', __( 'First Name', 'auto-glass-care' ), 'text', 'given-name' );
			echo $agc_field( 'last_name', __( 'Last Name', 'auto-glass-care' ), 'text', 'family-name' );
			echo $agc_field( 'phone', __( 'Phone', 'auto-glass-care' ), 'tel', 'tel' );
			echo $agc_field( 'email', __( 'Email', 'auto-glass-care' ), 'email', 'email' );

			if ( $agc_methods ) {
				echo $agc_choices( 'contact_method', __( 'Preferred Contact Method', 'auto-glass-care' ), $agc_methods, $agc_methods[0] );
			}
			if ( agc_get_setting( 'quote_mailing_list' ) ) {
				echo $agc_choices( 'mailing_list', __( 'Join Our Mailing List?', 'auto-glass-care' ), array( __( 'Yes', 'auto-glass-care' ), __( 'No', 'auto-glass-care' ) ), __( 'No', 'auto-glass-care' ) );
			}
			if ( ! empty( $attributes['showMessage'] ) ) {
				echo $agc_textarea( 'message', __( 'Message', 'auto-glass-care' ) );
			}
			if ( ! empty( $attributes['showConsent'] ) ) {
				printf(
					'<p class="agc-quote-form__field is-full agc-quote-form__consent"><label><input type="checkbox" name="sms_consent" value="Yes"> %s</label></p>',
					esc_html( $attributes['consentText'] )
				);
			}
		endif;
		// phpcs:enable
		?>

		<p class="agc-quote-form__actions is-full">
			<button type="submit" class="wp-element-button agc-quote-form__submit"><?php echo esc_html( $attributes['submitLabel'] ?: __( 'Send', 'auto-glass-care' ) ); ?></button>
		</p>
	</form>
</div>
