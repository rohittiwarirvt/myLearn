<?php get_header(); ?>

<div class="content_wrapper">
	<?php
	while ( have_posts() ) : the_post();

		get_template_part( 'partials/content', 'page' );

	endwhile;
	?>
</div>

<?php get_footer(); ?>
