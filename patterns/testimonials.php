<?php
/**
 * Title: Customer testimonials
 * Slug: auto-glass-care/testimonials
 * Categories: auto-glass-care, testimonials
 * Keywords: reviews, testimonials, quotes
 * Viewport Width: 1400
 *
 * @package AutoGlassCare
 */

$agc_reviews = array(
	array( __( 'Replace with a real customer review — what work was done and how it turned out.', 'auto-glass-care' ), __( 'Customer Name', 'auto-glass-care' ) ),
	array( __( 'Replace with a real customer review — mention service, speed and friendliness.', 'auto-glass-care' ), __( 'Customer Name', 'auto-glass-care' ) ),
	array( __( 'Replace with a real customer review — highlight warranty or results.', 'auto-glass-care' ), __( 'Customer Name', 'auto-glass-care' ) ),
);
?>
<!-- wp:group {"metadata":{"name":"Testimonials"},"align":"full","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:heading {"textAlign":"center","className":"is-style-section-title"} -->
	<h2 class="wp-block-heading has-text-align-center is-style-section-title"><?php esc_html_e( 'Customer Testimonials', 'auto-glass-care' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:group {"style":{"spacing":{"blockGap":"30px","margin":{"top":"40px"}}},"layout":{"type":"grid","minimumColumnWidth":"18rem"}} -->
	<div class="wp-block-group" style="margin-top:40px">
		<?php foreach ( $agc_reviews as [ $agc_text, $agc_author ] ) : ?>
			<!-- wp:quote {"className":"is-style-review-card"} -->
			<blockquote class="wp-block-quote is-style-review-card">
				<!-- wp:paragraph -->
				<p><?php echo esc_html( $agc_text ); ?></p>
				<!-- /wp:paragraph -->
				<cite><?php echo esc_html( $agc_author ); ?></cite>
			</blockquote>
			<!-- /wp:quote -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
