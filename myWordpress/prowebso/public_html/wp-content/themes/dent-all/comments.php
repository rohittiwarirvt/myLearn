<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title"><i class="stm-icon-comments"></i><?php echo sprintf( wp_kses( __( 'Comments <span>%s</span>', 'dent-all' ), array( 'span' => array() ) ), get_comments_number() ); ?></h3>
		<a href="#respond" class="button bordered add_comment_button"><?php esc_html_e( 'Add Comment', 'dent-all' ); ?></a>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
					'short_ping'  => true,
					'reply_text'  => wp_kses( __( '<i class="stm-icon-reply"></i> <span>Reply</span>', 'dent-all' ), array( 'i' => array( 'class' => array() ), 'span' => array() ) ),
					'avatar_size' => 65,
					'callback'    => 'stm_comment'
				) );
			?>
		</ul><!-- .comment-list -->

		<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				?>
				<nav class="navigation comment-navigation" role="navigation">
					<h4 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'dent-all' ); ?></h4>
					<div class="nav-links">
						<?php
						if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'dent-all' ) ) ) :
							printf( '<div class="nav-previous">%s</div>', $prev_link );
						endif;

						if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'dent-all' ) ) ) :
							printf( '<div class="nav-next">%s</div>', $next_link );
						endif;
						?>
					</div><!-- .nav-links -->
				</nav><!-- .comment-navigation -->
				<?php
			endif;
		?>

	<?php endif; // have_comments() ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'dent-all' ); ?></p>
	<?php endif; ?>

	<?php comment_form( array( 'comment_notes_before' => '', 'comment_notes_after' => '' ) ); ?>

</div><!-- .comments-area -->
