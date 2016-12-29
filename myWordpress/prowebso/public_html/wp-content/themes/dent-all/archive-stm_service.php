<?php get_header(); ?>
<?php get_template_part( 'partials/title_box' ); ?>
<?php
	$sidebar_type = stm_option( 'service_sidebar_type' );
	if( $sidebar_type == 'wp' ){
		$sidebar_id = stm_option( 'service_wp_sidebar' );
	}else{
		$sidebar_id = stm_option( 'service_vc_sidebar' );
	}
	$structure = stm_get_structure( $sidebar_id, $sidebar_type, stm_option( 'service_sidebar_position' ), stm_option( 'service_layout' ) ); ?>
	<div class="content_wrapper">
		<div class="container">
			<?php echo $structure['content_before']; ?>
				<div class="service_<?php echo esc_attr( $structure['class'] ); ?>">
					<?php
						if ( have_posts() ) :

							while ( have_posts() ) : the_post();
								if( stm_service_layout() == 'grid' ){
									get_template_part( 'partials/content', 'loop-service-grid' );
								}else{
									get_template_part( 'partials/content', 'loop-service-icon' );
								}
							endwhile;

						else:
							get_template_part( 'partials/content', 'none' );
						endif;
					?>
				</div>
				<?php
				echo paginate_links( array(
					'type'      => 'list',
					'prev_text' => '<i class="fa fa-arrow-left"></i>' . esc_html__( 'Prev Page', 'dent-all' ),
					'next_text' => esc_html__( 'Next Page', 'dent-all' ) . '<i class="fa fa-arrow-right"></i>',
				) );
				?>
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
		</div> <!--.container-->
	</div> <!--.content_wrapper-->

<?php get_footer(); ?>