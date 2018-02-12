<?php

global $tpl_args;

$component_position = $tpl_args[ 'component_position' ];
$column_count = $tpl_args[ 'column_count' ];

if ( $column_count == 1 && $component_position == 1 ) {
  $headline_tag_open = '<h2 class="headline">';
  $headline_tag_close = '</h2>';
  $subheadline_tag_open = '<h3 class="subheadline">';
  $subheadline_tag_close = '</h3>';
} else {
  $headline_tag_open = '<h3 class="headline">';
  $headline_tag_close = '</h3>';
  $subheadline_tag_open = '<h4 class="subheadline">';
  $subheadline_tag_close = '</h4>';
}

echo '<header' . component_id_classes( $c_classes ) . '>';

  if ( $headline = get_component_field('headline') ) {

    echo $headline_tag_open . $headline . $headline_tag_close;

  }

  if ( $subheadline = get_component_field('subheadline') ) {

    echo $subheadline_tag_open . $subheadline . $subheadline_tag_close;

  }

echo '</header>';