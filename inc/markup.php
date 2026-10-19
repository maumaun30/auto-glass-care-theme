<?php
/**
 * Block markup helpers for PHP patterns.
 *
 * Each helper returns serialized block markup that matches core's saved HTML, so patterns
 * built from them insert as valid blocks. Text arguments are plain text and are escaped here.
 *
 * @package AutoGlassCare
 */

defined( 'ABSPATH' ) || exit;

/**
 * Block comment delimiter: <!-- wp:name {attrs} --> or self-closing.
 */
function agc_block_open( string $name, array $attrs = array(), bool $void = false ): string {
	$json = $attrs ? ' ' . wp_json_encode( $attrs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) : '';
	return sprintf( '<!-- wp:%s%s %s-->', $name, $json, $void ? '/' : '' );
}

function agc_block_close( string $name ): string {
	return sprintf( '<!-- /wp:%s -->', $name );
}

/**
 * Dynamic block with no saved content (e.g. agc/quote-form, core/post-title).
 */
function agc_b_dynamic( string $name, array $attrs = array() ): string {
	return agc_block_open( $name, $attrs, true );
}

/**
 * Color, font size, alignment and custom classes that core adds to saved markup.
 */
function agc_b_classes( array $attrs, array $base = array() ): string {
	$classes = $base;
	if ( ! empty( $attrs['align'] ) ) {
		$classes[] = 'align' . $attrs['align'];
	}
	if ( ! empty( $attrs['textAlign'] ) ) {
		$classes[] = 'has-text-align-' . $attrs['textAlign'];
	}
	if ( ! empty( $attrs['textColor'] ) ) {
		$classes[] = 'has-' . $attrs['textColor'] . '-color';
		$classes[] = 'has-text-color';
	}
	if ( ! empty( $attrs['backgroundColor'] ) ) {
		$classes[] = 'has-' . $attrs['backgroundColor'] . '-background-color';
		$classes[] = 'has-background';
	}
	if ( ! empty( $attrs['fontSize'] ) ) {
		$classes[] = 'has-' . $attrs['fontSize'] . '-font-size';
	}
	if ( ! empty( $attrs['className'] ) ) {
		$classes[] = $attrs['className'];
	}
	return esc_attr( implode( ' ', array_filter( $classes ) ) );
}

function agc_b_heading( string $text, array $attrs = array() ): string {
	$level = (int) ( $attrs['level'] ?? 2 );
	return agc_block_open( 'heading', $attrs )
		. sprintf( '<h%1$d class="%2$s">%3$s</h%1$d>', $level, agc_b_classes( $attrs, array( 'wp-block-heading' ) ), esc_html( $text ) )
		. agc_block_close( 'heading' );
}

function agc_b_paragraph( string $text, array $attrs = array() ): string {
	// Paragraph stores text alignment as "align" but saves it as has-text-align-*.
	$class_attrs = $attrs;
	if ( ! empty( $class_attrs['align'] ) ) {
		$class_attrs['textAlign'] = $class_attrs['align'];
		unset( $class_attrs['align'] );
	}
	$classes = agc_b_classes( $class_attrs );
	return agc_block_open( 'paragraph', $attrs )
		. sprintf( '<p%s>%s</p>', $classes ? ' class="' . $classes . '"' : '', esc_html( $text ) )
		. agc_block_close( 'paragraph' );
}

function agc_b_list( array $items, array $attrs = array() ): string {
	$html = '';
	foreach ( $items as $item ) {
		$html .= agc_block_open( 'list-item' ) . '<li>' . esc_html( $item ) . '</li>' . agc_block_close( 'list-item' );
	}
	return agc_block_open( 'list', $attrs )
		. sprintf( '<ul class="%s">%s</ul>', agc_b_classes( $attrs, array( 'wp-block-list' ) ), $html )
		. agc_block_close( 'list' );
}

/**
 * One button. $url may be a Theme Settings binding key prefixed with "bind:" (e.g. "bind:phone_url").
 */
function agc_b_button( string $text, string $url, array $attrs = array() ): string {
	$href = '';
	if ( str_starts_with( $url, 'bind:' ) ) {
		$attrs['metadata']['bindings']['url'] = array(
			'source' => 'agc/settings',
			'args'   => array( 'key' => substr( $url, 5 ) ),
		);
	} else {
		$href = ' href="' . esc_url( $url ) . '"';
	}
	return agc_block_open( 'button', $attrs )
		. sprintf( '<div class="%s"><a class="wp-block-button__link wp-element-button"%s>%s</a></div>', agc_b_classes( $attrs, array( 'wp-block-button' ) ), $href, esc_html( $text ) )
		. agc_block_close( 'button' );
}

function agc_b_buttons( array $buttons, array $attrs = array() ): string {
	return agc_block_open( 'buttons', $attrs )
		. sprintf( '<div class="%s">%s</div>', agc_b_classes( $attrs, array( 'wp-block-buttons' ) ), implode( '', $buttons ) )
		. agc_block_close( 'buttons' );
}

function agc_b_image( string $src, string $alt, array $attrs = array() ): string {
	$attrs += array( 'sizeSlug' => 'large', 'linkDestination' => 'none' );
	return agc_block_open( 'image', $attrs )
		. sprintf(
			'<figure class="%s"><img src="%s" alt="%s"/></figure>',
			agc_b_classes( $attrs, array( 'wp-block-image', 'size-' . $attrs['sizeSlug'] ) ),
			esc_url( $src ),
			esc_attr( $alt )
		)
		. agc_block_close( 'image' );
}

function agc_b_gallery( array $images ): string {
	$inner = '';
	foreach ( $images as [ $src, $alt ] ) {
		$inner .= agc_b_image( $src, $alt );
	}
	return agc_block_open( 'gallery', array( 'linkTo' => 'none' ) )
		. '<figure class="wp-block-gallery has-nested-images columns-default is-cropped">' . $inner . '</figure>'
		. agc_block_close( 'gallery' );
}

/**
 * Group. Use section style variations (className is-style-*) for color and spacing instead of inline styles.
 */
function agc_b_group( string $inner, array $attrs = array() ): string {
	$attrs += array( 'layout' => array( 'type' => 'constrained' ) );
	$tag    = $attrs['tagName'] ?? 'div';
	$anchor = ! empty( $attrs['anchor'] ) ? ' id="' . esc_attr( $attrs['anchor'] ) . '"' : '';
	return agc_block_open( 'group', $attrs )
		. sprintf( '<%1$s%2$s class="%3$s">%4$s</%1$s>', $tag, $anchor, agc_b_classes( $attrs, array( 'wp-block-group' ) ), $inner )
		. agc_block_close( 'group' );
}

/**
 * Columns. Each column is [ inner markup, column attrs ].
 */
function agc_b_columns( array $columns, array $attrs = array() ): string {
	$html = '';
	foreach ( $columns as [ $inner, $column_attrs ] ) {
		$base = array( 'wp-block-column' );
		if ( ! empty( $column_attrs['verticalAlignment'] ) ) {
			$base[] = 'is-vertically-aligned-' . $column_attrs['verticalAlignment'];
		}
		$style = ! empty( $column_attrs['width'] ) ? ' style="flex-basis:' . esc_attr( $column_attrs['width'] ) . '"' : '';
		$html .= agc_block_open( 'column', $column_attrs )
			. sprintf( '<div class="%s"%s>%s</div>', agc_b_classes( $column_attrs, $base ), $style, $inner )
			. agc_block_close( 'column' );
	}
	$base = array( 'wp-block-columns' );
	if ( ! empty( $attrs['verticalAlignment'] ) ) {
		$base[] = 'are-vertically-aligned-' . $attrs['verticalAlignment'];
	}
	return agc_block_open( 'columns', $attrs )
		. sprintf( '<div class="%s">%s</div>', agc_b_classes( $attrs, $base ), $html )
		. agc_block_close( 'columns' );
}

/**
 * Responsive grid group (core grid layout) holding the given blocks.
 */
function agc_b_grid( array $items, string $min_width = '16rem' ): string {
	return agc_b_group(
		implode( '', $items ),
		array( 'layout' => array( 'type' => 'grid', 'minimumColumnWidth' => $min_width ) )
	);
}
