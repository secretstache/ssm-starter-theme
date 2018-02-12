<?php

$c_classes = 'buttons';
$buttons = get_component_field( 'buttons' );

echo '<div' . component_id_classes( $c_classes ) . '>';

if ( $buttons ) {

  foreach( $buttons as $button ) {

    $target = $button['target'] == 'New Tab' ? '_blank' : '_self';

    echo '<a class="button" href="' . $button['url'] . '" target="' . $target . '">' . $button['label'] . '</a>';

  }

}

echo '</div>';