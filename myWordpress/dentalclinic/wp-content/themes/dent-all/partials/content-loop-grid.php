<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ): ?>
		<div class="post_thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php
				the_post_thumbnail( 'stm_thumb-350x210' );
				?>
			</a>
			<?php echo stm_get_post_categories( get_the_ID() ); ?>
		</div>
	<?php endif; ?>

	<div class="post_bottom">
		<div class="post_details">
			<div class="post_date">
				<strong><?php echo get_the_date( 'd' ); ?></strong><?php echo get_the_date( 'M' ); ?>
			</div>
			<div class="comments_num">
				<a href="<?php echo esc_url( get_comments_link() ); ?>">
					<i class="stm-icon-comments"></i><?php echo comments_number( 0, 1, '%' ); ?>
				</a>
			</div>
		</div>
		<div class="post_text">
			<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>

			<div class="post_content">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>

</article> <!-- #post-## -->