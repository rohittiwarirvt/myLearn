<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$categories = get_terms( 'stm_service_price_category' );

?>
<div class="service_price<?php echo esc_attr( $css_class ); ?> wpb_text_column">
	<table>
		<tbody>
		<?php foreach ( $categories as $cat ): ?>
			<?php

			if ( $category != 'all' && $category != $cat->slug ) {
				continue;
			}

			$prices = new WP_Query( array(
				'post_type'                  => 'stm_service_price',
				'posts_per_page'             => - 1,
				'meta_key'                   => 'service',
				'meta_value'                 => get_the_ID(),
				'stm_service_price_category' => $cat->slug
			) );
			if ( ! $prices->have_posts() ) {
				continue;
			}
			?>
			<tr>
				<th colspan="2"><?php echo esc_html( $cat->name ); ?></th>
			</tr>
			<?php while ( $prices->have_posts() ): $prices->the_post();
				$current_price = get_post_meta( get_the_ID(), 'price', true );
				$sale_price    = get_post_meta( get_the_ID(), 'sale_price', true );
				?>
				<tr>
					<td><?php echo get_the_title( get_the_ID() ); ?></td>
					<td class="prices<?php echo ( $sale_price ) ? ' sale' : ''; ?>">
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
					</td>
				</tr>
			<?php endwhile;
			wp_reset_postdata(); ?>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>