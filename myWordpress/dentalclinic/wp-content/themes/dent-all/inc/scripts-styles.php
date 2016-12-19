<?php

global $theme_info;
$theme_info = wp_get_theme();
define( 'STM_THEME_VERSION', ( WP_DEBUG ) ? time() : $theme_info->get( 'Version' ) );

add_action( 'wp_loaded', 'stm_register_all_scripts' );

if( ! function_exists( 'stm_register_all_scripts' ) ){
	function stm_register_all_scripts() {
		$google_api_key = stm_option( 'google_api_key', false );

		/* Register Styles */
		wp_register_style( 'stm_theme-style', get_stylesheet_uri(), null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_bootstrap.min.css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_font-awesome.min.css', get_template_directory_uri() . '/assets/css/font-awesome.min.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_stm-icomoon.css', get_template_directory_uri() . '/assets/css/stm-icomoon.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_slick.css', get_template_directory_uri() . '/assets/css/slick.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_jquery.fancybox.css', get_template_directory_uri() . '/assets/css/jquery.fancybox.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_jquery-ui.min.css', get_template_directory_uri() . '/assets/css/jquery-ui.min.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_jquery-ui.datepicker.min.css', get_template_directory_uri() . '/assets/css/jquery-ui.datepicker.min.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_jquery-ui.slider.min.css', get_template_directory_uri() . '/assets/css/jquery-ui.slider.min.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_jquery-ui-timepicker-addon.min.css', get_template_directory_uri() . '/assets/css/jquery-ui-timepicker-addon.min.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_jquery.fonticonpicker.min.css', get_template_directory_uri() . '/assets/css/jquery.fonticonpicker.min.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_jquery.fonticonpicker.darkgrey.min.css', get_template_directory_uri() . '/assets/css/jquery.fonticonpicker.darkgrey.min.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_select2.css', get_template_directory_uri() . '/assets/css/select2.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_frontend_customizer', get_template_directory_uri() . '/assets/css/frontend_customizer.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_skin_2', get_template_directory_uri() . '/assets/css/skin_2.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_skin_3', get_template_directory_uri() . '/assets/css/skin_3.css', null, STM_THEME_VERSION, 'all' );
		wp_register_style( 'stm_skin_4', get_template_directory_uri() . '/assets/css/skin_4.css', null, STM_THEME_VERSION, 'all' );

		/* Register Scripts */
		wp_register_script( 'stm_bootstrap.min.js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
		wp_register_script( 'stm_custom.js', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), STM_THEME_VERSION, true );
		wp_register_script( 'stm_slick.min.js', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
		wp_register_script( 'stm_jquery.fancybox.pack.js', get_template_directory_uri() . '/assets/js/jquery.fancybox.pack.js', array( 'jquery' ), STM_THEME_VERSION, true );
		wp_register_script( 'stm_countUp.min.js', get_template_directory_uri() . '/assets/js/countUp.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
		wp_register_script( 'stm_jquery-ui-timepicker-addon.min.js', get_template_directory_uri() . '/assets/js/jquery-ui-timepicker-addon.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
		if( !empty($google_api_key) )
			wp_register_script( 'stm_gmap', 'https://maps.googleapis.com/maps/api/js?key='.$google_api_key.'&sensor=false', array( 'jquery' ), STM_THEME_VERSION, true );
		else
			wp_register_script( 'stm_gmap', 'https://maps.googleapis.com/maps/api/js?sensor=false', array( 'jquery' ), STM_THEME_VERSION, true );
		wp_register_script( 'stm_jquery.fonticonpicker.min.js', get_template_directory_uri() . '/assets/js/jquery.fonticonpicker.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
		wp_register_script( 'stm_select2.min.js', get_template_directory_uri() . '/assets/js/select2.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
		wp_register_script( 'stm_jquery.tablesorter.min.js', get_template_directory_uri() . '/assets/js/jquery.tablesorter.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
		wp_register_script( 'stm_jquery.cookie.min.js', get_template_directory_uri() . '/assets/js/jquery.cookie.min.js', array( 'jquery' ), STM_THEME_VERSION, true );

	}
}

add_action( 'wp_enqueue_scripts', 'stm_load_theme_scripts_and_styles' );

if( ! function_exists( 'stm_load_theme_scripts_and_styles' ) ){
	function stm_load_theme_scripts_and_styles() {

		/* Enqueue Styles */
		wp_enqueue_style( 'stm_bootstrap.min.css' );
		wp_enqueue_style( 'stm_font-awesome.min.css' );
		wp_enqueue_style( 'stm_stm-icomoon.css' );
		wp_enqueue_style( 'stm_jquery-ui.min.css' );
		wp_enqueue_style( 'stm_jquery-ui.datepicker.min.css' );
		wp_enqueue_style( 'stm_jquery-ui.slider.min.css' );
		wp_enqueue_style( 'stm_jquery-ui-timepicker-addon.min.css' );
		wp_enqueue_style( 'stm_jquery.fancybox.css' );
		wp_enqueue_style( 'stm_select2.css' );
		wp_enqueue_style( 'stm_theme-style' );

		if ( stm_option( 'frontend_customizer' ) ) {
			wp_enqueue_style( 'stm_frontend_customizer' );
			wp_enqueue_style( 'stm_skin_2' );
			wp_enqueue_style( 'stm_skin_3' );
			wp_enqueue_style( 'stm_skin_4' );

			wp_enqueue_script( 'stm_jquery.cookie.min.js' );
		} else {
			if ( stm_option( 'color_skin' ) ) {
				wp_enqueue_style( 'stm_' . stm_option( 'color_skin' ) );
			}
		}

		/* Enqueue Scripts */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'stm_bootstrap.min.js' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'stm_jquery-ui-timepicker-addon.min.js' );
		wp_enqueue_script( 'stm_jquery.fancybox.pack.js' );
		wp_enqueue_script( 'stm_select2.min.js' );
		wp_enqueue_script( 'stm_custom.js' );

	}
}

if( ! function_exists( 'stm_admin_styles' ) ){
	function stm_admin_styles() {

		wp_enqueue_style( 'stm_admin.css', get_template_directory_uri() . '/assets/css/admin.css', null, STM_THEME_VERSION, 'all' );
		wp_enqueue_style( 'stm_jquery.fonticonpicker.min.css' );
		wp_enqueue_style( 'stm_jquery.fonticonpicker.darkgrey.min.css' );
		wp_enqueue_style( 'stm_jquery-ui.min.css' );
		wp_enqueue_style( 'stm_jquery-ui.datepicker.min.css' );
		wp_enqueue_style( 'stm_jquery-ui.slider.min.css' );
		wp_enqueue_style( 'stm_jquery-ui-timepicker-addon.min.css' );
		wp_enqueue_style( 'stm_stm-icomoon.css' );

		wp_enqueue_script( 'stm_jquery.fonticonpicker.min.js' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'stm_jquery-ui-timepicker-addon.min.js' );

	}
}

add_action( 'admin_enqueue_scripts', 'stm_admin_styles' );
