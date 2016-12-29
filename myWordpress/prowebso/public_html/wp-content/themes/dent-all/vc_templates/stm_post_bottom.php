<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
?>
<div class="post_bottom media<?php echo esc_attr( $css_class ); ?>">
	<?php if ( $tags ): ?>
		<div class="tags media-body"><?php the_tags( '<span>' . esc_html__( 'Tags:', 'dent-all' ) . '</span>', '' ); ?></div>
	<?php endif; ?>
	<?php if ( $share ): ?>
		<div class="media-right">
			<div class="socials">
				<span><?php esc_html_e( 'Share:', 'dent-all' ); ?></span>
				<span class='st_facebook_large' displayText=''></span>
				<span class='st_instagram_large' displayText=''></span>
				<span class='st_twitter_large' displayText=''></span>
				<span class='st_linkedin_large' displayText=''></span>
				<script type="text/javascript">var switchTo5x = true;</script>
				<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
				<script type="text/javascript">
					stLight.options({
						doNotHash: false,
						doNotCopy: false,
						hashAddressBar: false
					});
				</script>
			</div>
		</div>
	<?php endif; ?>
</div>