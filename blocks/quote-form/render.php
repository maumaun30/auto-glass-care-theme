<?php
/**
 * Quote Form block. Posts to admin-post.php (see inc/quote-form.php).
 *
 * @var array $attributes Block attributes.
 * @package AutoGlassCare
 */

$agc_status   = sanitize_key( wp_unslash( $_GET['agc_quote'] ?? '' ) ); // phpcs:ignore WordPress.Security.NonceVerification
$agc_uid      = wp_unique_id( 'agc-quote-' );
$agc_services = agc_quote_services();
$agc_redirect = ( is_singular() && ! is_front_page() ) ? get_permalink() : home_url( '/' );

$agc_field = static function ( string $name, string $label, string $type = 'text', bool $required = false, string $autocomplete = '' ) use ( $agc_uid ): string {
	$id = $agc_uid . '-' . $name;
	return sprintf(
		'<p class="agc-quote-form__field"><label for="%1$s">%2$s%3$s</label><input id="%1$s" name="%4$s" type="%5$s"%6$s%7$s></p>',
		esc_attr( $id ),
		esc_html( $label ),
		$required ? '<span class="agc-quote-form__required" aria-hidden="true">*</span>' : '',
		esc_attr( $name ),
		esc_attr( $type ),
		$required ? ' required' : '',
		$autocomplete ? ' autocomplete="' . esc_attr( $autocomplete ) . '"' : ''
	);
};
?>
<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<?php if ( 'sent' === $agc_status ) : ?>
		<p class="agc-quote-form__notice is-success" role="status"><?php echo esc_html( agc_get_setting( 'quote_success' ) ); ?></p>
	<?php elseif ( 'error' === $agc_status ) : ?>
		<p class="agc-quote-form__notice is-error" role="alert"><?php esc_html_e( 'Please fill in all required fields with a valid email and try again.', 'auto-glass-care' ); ?></p>
	<?php endif; ?>

	<form class="agc-quote-form__form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="agc_quote">
		<input type="hidden" name="agc_redirect" value="<?php echo esc_url( $agc_redirect ); ?>">
		<input type="hidden" name="agc_started" value="<?php echo esc_attr( (string) time() ); ?>">
		<p class="agc-quote-form__hp" aria-hidden="true">
			<label for="<?php echo esc_attr( $agc_uid ); ?>-website">Website</label>
			<input id="<?php echo esc_attr( $agc_uid ); ?>-website" type="text" name="agc_website" tabindex="-1" autocomplete="off">
		</p>

		<p class="agc-quote-form__field is-full">
			<label for="<?php echo esc_attr( $agc_uid ); ?>-service"><?php esc_html_e( 'Select A Service', 'auto-glass-care' ); ?><span class="agc-quote-form__required" aria-hidden="true">*</span></label>
			<select id="<?php echo esc_attr( $agc_uid ); ?>-service" name="service" required>
				<option value=""><?php esc_html_e( 'Select Service', 'auto-glass-care' ); ?></option>
				<?php foreach ( $agc_services as $agc_service ) : ?>
					<option value="<?php echo esc_attr( $agc_service ); ?>"><?php echo esc_html( $agc_service ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>

		<?php
		// phpcs:disable WordPress.Security.EscapeOutput -- $agc_field escapes its output.
		if ( ! empty( $attributes['showVehicle'] ) ) {
			echo $agc_field( 'vehicle_make', __( 'Vehicle Make', 'auto-glass-care' ) );
			echo $agc_field( 'vehicle_model', __( 'Vehicle Model', 'auto-glass-care' ) );
			echo $agc_field( 'vehicle_year', __( 'Vehicle Year', 'auto-glass-care' ) );
		}
		echo $agc_field( 'first_name', __( 'First Name', 'auto-glass-care' ), 'text', true, 'given-name' );
		echo $agc_field( 'last_name', __( 'Last Name', 'auto-glass-care' ), 'text', false, 'family-name' );
		echo $agc_field( 'phone', __( 'Phone', 'auto-glass-care' ), 'tel', true, 'tel' );
		echo $agc_field( 'email', __( 'Email', 'auto-glass-care' ), 'email', true, 'email' );
		// phpcs:enable
		?>

		<fieldset class="agc-quote-form__field agc-quote-form__choices">
			<legend><?php esc_html_e( 'Preferred Contact Method', 'auto-glass-care' ); ?></legend>
			<label><input type="radio" name="contact_method" value="Email" checked> <?php esc_html_e( 'Email', 'auto-glass-care' ); ?></label>
			<label><input type="radio" name="contact_method" value="Phone"> <?php esc_html_e( 'Phone', 'auto-glass-care' ); ?></label>
		</fieldset>

		<?php if ( agc_get_setting( 'quote_mailing_list' ) ) : ?>
			<fieldset class="agc-quote-form__field agc-quote-form__choices">
				<legend><?php esc_html_e( 'Join Our Mailing List?', 'auto-glass-care' ); ?></legend>
				<label><input type="radio" name="mailing_list" value="Yes"> <?php esc_html_e( 'Yes', 'auto-glass-care' ); ?></label>
				<label><input type="radio" name="mailing_list" value="No" checked> <?php esc_html_e( 'No', 'auto-glass-care' ); ?></label>
			</fieldset>
		<?php endif; ?>

		<?php if ( ! empty( $attributes['showMessage'] ) ) : ?>
			<p class="agc-quote-form__field is-full">
				<label for="<?php echo esc_attr( $agc_uid ); ?>-message"><?php esc_html_e( 'Message', 'auto-glass-care' ); ?></label>
				<textarea id="<?php echo esc_attr( $agc_uid ); ?>-message" name="message" rows="4"></textarea>
			</p>
		<?php endif; ?>

		<p class="agc-quote-form__actions is-full">
			<button type="submit" class="wp-element-button agc-quote-form__submit"><?php echo esc_html( $attributes['submitLabel'] ?: __( 'Send', 'auto-glass-care' ) ); ?></button>
		</p>
	</form>
</div>
