<?php

add_action('admin_enqueue_scripts', 'acf_admin_css');
/**
 * ACF Admin CSS
 * @since 0.5
 */
function acf_admin_css() {
	wp_register_style('acf-styles', SSMPB_DIR_URI . 'acf/styles/acf.css', '', SSMPB_VERSION);
	wp_enqueue_style('acf-styles');
}

add_filter('acf/settings/save_json', 'json_save_point');
/**
 * Updates where acf json files are saved to
 *
 */
function json_save_point($path) {

	// update path
	$path = get_template_directory() . '/lib/ssmpb/acf/fields';

	// return
	return $path;

}

add_filter('acf/settings/load_json', 'json_load_point');
/**
 * Updates where acf json files are loaded from
 *
 */
function json_load_point($paths) {

	// append path
	$paths[] = get_stylesheet_directory() . '/lib/ssmpb/acf/fields';

	// return
	return $paths;

}

// Add Brand Settings Page
// TODO: put inside init action
acf_add_options_sub_page(array(
    'page_title' => 'Brand Settings',
    'menu_title' => 'Brand Settings',
    'parent_slug' => 'ssm',
));

// Add Documentation Page
// TODO: put inside init action
acf_add_options_sub_page(array(
    'page_title' => 'Documentation',
    'menu_title' => 'Documentation',
    'parent_slug' => 'ssm',
));

add_filter('acf/format_value/type=text', 'ssm_format_value', 10, 3);
add_filter('acf/format_value/type=textarea', 'ssm_format_value', 10, 3);
/**
 *  Filter text inputs and check for shortcode
 */
function ssm_format_value($value, $post_id, $field)
{

    // run do_shortcode on all textarea values
    $value = do_shortcode($value);

    // return
    return $value;
}

add_filter('acf/fields/flexible_content/layout_title/name=sections', 'section_title', 10, 4);
/**
 * Update The Flexible Content Label
 * @since 0.5
 */
function section_title($title, $field, $layout, $i) {

	if ( get_sub_field('section_label') ) {
		$label = get_sub_field('section_label');
	} else {
		$label = $title;
	}

	return $label;

}
