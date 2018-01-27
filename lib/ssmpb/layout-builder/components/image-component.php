<?php

$c_classes = 'image';
$image = get_component_field('image');

?>

<div<?php echo component_id_classes( $c_classes ); ?>>

  <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

</div>