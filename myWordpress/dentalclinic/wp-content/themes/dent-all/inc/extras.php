<?php

if( ! function_exists( 'stm_custom_mime' ) ){
	function stm_custom_mime( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		$mimes['ico'] = 'image/icon';

		return $mimes;
	}
}


if ( ! function_exists( 'stm_updater' ) ) {
	function stm_updater() {
		global $stm_option;
		if( isset( $stm_option['envato_username'] ) && isset( $stm_option['envato_api'] ) ){
			$envato_username = trim( $stm_option['envato_username'] );
			$envato_api_key  = trim( $stm_option['envato_api'] );
			if ( ! empty( $envato_username ) && ! empty( $envato_api_key ) ) {
				load_template( get_template_directory() . '/inc/updater/envato-theme-update.php' );

				if ( class_exists( 'Envato_Theme_Updater' ) ) {
					Envato_Theme_Updater::init( $envato_username, $envato_api_key, 'StylemixThemes' );
				}
			}
		}
	}
	add_action( 'after_setup_theme', 'stm_updater' );
}

add_filter( 'upload_mimes', 'stm_custom_mime' );

if( ! function_exists( 'stm_excerpt_more' ) ){
	function stm_excerpt_more() {
		return '...';
	}
}

add_filter( 'excerpt_more', 'stm_excerpt_more' );

if ( ! function_exists( 'stm_get_logo' ) ) {
	function stm_get_logo() {
		$logo = stm_option( 'logo', false, 'url' );
		if ( $logo ) {
			return '<a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $logo ) . '" alt="' . get_bloginfo( 'name' ) . '" /></a>';
		} else {
			return '<a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a>';
		}
	}
}

if ( ! function_exists( 'stm_option' ) ) {
	function stm_option( $id, $fallback = false, $key = false ) {
		global $stm_option;
		if ( $fallback == false ) {
			$fallback = '';
		}
		$output = ( isset( $stm_option[ $id ] ) && $stm_option[ $id ] !== '' ) ? $stm_option[ $id ] : $fallback;
		if ( ! empty( $stm_option[ $id ] ) && $key ) {
			$output = $stm_option[ $id ][ $key ];
		}

		return $output;
	}
}

if ( ! function_exists( 'stm_get_structure' ) ) {
	function stm_get_structure( $sidebar_id, $sidebar_type, $sidebar_position, $layout = false ) {

		$output                   = array();
		$output['content_before'] = $output['content_after'] = $output['sidebar_before'] = $output['sidebar_after'] = '';
		$output['class']          = 'posts_list';

		if ( $layout == 'grid' ) {
			$output['class'] = 'posts_grid';
		}
		if ( $layout == 'icon' ) {
			$output['class'] = 'posts_icon';
		}
		if ( ! empty( $_GET['layout'] ) && $_GET['layout'] == 'grid' ) {
			$output['class'] = 'posts_grid';
		}
		if ( ! empty( $_GET['layout'] ) && $_GET['layout'] == 'icon' ) {
			$output['class'] = 'posts_icon';
		}

		if ( ! empty( $_GET['sidebar_id'] ) ) {
			$sidebar_id = intval( $_GET['sidebar_id'] );
		}

		if ( $sidebar_type == 'vc' ) {
			if ( $sidebar_id ) {
				$sidebar = get_post( $sidebar_id );
			}
		} else {
			if ( $sidebar_id ) {
				$sidebar = true;
			}
		}

		if ( isset( $sidebar ) ) {
			$output['class'] .= ' with_sidebar';
		}

		if ( $sidebar_position == 'right' && isset( $sidebar ) ) {
			$output['content_before'] .= '<div class="row">';
			$output['content_before'] .= '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">';

			$output['content_after'] .= '</div>'; // col
			$output['sidebar_before'] .= '<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">';
			// .sidebar-area
			$output['sidebar_after'] .= '</div>'; // col
			$output['sidebar_after'] .= '</div>'; // row
		}

		if ( $sidebar_position == 'left' && isset( $sidebar ) ) {
			$output['content_before'] .= '<div class="row">';
			$output['content_before'] .= '<div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12">';

			$output['content_after'] .= '</div>'; // col
			$output['sidebar_before'] .= '<div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 hidden-sm hidden-xs">';
			// .sidebar-area
			$output['sidebar_after'] .= '</div>'; // col
			$output['sidebar_after'] .= '</div>'; // row
		}

		return $output;
	}
}

if ( ! function_exists( 'stm_get_post_categories' ) ) {
	function stm_get_post_categories( $postID ) {
		$output = '';
		if ( $categories = wp_get_post_categories( $postID ) ) {
			$output .= '<ul class="post_categories">';
			foreach ( $categories as $category ) {
				$cat = get_category( $category );
				$output .= '<li>';
				$output .= '<a href="' . esc_url( get_category_link( $category ) ) . '">' . esc_html( $cat->name ) . '</a>';
				$output .= '</li>';
			}
			$output .= '</ul>';
		}

		return $output;
	}
}

if ( ! function_exists( 'stm_blog_navigation' ) ) {
	function stm_blog_navigation() {
		$mode = stm_option( 'blog_navigation' );
		if ( isset( $_REQUEST['nav'] ) && $_REQUEST['nav'] == 'load_more' ) {
			$mode = 'load_more';
		}

		return $mode;
	}
}

if ( ! function_exists( 'stm_blog_layout' ) ) {
	function stm_blog_layout() {
		$blog_layout = stm_option( 'blog_layout' );
		if ( isset( $_REQUEST['layout'] ) && $_REQUEST['layout'] == 'grid' ) {
			$blog_layout = 'grid';
		}

		return $blog_layout;
	}
}

if ( ! function_exists( 'stm_service_layout' ) ) {
	function stm_service_layout() {
		$blog_layout = stm_option( 'service_layout' );
		if ( isset( $_REQUEST['layout'] ) && $_REQUEST['layout'] == 'icon' ) {
			$blog_layout = 'icon';
		}

		return $blog_layout;
	}
}

if ( ! function_exists( 'stm_nav_mode' ) ) {
	function stm_nav_mode() {
		$nav_mode = stm_option( 'nav_mode' );
		if ( isset( $_COOKIE['nav_mode'] ) && $_COOKIE['nav_mode'] == 'left' ) {
			$nav_mode = 'left';
		}

		return $nav_mode;
	}
}

if ( ! empty( $_GET['get_posts'] ) ) {
	add_action( 'wp', 'stm_load_more_posts' );
}

if ( ! function_exists( 'stm_load_more_posts' ) ) {
	function stm_load_more_posts() {
		global $wp_query;
		$json            = array();
		$json['content'] = '';
		if ( $wp_query->max_num_pages > $wp_query->query['paged'] ) {
			$json['button'] = get_next_posts_page_link();
		} else {
			$json['button'] = '';
		}
		if ( have_posts() ):
			ob_start();
			while ( have_posts() ) : the_post();
				if ( stm_blog_layout() == 'grid' ) {
					get_template_part( 'partials/content', 'loop-grid' );
				} else {
					get_template_part( 'partials/content', 'loop' );
				}
			endwhile;
			$json['content'] = ob_get_contents();
			ob_end_clean();
		endif;

		echo json_encode( $json );
		exit;
	}
}

add_action( 'wp_ajax_stm_load_testimonials', 'stm_load_testimonials' );
add_action( 'wp_ajax_nopriv_stm_load_testimonials', 'stm_load_testimonials' );

if( ! function_exists( 'stm_load_testimonials' ) ){
	function stm_load_testimonials() {
		$json            = array();
		$json['button']  = '';
		$json['content'] = '';
		$offset          = intval( $_POST['offset'] );
		$per_page        = intval( $_POST['per_page'] );
		$new_offset      = $offset + $per_page;
		$posts           = new WP_Query( array(
			'post_type'      => 'stm_testimonial',
			'offset'         => $offset,
			'posts_per_page' => $per_page
		) );
		if ( $posts->have_posts() ) {
			$json['query'] = $posts;
			ob_start();
			while ( $posts->have_posts() ) {
				$posts->the_post();
				get_template_part( 'partials/content', 'loop-testimonials' );
			}
			$json['content'] = ob_get_contents();
			ob_end_clean();

			if ( $posts->found_posts > $new_offset ) {
				$json['button'] = '<a class="button bordered" onclick="load_testimonials(jQuery(this), ' . esc_js( $new_offset ) . ', ' . esc_js( $per_page ) . '); return false;" href="#">' . esc_html__( 'Load more', 'dent-all' ) . ' </a>';
			} else {
				$json['button'] = '';
			}

			wp_reset_postdata();
		}

		echo json_encode( $json );
		exit;
	}
}

if ( ! function_exists( 'stm_comment' ) ) {
	function stm_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		extract( $args, EXTR_SKIP );

		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">

		<?php if ( 'div' != $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>

		<div class="comment-author vcard">
			<?php if ( $args['avatar_size'] != 0 ) {
				echo get_avatar( $comment, $args['avatar_size'] );
			} ?>
		</div>

		<div class="comment-body">
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'dent-all' ); ?></em>
				<br/>
			<?php endif; ?>

			<div class="comment-meta commentmetadata">
				<?php printf( wp_kses( __( '<cite class="fn">%s</cite>', 'dent-all' ), array( 'cite' => array( 'class' => array() ) ) ), get_comment_author_link() ); ?>
				<span class="comment-date"><?php printf( esc_html__( '%1$s at %2$s', 'dent-all' ), get_comment_date(), get_comment_time() ); ?></span>
				<?php edit_comment_link( esc_html__( '(Edit)', 'dent-all' ) ); ?>
				<?php comment_reply_link( array_merge( $args, array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth']
				) ) ); ?>
			</div>

			<?php comment_text(); ?>
		</div>

		<?php if ( 'div' != $args['style'] ) : ?>
			</div>
		<?php endif; ?>
		<?php
	}
}

add_filter( 'comment_form_default_fields', 'stm_comment_form_fields' );

if ( ! function_exists( 'stm_comment_form_fields' ) ) {
	function stm_comment_form_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? " aria-required='true'" : '' );
		$html5     = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
		$fields    = array(
			'author' => '<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="input-group comment-form-author">
		            			<input placeholder="' . esc_attr__( 'Name', 'dent-all' ) . ( $req ? ' *' : '' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
		            			<span class="input-addon"><i class="stm-icon-man"></i></span>
	                        </div>
	                    </div>',
			'email'  => '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="input-group comment-form-url">
								<input placeholder="' . esc_attr__( 'Website', 'dent-all' ) . '" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
								<span class="input-addon"><i class="stm-icon-roundels"></i></span>
							</div>
						</div>',
			'url'    => '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="input-group comment-form-email">
								<input placeholder="' . esc_attr__( 'E-mail', 'dent-all' ) . ( $req ? ' *' : '' ) . '" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
							<span class="input-addon"><i class="fa fa-envelope-o"></i></span>
						</div>
					</div></div>'
		);

		return $fields;
	}
}

add_filter( 'comment_form_defaults', 'stm_comment_form' );

if ( ! function_exists( 'stm_comment_form' ) ) {
	function stm_comment_form( $args ) {
		$args['comment_field'] = '<div class="input-group comment-form-comment">
						        <textarea placeholder="' . esc_attr( _x( 'Message', 'noun', 'dent-all' ) ) . ' *" name="comment" rows="9" aria-required="true"></textarea>
							  </div>';

		return $args;
	}
}


if ( ! function_exists( 'stm_load_more_button' ) ) {
	function stm_load_more_button() {
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) {
			printf( '<div class="load_more_posts"><a class="button bordered" onclick="loadmore(jQuery(this)); return false;" href="%s">%s </a> <i class="fa fa-spinner"></i></div>', esc_url( get_next_posts_page_link() ), esc_html__( 'Load more', 'dent-all' ) );
		}
	}
}

if ( ! function_exists( 'stm_after_content_import' ) ) {

	function stm_after_content_import( $demo_active_import, $demo_directory_path ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );

		$locations = get_theme_mod( 'nav_menu_locations' );
		$menus     = wp_get_nav_menus();

		if ( ! empty( $menus ) ) {
			foreach ( $menus as $menu ) {
				if ( is_object( $menu ) && $menu->name == 'Primary Menu' ) {
					switch ($menu->name) {
						case 'Primary Menu':
						$locations['primary_menu'] = $menu->term_id;
							break;
						case 'Top Bar Menu':
							$locations['top_bar_menu'] = $menu->term_id;
							break;
						case 'Left Nav Menu':
							$locations['left_nav'] = $menu->term_id;
							break;
						case 'Footer Menu':
							$locations['footer_nav'] = $menu->term_id;
							break;
					}
				}
			}
		}

		set_theme_mod( 'nav_menu_locations', $locations );

		update_option( 'show_on_front', 'page' );

		$front_page = get_page_by_title( 'Home' );
		if ( isset( $front_page->ID ) ) {
			update_option( 'page_on_front', $front_page->ID );
		}
		$blog_page = get_page_by_title( 'Blog' );
		if ( isset( $blog_page->ID ) ) {
			update_option( 'page_for_posts', $blog_page->ID );
		}

		if ( class_exists( 'RevSlider' ) ) {

			$wbc_sliders_array = array(
				'demo' => 'rev_slider_main_slider.zip'
			);

			if ( isset( $demo_active_import[ $current_key ]['directory'] ) && ! empty( $demo_active_import[ $current_key ]['directory'] ) && array_key_exists( $demo_active_import[ $current_key ]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[ $demo_active_import[ $current_key ]['directory'] ];

				if ( file_exists( $demo_directory_path . $wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path . $wbc_slider_import );
				}
			}

			$wbc_sliders_array = array(
				'demo' => 'rev_slider_about_us.zip'
			);

			if ( isset( $demo_active_import[ $current_key ]['directory'] ) && ! empty( $demo_active_import[ $current_key ]['directory'] ) && array_key_exists( $demo_active_import[ $current_key ]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[ $demo_active_import[ $current_key ]['directory'] ];

				if ( file_exists( $demo_directory_path . $wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path . $wbc_slider_import );
				}
			}
		}

	}
}

add_action( 'wbc_importer_after_content_import', 'stm_after_content_import', 10, 2 );