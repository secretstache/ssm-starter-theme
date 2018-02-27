<footer class="site-footer">
  <div class="grid-container">
		<?php if (has_nav_menu('footer_navigation')) {?>
			<div class="cell">
				<?php wp_nav_menu(array('menu' => 'footer_navigation', 'menu_class' => 'align-center menu'));?>
			</div>
		<?php }?>
    <?php if ($copyright = ssm_get_field('copyright', 'options')) {?>
    <div class="grid-x grid-margin-x">
      <div class="cell">
        <?php echo $copyright; ?>
      </div>
    </div>
    <?php }?>
  </div>
</footer>