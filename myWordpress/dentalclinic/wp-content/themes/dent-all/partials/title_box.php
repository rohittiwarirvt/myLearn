<?php

$post_id        = get_the_ID();
$title          = '';
$page_for_posts = get_option( 'page_for_posts' );

if ( is_home() || is_category() || is_search() || is_tag() || is_tax() ) {
	$post_id = $page_for_posts;
}

if ( is_post_type_archive( 'stm_service' ) ) {
	$post_id = stm_option( 'service_page' );
}

if ( is_home() ) {
	if ( ! $page_for_posts ) {
		$title = esc_html__( 'Blog', 'dent-all' );
	} else {
		$title = get_the_title( $post_id );
	}
} elseif ( is_archive() ) {
	$title = post_type_archive_title( '', false );
}  elseif ( is_category() || is_tag() || is_tax() ) {
	$title = single_cat_title( '', false );
} elseif ( is_search() ) {
	$title = sprintf( esc_html__( 'Search Results for: %s', 'dent-all' ), get_search_query() );
} else {
	$title = get_the_title( $post_id );
}

if ( get_post_meta( $post_id, 'title', true ) != 'hide' ) {

	$breadcrumbs = get_post_meta( $post_id, 'breadcrumbs', true );
	$style       = esc_attr( get_post_meta( $post_id, 'style', true ) );
	$post_info   = get_post_meta( $post_id, 'post_info', true );

	?>

	<div class="title_box<?php echo( ( $style ) ? ' ' . $style : '' ); ?>">
		<div class="container">
			<?php
			if ( $breadcrumbs != 'hide' ) {
				if ( function_exists( 'bcn_display' ) ) { ?>
					<div class="breadcrumbs">
						<?php bcn_display(); ?>
					</div>
				<?php }
			}
			?>
			<div class="title_wr">
				<h1><?php echo $title; ?></h1>
				<?php if ( is_single() && $post_info == 'show' ): ?>
					<div class="post_details">
						<?php echo stm_get_post_categories( get_the_ID() ); ?>
						<div class="post_date"><?php echo get_the_date(); ?></div>
						<div class="comments_num">
							<a href="<?php echo esc_url( get_comments_link() ); ?>">
								<i class="stm-icon-comments"></i>
								<span><?php echo comments_number( 0, 1 ); ?></span>
							</a>
						</div>
						<div class="post_author"><i class="stm-icon-user"></i> <span><?php the_author(); ?></span></div>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<!--.container-->
	</div>

<?php } ?>