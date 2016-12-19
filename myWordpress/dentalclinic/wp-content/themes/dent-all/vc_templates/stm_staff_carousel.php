<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class    = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$testimonials = new WP_Query( array( 'post_type' => 'stm_staff', 'posts_per_page' => $count ) );

wp_enqueue_script( 'stm_slick.min.js' );
wp_enqueue_style( 'stm_slick.css' );
$id = rand();

?>

<?php if ( $testimonials->have_posts() ) { ?>

	<div class="staff_carousel<?php echo esc_attr( $css_class ); ?>">
		<?php if ( $title ): ?>
			<h2<?php echo ( $title_color ) ? ' style="color: ' . esc_attr( $title_color ) . '"' : ''; ?>><?php echo esc_html( $title ); ?></h2>
		<?php endif; ?>

		<div class="slick_nav <?php echo esc_attr( $nav_style ); ?>">
			<div class="slick_prev" id="staff_carousel-<?php echo esc_attr( $id ) ?>-prev"><i class="stm-icon-chevron-left"></i></div>
			<div class="slick_next" id="staff_carousel-<?php echo esc_attr( $id ) ?>-next"><i class="stm-icon-chevron-right"></i></div>
		</div>

		<div id="staff_carousel-<?php echo esc_attr( $id ) ?>">
			<?php while ( $testimonials->have_posts() ):
				$testimonials->the_post(); ?>
				<div>
					<?php if ( has_post_thumbnail() ): ?>
						<div class="staff_image">
							<a href="#staff_popup_<?php the_ID(); ?>" class="fancy">
								<?php the_post_thumbnail( 'full' ); ?>
							</a>
						</div>
					<?php endif; ?>
					<div<?php echo ( $text_color ) ? ' style="color: ' . esc_attr( $text_color ) . '"' : ''; ?> class="staff_name h4"><?php the_title(); ?></div>
					<?php if ( $position = get_post_meta( get_the_ID(), 'position', true ) ): ?>
						<div<?php echo ( $text_color ) ? ' style="color: ' . esc_attr( $text_color ) . '"' : ''; ?> class="staff_position"><?php echo esc_html( $position ); ?></div>
					<?php endif; ?>
					<div class="hidden_element" id="staff_popup_<?php the_ID(); ?>">
						<div class="staff_popup">
							<div class="staff_header clearfix">
								<div class="staff_image_wr">
									<div class="staff_image">
										<?php the_post_thumbnail( 'stm_thumb-275x275' ); ?>
									</div>
								</div>
								<div class="staff_info">
									<div class="staff_name"><?php the_title(); ?></div>
									<?php if ( $position = get_post_meta( get_the_ID(), 'position', true ) ): ?>
										<div class="staff_position"><?php echo esc_html( $position ); ?></div>
									<?php endif; ?>
								</div>
								<?php
								$soc = 0;
								if ( $email = get_post_meta( get_the_ID(), 'email', true ) ) {
									$soc ++;
								}
								if ( $facebook = get_post_meta( get_the_ID(), 'facebook', true ) ) {
									$soc ++;
								}
								if ( $twitter = get_post_meta( get_the_ID(), 'twitter', true ) ) {
									$soc ++;
								}
								?>
								<?php if ( $email || $facebook || $twitter ): ?>
									<div class="staff_socials soc_<?php echo esc_attr( $soc ); ?>">
										<?php if ( $email ): ?>
											<a href="mailto:<?php echo antispambot( $email ); ?>">
												<i class="fa fa-envelope-o"></i>
											</a>
										<?php endif; ?>
										<?php if ( $facebook ): ?>
											<a href="<?php echo esc_url( $facebook ); ?>">
												<i class="fa fa-facebook"></i>
											</a>
										<?php endif; ?>
										<?php if ( $twitter ): ?>
											<a href="<?php echo esc_url( $twitter ); ?>">
												<i class="fa fa-twitter"></i>
											</a>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
							<div class="staff_text">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile;
			wp_reset_postdata(); ?>

		</div>

	</div>

	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			"use strict";
			var slick_<?php echo esc_js( $id ) ?> = $("#staff_carousel-<?php echo esc_js( $id ) ?>");
			var breakpoint_tablet = 769;
			var breakpoint_mobile = 479;
			slick_<?php echo esc_js( $id ) ?>.slick({
				dots: false,
				infinite: true,
				arrows: false,
				slidesToShow: <?php echo esc_js( $staff_to_show ); ?>,
				responsive: [
					{
						breakpoint: breakpoint_tablet,
						settings: {
							slidesToShow: <?php echo esc_js( $staff_to_show_tablet ); ?>,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: breakpoint_mobile,
						settings: {
							slidesToShow: <?php echo esc_js( $staff_to_show_mobile ); ?>,
							slidesToScroll: 1
						}
					}
				]
			});
			$("#staff_carousel-<?php echo esc_js( $id ) ?>-next").on('click',function () {
				slick_<?php echo esc_js( $id ) ?>.slick('slickNext');
			});
			$("#staff_carousel-<?php echo esc_attr( $id ) ?>-prev").on('click',function () {
				slick_<?php echo esc_js( $id ) ?>.slick('slickPrev');
			});
		});
	</script>

<?php } ?>