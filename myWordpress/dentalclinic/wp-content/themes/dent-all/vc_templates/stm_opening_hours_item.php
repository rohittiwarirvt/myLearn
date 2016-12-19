<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$days          = array(
	'sunday'    => esc_html__( 'Sunday', 'dent-all' ),
	'monday'    => esc_html__( 'Monday', 'dent-all' ),
	'tuesday'   => esc_html__( 'Tuesday', 'dent-all' ),
	'wednesday' => esc_html__( 'Wednesday', 'dent-all' ),
	'thursday'  => esc_html__( 'Thursday', 'dent-all' ),
	'friday'    => esc_html__( 'Friday', 'dent-all' ),
	'saturday'  => esc_html__( 'Saturday', 'dent-all' )
);
$css_class     = '';
$now           = current_time( 'timestamp' );
$time_to_close = strtotime( $closing_time ) - $now;

if ( strtolower( date( 'l' ) ) == $day && $now < strtotime( $closing_time ) && $now > strtotime( $opening_time ) ) {
	$css_class .= ' today';
}
if ( $output ) {
	$css_class .= ' output';
}
?>

<div class="day clearfix<?php echo esc_attr( $css_class ); ?>">
	<div class="icon">
		<i class="stm-icon-calendar"></i>
	</div>
	<div class="day_title">
		<strong><?php echo esc_html( $days[ $day ] ); ?></strong>
	</div>
	<div class="working_time">
		<?php if ( ! $output ): ?>
			<?php echo date( $time_format, strtotime( $opening_time ) ); ?> - <?php echo date( $time_format, strtotime( $closing_time ) ); ?>
		<?php else: ?>
			<?php echo esc_html( $text_1 ); ?>
		<?php endif; ?>
	</div>
	<div class="lunch_time">
		<?php if ( ! $output ): ?>
			<?php echo esc_html__( 'Lunch:', 'dent-all' ); ?>
			<?php echo date( $time_format, strtotime( $start_lunch ) ); ?> - <?php echo date( $time_format, strtotime( $end_lunch ) ); ?>
		<?php else: ?>
			<?php echo esc_html( $text_2 ); ?>
		<?php endif; ?>
	</div>
	<div class="time_to_closing">
		<?php echo sprintf( wp_kses( __( '<strong>%d h. %d min.</strong><br/>to closing', 'dent-all' ), array( 'strong' => array(), 'br' => array() )), date( 'H', $time_to_close ), date( 'i', $time_to_close ) ); ?>
	</div>
</div>