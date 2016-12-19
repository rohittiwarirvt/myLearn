<?php

if( ! function_exists( 'stm_print_styles' ) ){
	function stm_print_styles() {
		$post_id        = get_the_ID();
		$page_for_posts = get_option( 'page_for_posts' );
		if ( is_home() || is_category() || is_search() || is_tag() || is_tax() ) {
			$post_id = $page_for_posts;
		}
		if ( is_post_type_archive( 'stm_service' ) ) {
			$post_id = stm_option( 'service_page' );
		}

		$css             = "";
		$title_box_style = array();

		$breadcrumbs_font_color                 = get_post_meta( $post_id, 'breadcrumbs_font_color', true );
		$title_box_style['background-color']    = get_post_meta( $post_id, 'title_box_bg_color', true );
		$title_box_style['color']               = get_post_meta( $post_id, 'title_box_font_color', true );
		$title_box_style['background-image']    = wp_get_attachment_image_src( get_post_meta( $post_id, 'title_box_custom_bg_image', true ), 'full' );
		$title_box_style['background-position'] = get_post_meta( $post_id, 'title_box_bg_position', true );
		$title_box_style['background-size']     = get_post_meta( $post_id, 'title_box_bg_size', true );
		$title_box_style['background-repeat']   = get_post_meta( $post_id, 'title_box_bg_repeat', true );

		if ( $breadcrumbs_font_color ) {
			$css .= '
			.title_box .breadcrumbs,
			.title_box .breadcrumbs a,
			.title_box .breadcrumbs span
			{
				color: ' . esc_attr( $breadcrumbs_font_color ) . ';
			}
		';
		}

		if ( $title_box_style ) {
			$css .= '.title_box{ ';
			foreach ( $title_box_style as $key => $val ) {
				if ( $val ) {
					if ( $key != 'background-image' ) {
						$css .= $key . ': ' . esc_attr( $val ) . '; ';
					} else {
						$css .= $key . ': url(' . esc_url( $val[0] ) . '); ';
					}
				}
			}
			$css .= '}';
		}


		wp_add_inline_style( 'stm_theme-style', $css );
	}
}

add_action( 'wp_enqueue_scripts', 'stm_print_styles' );