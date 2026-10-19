<?php
/**
 * Title: Get a quote
 * Slug: auto-glass-care/quote
 * Categories: auto-glass-care, call-to-action
 * Keywords: quote, form, estimate, contact
 * Viewport Width: 1400
 *
 * @package AutoGlassCare
 */
?>
<!-- wp:group {"metadata":{"name":"Quote"},"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:0;padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:group {"anchor":"quote","className":"is-style-section-quote","layout":{"type":"constrained","contentSize":"760px"}} -->
	<div id="quote" class="wp-block-group is-style-section-quote">
		<!-- wp:heading {"textAlign":"center","className":"is-style-section-title","textColor":"base"} -->
		<h2 class="wp-block-heading has-text-align-center is-style-section-title has-base-color has-text-color"><?php esc_html_e( 'Get A Quote', 'auto-glass-care' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:agc/quote-form /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
