<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class    = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$testimonials = new WP_Query( array( 'post_type' => 'stm_testimonial', 'posts_per_page' => $testimonials_per_page ) );

?>

<?php if ( $testimonials->have_posts() ) { ?>
	<div class="testimonials<?php echo esc_attr( $css_class ); ?>">
		<ul class="<?php echo esc_attr( 'cols_' . $testimonials_per_row ); ?>">

			<?php while ( $testimonials->have_posts() ):
				$testimonials->the_post(); ?>
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
			<?php endwhile; wp_reset_postdata(); ?>

		</ul>

		<?php if ( $testimonials->found_posts > $testimonials_per_page ): ?>
			<div class="load_more_posts">
				<a class="button bordered" onclick="load_testimonials(jQuery(this), <?php echo esc_js( $testimonials_per_page ); ?>, <?php echo esc_js( $testimonials_per_page ); ?>); return false;" href="#"><?php esc_html_e( 'Load more', 'dent-all' ); ?> </a>
				<i class="fa fa-spinner"></i>
			</div>
		<?php endif; ?>

	</div>

<?php } ?>