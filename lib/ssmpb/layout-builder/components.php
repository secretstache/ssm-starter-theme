<?php

if ( have_rows('components') ) {
	
	global $c_i;
	global $tpl_args;

	$c_i = 1;

	while ( have_rows('components') ) {
		the_row();

		$tpl_args['component_position'] = $c_i;
		$layout = get_row_layout();

		switch ( $layout ) {
				
			case 'header' : 
			hm_get_template_part( SSMPB_DIR . 'layout-builder/components/header-component.php', $tpl_args);
			break;
			
			case 'hero_header' :
			hm_get_template_part( SSMPB_DIR . 'layout-builder/components/hero-header-component.php', $tpl_args);
			break;

			case 'text_editor' :
			hm_get_template_part( SSMPB_DIR . 'layout-builder/components/text-editor-component.php', $tpl_args);
			break;

			case 'image' :
			hm_get_template_part( SSMPB_DIR . 'layout-builder/components/image-component.php', $tpl_args);
			break;

			case 'video' :
			hm_get_template_part( SSMPB_DIR . 'layout-builder/components/video-component.php', $tpl_args);
			break;

			case 'form' :
			hm_get_template_part( SSMPB_DIR . 'layout-builder/components/form-component.php', $tpl_args);
			break;

			case 'buttons' :
			hm_get_template_part( SSMPB_DIR . 'layout-builder/components/buttons-component.php', $tpl_args);
			break;

			case 'business_information' :
			hm_get_template_part( SSMPB_DIR . 'layout-builder/components/business-information-component.php', $tpl_args);
			break;

		}

		$c_i++;

	}
}