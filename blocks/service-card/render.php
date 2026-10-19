<?php
/**
 * Service Card block.
 *
 * @var array $attributes Block attributes.
 * @package AutoGlassCare
 */

$agc_image = '';
if ( ! empty( $attributes['imageId'] ) ) {
	$agc_image = (string) wp_get_attachment_image_url( (int) $attributes['imageId'], 'large' );
}
if ( '' === $agc_image ) {
	$agc_image = $attributes['imageUrl'] ?? '';
}

$agc_title    = $attributes['title'] ?? '';
$agc_desc     = $attributes['description'] ?? '';
$agc_link     = $attributes['linkUrl'] ?? '';
$agc_tag      = $agc_link ? 'a' : 'div';
$agc_style    = sprintf( '--agc-card-height:%dpx;', max( 120, (int) ( $attributes['height'] ?? 313 ) ) );
if ( $agc_image ) {
	$agc_style .= sprintf( '--agc-card-image:url("%s");', esc_url( $agc_image ) );
}
?>
<div <?php echo get_block_wrapper_attributes( array( 'style' => $agc_style ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<<?php echo $agc_tag; // phpcs:ignore WordPress.Security.EscapeOutput ?> class="agc-service-card__inner"<?php echo $agc_link ? ' href="' . esc_url( $agc_link ) . '"' : ''; ?>>
		<div class="agc-service-card__face agc-service-card__front" aria-hidden="true">
			<span class="agc-service-card__title"><?php echo esc_html( $agc_title ); ?></span>
		</div>
		<div class="agc-service-card__face agc-service-card__back">
			<h3 class="agc-service-card__title"><?php echo esc_html( $agc_title ); ?></h3>
			<?php if ( $agc_desc ) : ?>
				<p class="agc-service-card__description"><?php echo esc_html( $agc_desc ); ?></p>
			<?php endif; ?>
			<?php if ( $agc_link && ! empty( $attributes['linkText'] ) ) : ?>
				<span class="agc-service-card__more"><?php echo esc_html( $attributes['linkText'] ); ?></span>
			<?php endif; ?>
		</div>
	</<?php echo $agc_tag; // phpcs:ignore WordPress.Security.EscapeOutput ?>>
</div>
