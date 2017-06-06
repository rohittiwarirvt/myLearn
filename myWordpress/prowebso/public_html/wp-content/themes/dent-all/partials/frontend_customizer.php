<div id="frontend_customizer" style="left: -276px;">
	<div class="customizer_wrapper">
		<h3><?php esc_html_e( 'Color Skin', 'dent-all' ); ?></h3>

		<div class="customizer_element">
			<div class="customizer_colors" id="skin_color">
				<span id="site_skin_1"></span>
				<span id="site_skin_2"></span>
				<span id="site_skin_3"></span>
				<span id="site_skin_4"></span>
			</div>
		</div>

		<h3><?php esc_html_e('Nav Mode', 'dent-all'); ?></h3>

		<div class="customizer_element">
			<div class="stm_switcher<?php echo( isset( $_COOKIE['nav_mode'] ) && $_COOKIE['nav_mode'] == 'left' ? ' active' : '' ); ?>" id="nav_mode">
				<div class="switcher_label static"><?php echo esc_html__('Horizontal', 'dent-all'); ?></div>
				<div class="switcher_nav"></div>
				<div class="switcher_label sticky"><?php echo esc_html__('Vertical', 'dent-all'); ?></div>
			</div>
			<div class="stm_switcher" id="navigation_type">
				<div class="switcher_label disable"><?php esc_html_e('Static', 'dent-all'); ?></div>
				<div class="switcher_nav"></div>
				<div class="switcher_label enable"><?php esc_html_e('Sticky', 'dent-all'); ?></div>
			</div>
		</div>
	</div>
	<div id="frontend_customizer_button"><i class="fa fa-cog"></i></div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function ($) {
		"use strict";

		$(window).load(function () {
			$("#frontend_customizer").animate({left: -233}, 300);
		});

		$("#frontend_customizer_button").live('click', function () {
			if ($("#frontend_customizer").hasClass('open')) {
				$("#frontend_customizer").animate({left: -233}, 300);
				$("#frontend_customizer").removeClass('open');
				$(this).find('.fa').removeClass('fa-spin');
			} else {
				$("#frontend_customizer").animate({left: 0}, 300);
				$("#frontend_customizer").addClass('open');
				$(this).find('.fa').addClass('fa-spin');
			}
		});

		$('.main').on('click', function (kik) {
			if (!$(kik.target).is('#frontend_customizer, #frontend_customizer *') && $('#frontend_customizer').is(':visible')) {
				$("#frontend_customizer").animate({left: -233}, 300);
				$("#frontend_customizer").removeClass('open');
				$(this).find('.fa').removeClass('fa-spin');
			}
		});

		$("#skin_color span").live('click', function () {
			$("#skin_color .active").removeClass("active");
			$(this).addClass("active");
			$("body").removeClass("site_skin_2 site_skin_3 site_skin_4");
			$("body").addClass($(this).attr("id"));
		});

		if ($("body").hasClass("site_skin_2")) {
			$("#skin_color #site_skin_2").addClass("active");
		} else if ($("body").hasClass("site_skin_3")) {
			$("#skin_color #site_skin_3").addClass("active");
		} else if ($("body").hasClass("site_skin_4")) {
			$("#skin_color #site_skin_4").addClass("active");
		} else {
			$("#skin_color #site_skin_1").addClass("active");
		}

		$("#nav_mode").on("click", function () {
			if ($(this).hasClass('active')) {
				$(this).removeClass('active');
				$.cookie('nav_mode', 'top', {expires: 7, path: '/'});
			} else {
				$(this).addClass('active');
				$.cookie('nav_mode', 'left', {expires: 7, path: '/'});
			}
			window.location.reload(true);
		});

		if ($.cookie('navigation_type') && $.cookie('navigation_type') == 'sticky_header') {
			$("body").addClass('sticky_header');
		}else{
			$("body").removeClass('sticky_header');
		}

		$("#navigation_type").on("click", function () {
			if ($(this).hasClass('active')) {
				$(this).removeClass('active');
				$("body").removeClass('sticky_header');
				$.cookie('navigation_type', 'static_header', {expires: 7, path: '/'});
			} else {
				$(this).addClass('active');
				$("body").addClass('sticky_header');
				$.cookie('navigation_type', 'sticky_header', {expires: 7, path: '/'});
			}
		});

		if($("body").hasClass("sticky_header")){
			$("#navigation_type").addClass("active");
		}

	});

</script>