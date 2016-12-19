<?php get_header(); ?>

	<div class="content_wrapper single_post">
		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'partials/content' );

		endwhile;
		?>
	</div>

<?php get_footer(); ?>