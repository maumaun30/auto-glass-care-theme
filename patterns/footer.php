<?php
/**
 * Title: Footer
 * Slug: auto-glass-care/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Inserter: no
 *
 * @package AutoGlassCare
 */

// Heading attributes bound to a Theme Settings key (see inc/bindings.php).
$agc_bound_heading = static fn( string $key, array $attrs ): string => wp_json_encode(
	$attrs + array( 'metadata' => array( 'bindings' => array( 'content' => array( 'source' => 'agc/settings', 'args' => array( 'key' => $key ) ) ) ) )
);
?>
<!-- wp:group {"metadata":{"name":"Footer"},"align":"full","className":"is-style-section-footer","style":{"spacing":{"padding":{"top":"50px","bottom":"20px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-footer" style="padding-top:50px;padding-bottom:20px">
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"40px"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column {"width":"30%"} -->
		<div class="wp-block-column" style="flex-basis:30%">
			<!-- wp:site-logo {"width":240,"shouldSyncIcon":false} /-->

			<!-- wp:heading <?php echo $agc_bound_heading( 'tagline', array( 'fontSize' => 'large', 'textColor' => 'accent', 'style' => array( 'typography' => array( 'textTransform' => 'none' ) ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?> -->
			<h2 class="wp-block-heading has-accent-color has-text-color has-large-font-size" style="text-transform:none"><?php echo esc_html( agc_get_setting( 'tagline' ) ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:heading <?php echo $agc_bound_heading( 'subtagline', array( 'fontSize' => 'large', 'style' => array( 'typography' => array( 'textTransform' => 'none' ) ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?> -->
			<h2 class="wp-block-heading has-large-font-size" style="text-transform:none"><?php echo esc_html( agc_get_setting( 'subtagline' ) ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:agc/social-links /-->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'Services', 'auto-glass-care' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:list {"className":"is-style-plain"} -->
			<ul class="wp-block-list is-style-plain">
				<!-- wp:list-item --><li><a href="<?php echo esc_url( home_url( '/window-tinting/' ) ); ?>"><?php esc_html_e( 'Window Tinting', 'auto-glass-care' ); ?></a></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><a href="<?php echo esc_url( home_url( '/clear-bra-paint-protection/' ) ); ?>"><?php esc_html_e( 'Clear Bra Paint Protection', 'auto-glass-care' ); ?></a></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><a href="<?php echo esc_url( home_url( '/ceramic-coating/' ) ); ?>"><?php esc_html_e( 'Vehicle Ceramic Coating', 'auto-glass-care' ); ?></a></li><!-- /wp:list-item -->
			</ul>
			<!-- /wp:list -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'Information', 'auto-glass-care' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:list {"className":"is-style-plain"} -->
			<ul class="wp-block-list is-style-plain">
				<!-- wp:list-item --><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'auto-glass-care' ); ?></a></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'auto-glass-care' ); ?></a></li><!-- /wp:list-item -->
			</ul>
			<!-- /wp:list -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"30%"} -->
		<div class="wp-block-column" style="flex-basis:30%">
			<!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e( 'Contact Us', 'auto-glass-care' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:agc/business-info {"field":"address","label":"Address:","isLink":false} /-->
			<!-- wp:agc/business-info {"field":"email","label":"Email:"} /-->
			<!-- wp:agc/business-info {"field":"phone","label":"Call:"} /-->
			<!-- wp:agc/business-info {"field":"hours","label":"Hours:"} /-->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->

	<!-- wp:agc/copyright {"style":{"typography":{"textAlign":"center"},"spacing":{"margin":{"top":"40px"}}},"fontSize":"small"} /-->
</div>
<!-- /wp:group -->
