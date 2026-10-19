<?php
/**
 * Title: Header
 * Slug: auto-glass-care/header
 * Categories: header
 * Block Types: core/template-part/header
 * Inserter: no
 *
 * @package AutoGlassCare
 */

$agc_phone_url = agc_phone_url( (string) agc_get_setting( 'phone' ) );
?>
<!-- wp:group {"metadata":{"name":"Top Bar"},"align":"full","className":"is-style-section-topbar","layout":{"type":"constrained","contentSize":"1400px"}} -->
<div class="wp-block-group alignfull is-style-section-topbar">
	<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
	<div class="wp-block-group">
		<!-- wp:site-logo {"width":300,"shouldSyncIcon":false} /-->

		<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"20px"}}} -->
		<div class="wp-block-group">
			<!-- wp:agc/business-info {"field":"phone","label":"Call Us:","fontSize":"large","className":"is-hidden-mobile"} /-->

			<!-- wp:image {"width":"300px","sizeSlug":"full","linkDestination":"custom","className":"agc-header-promo"} -->
			<figure class="wp-block-image size-full is-resized agc-header-promo"><a href="<?php echo esc_url( $agc_phone_url, array( 'tel' ) ); ?>"><img src="<?php echo esc_url( AGC_URI . '/assets/images/header-promo.webp' ); ?>" alt="<?php esc_attr_e( 'Authorized window film dealer — call now', 'auto-glass-care' ); ?>" style="width:300px"/></a></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Nav Bar"},"align":"full","className":"is-style-section-navbar","layout":{"type":"constrained","contentSize":"1400px"}} -->
<div class="wp-block-group alignfull is-style-section-navbar">
	<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
	<div class="wp-block-group">
		<!-- wp:navigation {"overlayMenu":"mobile","layout":{"type":"flex","justifyContent":"left"},"style":{"spacing":{"blockGap":"40px"}}} /-->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"className":"is-style-outline-highlight"} -->
			<div class="wp-block-button is-style-outline-highlight"><a class="wp-block-button__link wp-element-button" href="#quote"><?php esc_html_e( 'Get A Quote', 'auto-glass-care' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
