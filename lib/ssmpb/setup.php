<?php

define('SSMPB_VERSION', '0.5');
define('SSMPB_DIR', trailingslashit(get_template_directory() . '/lib/ssmpb'));
define('SSMPB_DIR_URI', trailingslashit(get_template_directory_uri() . '/lib/ssmpb'));
define( 'FIELD_LIBRARY', 'ACF' ); // Options: ACF || Carbon

// Field Library setup
if ( FIELD_LIBRARY == 'ACF' && class_exists('ACF') ) {
    require SSMPB_DIR . 'acf/boot.php';
} elseif ( FIELD_LIBRARY == 'Carbon' && class_exists('Carbon_Fields') ) {
    \Carbon_Fields\Carbon_Fields::boot();
    require SSMPB_DIR . 'carbon/boot.php';
}

// Load helper functions
require SSMPB_DIR . 'helpers.php';

add_action('admin_enqueue_scripts', 'ssmpb_admin_css');

/**
 * SSMPB Admin CSS
 * @since 0.5
 */
function ssmpb_admin_css() {
	wp_register_style('ssmpb-styles', SSMPB_DIR_URI . 'styles/ssmpb.css', '', SSMPB_VERSION);
	wp_enqueue_style('ssmpb-styles');
}

add_action('admin_enqueue_scripts', 'ssmpb_admin_js');

/**
 * SSMPB Admin JS
 * @since 0.5
 */
function ssmpb_admin_js() {
	wp_enqueue_script( 'columns_width', SSMPB_DIR_URI . 'scripts/columns_width.js' );
	wp_localize_script( 'columns_width', 'main', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ), 
		'stylesheet_directory' => get_stylesheet_directory_uri()
	));
}
