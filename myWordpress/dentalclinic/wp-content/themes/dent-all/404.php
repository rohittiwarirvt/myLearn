<?php get_header(); ?>

	<div class="content_wrapper">
		<div class="container">
			<div class="page_404">
				<h1><?php esc_html_e( 'Page not found', 'dent-all' ); ?></h1>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/404.png" alt="<?php esc_html_e( 'Page not found', 'dent-all' ); ?>"/>

				<p><?php esc_html_e( 'The page you are looking for does not exist.', 'dent-all' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button"><?php esc_html_e( 'Go to Home Page', 'dent-all' ); ?></a>
			</div>
		</div>
	</div>

<?php get_footer(); ?>