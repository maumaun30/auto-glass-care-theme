<?php
/**
 * Business Social Links block: renders core/social-links from Theme Settings URLs.
 *
 * @var array $attributes Block attributes.
 * @package AutoGlassCare
 */

$agc_services = array(
	'facebook'  => 'social_facebook',
	'google'    => 'social_google',
	'yelp'      => 'social_yelp',
	'instagram' => 'social_instagram',
	'youtube'   => 'social_youtube',
	'tiktok'    => 'social_tiktok',
	'x'         => 'social_x',
);

$agc_links = '';
foreach ( $agc_services as $agc_service => $agc_key ) {
	$agc_url = agc_get_setting( $agc_key );
	if ( $agc_url ) {
		$agc_links .= sprintf( '<!-- wp:social-link %s /-->', wp_json_encode( array( 'url' => $agc_url, 'service' => $agc_service ) ) );
	}
}

if ( '' === $agc_links ) {
	return;
}

$agc_size       = $attributes['size'] ?? 'has-normal-icon-size';
$agc_icon_color = $attributes['iconColor'] ?? '';
$agc_classes    = array( 'wp-block-social-links', $agc_size );
if ( ! empty( $attributes['logosOnly'] ) ) {
	$agc_classes[] = 'is-style-logos-only';
}
if ( $agc_icon_color ) {
	$agc_classes[] = 'has-icon-color';
}

$agc_core_attrs = array(
	'iconColorValue' => $agc_icon_color,
	'openInNewTab'   => true,
	'size'           => $agc_size,
	'className'      => empty( $attributes['logosOnly'] ) ? '' : 'is-style-logos-only',
);

$agc_markup = sprintf(
	'<!-- wp:social-links %1$s --><ul class="%2$s">%3$s</ul><!-- /wp:social-links -->',
	wp_json_encode( $agc_core_attrs ),
	esc_attr( implode( ' ', $agc_classes ) ),
	$agc_links
);
?>
<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<?php echo do_blocks( $agc_markup ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
</div>
