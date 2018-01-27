<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
		
		<section class="hero-unit auto bg-grey-light">
			<div class="grid-container">
				<div class="grid-x grid-margin-x align-center">
					<div class="cell small-11 medium-12">
						<header class="component stack-order-1">
							<h1 class="headline"><?php the_title(); ?></h1>
							<?php get_template_part('templates/entry-meta'); ?>
						</header>
					</div>
				</div>
				</div>
		</section>

		<?php if ( get_the_content() ) { ?>

		<section class="content-block">
			<div class="grid-container">
				<div class="grid-x grid-margin-x align-center">
					<div class="cell small-11 medium-12">

					<?php the_content(); ?>

					</div>
				</div>
			</div>
		</section>

		<?php } ?>

		<?php the_layout_builder(); ?>

	</article>
<?php endwhile; ?>
