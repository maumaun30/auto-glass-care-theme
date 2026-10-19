<?php
/**
 * Theme Settings: per-site business details reused by blocks, bindings and patterns.
 *
 * Everything that changes from one shop to the next lives here (Appearance → Theme Settings),
 * so the theme itself never needs editing when it is reused on another website.
 *
 * @package AutoGlassCare
 */

defined( 'ABSPATH' ) || exit;

const AGC_OPTION = 'agc_settings';

/**
 * Field definitions grouped by section. Drives the admin form, sanitizing and defaults.
 */
function agc_settings_fields(): array {
	return array(
		'business' => array(
			'title'  => __( 'Business', 'auto-glass-care' ),
			'fields' => array(
				'business_name'    => array( 'type' => 'text', 'label' => __( 'Business name', 'auto-glass-care' ), 'default' => 'Rodz Tint Touch' ),
				'tagline'          => array( 'type' => 'text', 'label' => __( 'Tagline', 'auto-glass-care' ), 'default' => 'Experience. Perfection. Quality.' ),
				'subtagline'       => array( 'type' => 'text', 'label' => __( 'Secondary tagline', 'auto-glass-care' ), 'default' => 'Quality Window Tinting' ),
				'phone'            => array( 'type' => 'tel', 'label' => __( 'Phone', 'auto-glass-care' ), 'default' => '(909) 930-5152' ),
				'email'            => array( 'type' => 'email', 'label' => __( 'Email', 'auto-glass-care' ), 'default' => 'rodzwindowtint@gmail.com' ),
				'address'          => array( 'type' => 'text', 'label' => __( 'Address', 'auto-glass-care' ), 'default' => '1722 S. Grove Ave Ste A, Ontario, CA 91761' ),
				'hours'            => array( 'type' => 'text', 'label' => __( 'Hours', 'auto-glass-care' ), 'default' => 'Mon-Sat: 9am - 6pm' ),
				'service_areas'    => array( 'type' => 'textarea', 'label' => __( 'Service areas', 'auto-glass-care' ), 'default' => 'Ontario, Rancho Cucamonga, Upland, Claremont, Chino Hills, Corona, Norco, Chino, Riverside, Fontana' ),
				'experience_years' => array( 'type' => 'number', 'label' => __( 'Years of experience', 'auto-glass-care' ), 'default' => 27 ),
				'founded_year'     => array( 'type' => 'number', 'label' => __( 'Copyright start year', 'auto-glass-care' ), 'default' => 2017 ),
			),
		),
		'social'   => array(
			'title'  => __( 'Social profiles', 'auto-glass-care' ),
			'fields' => array(
				'social_facebook'  => array( 'type' => 'url', 'label' => 'Facebook', 'default' => 'https://www.facebook.com/rodztinttouch' ),
				'social_google'    => array( 'type' => 'url', 'label' => 'Google Business', 'default' => 'https://share.google/pRtf2DWTI0hdZiJtg' ),
				'social_yelp'      => array( 'type' => 'url', 'label' => 'Yelp', 'default' => 'https://www.yelp.com/biz/rodz-tint-touch-ontario-3' ),
				'social_instagram' => array( 'type' => 'url', 'label' => 'Instagram', 'default' => '' ),
				'social_youtube'   => array( 'type' => 'url', 'label' => 'YouTube', 'default' => '' ),
				'social_tiktok'    => array( 'type' => 'url', 'label' => 'TikTok', 'default' => '' ),
				'social_x'         => array( 'type' => 'url', 'label' => 'X (Twitter)', 'default' => '' ),
			),
		),
		'quote'    => array(
			'title'  => __( 'Quote form', 'auto-glass-care' ),
			'fields' => array(
				'quote_email'        => array( 'type' => 'email', 'label' => __( 'Send quote requests to', 'auto-glass-care' ), 'default' => '', 'help' => __( 'Leave empty to use the business email.', 'auto-glass-care' ) ),
				'quote_services'     => array( 'type' => 'textarea', 'label' => __( 'Services (one per line)', 'auto-glass-care' ), 'default' => "3M Window Tinting\nClear Bra Paint Protection\nVehicle Ceramic Coating" ),
				'quote_success'      => array( 'type' => 'text', 'label' => __( 'Success message', 'auto-glass-care' ), 'default' => 'Thanks! Your request was sent. We will contact you shortly.' ),
				'quote_mailing_list' => array( 'type' => 'checkbox', 'label' => __( 'Ask "Join our mailing list?"', 'auto-glass-care' ), 'default' => 1 ),
			),
		),
	);
}

function agc_default_settings(): array {
	$defaults = array();
	foreach ( agc_settings_fields() as $section ) {
		foreach ( $section['fields'] as $key => $field ) {
			$defaults[ $key ] = $field['default'];
		}
	}
	return $defaults;
}

function agc_settings(): array {
	return wp_parse_args( (array) get_option( AGC_OPTION, array() ), agc_default_settings() );
}

function agc_get_setting( string $key, $fallback = '' ) {
	$settings = agc_settings();
	return $settings[ $key ] ?? $fallback;
}

function agc_phone_url( string $phone ): string {
	$digits = preg_replace( '/[^0-9+]/', '', $phone );
	return $digits ? 'tel:' . $digits : '';
}

/**
 * Services offered in the quote form, one per line in settings.
 */
function agc_quote_services(): array {
	$lines = preg_split( '/\R/', (string) agc_get_setting( 'quote_services' ) );
	return array_values( array_filter( array_map( 'trim', $lines ) ) );
}

function agc_sanitize_settings( $input ): array {
	$input = is_array( $input ) ? $input : array();
	$clean = array();

	foreach ( agc_settings_fields() as $section ) {
		foreach ( $section['fields'] as $key => $field ) {
			$value         = $input[ $key ] ?? '';
			$clean[ $key ] = match ( $field['type'] ) {
				'email'    => sanitize_email( $value ),
				'url'      => esc_url_raw( $value ),
				'textarea' => sanitize_textarea_field( $value ),
				'number'   => absint( $value ),
				'checkbox' => empty( $value ) ? 0 : 1,
				default    => sanitize_text_field( $value ),
			};
		}
	}

	return $clean;
}

add_action(
	'admin_init',
	function () {
		register_setting(
			'agc_settings_group',
			AGC_OPTION,
			array(
				'type'              => 'array',
				'sanitize_callback' => 'agc_sanitize_settings',
				'default'           => array(),
			)
		);
	}
);

add_action(
	'admin_menu',
	function () {
		add_theme_page(
			__( 'Theme Settings', 'auto-glass-care' ),
			__( 'Theme Settings', 'auto-glass-care' ),
			'edit_theme_options',
			'agc-settings',
			'agc_render_settings_page'
		);
	}
);

function agc_render_settings_page(): void {
	$settings = agc_settings();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Theme Settings', 'auto-glass-care' ); ?></h1>
		<p><?php esc_html_e( 'Business details used across the site (header, footer, quote form, blocks bound to Theme Settings). Colors and fonts are under Appearance → Editor → Styles.', 'auto-glass-care' ); ?></p>
		<form method="post" action="options.php">
			<?php settings_fields( 'agc_settings_group' ); ?>
			<?php foreach ( agc_settings_fields() as $section ) : ?>
				<h2 class="title"><?php echo esc_html( $section['title'] ); ?></h2>
				<table class="form-table" role="presentation">
					<?php
					foreach ( $section['fields'] as $key => $field ) :
						$id    = 'agc-' . $key;
						$name  = AGC_OPTION . '[' . $key . ']';
						$value = $settings[ $key ];
						?>
						<tr>
							<th scope="row"><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $field['label'] ); ?></label></th>
							<td>
								<?php if ( 'textarea' === $field['type'] ) : ?>
									<textarea id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" rows="4" class="large-text"><?php echo esc_textarea( $value ); ?></textarea>
								<?php elseif ( 'checkbox' === $field['type'] ) : ?>
									<input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="0">
									<input type="checkbox" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" value="1" <?php checked( (int) $value, 1 ); ?>>
								<?php else : ?>
									<input type="<?php echo esc_attr( $field['type'] ); ?>" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" class="<?php echo 'number' === $field['type'] ? 'small-text' : 'regular-text'; ?>">
								<?php endif; ?>
								<?php if ( ! empty( $field['help'] ) ) : ?>
									<p class="description"><?php echo esc_html( $field['help'] ); ?></p>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			<?php endforeach; ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
