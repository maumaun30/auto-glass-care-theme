<?php
/**
 * Auto Glass Care theme bootstrap.
 *
 * @package AutoGlassCare
 */

defined( 'ABSPATH' ) || exit;

define( 'AGC_VERSION', '1.1.0' );
define( 'AGC_DIR', get_template_directory() );
define( 'AGC_URI', get_template_directory_uri() );

require AGC_DIR . '/inc/settings.php';
require AGC_DIR . '/inc/setup.php';
require AGC_DIR . '/inc/markup.php';
require AGC_DIR . '/inc/sections.php';
require AGC_DIR . '/inc/blocks.php';
require AGC_DIR . '/inc/bindings.php';
require AGC_DIR . '/inc/quote-form.php';
