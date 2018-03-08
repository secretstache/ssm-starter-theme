<?php

global $tpl_args;

$c_classes[] = 'video';
$iframe = get_component_field('video_link');

preg_match('/src="(.+?)"/', $iframe, $matches);

$src = $matches[1];
$params = array();

if ( strpos( $iframe, 'vimeo' ) !== false ) {

  $params = array(
    'byline'    => 0,
    'title'     => 0,
    'portrait'  => 0,
    'quality'   => '1080p',
  );

  $c_classes[] = 'vimeo';

} elseif ( strpos( $iframe, 'youtube' ) !== false ) {

  $params = array(
    'rel'             => 0,
    'showinfo'        => 0,
    'modestbranding'  => 1,
		'vq'              => 'highres',
  );

  $c_classes[] = 'youtube';

}

$new_src = add_query_arg($params, $src);
$video = str_replace($src, $new_src, $iframe);

?>

<div<?php echo component_id_classes( $c_classes ); ?>>

    <div class="embed-container widescreen">

    <?php echo $video; ?>

    </div>

</div>