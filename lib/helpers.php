<?php

/**
 * Field abstraction layer
 */
function ssm_get_field( $field_name, $options = FALSE, $post_id = '' ) {
    if ( FIELD_LIBRARY == 'ACF' ) {
        if ( $options == TRUE ) {
            return get_field( $field_name, 'options' );
        } else {
            return get_field( $field_name, $post_id );
        }
    } elseif ( FIELD_LIBRARY == 'Carbon' ) {
        if ( $options == TRUE ) {
            return carbon_get_theme_option( $field_name );
        } else {
            return carbon_get_the_post_meta( $field_name );
        }
    } else {
        return false;
    }
}

/**
 * Retrieve the brand logo
 */
function get_the_brand_logo( $link = true ) {
    $html = '';

    if ( $link == true ) {
        $html .= '<a href="' . home_url() . '">';
    }

    if ( $logo = ssm_get_field('brand_logo', 'options') ) {
        if ( $icon = ssm_get_field('brand_icon', 'options') ) {
        $html .= '<img src="' . $logo['url'] . '" alt="' . $logo['alt'] . '" class="logo show-for-medium">';
        $html .= '<img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '" class="icon hide-for-medium">';
        } else {
            $html .= '<img src="' . $logo['url'] . '" alt="' . $logo['alt'] . '" class="logo">';
        }
    } else {
        $html .= '<span class="site-title">' . get_bloginfo('name') . '</span>';
    }

    if ( $link == true ) {
        $html .= '</a>';
    }

    return $html;
}

/**
 * Echo the site logo
 */
function the_brand_logo( $link = true ) {
    echo get_the_brand_logo( $link );
}

/**
 * Retrieve the primary category
 */
function get_the_primary_category() {
    global $post;

    $id = get_the_ID();
    $cat_count = count( get_the_category( $id ) );

    if ( class_exists( 'WPSEO_Primary_Term' ) && $cat_count > 1 ) {
        $primary = new WPSEO_Primary_Term('category', $id);
        $primary_cat_id = $primary->get_primary_term();
        $primary_category = get_category( $primary_cat_id );
    } else {
        $categories = get_the_category();
        $primary_category = $categories[0];
    }

    return $primary_category;

}

/**
 * Check if query has multiple pages
 */
function has_multiple_pages() {
    global $wp_query;
    return ( $wp_query->max_num_pages > 1 );
}

/**
 * Retreive the menu arguments to pass to wp_nav_menu
 */
function get_menu_args( $context = 'primary' ) {
    
    $args = array();

    if ( $context == 'offcanvas') {
        $args = array( 
            'theme_location' => 'primary_navigation', 
            'container' => FALSE, 
            'items_wrap' => '<ul class="vertical menu">%3$s</ul>', 
            'walker' => new Foundation_Nav_Walker 
        );
    } elseif ( $context == 'primary' ) {
        $args = array( 
            'theme_location' => 'primary_navigation', 
            'container' => FALSE, 
            'items_wrap' => '<ul class="horizontal menu show-for-medium dropdown" data-dropdown-menu>%3$s</ul>', 
            'walker' => new Foundation_Nav_Walker 
        );
    }
    return $args;
}

/**
 * Retreive the hamburger button
 */
function get_the_hamburger_button( $context = 'offCanvas' ) {
    $html = '';

    $html .= '<button class="hamburger hide-for-medium" type="button" data-toggle="' . $context . '" aria-expanded="false" aria-controls="' . $context . '">';
        $html .= '<span class="hamburger-line hamburger-line1"></span>';
        $html .= '<span class="hamburger-line hamburger-line2"></span>';
        $html .= '<span class="hamburger-line hamburger-line3"></span>';
    $html .= '</button>';

    return $html;
}

/**
 * Echo the hamburger button
 */
function the_hamburger_button( $context = 'offCanvas' ) {
    echo get_the_hamburger_button( $context );
}

/**
 * Retrieve the close icon
 */
function get_the_close_icon( $class = 'editable' ) {
    return $icon = '<img src="' . get_stylesheet_directory_uri() . '/dist/images/x.svg" alt="Close" class="' . $class . '">';
}

/**
 * Echo the close icon
 */
function the_close_icon( $class = 'editable' ) {
    echo get_the_close_icon( $class );
}

/**
 * utility for prettier print_r
 */
function pprint_r( $q ) {
    echo '<pre>';
    print_r( $q );
    echo '</pre>';
}

/**
 * Control the number of words returned
 */
function limit_words($string, $word_limit, $ellipses = true) {
    
    $word_limit = (int) $word_limit;
  
    $string = preg_replace("/<img[^>]+\>/i", '', $string); 		
    $string = preg_replace("/<iframe[^>]+\>/i", '', $string);
    
    $string = strip_shortcodes( $string );
  
    $words = explode(' ', $string);
  
    if ( count($words) >= $word_limit ) {
      $excerpt = implode(' ', array_slice($words, 0, $word_limit));
      $excerpt .= ( $ellipses ) ? '<span class="elipses">...</span>' : '...';
    } else {
      $excerpt = implode(' ', $words);
    }
  
    return $excerpt;
    
}