<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'stm_slick.min.js' );
wp_enqueue_style( 'stm_slick.css' );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
if ( '' === $images ) {
	$images = '-1,-2,-3';
}
if( '' === $img_size ){
	$img_size = '130x100';
}
$images = explode( ',', $images );
$id = rand();
$title_tag = 'h5';
if( $mode == 'horizontal' && $nav_type == 'type_2' ){
	$title_tag = 'h2';
}
?>

<div class="image_carousel<?php echo esc_attr( $css_class . ' ' . $mode . ' ' . $nav_style . ' ' . $nav_type ); ?>">

	<?php if ( $title ): ?>
		<<?php echo esc_attr( $title_tag ); echo ( $title_color ) ? ' style="color: ' . esc_attr( $title_color ) . '"' : ''; ?>><?php echo esc_html( $title ); ?></<?php echo esc_attr( $title_tag ); ?>>
	<?php endif; ?>

	<?php if ( $mode == 'horizontal' && $nav_type == 'type_2' ): ?>
		<div class="slick_nav <?php echo esc_attr( $nav_style ); ?>">
			<div class="slick_prev" id="image_carousel-<?php echo esc_attr( $id ) ?>-prev"><i class="stm-icon-chevron-left"></i></div>
			<div class="slick_next" id="image_carousel-<?php echo esc_attr( $id ) ?>-next"><i class="stm-icon-chevron-right"></i></div>
		</div>
	<?php endif; ?>

	<div id="image_carousel-<?php echo esc_attr( $id ); ?>">
		<?php
			foreach ( $images as $attach_id ):
				if ( $attach_id > 0 ) {
					$post_thumbnail = wpb_getImageBySize( array(
						'attach_id'  => $attach_id,
						'thumb_size' => $img_size
					) );
				} else {
					$post_thumbnail              = array();
					$post_thumbnail['thumbnail'] = '<img src="' . esc_url( vc_asset_url( 'vc/no_image.png' ) ) . '" />';
					$post_thumbnail['p_img_large'][0] = esc_url( vc_asset_url( 'vc/no_image.png' ) );
				}
				$thumbnail = $post_thumbnail['thumbnail'];
				$p_img_large = $post_thumbnail['p_img_large'];
				echo '<div><a class="fancy" href="' . esc_url( $p_img_large[0] ) . '">' . $thumbnail . '</a></div>';
			endforeach;
		?>
	</div>

	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			"use strict";
			var slick_<?php echo esc_js( $id ) ?> = $("#image_carousel-<?php echo esc_js( $id ) ?>");
			var breakpoint_tablet = 769;
			var breakpoint_mobile = 479;
			slick_<?php echo esc_js( $id ) ?>.slick({
				infinite: true,
				<?php if ( $mode == 'vertical' ): ?>
					vertical: true,
					verticalSwiping: true,
				<?php endif; ?>
				<?php if ( $nav_type == 'type_2' ): ?>
					arrows: false,
				<?php endif; ?>
				<?php
					if ( $mode == 'vertical' ){
						$prevArrow = '<div class="prev-arrow"><i class="fa fa-arrow-circle-o-up"></i></div>';
						$nextArrow = '<div class="next-arrow"><i class="fa fa-arrow-circle-o-down"></i></div>';
					}else{
						$prevArrow = '<div class="prev-arrow"><i class="fa fa-arrow-circle-o-left"></i></div>';
						$nextArrow = '<div class="next-arrow"><i class="fa fa-arrow-circle-o-right"></i></div>';
					}
				?>
				prevArrow: '<?php echo $prevArrow; ?>',
				nextArrow: '<?php echo $nextArrow; ?>',
				slidesToShow: <?php echo esc_js( $images_to_show ); ?>,
				slidesToScroll: 1,
				responsive: [
					{
						breakpoint: breakpoint_tablet,
						settings: {
							slidesToShow: <?php echo esc_js( $images_to_show_tablet ); ?>,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: breakpoint_mobile,
						settings: {
							slidesToShow: <?php echo esc_js( $images_to_show_mobile ); ?>,
							slidesToScroll: 1
						}
					}
				]
			});

			<?php if ( $mode == 'horizontal' && $nav_type == 'type_2' ): ?>
				$("#image_carousel-<?php echo esc_js( $id ) ?>-next").on('click',function () {
					slick_<?php echo esc_js( $id ) ?>.slick('slickNext');
				});
				$("#image_carousel-<?php echo esc_js( $id ) ?>-prev").on('click',function () {
					slick_<?php echo esc_js( $id ) ?>.slick('slickPrev');
				});
			<?php endif; ?>

		});
	</script>

</div>