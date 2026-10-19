<?php
/**
 * Business Info block.
 *
 * @var array $attributes Block attributes.
 * @package AutoGlassCare
 */

$agc_field = $attributes['field'] ?? 'phone';
$agc_value = trim( (string) agc_get_setting( $agc_field ) );

if ( '' === $agc_value ) {
	return;
}

$agc_href = '';
if ( ! empty( $attributes['isLink'] ) ) {
	$agc_href = match ( $agc_field ) {
		'phone'   => agc_phone_url( $agc_value ),
		'email'   => 'mailto:' . antispambot( $agc_value ),
		'address' => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $agc_value ),
		default   => '',
	};
}

$agc_output = $agc_href
	? sprintf( '<a class="agc-business-info__value" href="%s"%s>%s</a>', esc_url( $agc_href, array( 'tel', 'mailto', 'https' ) ), 'address' === $agc_field ? ' target="_blank" rel="noopener"' : '', esc_html( 'email' === $agc_field ? antispambot( $agc_value ) : $agc_value ) )
	: sprintf( '<span class="agc-business-info__value">%s</span>', esc_html( $agc_value ) );

$agc_label = $attributes['label'] ?? '';
?>
<p <?php echo get_block_wrapper_attributes( array( 'class' => 'is-field-' . sanitize_html_class( $agc_field ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<?php if ( '' !== $agc_label ) : ?>
		<span class="agc-business-info__label"><?php echo esc_html( $agc_label ); ?></span>
	<?php endif; ?>
	<?php echo $agc_output; // phpcs:ignore WordPress.Security.EscapeOutput ?>
</p>
