<?php
define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
define( 'REDUX_PATH', get_template_directory() . '/inc/redux' );
define( 'INC_PATH', get_template_directory() . '/inc' );

if ( ! isset( $content_width ) ) {
	$content_width = 826;
}

add_action( 'after_setup_theme', 'stm_theme_setup' );

if ( ! function_exists( 'stm_theme_setup' ) ) {

	function stm_theme_setup() {

		load_theme_textdomain( 'dent-all', get_template_directory() . '/languages' );

		add_image_size( 'stm_thumb-175x175', 175, 175, true );
		add_image_size( 'stm_thumb-275x275', 275, 275, true );
		add_image_size( 'stm_thumb-825x360', 825, 360, true );
		add_image_size( 'stm_thumb-825x550', 825, 550, true );
		add_image_size( 'stm_thumb-350x210', 350, 210, true );

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );

		register_nav_menus(
			array(
				'primary_menu' => esc_html__( 'Primary Menu', 'dent-all' ),
				'top_bar_menu' => esc_html__( 'Top Bar Menu', 'dent-all' ),
				'left_nav'     => esc_html__( 'Left Nav Menu', 'dent-all' ),
				'footer_nav'   => esc_html__( 'Footer Nav Menu', 'dent-all' )
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Right Sidebar', 'dent-all' ),
				'id'            => 'right_sidebar',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s right_widget">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h5>',
				'after_title'   => '</h5></div>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 1', 'dent-all' ),
				'id'            => 'footer_1',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widget">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h5>',
				'after_title'   => '</h5></div>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 2', 'dent-all' ),
				'id'            => 'footer_2',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widget">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h5>',
				'after_title'   => '</h5></div>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 3', 'dent-all' ),
				'id'            => 'footer_3',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widget">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h5>',
				'after_title'   => '</h5></div>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 4', 'dent-all' ),
				'id'            => 'footer_4',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widget">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h5>',
				'after_title'   => '</h5></div>',
			)
		);

	}

}

if( ! function_exists( 'stm_body_class' ) ) {
	function stm_body_class( $classes ) {
		if( stm_option( 'color_skin' ) ){
			$classes[] = 'site_' . stm_option( 'color_skin' );
		}
		if( stm_option( 'sticky' ) ){
			$classes[] = 'sticky_header';
		}
		if( stm_nav_mode() == 'left' ){
			$classes[] = 'left_nav_mode';
		}
		return $classes;
	}
}

add_filter( 'body_class', 'stm_body_class' );

if( ! function_exists( 'stm_site_icon' ) ){
	function stm_site_icon() {
		if ( $favicon = stm_option( 'favicon', false, 'url' ) ) {
			echo '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( $favicon ) . '" />' . "\n";
		} else {
			echo '<link rel="shortcut icon" type="image/png" href="' . get_template_directory_uri() . '/favicon.png" />' . "\n";
		}
	}
}

if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
	add_action( 'wp_head', 'stm_site_icon' );
}

if( ! function_exists( 'stm_wp_head' ) ){
	function stm_wp_head() {
		?>
		<script type="text/javascript">
			var ajaxurl = '<?php echo esc_url( admin_url('admin-ajax.php') ); ?>';
		</script>
		<?php
	}
}

add_action( 'wp_head', 'stm_wp_head' );

if ( ! class_exists( 'ReduxFramework' ) ) {
	require_once( REDUX_PATH . '/redux-extensions/extensions-init.php' );
	require_once( REDUX_PATH . '/framework.php' );
	require_once( INC_PATH . '/redux-config.php' );
}
require_once( INC_PATH . '/scripts-styles.php' );
require_once( INC_PATH . '/extras.php' );
require_once( INC_PATH . '/tgm/tgm-plugin-registration.php' );
if ( class_exists( 'STM_PostType' ) ) {
	require_once( INC_PATH . '/post_types-config.php' );
}
require_once( INC_PATH . '/vc-config.php' );
require_once( INC_PATH . '/print-styles.php' );
require_once( INC_PATH . '/widgets/widget_socials.php' );
require_once( INC_PATH . '/widgets/widget_schedule_table.php' );
require_once( INC_PATH . '/widgets/widget_contacts.php' );