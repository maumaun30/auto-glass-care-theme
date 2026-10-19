<?php
/**
 * Copyright block.
 *
 * @var array $attributes Block attributes.
 * @package AutoGlassCare
 */

$agc_start = (int) agc_get_setting( 'founded_year' );
$agc_now   = (int) wp_date( 'Y' );
$agc_years = ( $agc_start && $agc_start < $agc_now ) ? $agc_start . '-' . $agc_now : (string) $agc_now;
?>
<p <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	&copy; <?php echo esc_html( trim( $agc_years . ' ' . agc_get_setting( 'business_name' ) ) ); ?>.
	<?php echo esc_html( $attributes['suffix'] ?? '' ); ?>
</p>
