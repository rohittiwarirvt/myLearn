<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$link = vc_build_link( $link );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
if ( $el_class ) {
	$css_class .= ' ' . $el_class;
}
$css_class .= ' ' . $style;

if ( $style == 'icon_right' || $style == 'icon_left' ) {
	$css_class .= ' media';
}

$title_style = array();
$icon_style = array();

if( $animation ){
	$css_class .= ' animated_on_hover';
}

if ( $title_font_size ) {
	$title_style['font-size'] = 'font-size: ' . esc_attr( $title_font_size ) . 'px;';
}

if ( $title_font_weight ) {
	$title_style['font-weight'] = 'font-weight: ' . esc_attr( $title_font_weight ) . ';';
}

if ( $title_color ) {
	$title_style['color'] = 'color: ' . esc_attr( $title_color ) . ';';
}

if ( $icon_color ) {
	$icon_style['color'] = 'color: ' . esc_attr( $icon_color ) . ';';
}

if( $icon_size ){
	$icon_style['font-size'] = 'font-size: ' . esc_attr( $icon_size ) . 'px;';
}

?>

<div class="icon_box<?php echo esc_attr( $css_class ); ?>">

	<?php if ( $style == 'icon_right' ): ?>

		<div class="text media-body media-middle">
			<h4<?php echo( ( $title_style ) ? ' style="' . esc_attr( implode( ' ', $title_style ) ) . '"' : '' ); ?>><?php echo wp_kses_post( $title ); ?></h4>
			<?php echo wpb_js_remove_wpautop( $content, true ); ?>
		</div>

		<?php if ( $icon ): ?>
			<div class="icon media-right">
				<i<?php echo( ( $icon_style ) ? ' style="' . esc_attr( implode( ' ', $icon_style ) ) . '"' : '' ); ?> class="<?php echo esc_attr( $icon ); ?>"></i>
			</div>
		<?php endif; ?>

		<?php if ( $link['url'] ):
			if ( ! $link['target'] ):
				$link['target'] = '_self';
			endif; ?>
			<a class="link" target="<?php echo esc_attr( $link['target'] ); ?>" href="<?php echo esc_url( $link['url'] ); ?>"></a>
		<?php endif; ?>

	<?php elseif ( $style == 'icon_left' ): ?>

		<?php if ( $icon ): ?>
			<div class="icon media-middle">
				<i<?php echo( ( $icon_style ) ? ' style="' . esc_attr( implode( ' ', $icon_style ) ) . '"' : '' ); ?> class="<?php echo esc_attr( $icon ); ?>"></i>
			</div>
		<?php endif; ?>

		<div class="text media-right media-middle media-body">
			<h4<?php echo( ( $title_style ) ? ' style="' . esc_attr( implode( ' ', $title_style ) ) . '"' : '' ); ?>><?php echo wp_kses_post( $title ); ?></h4>
			<?php echo wpb_js_remove_wpautop( $content, true ); ?>
		</div>

		<?php if ( $link['url'] ):
			if ( ! $link['target'] ):
				$link['target'] = '_self';
			endif; ?>
			<a class="link" target="<?php echo esc_attr( $link['target'] ); ?>" href="<?php echo esc_url( $link['url'] ); ?>"></a>
		<?php endif; ?>

	<?php elseif ( $style == 'icon_top' ): ?>

		<?php if ( $icon ): ?>
			<div class="icon" style="height: <?php echo esc_attr( $icon_height ); ?>px;">
				<i<?php echo( ( $icon_style ) ? ' style="' . esc_attr( implode( ' ', $icon_style ) ) . '"' : '' ); ?> class="<?php echo esc_attr( $icon ); ?>"></i>
			</div>
		<?php endif; ?>

		<div class="text">
			<h4<?php echo( ( $title_style ) ? ' style="' . esc_attr( implode( ' ', $title_style ) ) . '"' : '' ); ?>>
				<?php if ( $link['url'] ):
					if ( ! $link['target'] ):
						$link['target'] = '_self';
					endif; ?>
					<a<?php echo( ( $title_style ) ? ' style="' . esc_attr( implode( ' ', $title_style ) ) . '"' : '' ); ?> target="<?php echo esc_attr( $link['target'] ); ?>" href="<?php echo esc_url( $link['url'] ); ?>"><?php echo wp_kses_post( $title ); ?></a>
				<?php else: ?>
					<?php echo wp_kses_post( $title ); ?>
				<?php endif; ?>
			</h4>
			<?php echo wpb_js_remove_wpautop( $content, true ); ?>
		</div>

	<?php endif; ?>

</div>