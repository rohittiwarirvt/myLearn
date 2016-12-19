</section> <!--#content-->
<footer id="footer">
	<?php if ( stm_option('footer_widgets') && ( is_active_sidebar( 'footer_1' ) || is_active_sidebar( 'footer_2' ) || is_active_sidebar( 'footer_3' ) || is_active_sidebar( 'footer_4' ) ) ): ?>
		<div class="footer_widgets">
			<div class="container">
				<div class="row">
					<?php
					$col = 12 / stm_option( 'footer_columns', 1 );
					for ( $count = 1; $count <= stm_option('footer_columns'); $count ++ ): ?>
						<div class="col-lg-<?php echo esc_attr( $col ); ?> col-md-<?php echo esc_attr( $col ); ?> col-sm-6 col-xs-12">
							<?php dynamic_sidebar( 'footer_' . $count ); ?>
						</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if ( stm_option('copyright') ): ?>
		<div class="copyright">
			<div class="container">
				<?php echo wp_kses_post( stm_option('copyright') ); ?>
			</div>
		</div>
	<?php endif; ?>
</footer>
</div> <!--.wrapper-->
</div> <!--.main_wrapper-->
<?php
if ( stm_option( 'frontend_customizer' ) ) {
	get_template_part( 'partials/frontend_customizer' );
}
?>
</div> <!--.main-->
<?php wp_footer(); ?>
</body>
</html>