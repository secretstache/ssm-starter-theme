<?php

$c_classes = 'form';
$form = get_component_field( 'form' );

?>

<div<?php echo component_id_classes( $c_classes ); ?>>

  <?php gravity_form_enqueue_scripts( $form['id'], true ); ?>
  <?php gravity_form( $form['id'], false, false, false, '', true, 1 ); ?>

</div>