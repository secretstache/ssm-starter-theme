<?php

// Bail if section is set to inactive
if (get_sub_field('status') == 0) {
    return;
}

global $tpl_args;

// $cols_cb_i = $tpl_args['cols_cb_i'];

$style = get_inline_styles();

echo '<section' . section_id_classes() . $style . '>';

the_video_background();
the_section_header();
the_columns('section', $cols_cb_i);

echo '</section>';