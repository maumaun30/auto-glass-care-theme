<?php
/**
 * Rating Summary block.
 *
 * @var array $attributes Block attributes.
 * @package AutoGlassCare
 */

$agc_rating = min( 5, max( 0, (float) agc_get_setting( 'rating_value' ) ) );
$agc_count  = (int) agc_get_setting( 'rating_count' );
$agc_url    = ! empty( $attributes['showLink'] ) ? (string) agc_get_setting( 'reviews_url' ) : '';

if ( ! $agc_rating ) {
	return;
}

$agc_rating_text = rtrim( rtrim( number_format_i18n( $agc_rating, 1 ), '0' ), '.' );
/* translators: %s: average rating, e.g. 4.9 */
$agc_headline = sprintf( __( '%s Out Of 5 Stars', 'auto-glass-care' ), $agc_rating_text );
/* translators: %s: number of reviews */
$agc_based_on = $agc_count ? sprintf( _n( 'Based on %s review', 'Based on %s reviews', $agc_count, 'auto-glass-care' ), number_format_i18n( $agc_count ) ) : '';
?>
<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<span class="agc-rating__stars" style="--agc-rating:<?php echo esc_attr( (string) ( $agc_rating / 5 * 100 ) ); ?>%" role="img" aria-label="<?php echo esc_attr( $agc_headline ); ?>"></span>
	<p class="agc-rating__headline"><?php echo esc_html( $agc_headline ); ?></p>
	<?php if ( $agc_based_on ) : ?>
		<p class="agc-rating__count">
			<?php if ( $agc_url ) : ?>
				<a href="<?php echo esc_url( $agc_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $agc_based_on ); ?></a>
			<?php else : ?>
				<?php echo esc_html( $agc_based_on ); ?>
			<?php endif; ?>
		</p>
	<?php endif; ?>
</div>
