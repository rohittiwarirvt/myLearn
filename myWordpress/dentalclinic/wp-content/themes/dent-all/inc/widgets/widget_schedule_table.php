<?php

class Stm_Schedule_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct( 'stm_schedule', esc_html__( 'STM Schedule Table', 'dent-all' ) );
	}

	public function form( $instance ) {
		$title = isset ( $instance['title'] ) ? $instance['title'] : '';
		$title = esc_attr( $title );

		printf(
			'<p><label for="%1$s">%2$s</label><br />
            <input type="text" name="%3$s" id="%1$s" value="%4$s" class="widefat"></p>',
			$this->get_field_id( 'title' ),
			'Title',
			$this->get_field_name( 'title' ),
			$title
		);

		$fields                   = isset ( $instance['fields'] ) ? $instance['fields'] : array();
		$field_num                = count( $fields );
		$fields[ $field_num + 1 ] = '';
		$fields_html              = array();
		$fields_counter           = 0;

		foreach ( $fields as $name => $value ) {
			$fields_html[] = '<div class="stm_schedule-item">';

			$fields_html[] = sprintf( '<h4>%1s</h4>', esc_html__( 'Schedule Item', 'dent-all' ) );

			$fields_html[] = '<div class="stm_schedule-fields">';

			$fields_html[] = sprintf(
				'<input type="text" name="%1$s[%2$s][day]" value="%3$s" class="stm_schedule-field" placeholder="Day">',
				$this->get_field_name( 'fields' ),
				$fields_counter,
				( ! empty( $value['day'] ) ) ? esc_attr( $value['day'] ) : ''
			);
			$fields_html[] = sprintf(
				'<input type="text" name="%1$s[%2$s][hour]" value="%3$s" class="stm_schedule-field" placeholder="Hour">',
				$this->get_field_name( 'fields' ),
				$fields_counter,
				( ! empty( $value['hour'] ) ) ? esc_attr( $value['hour'] ) : ''
			);

			$fields_html[] = '<a href="#" class="stm_schedule-fields_remove"><span class="dashicons dashicons-no-alt"></span></a>';

			$fields_html[] = '</div>';

			$fields_html[] = '</div>';

			$fields_counter += 1;
		}

		print join( '', $fields_html );
		?>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				var removeFields = $('.stm_schedule-fields_remove');

				removeFields.live('click', function () {
					$(this).closest('.stm_schedule-item').remove();
					return false;
				});
			});
		</script>
		<?php
	}

	public function widget( $args, $instance ) {
		$output = '';

		$output .= $args['before_widget'];
		$output .= $args['before_title'] . esc_html( apply_filters( 'widget_title', $instance['title'] ) ) . $args['after_title'];

		if ( $instance['fields'] ) {
			$output .= '<ul class="stm_schedule_list">';

			foreach ( $instance['fields'] as $fields_array ) {
				$output .= '<li class="schedule-list_item">';
				$output .= '<span class="schedule_day">' . esc_html( $fields_array['day'] ) . '</span>';
				$output .= '<span class="schedule_time">' . esc_html( $fields_array['hour'] ) . '</span>';
				$output .= '</li>';
			}

			$output .= '</ul>';
		}
		$output .= $args['after_widget'];

		echo $output;
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = esc_html( $new_instance['title'] );

		$instance['fields'] = array();

		if ( isset ( $new_instance['fields'] ) ) {
			foreach ( $new_instance['fields'] as $value ) {
				if ( '' !== trim( $value ) ) {
					$instance['fields'][] = $value;
				}
			}
		}

		return $instance;
	}

}

function register_stm_schedule_widget() {
	register_widget( 'Stm_Schedule_Widget' );
}

add_action( 'widgets_init', 'register_stm_schedule_widget' );