<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ): ?>
		<div class="post_thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php
				the_post_thumbnail( 'stm_thumb-350x210' );
				?>
			</a>
		</div>
	<?php endif; ?>

	<div class="post_bottom">
		<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
		<?php the_excerpt(); ?>
	</div>

</article> <!-- #post-## -->