<?php $vc_status = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true ); ?>
<?php get_template_part( 'partials/title_box' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="container">

		<?php if ( $vc_status != 'false' && $vc_status == true ): ?>

			<?php the_content(); ?>

		<?php else: ?>

			<?php
			$sidebar_type = stm_option( 'blog_sidebar_type' );
			if ( $sidebar_type == 'wp' ) {
				$sidebar_id = stm_option( 'blog_wp_sidebar' );
			} else {
				$sidebar_id = stm_option( 'blog_vc_sidebar' );
			}
			$structure = stm_get_structure( $sidebar_id, $sidebar_type, stm_option( 'blog_sidebar_position' ), stm_option( 'blog_layout' ) ); ?>

			<?php echo $structure['content_before']; ?>
			<div class="wpb_text_column">
				<?php if ( has_post_thumbnail() ): ?>
					<div class="post-thumbnail">
						<?php the_post_thumbnail( 'stm_thumb-825x360' ); ?>
					</div>
				<?php endif; ?>
				<?php the_content(); ?>
			</div>
			<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><label>' . esc_html__( 'Pages:', 'dent-all' ) . '</label>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '%',
				'separator'   => '',
			) );
			?>
			<div class="post_bottom media">
				<div class="tags media-body"><?php the_tags( '<span>' . esc_html__( 'Tags:', 'dent-all' ) . '</span>', '' ); ?></div>
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
			</div>
			<?php if ( comments_open() || get_comments_number() ) : ?>
				<div class="stm_post_comments">
					<?php comments_template(); ?>
				</div>
			<?php endif; ?>
			<?php echo $structure['content_after']; ?>
			<?php echo $structure['sidebar_before']; ?>
			<?php
			if ( $sidebar_id ) {
				if ( $sidebar_type == 'wp' ) {
					$sidebar = true;
				} else {
					$sidebar = get_post( $sidebar_id );
				}
			}
			if ( isset( $sidebar ) ) {
				if ( $sidebar_type == 'vc' ) { ?>
					<div class="sidebar-area stm_sidebar">
						<?php echo apply_filters( 'the_content', $sidebar->post_content ); ?>
					</div>
				<?php } else { ?>
					<div class="sidebar-area default_widgets">
						<?php dynamic_sidebar( $sidebar_id ); ?>
					</div>
				<?php }
			}
			?>
			<?php echo $structure['sidebar_after']; ?>
		<?php endif; ?>
	</div>
	<!--.container-->

</article> <!-- #post-## -->