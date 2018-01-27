<?php if ( get_the_content() ) { ?>

	<section class="content-block">
		<div class="grid-container">
		<div class="grid-x grid-margin-x align-center">
			<div class="cell small-12 medium-10">
				<?php the_content(); ?>
			</div>
		</div>
		</div>
	</section>

<?php } ?>

<?php the_layout_builder(); ?>