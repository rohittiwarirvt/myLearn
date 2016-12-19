<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class    = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$testimonials = new WP_Query( array( 'post_type' => 'stm_testimonial', 'posts_per_page' => $count ) );

wp_enqueue_script( 'stm_slick.min.js' );
wp_enqueue_style( 'stm_slick.css' );
$id = rand();

?>

<?php if ( $testimonials->have_posts() ) { ?>

	<div class="testimonials_carousel<?php echo esc_attr( $css_class ); ?>">
		<?php if ( $title ): ?>
			<h2<?php echo ( $title_color ) ? ' style="color: ' . esc_attr( $title_color ) . '"' : ''; ?>><?php echo esc_html( $title ); ?></h2>
		<?php endif; ?>

		<div class="slick_nav <?php echo esc_attr( $nav_style ); ?>">
			<div class="slick_prev" id="testimonials_carousel-<?php echo esc_attr( $id ) ?>-prev"><i class="stm-icon-chevron-left"></i></div>
			<div class="slick_next" id="testimonials_carousel-<?php echo esc_attr( $id ) ?>-next"><i class="stm-icon-chevron-right"></i></div>
		</div>

		<div id="testimonials_carousel-<?php echo esc_attr( $id ) ?>">
			<?php while ( $testimonials->have_posts() ):
				$testimonials->the_post(); ?>
				<div>
					<div class="testimonial_wr">
						<div class="testimonial_text additional_font">
							<?php the_excerpt(); ?>
						</div>
						<div class="testimonial_author"><?php the_title(); ?></div>
						<?php if ( $position = get_post_meta( get_the_ID(), 'position', true ) ): ?>
							<div class="testimonial_position"><?php echo esc_html( $position ); ?></div>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile;
			wp_reset_postdata(); ?>

		</div>

	</div>

	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			"use strict";
			var slick_<?php echo esc_js( $id ) ?> = $("#testimonials_carousel-<?php echo esc_js( $id ) ?>");
			slick_<?php echo esc_js( $id ) ?>.slick({
				dots: false,
				infinite: true,
				arrows: false,
				slidesToShow: <?php echo esc_js( $testimonials_to_show ); ?>,
				responsive: [
					{
						breakpoint: 769,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 479,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
			$("#testimonials_carousel-<?php echo esc_attr( $id ) ?>-next").on('click',function () {
				slick_<?php echo esc_js( $id ) ?>.slick('slickNext');
			});
			$("#testimonials_carousel-<?php echo esc_attr( $id ) ?>-prev").on('click',function () {
				slick_<?php echo esc_js( $id ) ?>.slick('slickPrev');
			});
		});
	</script>

<?php } ?>