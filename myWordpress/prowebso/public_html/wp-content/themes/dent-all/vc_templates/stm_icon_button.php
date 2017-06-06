<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$link      = vc_build_link( $link );
?>

<div class="icon_button<?php echo esc_attr( $css_class, true ); ?>">
	<?php
	if ( $link['url'] ) :
		if ( ! $link['target'] ) {
			$link['target'] = '_self';
		}
		?>
		<a target="<?php echo esc_attr( $link['target'] ); ?>" href="<?php echo esc_url( $link['url'] ); ?>">
			<span class="media-left media-middle">
				<i style="font-size: <?php echo esc_attr( $icon_size ); ?>px; line-height: <?php echo esc_attr( $icon_height ); ?>px; height: <?php echo esc_attr( $icon_height ); ?>px;" class="stm-icon <?php echo esc_attr( $icon ); ?>"></i>
			</span>
			<span class="media-body media-middle">
				<span class="text">
					<?php
					echo esc_html( $link['title'] );
					if ( $sub_text ) :
						echo '<br/><em>' . esc_html( $sub_text ) . '</em>';
					endif;
					?>
				</span>
			</span>
		</a>
	<?php endif; ?>
</div>