<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$link      = vc_build_link( $link );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if ( $el_class ) {
	$css_class .= ' ' . $el_class;
}

?>

<div class="stm_price<?php echo esc_attr( $css_class ); ?> clearfix">
	<div class="left">
		<h5><?php echo esc_html( $title ); ?></h5>

		<div class="prefix additional_font"><?php echo esc_html( $prefix ); ?></div>
		<div class="price"><?php echo esc_html( $price ); ?></div>
	</div>
	<div class="right">
		<p><?php echo esc_html( $text ); ?></p>
	</div>
	<?php if ( $link['url'] ):
		if ( ! $link['target'] ):
			$link['target'] = '_self';
		endif; ?>
		<a class="link" target="<?php echo esc_attr( $link['target'] ); ?>" href="<?php echo esc_url( $link['url'] ); ?>"></a>
	<?php endif; ?>
</div>