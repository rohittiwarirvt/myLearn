<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'stm_slick.min.js' );
wp_enqueue_style( 'stm_slick.css' );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$uni       = uniqid( 'js-slider-' . rand() );

$args = array( 'post_type' => 'stm_story', 'posts_per_page' => - 1 );

if ( $count ) {
	$args['posts_per_page'] = $count;
}

if ( $category != 'all' ) {
	$args['stm_story_category'] = $category;
}

$query = new WP_Query( $args );

if( ! $img_size ){
	$img_size = '250x223';
}

if ( $query->have_posts() ):
	?>
	<div class="slider slider_type_story recent-storys-carousel<?php echo esc_attr( $css_class ); ?>" id="<?php echo esc_attr( $uni ); ?>">

		<?php while ( $query->have_posts() ):

			$query->the_post();

			$photo_before_id = get_post_meta( get_the_ID(), 'story_photo_before', true );
			$photo_after_id  = get_post_meta( get_the_ID(), 'story_photo_after', true );

			$photo_before = wpb_getImageBySize( array(
				'attach_id'  => $photo_before_id,
				'thumb_size' => $img_size
			) );

			$photo_after = wpb_getImageBySize( array(
				'attach_id'  => $photo_after_id,
				'thumb_size' => $img_size
			) );

			?>

			<div class="slider-item story-carousel-item">
				<div class="story story_type_slider">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="story-images">
								<div class="story-images-inner">
									<div class="story-image story-image-first">
										<?php echo $photo_before['thumbnail']; ?>
										<div class="story-image-caption">
											<div class="story__caption-title"><?php esc_html_e( 'Before', 'dent-all' ); ?></div>
										</div>
									</div>
									<div class="story-image story-image-second">
										<?php echo $photo_after['thumbnail']; ?>
										<div class="story-image-caption">
											<div class="story__caption-title"><?php esc_html_e( 'After', 'dent-all' ); ?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="story-content">
								<h5 class="story__title"><?php echo esc_html( get_the_title() ); ?></h5>
								<?php echo wpautop( get_the_excerpt() ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php endwhile;
		wp_reset_postdata(); ?>

	</div>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			"use strict";
			var sliderId = "#<?php echo esc_js( $uni ); ?>";

			if (sliderId.length) {
				$(sliderId).slick({
					dots: true,
					speed: 1000,
					arrows: false,
					adaptiveHeight: true
				});
			}
		});
	</script>
<?php endif; ?>