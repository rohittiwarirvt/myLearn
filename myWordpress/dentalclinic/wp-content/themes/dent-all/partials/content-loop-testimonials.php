<li>
	<div class="testimonial_wr">
		<div class="testimonial_text additional_font">
			<?php the_excerpt(); ?>
		</div>
		<div class="testimonial_author"><?php the_title(); ?></div>
		<?php if ( $position = get_post_meta( get_the_ID(), 'position', true ) ): ?>
			<div class="testimonial_position"><?php echo esc_html( $position ); ?></div>
		<?php endif; ?>
	</div>
</li>