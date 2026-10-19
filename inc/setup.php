<?php
/**
 * Theme setup and component (per-block) stylesheets.
 *
 * @package AutoGlassCare
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'custom-logo' );
		add_theme_support( 'responsive-embeds' );
	}
);

/**
 * Core block component styles.
 *
 * assets/css/blocks/{namespace}-{block}.css is attached to that block only and is loaded
 * (front end and editor) just when the block is on the page, e.g. core-navigation.css → core/navigation.
 */
add_action(
	'init',
	function () {
		foreach ( glob( AGC_DIR . '/assets/css/blocks/*.css' ) as $file ) {
			$name = basename( $file, '.css' );
			[ $namespace, $block ] = explode( '-', $name, 2 );

			wp_enqueue_block_style(
				"$namespace/$block",
				array(
					'handle' => "agc-$name",
					'src'    => AGC_URI . "/assets/css/blocks/$name.css",
					'path'   => $file,
					'ver'    => AGC_VERSION,
				)
			);
		}
	}
);

add_action(
	'init',
	function () {
		register_block_pattern_category( 'auto-glass-care', array( 'label' => __( 'Auto Glass Care', 'auto-glass-care' ) ) );
	}
);

/**
 * Show the bundled logo until a Site Logo is chosen, so a fresh install still looks finished.
 */
add_filter(
	'render_block_core/site-logo',
	function ( string $content, array $block ): string {
		if ( '' !== trim( $content ) ) {
			return $content;
		}

		$width = (int) ( $block['attrs']['width'] ?? 240 );

		return sprintf(
			'<div class="wp-block-site-logo"><a href="%1$s" class="custom-logo-link" rel="home"><img src="%2$s" class="custom-logo" alt="%3$s" width="%4$d" style="width:%4$dpx;height:auto"></a></div>',
			esc_url( home_url( '/' ) ),
			esc_url( AGC_URI . '/assets/images/logo.webp' ),
			esc_attr( agc_get_setting( 'business_name' ) ),
			$width
		);
	},
	10,
	2
);
