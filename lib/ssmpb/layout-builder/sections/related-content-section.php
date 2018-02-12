<?php

// Bail if section is set to inactive
if ( get_sub_field('status') == 0 )
  return;

global $tpl_args;
$s_classes = 'related-content';

$args = array(
	'post_type'   =>  'post',
	'status'    =>  'publish',
);

$query = new WP_Query( $args );
$style = get_inline_styles();

echo '<section' . section_id_classes( $s_classes ) . $style . '>';

	the_video_background();
	the_section_header();
	
	if ( $query->have_posts() ) {

		echo '<div class="grid-container">';
			echo '<div class="grid-x grid-margin-x main align-center">';

			while ( $query->have_posts() ) {
				$query->the_post();

				echo '<div class="cell small-11 medium-6">';
					get_template_part( 'templates/content' );
				echo '</div>';

			}

			echo '</div>';
		echo '</div>';

		wp_reset_postdata();

	}

echo '</section>';