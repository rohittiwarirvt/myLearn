<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( ! wp_is_mobile() ) {
	wp_enqueue_script( 'stm_countUp.min.js' );
}

$text_style    = array();
$counter_style = array();

if ( $font_color ) {
	$text_style['color'] = 'color: ' . esc_attr( $font_color ) . ';';
}

if ( $counter_width ) {
	$counter_style['width'] = 'width: ' . esc_attr( $counter_width ) . 'px;';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$id        = rand();
?>

<div<?php echo( ( $text_style ) ? ' style="' . esc_attr( implode( ' ', $text_style ) ) . '"' : '' ); ?>
	class="stats_counter<?php echo esc_attr( $css_class ); ?>">
	<?php if ( wp_is_mobile() ) { ?>
		<div<?php echo( ( $counter_style ) ? ' style="' . esc_attr( implode( ' ', $counter_style ) ) . '"' : '' ); ?> class="h2" id="counter_<?php echo esc_attr( $id ); ?>"><?php echo esc_attr( $counter_value ); ?></div>
	<?php } else { ?>
		<div<?php echo( ( $counter_style ) ? ' style="' . esc_attr( implode( ' ', $counter_style ) ) . '"' : '' ); ?> class="h2" id="counter_<?php echo esc_attr( $id ); ?>"></div>
	<?php } ?>
	<?php if ( $title ) { ?>
		<div class="text"><?php echo wp_kses_post( $title ); ?></div>
	<?php } ?>
	<?php if ( ! wp_is_mobile() ) { ?>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				var counter_<?php echo esc_js( $id ); ?> = new countUp("counter_<?php echo esc_js( $id ); ?>", 0, <?php echo esc_js( $counter_value ); ?>, 0, <?php echo esc_js( $duration ); ?>, {
					useEasing: true,
					useGrouping: false
				});
				$(window).load(function () {
					if ($("#counter_<?php echo esc_js( $id ); ?>").is_on_screen()) {
						counter_<?php echo esc_js( $id ); ?>.start();
					}
				});
				$(window).scroll(function () {
					if ($("#counter_<?php echo esc_js( $id ); ?>").is_on_screen()) {
						counter_<?php echo esc_js( $id ); ?>.start();
					}
				});
			});
		</script>
	<?php } ?>
</div>