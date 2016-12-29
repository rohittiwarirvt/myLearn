<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$css = $atts['css'];
$style = $atts['style'];

if( ! function_exists( 'stm_strip_tags' ) ){
	function stm_strip_tags( $val ){
		return strip_tags($val);
	}
}

$atts = array_map( 'stm_strip_tags', $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$type      = 'Stm_Contacts_Widget';
$args      = array(
	'before_widget' => '<aside class="widget widget_contacts wpb_content_element vc_widgets' . esc_attr( $css_class . ' ' . $style ) . '">',
	'after_widget'  => '</aside>',
	'before_title'  => '<div class="widget_title"><h5>',
	'after_title'   => '</h5></div>'
);
?>

<?php the_widget( $type, $atts, $args ); ?>