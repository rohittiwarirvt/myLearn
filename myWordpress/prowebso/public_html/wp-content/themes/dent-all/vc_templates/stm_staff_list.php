<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$css_class .= ' ' . $style;
if ( $style == 'grid' ) {
	$css_class .= ' cols_' . $per_row;
}
$testimonials = new WP_Query( array( 'post_type' => 'stm_staff', 'posts_per_page' => $count ) );

?>

<?php if ( $testimonials->have_posts() ) { ?>

	<div class="staff_list<?php echo esc_attr( $css_class ); ?>">
		<ul>
			<?php while ( $testimonials->have_posts() ): $testimonials->the_post(); ?>
				<li>
					<div class="staff clearfix">
						<div class="staff_left">
							<div class="staff_image_wr">
								<div class="staff_image">
									<?php if ( $style == 'grid' ): ?>
										<a class="fancy" href="#staff_popup_<?php the_ID(); ?>"><?php the_post_thumbnail( 'stm_thumb-175x175' ); ?></a>
									<?php else: ?>
										<?php the_post_thumbnail( 'stm_thumb-175x175' ); ?>
									<?php endif; ?>
								</div>
								<div class="staff_name"><?php the_title(); ?></div>
								<?php if ( $position = get_post_meta( get_the_ID(), 'position', true ) ): ?>
									<div class="staff_position"><?php echo esc_html( $position ); ?></div>
								<?php endif; ?>
							</div>
							<?php
							$email    = get_post_meta( get_the_ID(), 'email', true );
							$facebook = get_post_meta( get_the_ID(), 'facebook', true );
							$twitter  = get_post_meta( get_the_ID(), 'twitter', true );
							?>
							<?php if ( $email || $facebook || $twitter ): ?>
								<div class="staff_socials">
									<?php if ( $email ): ?>
										<a href="mailto:<?php echo antispambot( $email ); ?>"><i class="fa fa-envelope-o"></i></a>
									<?php endif; ?>
									<?php if ( $facebook ): ?>
										<a href="<?php echo esc_url( $facebook ); ?>"><i class="fa fa-facebook"></i></a>
									<?php endif; ?>
									<?php if ( $twitter ): ?>
										<a href="<?php echo esc_url( $twitter ); ?>"><i class="fa fa-twitter"></i></a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
						<?php if ( $style != 'grid' ): ?>
							<div class="staff_right">
								<?php the_excerpt(); ?>
								<div class="full_text">
									<?php the_content(); ?>
								</div>
								<a href="#" class="button staff_read_more bordered"><?php esc_html_e( 'Read More', 'dent-all' ); ?></a>
							</div>
						<?php endif; ?>
					</div>
					<?php if ( $style == 'grid' ): ?>
						<div class="hidden_element" id="staff_popup_<?php the_ID(); ?>">
							<div class="staff_popup">
								<div class="staff_header clearfix">
									<div class="staff_image_wr">
										<div class="staff_image">
											<?php the_post_thumbnail( 'stm_thumb-175x175' ); ?>
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
					<?php endif; ?>
				</li>
			<?php endwhile;
			wp_reset_postdata(); ?>
		</ul>

	</div>

<?php } ?>