<?php
/**
 * Title: Contact details
 * Slug: auto-glass-care/contact-details
 * Categories: auto-glass-care, contact
 * Keywords: contact, address, phone, hours
 * Viewport Width: 1400
 *
 * @package AutoGlassCare
 */

$agc_items = array(
	array( __( 'Visit Us', 'auto-glass-care' ), 'address' ),
	array( __( 'Call Us', 'auto-glass-care' ), 'phone' ),
	array( __( 'Email Us', 'auto-glass-care' ), 'email' ),
	array( __( 'Shop Hours', 'auto-glass-care' ), 'hours' ),
);
?>
<!-- wp:group {"metadata":{"name":"Contact Details"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"30px"}},"layout":{"type":"grid","minimumColumnWidth":"14rem"}} -->
	<div class="wp-block-group">
		<?php foreach ( $agc_items as [ $agc_label, $agc_field ] ) : ?>
			<!-- wp:group {"className":"is-style-info-card","layout":{"type":"default"}} -->
			<div class="wp-block-group is-style-info-card">
				<!-- wp:heading {"level":3,"textColor":"accent","fontSize":"large"} -->
				<h3 class="wp-block-heading has-accent-color has-text-color has-large-font-size"><?php echo esc_html( $agc_label ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:agc/business-info <?php echo wp_json_encode( array( 'field' => $agc_field ) ); ?> /-->
			</div>
			<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
