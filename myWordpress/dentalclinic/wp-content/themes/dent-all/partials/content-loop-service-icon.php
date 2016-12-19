<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="service_wr">
		<div class="post_icon">
			<i class="<?php echo get_post_meta( get_the_ID(), 'icon', true ); ?>"></i>
		</div>
		<div class="post_info">
			<h5><?php the_title(); ?></h5>
			<?php the_excerpt(); ?>
		</div>
		<a class="link" href="<?php the_permalink(); ?>"></a>
	</div>

</article> <!-- #post-## -->