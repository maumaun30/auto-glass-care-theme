<?php
/**
 * Title: Hero — brand intro
 * Slug: auto-glass-care/hero
 * Categories: auto-glass-care, banner
 * Keywords: hero, intro, banner
 * Viewport Width: 1400
 *
 * @package AutoGlassCare
 */

$agc_name  = (string) agc_get_setting( 'business_name' );
$agc_parts = preg_split( '/\s+/', trim( $agc_name ), 2 );
$agc_years = (int) agc_get_setting( 'experience_years' );
$agc_areas = (string) agc_get_setting( 'service_areas' );

$agc_tagline_attrs = wp_json_encode(
	array(
		'textAlign' => 'center',
		'textColor' => 'accent',
		'className' => 'is-style-section-title',
		'metadata'  => array( 'bindings' => array( 'content' => array( 'source' => 'agc/settings', 'args' => array( 'key' => 'tagline' ) ) ) ),
	)
);
?>
<!-- wp:group {"metadata":{"name":"Hero"},"align":"full","className":"is-style-section-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-hero">
	<!-- wp:image {"align":"center","sizeSlug":"full","style":{"spacing":{"margin":{"bottom":"50px"}}}} -->
	<figure class="wp-block-image aligncenter size-full" style="margin-bottom:50px"><img src="<?php echo esc_url( AGC_URI . '/assets/images/hero-banner.webp' ); ?>" alt="<?php echo esc_attr( $agc_name ); ?>"/></figure>
	<!-- /wp:image -->

	<!-- wp:heading {"textAlign":"center","level":1,"textColor":"accent","className":"is-style-brand-display"} -->
	<h1 class="wp-block-heading has-text-align-center is-style-brand-display has-accent-color has-text-color"><?php echo esc_html( $agc_parts[0] ?? '' ); ?> <span class="has-base-color has-text-color" style="display:block"><?php echo esc_html( $agc_parts[1] ?? '' ); ?></span></h1>
	<!-- /wp:heading -->

	<!-- wp:separator {"className":"is-style-wide","style":{"spacing":{"margin":{"top":"20px","bottom":"20px"}}}} -->
	<hr class="wp-block-separator has-alpha-channel-opacity is-style-wide" style="margin-top:20px;margin-bottom:20px"/>
	<!-- /wp:separator -->

	<!-- wp:heading <?php echo $agc_tagline_attrs; // phpcs:ignore WordPress.Security.EscapeOutput ?> -->
	<h2 class="wp-block-heading has-text-align-center is-style-section-title has-accent-color has-text-color"><?php echo esc_html( agc_get_setting( 'tagline' ) ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center">
		<?php
		printf(
			/* translators: 1: years in business, 2: business name */
			esc_html__( 'Auto window tint and related services done with quality and integrity for over %1$d years! %2$s is a local shop for window tinting, auto glass coating, clear bra, ceramic coating, vinyl wrap and auto glass repair.', 'auto-glass-care' ),
			(int) $agc_years,
			esc_html( $agc_name )
		);
		?>
	</p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center">
		<?php
		printf(
			/* translators: %s: comma separated service areas */
			esc_html__( 'Proudly serving %s and beyond. Free estimates — call us today!', 'auto-glass-care' ),
			esc_html( $agc_areas )
		);
		?>
	</p>
	<!-- /wp:paragraph -->

	<!-- wp:columns {"style":{"spacing":{"margin":{"top":"40px"}}}} -->
	<div class="wp-block-columns" style="margin-top:40px">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:image {"height":"350px","sizeSlug":"full","scale":"cover","className":"is-style-framed"} -->
			<figure class="wp-block-image size-full is-resized is-style-framed"><img src="<?php echo esc_url( AGC_URI . '/assets/images/car-orange.webp' ); ?>" alt="<?php esc_attr_e( 'Tinted sports car', 'auto-glass-care' ); ?>" style="object-fit:cover;height:350px"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:image {"height":"350px","sizeSlug":"full","scale":"cover","className":"is-style-framed"} -->
			<figure class="wp-block-image size-full is-resized is-style-framed"><img src="<?php echo esc_url( AGC_URI . '/assets/images/car-black.webp' ); ?>" alt="<?php esc_attr_e( 'Tinted black car', 'auto-glass-care' ); ?>" style="object-fit:cover;height:350px"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
