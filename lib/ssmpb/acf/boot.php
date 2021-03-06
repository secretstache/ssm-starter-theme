<?php

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

add_action('admin_enqueue_scripts', 'acf_admin_css');
/**
 * ACF Admin CSS
 * @since 0.5
 */
function acf_admin_css() {
	wp_register_style('acf-styles', SSMPB_DIR_URI . 'acf/styles/acf.css', '', SSMPB_VERSION);
	wp_enqueue_style('acf-styles');
}

// Add Brand Settings Page
// TODO: wrap inside init action
acf_add_options_sub_page(array(
    'page_title' => 'Brand Settings',
    'menu_title' => 'Brand Settings',
    'parent_slug' => 'ssm',
));

// Add Documentation Page
// TODO: wrap inside init action
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

add_action('acf/input/admin_head', 'acf_flexible_content_collapse');
/**
 * Collapse Flexible Content Fields by default
 * @since 0.5
 */
function acf_flexible_content_collapse() {
	?>
	<style id="acf-flexible-content-collapse">.acf-flexible-content .acf-fields { display: none; }</style>
	<script type="text/javascript">
			jQuery(function($) {
					$('.acf-flexible-content .layout').addClass('-collapsed');
					$('#acf-flexible-content-collapse').detach();
			});
	</script>
	<?php
}


// add_filter('acf/load_field/name=column_width', 'load_default_width');
// /**
//  * Collapse Flexible Content Fields by default
//  * @since 1.0
//  */
// function load_default_width( $field ) {
// 	// pprint_r( $field );

// 	$cols = get_sub_field('section_columns');

// 	if ( count( $cols ) == 1 ) {
// 		$field['default_value'] = '12';
// 	} elseif ( count( $cols ) == 2 ) {
// 		$field['default_value'] = '6';
// 	} elseif ( count( $cols ) == 3 ) {
// 		$field['default_value'] = '4';
// 	} elseif ( count( $cols ) == 4 ) {
// 		$field['default_value'] = '3';
// 	}

// 	return $field;

// }