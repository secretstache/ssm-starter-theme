<article <?php post_class(); ?>>
  <header class="component stack-order-1">
    <h2 class="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="component default">
    <?php the_excerpt(); ?>
  </div>
</article>
