<?php
/**
 * Title: Services — flip cards
 * Slug: auto-glass-care/services
 * Categories: auto-glass-care, featured
 * Keywords: services, cards, flip
 * Viewport Width: 1400
 *
 * @package AutoGlassCare
 */

$agc_cards = array(
	array(
		'title'       => __( 'Window Tinting', 'auto-glass-care' ),
		'description' => __( 'Block UV rays and glare while keeping your car cool and stylish.', 'auto-glass-care' ),
		'image'       => 'service-window-tinting.webp',
		'link'        => '/window-tinting/',
	),
	array(
		'title'       => __( 'Vehicle Ceramic Coating', 'auto-glass-care' ),
		'description' => __( 'Keep that showroom shine with a durable layer of protection.', 'auto-glass-care' ),
		'image'       => 'service-ceramic-coating.webp',
		'link'        => '/ceramic-coating/',
	),
	array(
		'title'       => __( 'Clear Bra Paint Protection', 'auto-glass-care' ),
		'description' => __( 'Shield your paint from rock chips, scratches and the elements.', 'auto-glass-care' ),
		'image'       => 'service-clear-bra.webp',
		'link'        => '/clear-bra-paint-protection/',
	),
);
?>
<!-- wp:group {"metadata":{"name":"Services"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:heading {"textAlign":"center","className":"is-style-section-title"} -->
	<h2 class="wp-block-heading has-text-align-center is-style-section-title"><?php esc_html_e( 'Our Services', 'auto-glass-care' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:group {"style":{"spacing":{"blockGap":"30px","margin":{"top":"40px"}}},"layout":{"type":"grid","minimumColumnWidth":"18rem"}} -->
	<div class="wp-block-group" style="margin-top:40px">
		<?php foreach ( $agc_cards as $agc_card ) : ?>
			<!-- wp:agc/service-card <?php echo wp_json_encode( array( 'title' => $agc_card['title'], 'description' => $agc_card['description'], 'imageUrl' => AGC_URI . '/assets/images/' . $agc_card['image'], 'linkUrl' => home_url( $agc_card['link'] ), 'linkText' => __( 'Get a quote', 'auto-glass-care' ) ) ); ?> /-->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
