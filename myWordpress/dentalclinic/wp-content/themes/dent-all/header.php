<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="main">

	<?php if ( stm_nav_mode() == 'left' ) { ?>
		<div class="left_nav">
			<div class="left_nav_wr">
				<div class="logo">
					<?php echo stm_get_logo(); ?>
				</div>
				<?php
					wp_nav_menu( array(
							'theme_location' => 'left_nav',
							'container'      => false,
							'menu_class'     => 'left_nav_menu',
							'fallback_cb'    => false
						)
					);
				?>
			</div>
		</div>
	<?php } ?>

	<div class="main_wrapper">
		<div class="wrapper">
			<header id="header">
				<?php if ( stm_option('top_bar') ): ?>
					<div class="top_bar">
						<div class="container">
							<div class="row">

								<div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
									<div class="top_bar_left">

										<?php if ( stm_option('top_bar_label') ): ?>
											<b><?php esc_html_e( stm_option('top_bar_label') ); ?></b>
										<?php endif; ?>

										<?php
										wp_nav_menu( array(
												'theme_location' => 'top_bar_menu',
												'container'      => false,
												'menu_class'     => 'top_bar_menu',
												'fallback_cb'    => false
											)
										);
										?>

									</div>
								</div>

								<div class="col-lg-6 col-md-7 col-sm-12 col-xs-12">
									<div class="top_bar_right">

										<?php
										if ( stm_option('top_bar_search') && stm_nav_mode() != 'left' ) {
											get_search_form();
										}
										?>

										<?php
										if ( stm_option('top_bar_wpml') ) {
											do_action( 'wpml_add_language_selector' );
										}
										?>

										<?php if ( stm_option('top_bar_social') ): ?>
											<div class="top_bar_socials">
												<ul>
													<?php foreach ( stm_option('top_bar_use_social') as $key => $val ) : ?>
														<?php if ( stm_option( $key ) && $val == 1 ): ?>
															<li>
																<a target="_blank" href="<?php echo esc_url( stm_option( $key ) ); ?>">
																	<i class="fa fa-<?php echo esc_attr( $key ); ?>"></i>
																</a>
															</li>
														<?php endif; ?>
													<?php endforeach; ?>
												</ul>
											</div>
										<?php endif; ?>

									</div>
								</div>

							</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( stm_option('top_bar_search') ): ?>
					<div class="mobile_search">
						<?php echo get_search_form(); ?>
					</div>
				<?php endif; ?>

				<?php if ( stm_nav_mode() != 'left' ): ?>
					<div class="top_nav">
						<div class="container">
							<div class="row">

								<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
									<div class="logo">
										<?php echo stm_get_logo(); ?>
										<div id="menu_toggle">
											<button></button>
										</div>
									</div>
								</div>

								<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
									<?php
									wp_nav_menu( array(
											'theme_location' => 'primary_menu',
											'container'      => false,
											'depth'          => 3,
											'fallback_cb'    => false,
											'menu_class'     => 'top_nav_menu'
										)
									);
									?>
								</div>

							</div>
						</div>
						<div class="mobile_menu">
							<?php
							wp_nav_menu( array(
									'theme_location' => 'primary_menu',
									'container'      => false,
									'depth'          => 3,
									'fallback_cb'    => false,
									'menu_class'     => 'top_mobile_menu'
								)
							);
							?>
						</div>
					</div>
				<?php else: ?>
					<div class="top_nav">
						<div class="container">
							<div class="mod_table">

								<div class="mod_table_cell">
									<div id="left_menu_toggle">
										<button></button>
									</div>
								</div>

								<div class="mod_table_cell show_on_mobile">
									<div class="logo">
										<?php echo stm_get_logo(); ?>
										<div id="menu_toggle">
											<button></button>
										</div>
									</div>
								</div>

								<div class="mod_table_cell">
									<?php
									if ( stm_option('top_bar_search') ) {
										get_search_form();
									}
									?>
								</div>

							</div>
						</div>
						<div class="mobile_menu">
							<?php
							wp_nav_menu( array(
									'theme_location' => 'primary_menu',
									'container'      => false,
									'depth'          => 3,
									'fallback_cb'    => false,
									'menu_class'     => 'top_mobile_menu'
								)
							);
							?>
						</div>
					</div>
				<?php endif; ?>
				
				<?php if ( stm_option('top_info_show') ): ?>
					<div class="top_info_boxes">
						<div class="container">
							<div class="row">

								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="top_info_box">
										<?php if ( stm_option( 'top_info_left_icon' ) ): ?>
											<div class="icon">
												<i class="<?php echo esc_attr( stm_option( 'top_info_left_icon' ) ); ?>"></i>
											</div>
										<?php endif; ?>
										<div class="text">
											<?php if ( stm_option('top_info_left_label') ): ?>
												<strong><?php esc_html_e( stm_option('top_info_left_label') ); ?></strong>
											<?php endif; ?>
											<?php if ( stm_option('top_info_left_value') ): ?>
												<span><?php esc_html_e( stm_option('top_info_left_value') ); ?></span>
											<?php endif; ?>
										</div>
										<?php if ( stm_option('top_info_left_link') ): ?>
											<a href="<?php echo esc_url( stm_option('top_info_left_link') ); ?>" class="link"></a>
										<?php endif; ?>
									</div>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="top_info_box">
										<?php if ( stm_option('top_info_center_icon') ): ?>
											<div class="icon">
												<i class="<?php echo esc_attr( stm_option( 'top_info_center_icon' ) ); ?>"></i>
											</div>
										<?php endif; ?>
										<div class="text">
											<?php if ( stm_option( 'top_info_center_label' ) ): ?>
												<strong><?php esc_html_e( stm_option( 'top_info_center_label' ) ); ?></strong>
											<?php endif; ?>
											<?php if ( stm_option( 'top_info_center_value' ) ): ?>
												<span><?php esc_html_e( stm_option( 'top_info_center_value' ) ); ?></span>
											<?php endif; ?>
										</div>
										<?php if ( stm_option( 'top_info_center_link' ) ): ?>
											<a href="<?php echo esc_url( stm_option( 'top_info_center_link' ) ); ?>" class="link"></a>
										<?php endif; ?>
									</div>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-right">
									<div class="top_info_box linked">
										<?php if ( stm_option( 'top_info_right_icon' ) ): ?>
											<div class="icon">
												<i class="<?php echo esc_attr( stm_option( 'top_info_right_icon' ) ); ?>"></i>
											</div>
										<?php endif; ?>
										<div class="text">
											<?php if ( stm_option( 'top_info_right_label' ) ): ?>
												<strong><?php esc_html_e( stm_option( 'top_info_right_label' ) ); ?></strong>
											<?php endif; ?>
											<?php if ( stm_option( 'top_info_right_value' ) ): ?>
												<span><?php esc_html_e( stm_option( 'top_info_right_value' ) ); ?></span>
											<?php endif; ?>
										</div>
										<?php if ( stm_option( 'top_info_right_link' ) ): ?>
											<a href="<?php echo esc_url( stm_option( 'top_info_right_link' ) ); ?>" class="link"></a>
										<?php endif; ?>
									</div>
								</div>

							</div>
						</div>
					</div>
				<?php endif; ?>

			</header>
			<section id="content">