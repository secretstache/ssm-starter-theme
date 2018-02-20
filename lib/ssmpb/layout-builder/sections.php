<?php

if (!post_password_required()) {

    if (have_rows('sections')) {

        global $tpl_args;

        $cols_cb_i = 0;

        while (have_rows('sections')) {
            the_row();

            $cb_i = get_row_index();

            $tpl_args['cb_i'] = $cb_i;
            $tpl_args['cols_cb_i'] = $cols_cb_i;

            $layout = get_row_layout();

            switch ($layout) {

                case 'columns':
                    hm_get_template_part(SSMPB_DIR . 'layout-builder/sections/columns-section.php', $tpl_args);
                    $cols_cb_i++;
                    break;

                case 'related_content':
                    hm_get_template_part(SSMPB_DIR . 'layout-builder/sections/related-content-section.php', $tpl_args);
                    break;

                case 'block_grid':
                    hm_get_template_part(SSMPB_DIR . 'layout-builder/sections/block-grid-section.php', $tpl_args);
                    break;

                case 'podcast':
                    hm_get_template_part(SSMPB_DIR . 'layout-builder/sections/podcast-section.php', $tpl_args);
                    break;

            }

        }

    }

}