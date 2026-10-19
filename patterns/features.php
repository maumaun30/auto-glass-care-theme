<?php
/**
 * Title: Service intro with highlights
 * Slug: auto-glass-care/features
 * Categories: auto-glass-care, featured
 * Keywords: features, highlights, checklist, warranty
 * Viewport Width: 1400
 *
 * @package AutoGlassCare
 */

$agc_years = (int) agc_get_setting( 'experience_years' );
?>
<!-- wp:group {"metadata":{"name":"Highlights"},"align":"full","className":"is-style-section-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-hero">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"60px"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:heading {"className":"is-style-section-title"} -->
			<h2 class="wp-block-heading is-style-section-title"><?php esc_html_e( 'Auto Window Tinting', 'auto-glass-care' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:heading {"level":3,"textColor":"highlight"} -->
			<h3 class="wp-block-heading has-highlight-color has-text-color"><?php esc_html_e( 'Your local tint specialists', 'auto-glass-care' ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:list {"className":"is-style-checklist"} -->
			<ul class="wp-block-list is-style-checklist">
				<!-- wp:list-item --><li><?php esc_html_e( 'Computer-cut film for a precise fit', 'auto-glass-care' ); ?></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><?php esc_html_e( 'Lifetime warranty on film and labor', 'auto-glass-care' ); ?></li><!-- /wp:list-item -->
				<!-- wp:list-item --><li>
				<?php
				/* translators: %d: years of experience */
				printf( esc_html__( '%d+ years of experience', 'auto-glass-care' ), (int) $agc_years );
				?>
				</li><!-- /wp:list-item -->
				<!-- wp:list-item --><li><?php esc_html_e( 'Certified film installers', 'auto-glass-care' ); ?></li><!-- /wp:list-item -->
			</ul>
			<!-- /wp:list -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"metadata":{"bindings":{"url":{"source":"agc/settings","args":{"key":"phone_url"}}}}} -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Call Us Now & Save', 'auto-glass-care' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:image {"sizeSlug":"full","className":"is-style-framed"} -->
			<figure class="wp-block-image size-full is-style-framed"><img src="<?php echo esc_url( AGC_URI . '/assets/images/service-window-tinting.webp' ); ?>" alt="<?php esc_attr_e( 'Window tint installation', 'auto-glass-care' ); ?>"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
