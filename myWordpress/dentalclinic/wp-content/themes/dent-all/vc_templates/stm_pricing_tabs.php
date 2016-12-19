<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$args = array( 'post_type' => 'stm_service', 'posts_per_page' => - 1, 'suppress_filters' => 0 );
if ( $category != 'all' ) {
	$args['stm_service_category'] = $category;
}
$all_services     = get_posts( $args );
$all_prices       = get_posts( array(
	'post_type'      => 'stm_service_price',
	'posts_per_page' => - 1,
	'meta_key'       => 'featured',
	'suppress_filters'       => '0'
) );
$all_services_ids = array();
$all_prices_ids   = array();
foreach ( $all_prices as $price ) {
	$all_prices_ids[] = get_post_meta( $price->ID, 'service', true );
}
?>
<?php if ( $all_services ): ?>
	<div class="pricing_list_wr<?php echo esc_attr( $css_class ); ?>">

		<div class="pricing_list_header">
			<?php if ( $title ): ?>
				<h2<?php echo ( $title_color ) ? ' style="color: ' . esc_attr( $title_color ) . '"' : ''; ?>><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>

			<?php if ( $all_services ): ?>
				<ul class="tabs" role="tablist">
					<li class="active"><a href="#all" role="tab" data-toggle="tab"><?php esc_html_e( 'All', 'dent-all' ); ?></a></li>
					<?php foreach ( $all_services as $service ): array_push( $all_services_ids, $service->ID ); ?>
						<?php if ( in_array( $service->ID, $all_prices_ids ) ): ?>
							<li><a href="#<?php echo esc_attr( $service->post_name ); ?>" role="tab" data-toggle="tab"><?php echo get_the_title( $service->ID ); ?></a></li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<div class="tab-content">

			<?php if ( $all_prices ): ?>
				<div role="tabpanel" class="tab-pane fade in active" id="all">
					<ul class="pricing_list clearfix"<?php echo ( $text_color ) ? ' style="color: ' . esc_attr( $text_color ) . '"' : ''; ?>>
						<?php foreach ( $all_prices as $price ): ?>
							<?php
							$current_price = get_post_meta( $price->ID, 'price', true );
							$sale_price    = get_post_meta( $price->ID, 'sale_price', true );
							$service_id    = get_post_meta( $price->ID, 'service', true );
							?>
							<?php if ( in_array( $service_id, $all_services_ids ) ): ?>
								<li class="media<?php echo ( $sale_price ) ? ' sale' : ''; ?>">

									<div class="media-body">
										<div class="content">
											<h4><?php echo get_the_title( $price->ID ); ?></h4>
											<?php echo apply_filters( 'the_excerpt', $price->post_excerpt ); ?>
										</div>
									</div>

									<div class="media-right<?php echo ( ! $sale_price ) ? ' media-middle' : ''; ?>">
										<?php if ( $current_price ): ?>
											<div class="price">
												<?php echo esc_html( $current_price ); ?>
											</div>
										<?php endif; ?>
										<?php if ( $sale_price ): ?>
											<div class="sale_price">
												<?php echo esc_html( $sale_price ); ?>
											</div>
										<?php endif; ?>
									</div>

								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<?php foreach ( $all_services as $service ): ?>
				<?php $prices = get_posts( array(
					'post_type'      => 'stm_service_price',
					'posts_per_page' => - 1,
					'meta_query'     => array(
						array(
							'key'   => 'service',
							'value' => $service->ID,
						),
						array(
							'key' => 'featured'
						)
					),
					'suppress_filters'       => '0'
				) ); ?>
				<div role="tabpanel" class="tab-pane fade" id="<?php echo esc_attr( $service->post_name ); ?>">
					<ul class="pricing_list clearfix"<?php echo ( $text_color ) ? ' style="color: ' . esc_attr( $text_color ) . '"' : ''; ?>>
						<?php foreach ( $prices as $price ): ?>
							<?php
							$current_price = get_post_meta( $price->ID, 'price', true );
							$sale_price    = get_post_meta( $price->ID, 'sale_price', true );
							?>
							<li class="media<?php echo ( $sale_price ) ? ' sale' : ''; ?>">

								<div class="media-body">
									<div class="content">
										<h4><?php echo get_the_title( $price->ID ); ?></h4>
										<?php echo apply_filters( 'the_excerpt', $price->post_excerpt ); ?>
									</div>
								</div>

								<div class="media-right<?php echo ( ! $sale_price ) ? ' media-middle' : ''; ?>">
									<?php if ( $current_price ): ?>
										<div class="price">
											<?php echo esc_html( $current_price ); ?>
										</div>
									<?php endif; ?>
									<?php if ( $sale_price ): ?>
										<div class="sale_price">
											<?php echo esc_html( $sale_price ); ?>
										</div>
									<?php endif; ?>
								</div>

							</li>
						<?php endforeach; ?>
					</ul>
					<?php if ( $full_price ): ?>
						<div class="full_price">
							<a href="<?php echo get_permalink( $service->ID ); ?>" class="button"><?php esc_html_e( 'Full Price', 'dent-all' ); ?></a>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>