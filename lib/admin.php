<?php

add_action('admin_init', 'ssm_remove_post_type_support');
/**
*  Remove Editor Support on Pages (Replaced with SSMPB)
*/
function ssm_remove_post_type_support() {
  remove_post_type_support( 'page', 'editor' );
}

add_action( 'admin_init', 'remove_dashboard_meta' );
/**
 *  Remove default dashboards
 */
function remove_dashboard_meta() {
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
  remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'normal' );
  remove_meta_box( 'wpe_dify_news_feed', 'dashboard', 'normal' );
	remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' );
	remove_meta_box( 'ssm_main_dashboard_widget', 'dashboard', 'normal' );
}

// Remove default welcome panel
// remove_action( 'welcome_panel', 'wp_welcome_panel' );

// add_action( 'welcome_panel', 'ssm_welcome_panel' );
/**
 * Create Custom Welcome Panel
 */
function ssm_welcome_panel() {
	get_template_part('templates/welcome-panel');
}


add_filter( 'wpseo_metabox_prio', 'ssm_filter_yoast_seo_metabox' );
/**
 * Filter Yoast SEO Metabox Priority
 */
function ssm_filter_yoast_seo_metabox() {
  return 'low';
}

add_action( 'admin_menu', 'ssm_admin_menu' );
/**
 *  Add SSM menu item
 */
function ssm_admin_menu() {
  add_menu_page(
    __( 'Secret Stache', 'ssm' ), // page_title
    'Secret Stache', // menu_title
    'manage_options', // capability
    'ssm', // menu_slug
    '', // function
    'dashicons-layout', // icon
    5 // position
  );
}

add_action( 'init', 'ssm_move_cpts_to_admin_menu', 25 );
/**
 *  Move various menu items into LIB menu
 */
function ssm_move_cpts_to_admin_menu() {

  global $wp_post_types;

  if ( post_type_exists('insert_cpt') ) {
    $wp_post_types['insert_cpt']->show_in_menu = 'ssm';
  }

}

add_filter( 'admin_body_class', 'is_front_admin_body_class' );
/**
 *  Filter the admin body classes if is_front
 */
function is_front_admin_body_class( $classes ) {

  global $post;

  $current_id = $post->ID;
  $front_page_id = get_option( 'page_on_front' );

  if ( $current_id == $front_page_id ) {
    return $classes = 'is-front';
  }

}

add_action( 'wp_ajax_get_width_values', 'get_width_values' ); 
add_action( 'wp_ajax_nopriv_get_width_values', 'get_width_values' );

add_action( 'save_post', 'update_width_post_meta', 10, 3 );

function update_width_post_meta( $post_ID, $post, $update ) {

  if ( isset( $_POST['columns_count'] ) ) {
  
    for ( $i = 0; $i < $_POST['columns_count']; $i++ ) { 

      if ( get_post_meta( $_POST['post_ID'], 'columns_width_' . $i ) ) {
        update_post_meta( $_POST['post_ID'], 'columns_width_' . $i, $_POST['columns_width_' . $i] );
      } else {
        add_post_meta( $_POST['post_ID'], 'columns_width_' . $i, $_POST['columns_width_' . $i] );       
      }

    }
  }
}

function get_width_values() {

  $response = array();

  for ( $i = 0; $i < $_POST['columns_count']; $i++ ) { 
    array_push( $response, get_post_meta( $_POST['page_id'], 'columns_width_' . $i, true ) );
  }

  echo json_encode( $response );
  wp_die();
}