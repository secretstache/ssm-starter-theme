<?php

$alignment = 'justify';
$link = true;

if ( is_page_template('landing-page.php') ) {
  $alignment = 'center';
  $link = false;
}

?>

<?php if ( !is_page_template('landing-page.php') && has_nav_menu('primary_navigation') ) { ?>
  <div class="off-canvas right" id="offCanvas" data-toggler=".is-active">
    <?php wp_nav_menu( get_menu_args('offcanvas') ); ?>
    <button class="button off-canvas-close" data-toggle="offCanvas">
      <?php the_close_icon(); ?>
    </button>
  </div>
<?php } ?>

<header class="site-header">
  <div class="grid-container">
    <div class="grid-x grid-margin-x align-middle align-<?php echo $alignment; ?>">
      <div class="brand cell shrink">
        <?php the_brand_logo( $link ); ?>
      </div>

      <?php if ( !is_page_template('landing-page.php') && has_nav_menu('primary_navigation') ) { ?>
        <nav class="primary-navigation cell shrink">
          <?php wp_nav_menu( get_menu_args('primary') ); ?>
          <?php the_hamburger_button(); ?>
        </nav>
      <?php } ?>
      
    </div>    
  </div>
</header>