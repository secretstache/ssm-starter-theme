<?php

if ( ! post_password_required() ) {

  if ( have_rows('sections') ) {

		$s_i = 1;
    global $tpl_args;

    while ( have_rows('sections') ) {
			the_row();

			$tpl_args['section_position'] = $s_i;
			$layout = get_row_layout();

			switch( $layout ) {

				case 'columns' :
				hm_get_template_part( SSMPB_DIR . 'layout-builder/sections/columns-section.php', $tpl_args);
				break;

				case 'related_content' : 
				hm_get_template_part( SSMPB_DIR . 'layout-builder/sections/related-content-section.php', $tpl_args);
				break;

				case 'block_grid' : 
				hm_get_template_part( SSMPB_DIR . 'layout-builder/sections/block-grid-section.php', $tpl_args);
				break;

			}

			$s_i++;
			
		}
	
	}

}