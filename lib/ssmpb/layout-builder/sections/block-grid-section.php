<?php

// Bail if section is set to inactive
if ( get_sub_field('status') == 0 )
  return;

global $tpl_args;
$s_classes = 'block-grid';
$count = count( get_sub_field( 'block_grid_columns' ) );

if ( $count < 4 ) {
	$num = 3;
} elseif ( $count > 4 && $count < 8 ) {
	$num = round( $count / 2 ); 
} else {
	$num = 4;
}

$style = get_inline_styles();

echo '<section' . section_id_classes( $s_classes ) . $style . '>';

	the_video_background();
	the_section_header();
	
	if ( have_rows( 'block_grid_columns' ) ) {

		echo '<div class="grid-container">';
			echo '<div class="grid-x grid-margin-x main align-center small-up-1 medium-up-' . $num . '">';

			while( have_rows( 'block_grid_columns' ) ) {
				the_row();

				echo '<div class="cell">';
					the_components( $tpl_args );
				echo '</div>';

			}

			echo '</div>';
		echo '</div>';

	}

echo '</section>';