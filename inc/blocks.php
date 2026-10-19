<?php
/**
 * Custom server-rendered blocks. Each block lives in blocks/{name}/ with its own
 * block.json, render.php, editor script and component stylesheet.
 *
 * @package AutoGlassCare
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'init',
	function () {
		foreach ( glob( AGC_DIR . '/blocks/*/block.json' ) as $metadata ) {
			register_block_type( dirname( $metadata ) );
		}
	}
);

add_filter(
	'block_categories_all',
	function ( array $categories ): array {
		array_unshift(
			$categories,
			array(
				'slug'  => 'auto-glass-care',
				'title' => __( 'Auto Glass Care', 'auto-glass-care' ),
			)
		);
		return $categories;
	}
);
