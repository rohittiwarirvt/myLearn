<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ): ?>
		<div class="post_thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php
				if ( is_sticky() ) {
					the_post_thumbnail( 'stm_thumb-825x550' );
				} else {
					the_post_thumbnail( 'stm_thumb-825x360' );
				}
				?>
			</a>
		</div>
	<?php endif; ?>
	<div class="post_bottom">
		<div class="post_details">
			<?php echo stm_get_post_categories( get_the_ID() ); ?>
			<div class="post_date"><?php echo get_the_date(); ?></div>
			<div class="comments_num">
				<a href="<?php echo esc_url( get_comments_link() ); ?>"><i class="stm-icon-comments"></i>
					<span><?php echo comments_number( 0, 1, '%' ); ?></span>
				</a>
			</div>
			<div class="post_author"><i class="stm-icon-user"></i> <span><?php the_author(); ?></span></div>
		</div>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

		<div class="post_content">
			<?php the_excerpt(); ?>
		</div>
	</div>

</article> <!-- #post-## -->