<?php

if( ! function_exists( 'stm_post_types_init' ) ){
	function stm_post_types_init() {

		$defaultPostTypesOptions = array(
			'stm_service'       => array(
				'title'        => stm_option( 'post_type_services_title', esc_html__( 'Service', 'dent-all' ) ),
				'plural_title' => stm_option( 'post_type_services_plural', esc_html__( 'Services', 'dent-all' ) ),
				'rewrite'      => stm_option( 'post_type_services_rewrite', 'services' ),
				'icon'         => 'dashicons-clipboard',
				'redux'        => 'post_type_services',
				'supports'     => array( 'title', 'thumbnail', 'editor', 'excerpt' )
			),
			'stm_service_price' => array(
				'title'               => esc_html__( 'Price', 'dent-all' ),
				'plural_title'        => esc_html__( 'Service Prices', 'dent-all' ),
				'show'                => true,
				'icon'                => 'dashicons-list-view',
				'redux'               => '',
				'supports'            => array( 'title', 'excerpt' ),
				'exclude_from_search' => true,
				'publicly_queryable'  => false
			),
			'stm_staff'         => array(
				'title'        => stm_option( 'post_type_staff_title', esc_html__( 'Staff', 'dent-all' ) ),
				'plural_title' => stm_option( 'post_type_staff_plural', esc_html__( 'Staff', 'dent-all' ) ),
				'rewrite'      => stm_option( 'post_type_staff_rewrite', 'staff' ),
				'icon'         => 'dashicons-groups',
				'redux'        => 'post_type_staff',
				'supports'     => array( 'title', 'thumbnail', 'editor', 'excerpt' )
			),
			'stm_testimonial'   => array(
				'title'        => stm_option( 'post_type_testimonials_title', esc_html__( 'Testimonial', 'dent-all' ) ),
				'plural_title' => stm_option( 'post_type_testimonials_plural', esc_html__( 'Testimonials', 'dent-all' ) ),
				'rewrite'      => stm_option( 'post_type_testimonials_rewrite', 'testimonials' ),
				'icon'         => 'dashicons-testimonial',
				'redux'        => 'post_type_testimonials',
				'supports'     => array( 'title', 'excerpt' )
			),
			'stm_sidebar'       => array(
				'title'               => esc_html__( 'Sidebar', 'dent-all' ),
				'plural_title'        => esc_html__( 'Sidebars', 'dent-all' ),
				'show'                => true,
				'redux'               => '',
				'icon'                => 'dashicons-schedule',
				'supports'            => array( 'title', 'editor' ),
				'exclude_from_search' => true,
				'publicly_queryable'  => false
			),
			'stm_vacancy'       => array(
				'title'        => stm_option( 'post_type_vacancies_title', esc_html__( 'Vacancy', 'dent-all' ) ),
				'plural_title' => stm_option( 'post_type_vacancies_plural', esc_html__( 'Vacancies', 'dent-all' ) ),
				'rewrite'      => stm_option( 'post_type_vacancies_rewrite', 'vacancies' ),
				'icon'         => 'dashicons-id',
				'redux'        => 'post_type_vacancies',
				'supports'     => array( 'title', 'editor' )
			),
			'stm_story'       => array(
				'title'        => stm_option( 'post_type_story_title', esc_html__( 'Success Story', 'dent-all' ) ),
				'plural_title' => stm_option( 'post_type_story_plural', esc_html__( 'Success Stories', 'dent-all' ) ),
				'rewrite'      => stm_option( 'post_type_story_rewrite', 'story' ),
				'icon'         => 'dashicons-portfolio',
				'redux'        => 'post_type_stories',
				'supports'     => array( 'title', 'excerpt' ),
				'exclude_from_search' => true,
				'publicly_queryable'  => false
			)
		);

		foreach ( $defaultPostTypesOptions as $post_type => $data ) {
			$args = array();

			if ( ! empty( $data['plural_title'] ) ) {
				$args['pluralTitle'] = $data['plural_title'];
			}
			if ( ! empty( $data['icon'] ) ) {
				$args['menu_icon'] = $data['icon'];
			}
			if ( ! empty( $data['rewrite'] ) ) {
				$args['rewrite'] = array( 'slug' => $data['rewrite'] );
			}
			if ( ! empty( $data['supports'] ) ) {
				$args['supports'] = $data['supports'];
			}
			if ( ! empty( $data['exclude_from_search'] ) ) {
				$args['exclude_from_search'] = $data['exclude_from_search'];
			}
			if ( ! empty( $data['publicly_queryable'] ) ) {
				$args['publicly_queryable'] = $data['publicly_queryable'];
			}
			if ( ! empty( $data['show_in_menu'] ) ) {
				$args['show_in_menu'] = $data['show_in_menu'];
			}
			if ( isset( $data['show'] ) || stm_option( $data['redux'] ) && stm_option( $data['redux'] ) ) {
				STM_PostType::registerPostType( $post_type, esc_html( $data['title'] ), $args );
			}
		}

		STM_PostType::addTaxonomy( 'stm_service_category', esc_html__( 'Categories', 'dent-all' ), 'stm_service' );
		STM_PostType::addTaxonomy( 'stm_service_price_category', esc_html__( 'Categories', 'dent-all' ), 'stm_service_price' );
		STM_PostType::addTaxonomy( 'stm_story_category', esc_html__( 'Categories', 'dent-all' ), 'stm_story' );

		STM_PostType::addMetaBox( 'stm_info', esc_html__( 'Information', 'dent-all' ), array( 'stm_testimonial', 'stm_staff' ), '', '', '', array(
			'fields' => array(
				'position' => array(
					'label' => esc_html__( 'Position', 'dent-all' ),
					'type'  => 'text'
				)
			)
		) );

		STM_PostType::addMetaBox( 'stm_staff_contacts', esc_html__( 'Contacts', 'dent-all' ), array( 'stm_staff' ), '', '', '', array(
			'fields' => array(
				'email'    => array(
					'label' => esc_html__( 'E-mail', 'dent-all' ),
					'type'  => 'text'
				),
				'facebook' => array(
					'label' => esc_html__( 'Facebook', 'dent-all' ),
					'type'  => 'text'
				),
				'twitter'  => array(
					'label' => esc_html__( 'Twitter', 'dent-all' ),
					'type'  => 'text'
				)
			)
		) );

		$services_array = get_posts( array( 'post_type' => 'stm_service', 'posts_per_page' => - 1 ) );
		$services       = array();
		foreach ( $services_array as $service ) {
			$services[ $service->ID ] = get_the_title( $service->ID );
		}

		STM_PostType::addMetaBox( 'stm_price', esc_html__( 'Information', 'dent-all' ), array( 'stm_service_price' ), '', '', '', array(
			'fields' => array(
				'featured'   => array(
					'label' => esc_html__( 'Featured', 'dent-all' ),
					'type'  => 'checkbox'
				),
				'service'    => array(
					'label'   => esc_html__( 'Service', 'dent-all' ),
					'type'    => 'select',
					'options' => $services
				),
				'price'      => array(
					'label' => esc_html__( 'Price', 'dent-all' ),
					'type'  => 'text'
				),
				'sale_price' => array(
					'label' => esc_html__( 'Sale Price', 'dent-all' ),
					'type'  => 'text'
				)
			)
		) );

		STM_PostType::addMetaBox( 'service_info', esc_html__( 'Options', 'dent-all' ), array( 'stm_service' ), '', '', '', array(
			'fields' => array(
				'icon' => array(
					'label' => esc_html__( 'Icon', 'dent-all' ),
					'type'  => 'iconpicker'
				)
			)
		) );

		STM_PostType::addMetaBox( 'page_options', esc_html__( 'Page Options', 'dent-all' ), array( 'page', 'stm_vacancy', 'stm_service' ), '', '', '', array(
			'fields' => array(
				'title'                     => array(
					'label'   => esc_html__( 'Title', 'dent-all' ),
					'type'    => 'select',
					'options' => array(
						'show' => esc_html__( 'Show', 'dent-all' ),
						'hide' => esc_html__( 'Hide', 'dent-all' )
					)
				),
				'separator_breadcrumbs'     => array(
					'label' => esc_html__( 'Breadcrumbs', 'dent-all' ),
					'type'  => 'separator'
				),
				'breadcrumbs'               => array(
					'label'   => esc_html__( 'Breadcrumbs', 'dent-all' ),
					'type'    => 'select',
					'options' => array(
						'show' => esc_html__( 'Show', 'dent-all' ),
						'hide' => esc_html__( 'Hide', 'dent-all' )
					)
				),
				'breadcrumbs_font_color'    => array(
					'label' => esc_html__( 'Breadcrumbs Color', 'dent-all' ),
					'type'  => 'color_picker'
				),
				'separator_title_box'       => array(
					'label' => esc_html__( 'Title Box', 'dent-all' ),
					'type'  => 'separator'
				),
				'title_box_bg_color'        => array(
					'label' => esc_html__( 'Background Color', 'dent-all' ),
					'type'  => 'color_picker'
				),
				'title_box_font_color'      => array(
					'label' => esc_html__( 'Font Color', 'dent-all' ),
					'type'  => 'color_picker'
				),
				'title_box_custom_bg_image' => array(
					'label' => esc_html__( 'Custom Background Image', 'dent-all' ),
					'type'  => 'image'
				),
				'title_box_bg_position'     => array(
					'label' => esc_html__( 'Background Position', 'dent-all' ),
					'type'  => 'text'
				),
				'title_box_bg_size'         => array(
					'label' => esc_html__( 'Background Size', 'dent-all' ),
					'type'  => 'text'
				),
				'title_box_bg_repeat'       => array(
					'label'   => esc_html__( 'Background Repeat', 'dent-all' ),
					'type'    => 'select',
					'options' => array(
						'repeat'    => esc_html__( 'Repeat', 'dent-all' ),
						'no-repeat' => esc_html__( 'No Repeat', 'dent-all' ),
						'repeat-x'  => esc_html__( 'Repeat-X', 'dent-all' ),
						'repeat-y'  => esc_html__( 'Repeat-Y', 'dent-all' )
					)
				),
			)
		) );

		STM_PostType::addMetaBox( 'page_options', esc_html__( 'Page Options', 'dent-all' ), array( 'post' ), '', '', '', array(
			'fields' => array(
				'title'                     => array(
					'label'   => esc_html__( 'Title', 'dent-all' ),
					'type'    => 'select',
					'options' => array(
						'show' => esc_html__( 'Show', 'dent-all' ),
						'hide' => esc_html__( 'Hide', 'dent-all' )
					)
				),
				'style'                     => array(
					'label'   => esc_html__( 'Style', 'dent-all' ),
					'type'    => 'select',
					'options' => array(
						'style_1' => esc_html__( 'Style 1', 'dent-all' ),
						'style_2' => esc_html__( 'Style 2', 'dent-all' )
					)
				),
				'post_info'                 => array(
					'label'   => esc_html__( 'Post Info', 'dent-all' ),
					'type'    => 'select',
					'options' => array(
						'show' => esc_html__( 'Show', 'dent-all' ),
						'hide' => esc_html__( 'Hide', 'dent-all' )
					)
				),
				'separator_breadcrumbs'     => array(
					'label' => esc_html__( 'Breadcrumbs', 'dent-all' ),
					'type'  => 'separator'
				),
				'breadcrumbs'               => array(
					'label'   => esc_html__( 'Breadcrumbs', 'dent-all' ),
					'type'    => 'select',
					'options' => array(
						'show' => esc_html__( 'Show', 'dent-all' ),
						'hide' => esc_html__( 'Hide', 'dent-all' )
					)
				),
				'breadcrumbs_font_color'    => array(
					'label' => esc_html__( 'Breadcrumbs Color', 'dent-all' ),
					'type'  => 'color_picker'
				),
				'separator_title_box'       => array(
					'label' => esc_html__( 'Title Box', 'dent-all' ),
					'type'  => 'separator'
				),
				'title_box_bg_color'        => array(
					'label' => esc_html__( 'Background Color', 'dent-all' ),
					'type'  => 'color_picker'
				),
				'title_box_font_color'      => array(
					'label' => esc_html__( 'Font Color', 'dent-all' ),
					'type'  => 'color_picker'
				),
				'title_box_custom_bg_image' => array(
					'label' => esc_html__( 'Custom Background Image', 'dent-all' ),
					'type'  => 'image'
				),
				'title_box_bg_position'     => array(
					'label' => esc_html__( 'Background Position', 'dent-all' ),
					'type'  => 'text'
				),
				'title_box_bg_size'         => array(
					'label' => esc_html__( 'Background Size', 'dent-all' ),
					'type'  => 'text'
				),
				'title_box_bg_repeat'       => array(
					'label'   => esc_html__( 'Background Repeat', 'dent-all' ),
					'type'    => 'select',
					'options' => array(
						'repeat'    => esc_html__( 'Repeat', 'dent-all' ),
						'no-repeat' => esc_html__( 'No Repeat', 'dent-all' ),
						'repeat-x'  => esc_html__( 'Repeat-X', 'dent-all' ),
						'repeat-y'  => esc_html__( 'Repeat-Y', 'dent-all' )
					)
				),
			)
		) );

		STM_PostType::addMetaBox( 'vacancy_info', esc_html__( 'Options', 'dent-all' ), array( 'stm_vacancy' ), '', '', '', array(
			'fields' => array(
				'vacancy_location'   => array(
					'label' => esc_html__( 'Location', 'dent-all' ),
					'type'  => 'text'
				),
				'vacancy_department' => array(
					'label' => esc_html__( 'Department', 'dent-all' ),
					'type'  => 'text'
				)
			)
		) );

		STM_PostType::addMetaBox( 'story_details', esc_html__( 'Story Details', 'dent-all' ), array( 'stm_story' ), '', '', '', array(
			'fields' => array(
				'story_author' => array(
					'label'   => esc_html__( 'Author', 'dent-all' ),
					'type'    => 'text',
				),
				'story_short_desc' => array(
					'label'   => esc_html__( 'Description', 'dent-all' ),
					'type'    => 'textarea',
				),
				'story_photo_before' => array(
					'label'   => esc_html__( 'Before', 'dent-all' ),
					'type'    => 'image',
				),
				'story_photo_after' => array(
					'label'   => esc_html__( 'After', 'dent-all' ),
					'type'    => 'image',
				),
			)
		) );

	}
}

add_action( 'redux/loaded', 'stm_post_types_init' );