<?php

$c_classes = 'hero-header';
$subheadline = get_component_field('hero_subheadline');

if ( get_component_field('use_page_title_for_headline') == FALSE && get_component_field('custom_hero_headline') ) {
		$headline = get_component_field('custom_hero_headline');
	} elseif ( get_component_field('use_page_title_for_headline') == TRUE ) {
		$headline = get_the_title();
	}

if ( $subheadline && $headline == NULL ) {
	$class = 'headline';
} else {
	$class = 'subheadline';
}

echo '<header' . component_id_classes( $c_classes ) . '>';

	if ( $headline ) {

		echo '<h1 class="headline">' . $headline . '</h1>';

	}

	if ( $subheadline ) {
			echo '<h2 class="' . $class . '">' . $subheadline . '</h2>';
	}

echo '</header>';