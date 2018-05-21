<?php

if ( !post_password_required() ) {

	global $tpl_args;

	$style = get_inline_styles( 'hero_unit' );
	$cols = ssm_get_field( 'hero_unit_columns' );

	if ( $cols[0]['components'] != NULL ) {

	echo '<section' . hero_unit_id_classes() . $style . '>';

		the_video_background( 'hero_unit' );
		the_columns( 'hero_unit', $tpl_args );

	echo '</section>';

	} else {

		get_template_part( 'templates/page', 'header' );

	}

}