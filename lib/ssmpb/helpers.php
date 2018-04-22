<?php

function the_columns($context = 'section', $tpl_args)
{
		global $post;
		global $tpl_args;

		$cols_cb_i = $tpl_args['cols_cb_i'];

    if (FIELD_LIBRARY == 'ACF') {

        $page_id = $post->ID;

        $cols = '';
        $alignment = '';

        if ($context == 'hero_unit') {
            $cols = get_field($context . '_columns');
            // this seems unecessary ** check how ACF clone is rendering different in Hero Unit
						$alignment_array = get_field('hero_unit_column_alignment');
				
            if ($alignment_array['y_alignment'] != 'top') {
                $y_alignment = ' align-' . $alignment_array['y_alignment'];
            }
            $x_alignment = ' align-center';

        } elseif ($context == 'section') {
            $cols = get_sub_field($context . '_columns');
            if (get_sub_field('y_alignment') != 'top') {
                $y_alignment = ' align-' . get_sub_field('y_alignment');
            }
            $x_alignment = ' align-' . get_sub_field('x_alignment');
        }

        $count = count($cols);

        // first Content Block - columns_width_0, second Content Block - columns_width_1 ...
        $columns_width = get_post_meta($page_id, 'columns_width_' . $cols_cb_i, true);

        $width_array = explode('_', $columns_width);
        $pluck = 0;

        $tpl_args['column_count'] = $count;
        $tpl_args['context'] = $context;

        if (have_rows($context . '_columns')) {

            echo '<div class="grid-container">';
            echo '<div class="main grid-x grid-margin-x' . $x_alignment . $y_alignment . ' has-' . $count . '-cols">';
            while (have_rows($context . '_columns')) {
                the_row();

                if ($context == 'hero_unit') {
                    $width = 12 / $count;
                } elseif ($context == 'section') {
                    if ($columns_width != null) {
                        $width = $width_array[$pluck];
                    } else {
                        $width = 12 / $count;
                    }
                }

                $tpl_args['column_width'] = $width;

                echo '<div class="cell small-11 medium-' . $width . ' i-' . get_row_index() . '">';

                echo '<div class="inner">';

                the_components($tpl_args);

                echo '</div>';

                echo '</div>';

                $pluck++;
            }
            echo '</div>';
            echo '</div>';
        }

    } elseif (FIELD_LIBRARY == 'Carbon') {

        // TODO

    }

}

function the_components( $tpl_args = '' ) {

	hm_get_template_part( SSMPB_DIR . 'layout-builder/components.php', $tpl_args );

}

function get_component_field( $field ) {

	if ( FIELD_LIBRARY == 'ACF' ) {

		return get_sub_field( $field );

	} elseif ( FIELD_LIBRARY == 'Carbon' ) {

		// TODO

	}

}

function the_component_field( $field ) {
	echo get_component_field( $field );
}

function the_layout_builder( $tpl_args = '' ) {
	hm_get_template_part( SSMPB_DIR . 'layout-builder/sections.php', $tpl_args );
}

function the_section_header() {

  global $tpl_args;

  $include_header = get_sub_field('include_section_header');
  $headline = get_sub_field('section_headline');
  $subheadline = get_sub_field('section_subheadline');

  $headline_tag_open = '<h2 class="headline">';
  $headline_tag_close = '</h2>';
  $subheadline_tag_open = '<h3 class="subheadline">';
  $subheadline_tag_close = '</h3>';

  if ( $include_header == TRUE ) {

    $html = '<div class="grid-container">';
    $html .= '<div class="grid-x grid-x-margin align-center">';
        $html .= '<div class="cell small-12 medium-10">';
          $html .= '<header class="component section-header align-center">';
            if ( $headline ) {
              $html .= $headline_tag_open . $headline . $headline_tag_close;
            }
            if ( $subheadline ) {
              $html .= $subheadline_tag_open . $subheadline . $subheadline_tag_close;
            }
          $html .= '</header>';
        $html .= '</div>';
      $html .= '</div>';
    $html .= '</div>';

    echo $html;

  }

}

function hero_unit_id_classes( $h_classes = '' ) {

  $inline_classes = get_field('html_classes');

  $hero_unit_id_classes = '';

  if ( $html_id = get_field('html_id') ) {
    $html_id = sanitize_html_class(strtolower($html_id));
    $hero_unit_id_classes .= ' id="' . $html_id . '" class="hero-unit';
  } else {
    $hero_unit_id_classes .= ' class="hero-unit';
  }

  if ( get_field('background_options') == 'Color' ) {
    $hero_unit_id_classes .= ' ' . sanitize_html_class( get_field('background_color') );
  }

  if ( get_field('background_options') == 'Image' ) {
    $hero_unit_id_classes .= ' bg-image bg-dark';
  }

  if ( get_field('background_options') == 'Video' ) {
    $hero_unit_id_classes .= ' bg-video';
  }

  if ( get_field('hero_unit_height') == 'full' ) {
    $hero_unit_id_classes .= ' full-height';
  } elseif ( get_field('hero_unit_height') == 'auto' ) {
    $hero_unit_id_classes .= ' auto';
  }

  if ( $h_classes != NULL ) {
    $h_classes = \SSMCore\Helpers\sanitize_html_classes($s_classes);
    $hero_unit_id_classes .= ' ' . $h_classes;

  }

  if ( $inline_classes != NULL ) {
    $hero_unit_id_classes .= ' ' . $inline_classes;
  }

  $hero_unit_id_classes .= '"';

  return $hero_unit_id_classes;

}

function section_id_classes( $s_classes = '' ) {

  $inline_classes = get_sub_field('html_classes');
  $section_id_classes = '';

  if ( $html_id = get_sub_field('html_id') ) {
    $html_id = sanitize_html_class(strtolower($html_id));
    $section_id_classes .= ' id="' . $html_id . '" class="content-block';
  } else {
    $section_id_classes .= ' class="content-block';
  }

  if ( get_sub_field('background_options') == 'Color' ) {
    $section_id_classes .= ' ' . sanitize_html_class( get_sub_field('background_color') );

  }

  if ( get_sub_field('background_options') == 'Image' ) {
    $section_id_classes .= ' bg-image bg-dark';

  }

  if ( get_sub_field('background_options') == 'Video' ) {
    $section_id_classes .= ' bg-video bg-dark';
  }

  if ( $s_classes != NULL ) {
    $s_classes = \SSMCore\Helpers\sanitize_html_classes($s_classes);
    $section_id_classes .= ' ' . $s_classes;

  }

  if ( $inline_classes != NULL ) {
    $section_id_classes .= ' ' . $inline_classes;
  }

  $section_id_classes .= '"';

  return $section_id_classes;

}

function component_id_classes( $c_classes = '' ) {

  global $c_i;
  $even_odd = 0 == $c_i % 2 ? 'even' : 'odd';
  $inline_classes = get_component_field('html_classes');
  $component_id_classes = '';

  if ( $html_id = get_component_field('html_id') ) {
    $html_id = sanitize_html_class(strtolower($html_id));
    $component_id_classes .= ' id="' . $html_id . '" class="component stack-order-' . $c_i . ' stack-order-' . $even_odd;
  } else {
    $component_id_classes .= ' class="component stack-order-' . $c_i . ' stack-order-' . $even_odd;
  }

  if ( $alignment = get_component_field('alignment') ) {
    $component_id_classes .= ' ' . sanitize_html_class( $alignment );
  }

  if ( $c_classes != NULL ) {
    $c_classes = \SSMCore\Helpers\sanitize_html_classes($c_classes);
    $component_id_classes .= ' ' . $c_classes;

  }

  if ( $inline_classes != NULL ) {
    $component_id_classes .= ' ' . $inline_classes;
  }

  $component_id_classes .= '"';

  return $component_id_classes;

}

// function column_id_classes( $col_classes = '' ) {

//   $inline_classes = get_sub_field('html_classes');

//   $column_id_classes = '';

//   if ( $html_id = get_sub_field('html_id') ) {
//     $html_id = sanitize_html_class(strtolower($html_id));
//     $column_id_classes .= ' id="' . $html_id . '" class="inner';
//   } else {
//     $column_id_classes .= ' class="inner';
//   }

//   if ( $col_classes != NULL ) {
//       $col_classes = \SSMCore\Helpers\sanitize_html_classes($col_classes);
//       $column_id_classes .= ' ' . $col_classes;

//   }

//   if ( $inline_classes != NULL ) {
//       $column_id_classes .= ' ' . $inline_classes;
//   }

//   $column_id_classes .= '"';

//   return $column_id_classes;

// }

// function do_column( $template_args = array() ) {

//   echo '<div' . column_id_classes( $col_classes ) . '>';

//     hm_get_template_part( SSMPB_DIR . 'page-builder/components.php', $template_args );

//   echo '</div>';

// }

/**
 * Like get_template_part() but lets you pass args to the template file
 * Args are available in the tempalte as $template_args array
 * @param string filepart
 * @param mixed wp_args style argument list
 */
function hm_get_template_part($file, $template_args = array(), $cache_args = array())
{
    $template_args = wp_parse_args($template_args);
    $cache_args = wp_parse_args($cache_args);
    if ($cache_args) {
        foreach ($template_args as $key => $value) {
            if (is_scalar($value) || is_array($value)) {
                $cache_args[$key] = $value;
            } else if (is_object($value) && method_exists($value, 'get_id')) {
                $cache_args[$key] = call_user_func('get_id', $value);
            }
        }
        if (($cache = wp_cache_get($file, serialize($cache_args))) !== false) {
            if (!empty($template_args['return'])) {
                return $cache;
            }

            echo $cache;
            return;
        }
    }
    $file_handle = $file;
    do_action('start_operation', 'hm_template_part::' . $file_handle);
    if (file_exists(get_stylesheet_directory() . '/' . $file . '.php')) {
        $file = get_stylesheet_directory() . '/' . $file . '.php';
    } elseif (file_exists(get_template_directory() . '/' . $file . '.php')) {
        $file = get_template_directory() . '/' . $file . '.php';
    }

    ob_start();
    $return = require $file;
    $data = ob_get_clean();
    do_action('end_operation', 'hm_template_part::' . $file_handle);
    if ($cache_args) {
        wp_cache_set($file, $data, serialize($cache_args), 3600);
    }
    if (!empty($template_args['return'])) {
        if ($return === false) {
            return false;
        } else {
            return $data;
        }
    }

    echo $data;
}

add_action('wp_head', 'do_inline_css', 99);
/**
 * Injects inline CSS into the head
 * @since 1.0.0
 */
function do_inline_css() {

  global $post;
  $styles = array();

  if ( $global_styles = ssm_get_field('global_inline_styles', 'options') ) {
    $styles[] = $global_styles;
  }

  if ( $page_styles = ssm_get_field('page_inline_styles') ) {
    $styles[] = $page_styles;
  }

  foreach ( $styles as $style ) :
    $output .= $style;
  endforeach;

  if ( $output != '' ) {
    echo '<style id="inline-css">' . $output . '</style>';
  }

}

add_action('admin_notices', 'ssmpb_notices');
/**
 * Conditionally shows message if URL contains ssmpb=save_reminder
 * @since 1.0.0
 */
function ssmpb_notices()
{
    if (isset($_GET["ssmpb"]) && trim($_GET["ssmpb"]) == 'save_reminder') {

        global $post;

        $post_type = get_post_type();

        echo '<div class="notice notice-warning is-dismissible">';
        echo '<p>After you save this new ' . $post_type . ' item, you will need to reload the last page to retreive it.</p>';
        echo '</div>';

    }
}

function get_inline_styles($context = 'section')
{

    $image = '';
    $style = '';

    if ($context == 'hero_unit') {
        if (get_field('background_options') == 'Image' && get_field('background_image') != null) {
            $image = get_field('background_image');
            $style = ' style="background-image: url(' . $image['url'] . ')"';
        }
    } else {
        if (get_sub_field('background_options') == 'Image' && get_sub_field('background_image') != null) {
            $image = get_sub_field('background_image');
            $style = ' style="background-image: url(' . $image['url'] . ')"';
        }
    }

    return $style;

}

function the_video_background($context = 'section') {
	
	$html = '';

	if ( $context == 'hero_unit' ) {
		if ( get_field('background_options') == 'Video' && get_field('background_video') != null ) {
			$video = get_field('background_video');
			$html = '<div class="hero-video">';
			$html .= '<video autoplay loop>';
			$html .= '<source src="' . $video['url'] . '" type="video/mp4">';
			$html .= '</video>';
			$html .= '</div>';
			$html .= '<div class="overlay"></div>';
		}
	} else {
		if ( get_sub_field('background_options') == 'Video' && get_sub_field('background_video') != null ) {
			$video = get_fsub_ield('background_video');
			$html = '<div class="hero-video">';
			$html .= '<video autoplay loop>';
			$html .= '<source src="' . $video['url'] . '" type="video/mp4">';
			$html .= '</video>';
			$html .= '</div>';
			$html .= '<div class="overlay"></div>';
		}
	}

	if ( get_field('background_options') == 'Video' && get_field('background_video') != null || get_sub_field('background_options') == 'Video' && get_sub_field('background_video') != null ) {
		
	}

	echo $html;

}