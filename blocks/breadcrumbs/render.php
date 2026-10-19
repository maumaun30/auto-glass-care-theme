<?php
/**
 * Breadcrumbs block.
 *
 * @var array    $attributes Block attributes.
 * @var WP_Block $block      Block instance.
 * @package AutoGlassCare
 */

$agc_post_id = (int) ( $block->context['postId'] ?? 0 );
if ( ! $agc_post_id && ( is_singular() || wp_is_serving_rest_request() ) ) {
	// Template root on singular views, or the editor's server-side preview (post_id query arg).
	$agc_post_id = (int) get_the_ID();
}

$agc_crumbs = array(
	array( $attributes['homeLabel'] ?? __( 'Home', 'auto-glass-care' ), home_url( '/' ) ),
);

if ( $agc_post_id ) {
	foreach ( array_reverse( get_post_ancestors( $agc_post_id ) ) as $agc_ancestor ) {
		$agc_crumbs[] = array( get_the_title( $agc_ancestor ), get_permalink( $agc_ancestor ) );
	}
	$agc_crumbs[] = array( get_the_title( $agc_post_id ), '' );
} elseif ( is_search() ) {
	$agc_crumbs[] = array( __( 'Search results', 'auto-glass-care' ), '' );
} elseif ( is_archive() ) {
	$agc_crumbs[] = array( wp_strip_all_tags( get_the_archive_title() ), '' );
} elseif ( is_404() ) {
	$agc_crumbs[] = array( __( 'Page not found', 'auto-glass-care' ), '' );
}
?>
<nav <?php echo get_block_wrapper_attributes( array( 'aria-label' => __( 'Breadcrumb', 'auto-glass-care' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<ol>
		<?php foreach ( $agc_crumbs as [ $agc_label, $agc_url ] ) : ?>
			<li>
				<?php if ( $agc_url ) : ?>
					<a href="<?php echo esc_url( $agc_url ); ?>"><?php echo esc_html( $agc_label ); ?></a>
				<?php else : ?>
					<span aria-current="page"><?php echo esc_html( $agc_label ); ?></span>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ol>
</nav>
