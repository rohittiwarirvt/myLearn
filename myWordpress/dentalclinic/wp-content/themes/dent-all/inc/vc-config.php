<?php

if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
	vc_set_default_editor_post_types( array( 'page', 'post', 'stm_sidebar', 'stm_service_price', 'stm_service', 'stm_vacancy', 'stm_vacancy' ) );
}

add_action( 'vc_before_init', 'stm_vc_set_as_theme' );

if( ! function_exists( 'stm_vc_set_as_theme' ) ){
	function stm_vc_set_as_theme() {
		vc_set_as_theme( true );
	}
}

if ( is_admin() ) {
	if ( ! function_exists( 'stm_vc_remove_teaser_metabox' ) ) {
		function stm_vc_remove_teaser_metabox() {
			$post_types = get_post_types( '', 'names' );
			foreach ( $post_types as $post_type ) {
				remove_meta_box( 'vc_teaser', $post_type, 'side' );
			}
		}

		add_action( 'do_meta_boxes', 'stm_vc_remove_teaser_metabox' );
	}
}

if ( function_exists( 'vc_add_shortcode_param' ) ) {
	vc_add_shortcode_param( 'timepicker', 'stm_vc_timepicker_param' );
}

if( ! function_exists( 'stm_vc_timepicker_param' ) ){
	function stm_vc_timepicker_param( $settings, $value ) {
		$id     = uniqid( 'timepicker-' );
		$output = '<input type="text" id="' . esc_attr( $id ) . '" name="' . esc_attr( $settings['param_name'] ) . '" value="' . esc_attr( $value ) . '" class="wpb_vc_param_value wpb-textinput ' . esc_attr( $settings['param_name'] ) . ' ' . esc_attr( $settings['type'] ) . '_field" />';
		$output .= '
		<script type="text/javascript">
			jQuery(document).ready(function($) {
			  $("#' . esc_js( $id ) . '").timepicker();
			});
		</script>
	';

		return $output;
	}
}

if ( function_exists( 'vc_map' ) ) {
	add_action( 'init', 'vc_stm_elements' );
}

if( ! function_exists( 'vc_stm_elements' ) ){
	function vc_stm_elements() {

		$stm_service_categories_array[ esc_html__( 'All', 'dent-all' ) ] = 'all';
		$stm_service_categories                                = get_terms( 'stm_service_category' );
		if ( ! is_wp_error( $stm_service_categories ) ) {
			foreach ( $stm_service_categories as $category ) {
				$stm_service_categories_array[ $category->name ] = $category->slug;
			}
		}


		vc_map( array(
			'name'     => esc_html__( 'Icon Box', 'dent-all' ),
			'base'     => 'stm_icon_box',
			'icon'     => 'stm_icon_box',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'textarea',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'dent-all' ),
					'param_name' => 'title'
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'dent-all' ),
					'param_name' => 'link'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title Font Size', 'dent-all' ),
					'param_name'  => 'title_font_size',
					'value'       => '20',
					'description' => esc_html__( 'Enter font size in px', 'dent-all' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title Font Weight', 'dent-all' ),
					'param_name'  => 'title_font_weight',
					'value'       => '500',
					'description' => esc_html__( 'Enter font weight', 'dent-all' )
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title Color', 'dent-all' ),
					'param_name' => 'title_color'
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icon Color', 'dent-all' ),
					'param_name' => 'icon_color'
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'dent-all' ),
					'param_name' => 'icon',
					'value'      => ''
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'dent-all' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Icon Top', 'dent-all' )   => 'icon_top',
						esc_html__( 'Icon Left', 'dent-all' )  => 'icon_left',
						esc_html__( 'Icon Right', 'dent-all' ) => 'icon_right'
					)
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Size', 'dent-all' ),
					'param_name'  => 'icon_size',
					'value'       => '49',
					'description' => esc_html__( 'Enter icon size in px', 'dent-all' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Height', 'dent-all' ),
					'param_name'  => 'icon_height',
					'value'       => '65',
					'description' => esc_html__( 'Enter icon height in px', 'dent-all' ),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'icon_top' )
					)
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Animation on hover', 'dent-all' ),
					'param_name' => 'animation',
					'value'      => array(
						esc_html__( 'Enable', 'dent-all' ) => 'enable'
					)
				),
				array(
					'type'       => 'textarea_html',
					'heading'    => esc_html__( 'Text', 'dent-all' ),
					'param_name' => 'content'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Extra class name', 'dent-all' ),
					'param_name'  => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'dent-all' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Image Carousel', 'dent-all' ),
			'base'     => 'stm_image_carousel',
			'icon'     => 'stm_image_carousel',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'attach_images',
					'heading'    => esc_html__( 'Images', 'dent-all' ),
					'param_name' => 'images'
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Slide Mode', 'dent-all' ),
					'param_name' => 'mode',
					'value'      => array(
						esc_html__( 'Vertical', 'dent-all' )   => 'vertical',
						esc_html__( 'Horizontal', 'dent-all' ) => 'horizontal'
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'dent-all' ),
					'param_name' => 'title'
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title Color', 'dent-all' ),
					'param_name' => 'title_color'
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Nav Type', 'dent-all' ),
					'param_name' => 'nav_type',
					'value'      => array(
						esc_html__( 'Type 1', 'dent-all' ) => 'type_1',
						esc_html__( 'Type 2', 'dent-all' ) => 'type_2'
					),
					'dependency' => array(
						'element' => 'mode',
						'value'   => array( 'horizontal' )
					)
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Navigation Style', 'dent-all' ),
					'param_name' => 'nav_style',
					'value'      => array(
						esc_html__( 'Style 1', 'dent-all' ) => 'style_1',
						esc_html__( 'Style 2', 'dent-all' ) => 'style_2'
					),
					'dependency' => array(
						'element' => 'nav_type',
						'value'   => array( 'type_2' )
					)
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Images To Show (Normal Desktop)', 'dent-all' ),
					'param_name'  => 'images_to_show',
					'value'       => 3,
					'description' => esc_html__( 'Number of items the carousel will display. Default: at <980px - 3 items.', 'dent-all' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Images To Show (Tablet)', 'dent-all' ),
					'param_name'  => 'images_to_show_tablet',
					'value'       => 4,
					'description' => esc_html__( 'Number of items the carousel will display. Default: at <768px - 2 items.', 'dent-all' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Images To Show (Mobile)', 'dent-all' ),
					'param_name'  => 'images_to_show_mobile',
					'value'       => 3,
					'description' => esc_html__( 'Number of items the carousel will display. Default: at <479px - 1 item.', 'dent-all' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Images Size', 'dent-all' ),
					'param_name'  => 'img_size',
					'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'dent-all' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Stats Counter', 'dent-all' ),
			'base'     => 'stm_stats_counter',
			'icon'     => 'stm_stats_counter',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'textarea',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'dent-all' ),
					'param_name' => 'title'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Counter Value', 'dent-all' ),
					'param_name' => 'counter_value',
					'value'      => '1000'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Counter Width', 'dent-all' ),
					'param_name'  => 'counter_width',
					'description' => esc_html__( 'Enter counter width in px', 'dent-all' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Duration', 'dent-all' ),
					'param_name' => 'duration',
					'value'      => '2.5'
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Font Color', 'dent-all' ),
					'param_name' => 'font_color'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Testimonials', 'dent-all' ),
			'base'     => 'stm_testimonials',
			'icon'     => 'stm_testimonials',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'dent-all' ),
					'param_name' => 'title'
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title Color', 'dent-all' ),
					'param_name' => 'title_color'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Count', 'dent-all' ),
					'param_name' => 'count',
					'value'      => 5
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Testimonials To Show', 'dent-all' ),
					'param_name' => 'testimonials_to_show',
					'value'      => 3
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Navigation Style', 'dent-all' ),
					'param_name' => 'nav_style',
					'value'      => array(
						esc_html__( 'Style 1', 'dent-all' ) => 'style_1',
						esc_html__( 'Style 2', 'dent-all' ) => 'style_2'
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Testimonials 2', 'dent-all' ),
			'base'     => 'stm_testimonials_2',
			'icon'     => 'stm_testimonials_2',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Testimonials Per Page', 'dent-all' ),
					'param_name' => 'testimonials_per_page',
					'value'      => 6
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Testimonials Per Row', 'dent-all' ),
					'param_name' => 'testimonials_per_row',
					'value'      => array(
						1 => 1,
						2 => 2,
						3 => 3,
						4 => 4
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Staff Carousel', 'dent-all' ),
			'base'     => 'stm_staff_carousel',
			'icon'     => 'stm_staff_carousel',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'dent-all' ),
					'param_name' => 'title'
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title Color', 'dent-all' ),
					'param_name' => 'title_color'
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Text Color', 'dent-all' ),
					'param_name' => 'text_color'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Count', 'dent-all' ),
					'param_name' => 'count',
					'value'      => 1
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Staff To Show (Normal Desktop)', 'dent-all' ),
					'param_name'  => 'staff_to_show',
					'value'       => 5,
					'description' => esc_html__( 'Number of items the carousel will display. Default: at <980px - 3 items.', 'dent-all' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Staff To Show (Tablet)', 'dent-all' ),
					'param_name'  => 'staff_to_show_tablet',
					'value'       => 4,
					'description' => esc_html__( 'Number of items the carousel will display. Default: at <768px - 2 items.', 'dent-all' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Staff To Show (Mobile)', 'dent-all' ),
					'param_name'  => 'staff_to_show_mobile',
					'value'       => 3,
					'description' => esc_html__( 'Number of items the carousel will display. Default: at <479px - 1 item.', 'dent-all' )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Navigation Style', 'dent-all' ),
					'param_name' => 'nav_style',
					'value'      => array(
						esc_html__( 'Style 1', 'dent-all' ) => 'style_1',
						esc_html__( 'Style 2', 'dent-all' ) => 'style_2'
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Staff List', 'dent-all' ),
			'base'     => 'stm_staff_list',
			'icon'     => 'stm_staff_list',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'dent-all' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'List', 'dent-all' ) => 'style',
						esc_html__( 'Grid', 'dent-all' ) => 'grid'
					)
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Staff Per Row', 'dent-all' ),
					'param_name' => 'per_row',
					'value'      => array(
						3 => 3,
						4 => 4
					),
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'grid' )
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Count', 'dent-all' ),
					'param_name' => 'count',
					'value'      => 10
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Pricing Tabs', 'dent-all' ),
			'base'     => 'stm_pricing_tabs',
			'icon'     => 'stm_pricing_tabs',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'dent-all' ),
					'param_name' => 'title'
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title Color', 'dent-all' ),
					'param_name' => 'title_color'
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Text Color', 'dent-all' ),
					'param_name' => 'text_color'
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( '"Full Price" Button', 'dent-all' ),
					'param_name' => 'full_price',
					'value'      => array(
						esc_html__( 'Enable', 'dent-all' ) => true
					)
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Category', 'dent-all' ),
					'param_name' => 'category',
					'value'      => $stm_service_categories_array
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Google Map', 'dent-all' ),
			'base'     => 'stm_gmap',
			'icon'     => 'stm_gmap',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Map Width', 'dent-all' ),
					'param_name'  => 'map_width',
					'value'       => '100%',
					'description' => esc_html__( 'Enter map width in px or %', 'dent-all' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Map Height', 'dent-all' ),
					'param_name'  => 'map_height',
					'value'       => '460px',
					'description' => esc_html__( 'Enter map height in px', 'dent-all' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Latitude', 'dent-all' ),
					'param_name'  => 'lat',
					'description' => wp_kses( __( '<a href="http://www.latlong.net/convert-address-to-lat-long.html">Here is a tool</a> where you can find Latitude & Longitude of your location', 'dent-all' ), array( 'a' => array( 'href' => array() ) ))
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Longitude', 'dent-all' ),
					'param_name'  => 'lng',
					'description' => wp_kses( __( '<a href="http://www.latlong.net/convert-address-to-lat-long.html">Here is a tool</a> where you can find Latitude & Longitude of your location', 'dent-all' ), array( 'a' => array( 'href' => array() ) ))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Map Zoom', 'dent-all' ),
					'param_name' => 'map_zoom',
					'value'      => 18
				),
				array(
					'type'       => 'checkbox',
					'param_name' => 'disable_mouse_whell',
					'value'      => array(
						esc_html__( 'Disable map zoom on mouse wheel scroll', 'dent-all' ) => 'disable'
					)
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Extra class name', 'dent-all' ),
					'param_name'  => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'dent-all' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Contacts', 'dent-all' ),
			'base'     => 'stm_contacts_widget',
			'icon'     => 'icon-wpb-wp',
			'category' => esc_html__( 'STM Widgets', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'dent-all' ),
					'param_name' => 'title'
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Address', 'dent-all' ),
					'param_name' => 'address'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Email', 'dent-all' ),
					'param_name' => 'email'
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Phone', 'dent-all' ),
					'param_name' => 'phone'
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Opening Hours', 'dent-all' ),
					'param_name' => 'hours'
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'dent-all' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Style 1', 'dent-all' ) => 'style_1',
						esc_html__( 'Style 2', 'dent-all' ) => 'style_2',
						esc_html__( 'Style 3', 'dent-all' ) => 'style_3'
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		$stm_sidebars_array = get_posts( array( 'post_type' => 'stm_sidebar', 'posts_per_page' => - 1, 'suppress_filters' => '0' ) );
		$stm_sidebars       = array( esc_html__( 'Select', 'dent-all' ) => 0 );
		if ( $stm_sidebars_array ) {
			foreach ( $stm_sidebars_array as $val ) {
				$stm_sidebars[ get_the_title( $val ) ] = $val->ID;
			}
		}

		vc_map( array(
			'name'     => esc_html__( 'STM Sidebar', 'dent-all' ),
			'base'     => 'stm_sidebar',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Sidebar', 'dent-all' ),
					'param_name' => 'sidebar',
					'value'      => $stm_sidebars
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Icon Button', 'dent-all' ),
			'base'     => 'stm_icon_button',
			'icon'     => 'stm_icon_button',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'dent-all' ),
					'param_name' => 'link'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Sub Text', 'dent-all' ),
					'param_name' => 'sub_text',
					'value'      => ''
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'dent-all' ),
					'param_name' => 'icon',
					'value'      => ''
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Size', 'dent-all' ),
					'param_name'  => 'icon_size',
					'value'       => '19',
					'description' => esc_html__( 'Enter icon size in px', 'dent-all' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Height', 'dent-all' ),
					'param_name'  => 'icon_height',
					'value'       => '29',
					'description' => esc_html__( 'Enter icon height in px', 'dent-all' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		vc_map( array(
			'name'                    => esc_html__( 'Opening Hours', 'dent-all' ),
			'base'                    => 'stm_opening_hours',
			'icon'                    => 'stm_opening_hours',
			'as_parent'               => array( 'only' => 'stm_opening_hours_item' ),
			'show_settings_on_create' => false,
			'js_view'                 => 'VcColumnView',
			'category'                => esc_html__( 'STM', 'dent-all' ),
			'params'                  => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css'
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Item', 'dent-all' ),
			'base'     => 'stm_opening_hours_item',
			'as_child' => array( 'only' => 'stm_opening_hours' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Day', 'dent-all' ),
					'param_name' => 'day',
					'value'      => array(
						esc_html__( 'Sunday', 'dent-all' )    => 'sunday',
						esc_html__( 'Monday', 'dent-all' )    => 'monday',
						esc_html__( 'Tuesday', 'dent-all' )   => 'tuesday',
						esc_html__( 'Wednesday', 'dent-all' ) => 'wednesday',
						esc_html__( 'Thursday', 'dent-all' )  => 'thursday',
						esc_html__( 'Friday', 'dent-all' )    => 'friday',
						esc_html__( 'Saturday', 'dent-all' )  => 'saturday'
					)
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Output', 'dent-all' ),
					'param_name' => 'output',
					'value'      => array(
						esc_html__( 'Enable', 'dent-all' ) => 'enable'
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Text 1', 'dent-all' ),
					'param_name' => 'text_1',
					'value'      => esc_html__( 'Output', 'dent-all' ),
					'dependency' => array(
						'element' => 'output',
						'value'   => array( 'enable' )
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Text 2', 'dent-all' ),
					'param_name' => 'text_2',
					'value'      => esc_html__( 'On this day we rest', 'dent-all' ),
					'dependency' => array(
						'element' => 'output',
						'value'   => array( 'enable' )
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Time Format', 'dent-all' ),
					'param_name' => 'time_format',
					'value'      => 'g.ia'
				),
				array(
					'type'       => 'timepicker',
					'heading'    => esc_html__( 'Opening Time', 'dent-all' ),
					'param_name' => 'opening_time',
					'value'      => '8:00',
					'group'      => esc_html__( 'Working Time', 'dent-all' )
				),
				array(
					'type'       => 'timepicker',
					'heading'    => esc_html__( 'Closing Time', 'dent-all' ),
					'param_name' => 'closing_time',
					'value'      => '19:00',
					'group'      => esc_html__( 'Working Time', 'dent-all' )
				),
				array(
					'type'       => 'timepicker',
					'heading'    => esc_html__( 'Start Lunch', 'dent-all' ),
					'param_name' => 'start_lunch',
					'value'      => '13:00',
					'group'      => esc_html__( 'Lunch Time', 'dent-all' )
				),
				array(
					'type'       => 'timepicker',
					'heading'    => esc_html__( 'End Lunch', 'dent-all' ),
					'param_name' => 'end_lunch',
					'value'      => '14:00',
					'group'      => esc_html__( 'Lunch Time', 'dent-all' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Post Bottom Info', 'dent-all' ),
			'base'     => 'stm_post_bottom',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Tags', 'dent-all' ),
					'param_name' => 'tags',
					'value'      => array(
						esc_html__( 'Show', 'dent-all' ) => 'show'
					)
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Share', 'dent-all' ),
					'param_name' => 'share',
					'value'      => array(
						esc_html__( 'Show', 'dent-all' ) => 'show'
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Post Comments', 'dent-all' ),
			'base'     => 'stm_post_comments',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Vacancies', 'dent-all' ),
			'base'     => 'stm_vacancies',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css'
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Price', 'dent-all' ),
			'base'     => 'stm_price',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'dent-all' ),
					'param_name' => 'title'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Price Prefix', 'dent-all' ),
					'param_name' => 'prefix'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Price', 'dent-all' ),
					'param_name' => 'price'
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Text', 'dent-all' ),
					'param_name' => 'text'
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'dent-all' ),
					'param_name' => 'link'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Extra class name', 'dent-all' ),
					'param_name'  => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'dent-all' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		$price_categories_array[ esc_html__( 'All', 'dent-all' ) ] = 'all';
		$price_categories                                = get_terms( 'stm_service_price_category' );
		if ( ! is_wp_error( $price_categories ) ) {
			foreach ( $price_categories as $category ) {
				$price_categories_array[ $category->name ] = $category->slug;
			}
		}

		vc_map( array(
			'name'     => esc_html__( 'Service Price', 'dent-all' ),
			'base'     => 'stm_service_price',
			'category' => esc_html__( 'STM', 'dent-all' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Category', 'dent-all' ),
					'param_name' => 'category',
					'value'      => $price_categories_array
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				)
			)
		) );

		$testimonials_categories_terms = get_terms('testimonial_categories');
		$story_categories_array = array();

		if( ! is_wp_error( $testimonials_categories_terms ) ) {
			$story_categories_array[esc_html__('Select category', 'dent-all' )] = 0;
			foreach($testimonials_categories_terms as $testimonials_categories_term) {
				$story_categories_array[$testimonials_categories_term->name] = $testimonials_categories_term->slug;
			}
		}

		$story_categories_array[ esc_html__( 'All', 'dent-all' ) ] = 'all';
		$story_categories_categories = get_terms( 'stm_story_category' );
		if ( ! is_wp_error( $story_categories_categories ) ) {
			foreach ( $story_categories_categories as $category ) {
				$story_categories_array[ $category->name ] = $category->slug;
			}
		}

		vc_map( array(
			'name'     => esc_html__( 'Success Stories', 'dent-all' ),
			'base'     => 'stm_stories',
			'category' => esc_html__( 'STM', 'dent-all' ),
			"params"   => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Story count', 'dent-all' ),
					'param_name' => 'count'
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Category', 'dent-all' ),
					'param_name' => 'category',
					'value'      => $story_categories_array
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Images Size', 'dent-all' ),
					'param_name'  => 'img_size',
					'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'dent-all' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dent-all' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dent-all' )
				),

			),
		) );


	}
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Stm_Opening_Hours extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Stm_Icon_Box extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Image_Carousel extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Stats_Counter extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Testimonials extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Testimonials_2 extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Staff_Carousel extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Pricing_Tabs extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Gmap extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Contacts_Widget extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Sidebar extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Icon_Button extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Opening_Hours_Item extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Staff_List extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Post_Bottom extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Post_Comments extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Vacancies extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Price extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Service_Price extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Stories extends WPBakeryShortCode {
	}
}

add_filter( 'vc_iconpicker-type-fontawesome', 'vc_stm_icons' );

if( ! function_exists( 'vc_stm_icons' ) ){
	function vc_stm_icons( $fonts ) {
		global $wp_filesystem;
		$icons = json_decode( $wp_filesystem->get_contents( get_template_directory() . '/assets/js/icomoon-selection.json' ), true );

		foreach ( $icons['icons'] as $icon ) {
			$fonts['DentAll Icons'][] = array(
				"stm-icon-" . $icon['properties']['name'] => 'STM ' . $icon['properties']['name']
			);
		}

		return $fonts;
	}
}