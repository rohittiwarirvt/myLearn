<?php

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "stm_option";

$theme = wp_get_theme();

$args = array(
	// TYPICAL -> Change these values as you need/desire
	'opt_name'             => $opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'display_name'         => $theme->get( 'Name' ),
	// Name that appears at the top of your panel
	'display_version'      => $theme->get( 'Version' ),
	// Version that appears at the top of your panel
	'menu_type'            => 'menu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'       => true,
	// Show the sections below the admin menu item or not
	'menu_title'           => esc_html__( 'Theme Options', 'dent-all' ),
	'page_title'           => esc_html__( 'Theme Options', 'dent-all' ),
	// You will need to generate a Google API key to use this feature.
	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	'google_api_key'       => '',
	// Set it you want google fonts to update weekly. A google_api_key value is required.
	'google_update_weekly' => false,
	// Must be defined to add google fonts to the typography module
	'async_typography'     => true,
	// Use a asynchronous font on the front end or font string
	//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
	'admin_bar'            => true,
	// Show the panel pages on the admin bar
	'admin_bar_icon'       => 'dashicons-admin-generic',
	// Choose an icon for the admin bar menu
	'admin_bar_priority'   => 50,
	// Choose an priority for the admin bar menu
	'global_variable'      => '',
	// Set a different name for your global variable other than the opt_name
	'dev_mode'             => false,
	// Show the time the page took to load, etc
	'update_notice'        => false,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'           => false,
	// Enable basic customizer support
	//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
	//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

	// OPTIONAL -> Give you extra features
	'page_priority'        => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'          => 'themes.php',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'     => 'manage_options',
	// Permissions needed to access the options panel.
	'menu_icon'            => '',
	// Specify a custom URL to an icon
	'last_tab'             => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon'            => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug'            => '',
	// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
	'save_defaults'        => true,
	// On load save the defaults to DB before user clicks save or not
	'default_show'         => false,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark'         => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'   => true,
	// Shows the Import/Export panel when not used as a field.

	// CAREFUL -> These options are for advanced use only
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'           => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'             => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'use_cdn'              => true,
	// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
);

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
$args['share_icons'][] = array(
	'url'   => 'https://www.facebook.com/stylemixthemes',
	'title' => 'Like us on Facebook',
	'icon'  => 'el el-facebook'
);
$args['share_icons'][] = array(
	'url'   => 'https://twitter.com/stylemix_themes',
	'title' => 'Follow us on Twitter',
	'icon'  => 'el el-twitter'
);
$args['share_icons'][] = array(
	'url'   => 'https://www.behance.net/stylemixthemes',
	'title' => 'Find us on Behance',
	'icon'  => 'el el-behance'
);

Redux::setArgs( $opt_name, $args );


// -> START Basic Fields
Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'General', 'dent-all' ),
	'fields' => array(
		array(
			'id'       => 'logo',
			'url'      => false,
			'type'     => 'media',
			'title'    => esc_html__( 'Site Logo', 'dent-all' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/logo.png' ),
			'subtitle' => esc_html__( 'Upload your logo file here.', 'dent-all' ),
		),
		array(
			'id'       => 'favicon',
			'url'      => false,
			'type'     => 'media',
			'title'    => esc_html__( 'Site Favicon', 'dent-all' ),
			'default'  => '',
			'subtitle' => esc_html__( 'Upload a 16px x 16px .png or .gif image here', 'dent-all' ),
		),
		array(
			'title'   => esc_html__( 'Enable Frontend Customizer', 'dent-all' ),
			'id'      => 'frontend_customizer',
			'type'    => 'switch',
			'default' => false
		),
		array(
			'title'    => esc_html__( 'Google API Key', 'dent-all' ),
			'id'       => 'google_api_key',
			'type'     => 'text',
			'description'  => esc_html__( 'Enter here the secret api key you have created on Google APIs. You can enable MAP API in Google APIs > Google Maps APIs > Google Maps JavaScript API.', 'dent-all' ),
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Header', 'dent-all' ),
	'icon'  => 'el-icon-file',
	'fields' => array(
		array(
			'id'      => 'nav_mode',
			'type'    => 'button_set',
			'title'   => __( 'Navigation Mode', 'dental' ),
			'default' => 'top',
			'options' => array(
				'top'  => __( 'Top', 'dental' ),
				'left' => __( 'Left', 'dental' )
			),
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Top Nav', 'dent-all' ),
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'logo_dimensions',
			'type'    => 'dimensions',
			'title'   => esc_html__( 'Logo Dimensions (px)', 'dent-all' ),
			'output'  => array( '.top_nav .logo img, .left_nav .logo img' ),
			'units'   => 'px',
			'default' => array(
				'width'  => '172px',
				'height' => '60px'
			)
		),
		array(
			'id'             => 'logo_margin',
			'type'           => 'spacing',
			'output'         => array( '.top_nav .logo' ),
			'mode'           => 'padding',
			'units'          => array( 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Logo Padding', 'dent-all' ),
			'subtitle'       => '',
			'desc'           => esc_html__( 'Set your logo padding in px. Just use the number', 'dent-all' ),
			'default'        => array(
				'units' => 'px',
			)

		),
		array(
			'id'             => 'top_nav_margin',
			'type'           => 'spacing',
			'output'         => array( '.top_nav ul.top_nav_menu' ),
			'mode'           => 'padding',
			'units'          => array( 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Top Nav Padding', 'dent-all' ),
			'subtitle'       => '',
			'desc'           => esc_html__( 'Set your top nav padding in px. Just use the number', 'dent-all' ),
			'default'        => array(
				'units' => 'px',
			)

		),
		array(
			'title'   => esc_html__( 'Sticky', 'dent-all' ),
			'id'      => 'sticky',
			'type'    => 'switch',
			'default' => false
		),
		array(
			'id'      => 'sticky_logo_dimensions',
			'type'    => 'dimensions',
			'title'   => esc_html__( 'Sticky Logo Dimensions (px)', 'dent-all' ),
			'output'  => array( 'body.sticky_header .top_nav.affix img' ),
			'units'   => 'px',
			'default' => array(
				'width'  => '142px',
				'height' => '50px'
			)
		),
		array(
			'id'             => 'sticky_logo_margin',
			'type'           => 'spacing',
			'output'         => array( 'body.sticky_header .top_nav.affix .logo' ),
			'mode'           => 'padding',
			'units'          => array( 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Sticky Logo Padding', 'dent-all' ),
			'subtitle'       => '',
			'desc'           => esc_html__( 'Set your logo padding in px. Just use the number', 'dent-all' ),
			'default'        => array(
				'units' => 'px',
			)
		),
		array(
			'id'             => 'sticky_top_nav_margin',
			'type'           => 'spacing',
			'output'         => array( 'body.sticky_header .top_nav.affix ul.top_nav_menu' ),
			'mode'           => 'padding',
			'units'          => array( 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Sticky Top Nav Padding', 'dent-all' ),
			'subtitle'       => '',
			'desc'           => esc_html__( 'Set your top nav padding in px. Just use the number', 'dent-all' ),
			'default'        => array(
				'units' => 'px',
			)
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Top Bar', 'dent-all' ),
	'subsection' => true,
	'fields'     => array(
		array(
			'title'   => esc_html__( 'Enable Top Bar', 'dent-all' ),
			'id'      => 'top_bar',
			'type'    => 'switch',
			'default' => true
		),
		array(
			'title'    => esc_html__( 'Top Bar Label', 'dent-all' ),
			'id'       => 'top_bar_label',
			'type'     => 'text',
			'default'  => esc_html__( 'Dentist in San Franc', 'dent-all' ),
			'required' => array(
				array( 'top_bar', '=', true )
			),
		),
		array(
			'id'       => 'top_bar_wpml',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable Top Bar WPML Switcher', 'dent-all' ),
			'default'  => true,
			'required' => array(
				array( 'top_bar', '=', true )
			),
		),
		array(
			'id'       => 'top_bar_search',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable Top Bar Search Form', 'dent-all' ),
			'default'  => true,
			'required' => array(
				array( 'top_bar', '=', true )
			),
		),
		array(
			'id'       => 'top_bar_social',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable Top Bar Social Media icons', 'dent-all' ),
			'default'  => true,
			'required' => array(
				array( 'top_bar', '=', true )
			),
		),
		array(
			'id'       => 'top_bar_use_social',
			'type'     => 'checkbox',
			'title'    => esc_html__( 'Select Social Media Icons to display', 'dent-all' ),
			'subtitle' => esc_html__( 'The urls for your social media icons will be taken from Social Media settings tab.', 'dent-all' ),
			'required' => array(
				array( 'top_bar_social', '=', true ),
				array( 'top_bar', '=', true )
			),
			'default'  => array(
				'facebook'  => '1',
				'twitter'   => '1',
				'instagram' => '1',
				'linkedin'  => '1'
			),
			'options'  => array(
				'facebook'   => 'Facebook',
				'twitter'    => 'Twitter',
				'instagram'  => 'Instagram',
				'behance'    => 'Behance',
				'dribbble'   => 'Dribbble',
				'flickr'     => 'Flickr',
				'git'        => 'Git',
				'linkedin'   => 'Linkedin',
				'pinterest'  => 'Pinterest',
				'yahoo'      => 'Yahoo',
				'delicious'  => 'Delicious',
				'dropbox'    => 'Dropbox',
				'reddit'     => 'Reddit',
				'soundcloud' => 'Soundcloud',
				'google'     => 'Google',
				'skype'      => 'Skype',
				'youtube'    => 'Youtube',
				'tumblr'     => 'Tumblr',
				'whatsapp'   => 'Whatsapp',
			),
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Top Info', 'dent-all' ),
	'subsection' => true,
	'fields'     => array(
		array(
			'title'   => esc_html__( 'Enable Top Info', 'dent-all' ),
			'id'      => 'top_info_show',
			'type'    => 'switch',
			'default' => true
		),
		array(
			'id'     => 'top_info_left_section_start',
			'type'   => 'section',
			'title'  => esc_html__( 'Left', 'dent-all' ),
			'indent' => true
		),
		array(
			'id'       => 'top_info_left_icon',
			'type'     => 'callback',
			'title'    => esc_html__( 'Icon', 'dent-all' ),
			'callback' => 'stm_iconpicker',
			'default'  => 'stm-icon-roundels'
		),
		array(
			'id'      => 'top_info_left_label',
			'type'    => 'text',
			'title'   => esc_html__( 'Label', 'dent-all' ),
			'default' => esc_html__( 'Call Today 020 8567 0707', 'dent-all' )
		),
		array(
			'id'      => 'top_info_left_value',
			'type'    => 'text',
			'title'   => esc_html__( 'Value', 'dent-all' ),
			'default' => esc_html__( '51 Uxbridge Road, San Francisco W7 3PX', 'dent-all' )
		),
		array(
			'id'    => 'top_info_left_link',
			'type'  => 'text',
			'title' => esc_html__( 'Link', 'dent-all' )
		),
		array(
			'id'     => 'top_info_left_section_end',
			'type'   => 'section',
			'indent' => false
		),
		array(
			'id'     => 'top_info_center_section_start',
			'type'   => 'section',
			'title'  => esc_html__( 'Center', 'dent-all' ),
			'indent' => true
		),
		array(
			'id'       => 'top_info_center_icon',
			'type'     => 'callback',
			'title'    => esc_html__( 'Icon', 'dent-all' ),
			'callback' => 'stm_iconpicker',
			'default'  => 'stm-icon-clock'
		),
		array(
			'id'      => 'top_info_center_label',
			'type'    => 'text',
			'title'   => esc_html__( 'Label', 'dent-all' ),
			'default' => esc_html__( 'Open Hours', 'dent-all' )
		),
		array(
			'id'      => 'top_info_center_value',
			'type'    => 'text',
			'title'   => esc_html__( 'Value', 'dent-all' ),
			'default' => esc_html__( 'Mon - Sat 8.00 - 18.00  Sunday CLOSED', 'dent-all' )
		),
		array(
			'id'    => 'top_info_center_link',
			'type'  => 'text',
			'title' => esc_html__( 'Link', 'dent-all' )
		),
		array(
			'id'     => 'top_info_center_section_end',
			'type'   => 'section',
			'indent' => false
		),
		array(
			'id'     => 'top_info_right_section_start',
			'type'   => 'section',
			'title'  => esc_html__( 'Right', 'dent-all' ),
			'indent' => true
		),
		array(
			'id'       => 'top_info_right_icon',
			'type'     => 'callback',
			'title'    => esc_html__( 'Icon', 'dent-all' ),
			'callback' => 'stm_iconpicker',
			'default'  => 'stm-icon-calculator'
		),
		array(
			'id'      => 'top_info_right_label',
			'type'    => 'text',
			'title'   => esc_html__( 'Label', 'dent-all' ),
			'default' => esc_html__( 'Make an Appointment', 'dent-all' )
		),
		array(
			'id'      => 'top_info_right_value',
			'type'    => 'text',
			'title'   => esc_html__( 'Value', 'dent-all' ),
			'default' => esc_html__( 'It`s so fast', 'dent-all' )
		),
		array(
			'id'      => 'top_info_right_link',
			'type'    => 'text',
			'title'   => esc_html__( 'Link', 'dent-all' ),
			'default' => '#'
		),
		array(
			'id'     => 'top_info_right_section_end',
			'type'   => 'section',
			'indent' => false
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => esc_html__( 'Blog', 'dent-all' ),
	'desc'    => '',
	'icon'    => 'el-icon-pencil',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'blog_layout',
			'type'    => 'button_set',
			'options' => array(
				'grid' => esc_html__( 'Grid view', 'dent-all' ),
				'list' => esc_html__( 'List view', 'dent-all' )
			),
			'default' => 'list',
			'title'   => esc_html__( 'Blog Layout', 'dent-all' )
		),
		array(
			'id'      => 'blog_sidebar_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Sidebar', 'dent-all' ),
			'options' => array(
				'wp' => esc_html__( 'Wordpress Sidebars', 'dent-all' ),
				'vc' => esc_html__( 'VC Sidebars', 'dent-all' )
			),
			'default' => 'wp'
		),
		array(
			'id'       => 'blog_wp_sidebar',
			'type'     => 'select',
			'data'     => 'sidebar',
			'title'    => esc_html__( 'Sidebar', 'dent-all' ),
			'required' => array(
				array( 'blog_sidebar_type', '=', 'wp' )
			),
			'default'  => 'right_sidebar'
		),
		array(
			'id'       => 'blog_vc_sidebar',
			'type'     => 'select',
			'data'     => 'posts',
			'args'     => array( 'post_type' => array( 'stm_sidebar' ), 'posts_per_page' => - 1 ),
			'title'    => esc_html__( 'Sidebar', 'dent-all' ),
			'required' => array(
				array( 'blog_sidebar_type', '=', 'vc' )
			),
		),
		array(
			'id'      => 'blog_sidebar_position',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Sidebar - Position', 'dent-all' ),
			'options' => array(
				'left'  => esc_html__( 'Left', 'dent-all' ),
				'right' => esc_html__( 'Right', 'dent-all' )
			),
			'default' => 'right'
		),
		array(
			'id'      => 'blog_navigation',
			'type'    => 'button_set',
			'options' => array(
				'pagination' => esc_html__( 'Pagination', 'dent-all' ),
				'load_more'  => esc_html__( 'Load More Button', 'dent-all' )
			),
			'default' => 'pagination',
			'title'   => esc_html__( 'Blog Navigation', 'dent-all' )
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => esc_html__( 'Services', 'dent-all' ),
	'desc'    => '',
	'icon'    => 'el-icon-pencil',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'    => 'service_page',
			'type'  => 'select',
			'data'  => 'posts',
			'args'  => array( 'post_type' => array( 'page' ), 'posts_per_page' => - 1 ),
			'title' => esc_html__( 'Service Page', 'dent-all' )
		),
		array(
			'id'      => 'service_layout',
			'type'    => 'button_set',
			'options' => array(
				'grid' => esc_html__( 'Grid view', 'dent-all' ),
				'icon' => esc_html__( 'Icon view', 'dent-all' )
			),
			'default' => 'grid',
			'title'   => esc_html__( 'Service Layout', 'dent-all' )
		),
		array(
			'id'      => 'service_sidebar_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Sidebar', 'dent-all' ),
			'options' => array(
				'wp' => esc_html__( 'Wordpress Sidebars', 'dent-all' ),
				'vc' => esc_html__( 'VC Sidebars', 'dent-all' )
			),
			'default' => 'wp'
		),
		array(
			'id'       => 'service_wp_sidebar',
			'type'     => 'select',
			'data'     => 'sidebar',
			'title'    => esc_html__( 'Sidebar', 'dent-all' ),
			'required' => array(
				array( 'service_sidebar_type', '=', 'wp' )
			),
			'default'  => 'right_sidebar'
		),
		array(
			'id'       => 'service_vc_sidebar',
			'type'     => 'select',
			'data'     => 'posts',
			'args'     => array( 'post_type' => array( 'stm_sidebar' ), 'posts_per_page' => - 1 ),
			'title'    => esc_html__( 'Sidebar', 'dent-all' ),
			'required' => array(
				array( 'service_sidebar_type', '=', 'vc' )
			),
		),
		array(
			'id'      => 'service_sidebar_position',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Sidebar - Position', 'dent-all' ),
			'options' => array(
				'left'  => esc_html__( 'Left', 'dent-all' ),
				'right' => esc_html__( 'Right', 'dent-all' )
			),
			'default' => 'right'
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => esc_html__( 'Footer', 'dent-all' ),
	'desc'    => '',
	'icon'    => 'el-icon-photo',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'footer_widgets',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable footer widgets area.', 'dent-all' ),
			'default' => true,
		),
		array(
			'id'       => 'footer_columns',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Footer Columns', 'dent-all' ),
			'desc'     => esc_html__( 'Select the number of columns to display in the footer.', 'dent-all' ),
			'default'  => '4',
			'required' => array( 'footer_widgets', '=', true, ),
			'options'  => array(
				'1' => esc_html__( '1 Columns', 'dent-all' ),
				'2' => esc_html__( '2 Columns', 'dent-all' ),
				'3' => esc_html__( '3 Columns', 'dent-all' ),
				'4' => esc_html__( '4 Columns', 'dent-all' ),
			),
		),
		array(
			'id'       => 'copyright',
			'type'     => 'textarea',
			'title'    => esc_html__( 'Footer Copyright', 'dent-all' ),
			'subtitle' => esc_html__( 'Enter the copyright text.', 'dent-all' ),
			'default'  => wp_kses( __( 'Copyright &copy; 2015 dental practice Theme by <a target="_blank" href="http://www.stylemixthemes.com/">Stylemix Themes</a>', 'dent-all' ), array( 'a' => array( 'target' => array(), 'href' => array() ) ) )
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => esc_html__( 'Styling', 'dent-all' ),
	'desc'    => '',
	'icon'    => 'el-icon-tint',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'color_skin',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Color Skin', 'dent-all' ),
			'options' => array(
				''       => esc_html__( 'Skin 1', 'dent-all' ),
				'skin_2' => esc_html__( 'Skin 2', 'dent-all' ),
				'skin_3' => esc_html__( 'Skin 3', 'dent-all' ),
				'skin_4' => esc_html__( 'Skin 4', 'dent-all' )
			),
			'default' => ''
		),
		array(
			'id'       => 'footer_bg',
			'type'     => 'color',
			'compiler' => true,
			'title'    => esc_html__( 'Footer Background', 'dent-all' ),
			'default'  => '#4C6575',
			'output'   => array( 'background-color' => '#footer .footer_widgets' )
		),
		array(
			'id'       => 'footer_text_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => esc_html__( 'Footer Text Color', 'dent-all' ),
			'default'  => '#ffffff',
			'output'   => array( 'color' => '#footer .footer_widgets' )
		),
		array(
			'id'       => 'copyright_bg',
			'type'     => 'color',
			'compiler' => true,
			'title'    => esc_html__( 'Copyright Background', 'dent-all' ),
			'default'  => '#395261',
			'output'   => array( 'background-color' => '#footer .copyright' )
		),
		array(
			'id'       => 'copyright_text_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => esc_html__( 'Copyright Text Color', 'dent-all' ),
			'default'  => '#ffffff',
			'output'   => array( 'color' => '#footer .copyright' )
		),
	)
) );


Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Typography', 'dent-all' ),
	'icon'   => 'el-icon-font',
	'fields' => array(
		array(
			'id'          => 'font_body',
			'type'        => 'typography',
			'title'       => esc_html__( 'Body', 'dent-all' ),
			'subtitle'    => esc_html__( 'Specify the body font properties.', 'dent-all' ),
			'google'      => true,
			'all_styles'  => true,
			'font-weight' => false,
			'font-style'  => false,
			'text-align'  => false,
			'line-height' => false,
			'subsets'     => true,
			'output'      => array( 'body, body table.booked-calendar td, body table.booked-calendar th' ),
			'default'     => array(
				'color'       => '#868686',
				'font-size'   => '16px',
				'font-family' => 'Roboto'
			),
		),
		array(
			'id'          => 'additional_font',
			'type'        => 'typography',
			'title'       => esc_html__( 'Additional Font', 'dent-all' ),
			'google'      => true,
			'all_styles'  => true,
			'font-weight' => false,
			'font-style'  => true,
			'text-align'  => false,
			'font-size'   => false,
			'line-height' => false,
			'color'       => false,
			'subsets'     => true,
			'output'      => array( '.additional_font, blockquote' ),
			'default'     => array(
				'font-family' => 'Playfair Display',
				'font-style'  => 'italic'
			),
		),
		array(
			'id'             => 'paragraph_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'Paragraph', 'dent-all' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => false,
			'font-weight'    => true,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'p' ),
			'units'          => 'px',
			'default'        => array(
				'font-size'   => '18px',
				'line-height' => '30px',
				'font-weight' => '300'
			)
		),
		array(
			'id'             => 'h1_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H1', 'dent-all' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => true,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h1,.h1' ),
			'units'          => 'px',
			'default'        => array(
				'font-size'   => '60px',
				'font-weight' => '300',
				'font-family' => 'Roboto',
				'line-height' => '72px'
			)
		),
		array(
			'id'             => 'h2_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H2', 'dent-all' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => true,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h2,.h2' ),
			'units'          => 'px',
			'default'        => array(
				'font-size'   => '48px',
				'font-weight' => '300',
				'font-family' => 'Roboto',
				'line-height' => '60px'
			)
		),
		array(
			'id'             => 'h3_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H3', 'dent-all' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => true,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h3,.h3' ),
			'units'          => 'px',
			'default'        => array(
				'font-size'   => '36px',
				'font-weight' => '500',
				'font-family' => 'Roboto',
				'line-height' => '44px'
			)
		),
		array(
			'id'             => 'h4_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H4', 'dent-all' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => true,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h4,.h4' ),
			'units'          => 'px',
			'default'        => array(
				'font-size'   => '24px',
				'font-weight' => '500',
				'font-family' => 'Roboto',
				'line-height' => '30px'
			)
		),
		array(
			'id'             => 'h5_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H5', 'dent-all' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => true,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h5,.h5' ),
			'units'          => 'px',
			'default'        => array(
				'font-size'   => '18px',
				'font-weight' => '500',
				'font-family' => 'Roboto',
				'line-height' => '24px'
			)
		),
		array(
			'id'             => 'h6_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H6', 'dent-all' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => true,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h6,.h6' ),
			'units'          => 'px',
			'default'        => array(
				'font-size'   => '14px',
				'font-weight' => '500',
				'font-family' => 'Roboto',
				'line-height' => '20px'
			)
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Social Media', 'dent-all' ),
	'icon'   => 'el-icon-address-book',
	'desc'   => esc_html__( 'Enter social media urls here and then you can enable them for footer or header. Please add full URLs including "http://".', 'dent-all' ),
	'fields' => array(
		array(
			'id'       => 'facebook',
			'type'     => 'text',
			'title'    => esc_html__( 'Facebook', 'dent-all' ),
			'subtitle' => '',
			'default'  => 'https://www.facebook.com/',
			'desc'     => esc_html__( 'Enter your Facebook URL.', 'dent-all' ),
		),
		array(
			'id'       => 'twitter',
			'type'     => 'text',
			'title'    => esc_html__( 'Twitter', 'dent-all' ),
			'subtitle' => '',
			'default'  => 'https://www.twitter.com/',
			'desc'     => esc_html__( 'Enter your Twitter URL.', 'dent-all' ),
		),
		array(
			'id'       => 'instagram',
			'type'     => 'text',
			'title'    => esc_html__( 'Instagram', 'dent-all' ),
			'subtitle' => '',
			'default'  => 'https://www.instagram.com/',
			'desc'     => esc_html__( 'Enter your Instagram URL.', 'dent-all' ),
		),
		array(
			'id'       => 'behance',
			'type'     => 'text',
			'title'    => esc_html__( 'Behance', 'dent-all' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Enter your Behance URL.', 'dent-all' ),
		),
		array(
			'id'       => 'dribbble',
			'type'     => 'text',
			'title'    => esc_html__( 'Dribbble', 'dent-all' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Enter your Dribbble URL.', 'dent-all' ),
		),
		array(
			'id'       => 'flickr',
			'type'     => 'text',
			'title'    => esc_html__( 'Flickr', 'dent-all' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Enter your Flickr URL.', 'dent-all' ),
		),
		array(
			'id'       => 'git',
			'type'     => 'text',
			'title'    => esc_html__( 'Git', 'dent-all' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Enter your Git URL.', 'dent-all' ),
		),
		array(
			'id'       => 'linkedin',
			'type'     => 'text',
			'title'    => esc_html__( 'Linkedin', 'dent-all' ),
			'subtitle' => '',
			'default'  => 'https://www.linkedin.com/',
			'desc'     => esc_html__( 'Enter your Linkedin URL.', 'dent-all' ),
		),
		array(
			'id'       => 'pinterest',
			'type'     => 'text',
			'title'    => esc_html__( 'Pinterest', 'dent-all' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Enter your Pinterest URL.', 'dent-all' ),
		),
		array(
			'id'       => 'yahoo',
			'type'     => 'text',
			'title'    => esc_html__( 'Yahoo', 'dent-all' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Enter your Yahoo URL.', 'dent-all' ),
		),
		array(
			'id'       => 'delicious',
			'type'     => 'text',
			'title'    => esc_html__( 'Delicious', 'dent-all' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Enter your Delicious URL.', 'dent-all' ),
		),
		array(
			'id'       => 'dropbox',
			'type'     => 'text',
			'title'    => esc_html__( 'Dropbox', 'dent-all' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Enter your Dropbox URL.', 'dent-all' ),
		),
		array(
			'id'       => 'reddit',
			'type'     => 'text',
			'title'    => esc_html__( 'Reddit', 'dent-all' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Enter your Reddit URL.', 'dent-all' ),
		),
		array(
			'id'       => 'soundcloud',
			'type'     => 'text',
			'title'    => esc_html__( 'Soundcloud', 'dent-all' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Enter your Soundcloud URL.', 'dent-all' ),
		),
		array(
			'id'       => 'google',
			'type'     => 'text',
			'title'    => esc_html__( 'Google', 'dent-all' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Enter your Google URL.', 'dent-all' ),
		),
		array(
			'id'       => 'skype',
			'type'     => 'text',
			'title'    => esc_html__( 'Skype', 'dent-all' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Enter your Skype URL.', 'dent-all' ),
		),
		array(
			'id'       => 'youtube',
			'type'     => 'text',
			'title'    => esc_html__( 'Youtube', 'dent-all' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Enter your Youtube URL.', 'dent-all' ),
		),
		array(
			'id'       => 'tumblr',
			'type'     => 'text',
			'title'    => esc_html__( 'Tumblr', 'dent-all' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Enter your Tumblr URL.', 'dent-all' ),
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Post Types', 'dent-all' ),
	'icon'   => 'el-icon-pencil',
	'fields' => array(
		array(
			'id'     => 'post_type_services_section_start',
			'type'   => 'section',
			'title'  => esc_html__( 'Services', 'dent-all' ),
			'indent' => true
		),
		array(
			'id'      => 'post_type_services',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable "Services" Post Type', 'dent-all' ),
			'default' => true,
		),
		array(
			'id'       => 'post_type_services_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Title', 'dent-all' ),
			'default'  => esc_html__( 'Service', 'dent-all' ),
			'required' => array( 'post_type_services', '=', true, ),
		),
		array(
			'id'       => 'post_type_services_plural',
			'type'     => 'text',
			'title'    => esc_html__( 'Plural title', 'dent-all' ),
			'default'  => esc_html__( 'Services', 'dent-all' ),
			'required' => array( 'post_type_services', '=', true, ),
		),
		array(
			'id'       => 'post_type_services_rewrite',
			'type'     => 'text',
			'title'    => esc_html__( 'Rewrite (URL text)', 'dent-all' ),
			'default'  => 'service',
			'required' => array( 'post_type_services', '=', true, ),
		),
		array(
			'id'     => 'post_type_services_section_end',
			'type'   => 'section',
			'indent' => false
		),
		array(
			'id'     => 'post_type_staff_section_start',
			'type'   => 'section',
			'title'  => esc_html__( 'Staff', 'dent-all' ),
			'indent' => true
		),
		array(
			'id'      => 'post_type_staff',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable "Staff" Post Type', 'dent-all' ),
			'default' => true,
		),
		array(
			'id'       => 'post_type_staff_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Title', 'dent-all' ),
			'default'  => esc_html__( 'Staff', 'dent-all' ),
			'required' => array( 'post_type_staff', '=', true, ),
		),
		array(
			'id'       => 'post_type_staff_plural',
			'type'     => 'text',
			'title'    => esc_html__( 'Plural title', 'dent-all' ),
			'default'  => esc_html__( 'Staff', 'dent-all' ),
			'required' => array( 'post_type_staff', '=', true, ),
		),
		array(
			'id'       => 'post_type_staff_rewrite',
			'type'     => 'text',
			'title'    => esc_html__( 'Rewrite (URL text)', 'dent-all' ),
			'default'  => 'staff',
			'required' => array( 'post_type_staff', '=', true, ),
		),
		array(
			'id'     => 'post_type_staff_section_end',
			'type'   => 'section',
			'indent' => false
		),
		array(
			'id'     => 'post_type_testimonials_section_start',
			'type'   => 'section',
			'title'  => esc_html__( 'Testimonials', 'dent-all' ),
			'indent' => true
		),
		array(
			'id'      => 'post_type_testimonials',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable "Testimonials" Post Type', 'dent-all' ),
			'default' => true,
		),
		array(
			'id'       => 'post_type_testimonials_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Title', 'dent-all' ),
			'default'  => esc_html__( 'Testimonial', 'dent-all' ),
			'required' => array( 'post_type_testimonials', '=', true, ),
		),
		array(
			'id'       => 'post_type_testimonials_plural',
			'type'     => 'text',
			'title'    => esc_html__( 'Plural title', 'dent-all' ),
			'default'  => esc_html__( 'Testimonials', 'dent-all' ),
			'required' => array( 'post_type_testimonials', '=', true, ),
		),
		array(
			'id'       => 'post_type_testimonials_rewrite',
			'type'     => 'text',
			'title'    => esc_html__( 'Rewrite (URL text)', 'dent-all' ),
			'default'  => 'testimonial',
			'required' => array( 'post_type_testimonials', '=', true, ),
		),
		array(
			'id'     => 'post_type_testimonials_section_end',
			'type'   => 'section',
			'indent' => false
		),
		array(
			'id'     => 'post_type_vacancies_section_start',
			'type'   => 'section',
			'title'  => esc_html__( 'Vacancies', 'dent-all' ),
			'indent' => true
		),
		array(
			'id'      => 'post_type_vacancies',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable "Vacancies" Post Type', 'dent-all' ),
			'default' => true,
		),
		array(
			'id'       => 'post_type_vacancies_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Title', 'dent-all' ),
			'default'  => esc_html__( 'Vacancy', 'dent-all' ),
			'required' => array( 'post_type_vacancies', '=', true, ),
		),
		array(
			'id'       => 'post_type_vacancies_plural',
			'type'     => 'text',
			'title'    => esc_html__( 'Plural title', 'dent-all' ),
			'default'  => esc_html__( 'Vacancies', 'dent-all' ),
			'required' => array( 'post_type_vacancies', '=', true, ),
		),
		array(
			'id'       => 'post_type_vacancies_rewrite',
			'type'     => 'text',
			'title'    => esc_html__( 'Rewrite (URL text)', 'dent-all' ),
			'default'  => 'vacancy',
			'required' => array( 'post_type_vacancies', '=', true, ),
		),
		array(
			'id'     => 'post_type_vacancies_section_end',
			'type'   => 'section',
			'indent' => false
		),
		array(
			'id'     => 'post_type_stories_section_start',
			'type'   => 'section',
			'title'  => esc_html__( 'Success Stories', 'dent-all' ),
			'indent' => true
		),
		array(
			'id'      => 'post_type_stories',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable "Success Stories" Post Type', 'dent-all' ),
			'default' => true,
		),
		array(
			'id'       => 'post_type_stories_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Title', 'dent-all' ),
			'default'  => esc_html__( 'Success Story', 'dent-all' ),
			'required' => array( 'post_type_stories', '=', true, ),
		),
		array(
			'id'       => 'post_type_stories_plural',
			'type'     => 'text',
			'title'    => esc_html__( 'Plural title', 'dent-all' ),
			'default'  => esc_html__( 'Success Stories', 'dent-all' ),
			'required' => array( 'post_type_stories', '=', true, ),
		),
		array(
			'id'       => 'post_type_stories_rewrite',
			'type'     => 'text',
			'title'    => esc_html__( 'Rewrite (URL text)', 'dent-all' ),
			'default'  => 'story',
			'required' => array( 'post_type_stories', '=', true, ),
		),
		array(
			'id'     => 'post_type_stories_section_end',
			'type'   => 'section',
			'indent' => false
		),
	)
) );

Redux::setSection( $opt_name, array(
	'icon'       => 'el-refresh',
	'icon_class' => 'el-icon-large',
	'title'      => __('One Click Update', 'dent-all'),
	'desc'    => __( 'Let us notify you when new versions of this theme are live on ThemeForest! Update with just one button click and forget about manual updates!<br> If you have any troubles while using auto update ( It is likely to be a permissions issue ) then you may want to manually update the theme as normal.', 'dent-all' ),
	'submenu'    => true,
	'fields'     => array(
		array(
			'id'       =>'envato_username',
			'type'     => 'text',
			'title'    => __('ThemeForest Username', 'dent-all'),
			'subtitle' => '',
			'desc'     => __('Enter here your ThemeForest (or Envato) username account (i.e. Stylemixthemes).', 'dent-all'),
		),
		array(
			'id'       =>'envato_api',
			'type'     => 'text',
			'title'    => __('ThemeForest Secret API Key', 'dent-all'),
			'subtitle' => '',
			'desc'     => __('Enter here the secret api key you have created on ThemeForest. You can create a new one in the Settings > API Keys section of your profile.', 'dent-all'),
		),
	)
));

if ( ! function_exists( 'stm_iconpicker' ) ) {
	function stm_iconpicker( $field, $value ) {

		global $wp_filesystem;

		$icons = json_decode( $wp_filesystem->get_contents( get_template_directory() . '/assets/js/icomoon-selection.json' ), true );

		foreach ( $icons['icons'] as $icon ) {
			$fonts[] = 'stm-icon-' . $icon['properties']['name'];
		}

		?>

		<input type="text" id="<?php echo esc_attr( $field['id'] ); ?>" name="<?php echo esc_attr( $field['name'] ); ?>" value="<?php echo esc_attr( $value ); ?>"/>

		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				$('#<?php echo esc_js( $field['id'] ); ?>').fontIconPicker({
					theme: 'fip-darkgrey',
					emptyIcon: false,
					source: <?php echo json_encode( $fonts ); ?>
				});
			});
		</script>
	<?php }
}