<?php

class Stm_Contacts_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( 'contacts', esc_html__( 'Contacts', 'dent-all' ) );
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}
		echo '<ul>';
		if ( ! empty( $instance['address'] ) ) {
			echo '<li><div class="text"><strong>' . esc_html__( 'Office', 'dent-all' ) . '</strong><p>' . nl2br( esc_html( $instance['address'] ) ) . '</p></div><div class="icon"><i class="stm-icon-map-marker"></i></div></li>';
		}

		if ( ! empty( $instance['email'] ) ) {
			echo '<li><div class="text"><strong>' . esc_html__( 'E-mail', 'dent-all' ) . '</strong><p><a href="mailto:' . antispambot( $instance['email'] ) . '">' . antispambot( $instance['email'] ) . '</a></p></div><div class="icon"><i class="fa fa-envelope-o"></i></div></li>';
		}

		if ( ! empty( $instance['phone'] ) ) {
			echo '<li><div class="text"><strong>' . esc_html__( 'Phone', 'dent-all' ) . '</strong><p>' . nl2br( esc_html( $instance['phone'] ) ) . '</p></div><div class="icon"><i class="stm-icon-roundels"></i></div></li>';
		}

		if ( ! empty( $instance['hours'] ) ) {
			echo '<li><div class="text"><strong>' . esc_html__( 'Opening hours', 'dent-all' ) . '</strong><p>' . nl2br( esc_html( $instance['hours'] ) ) . '</p></div><div class="icon"><i class="stm-icon-clock"></i></div></li>';
		}

		echo '</ul>';


		echo $args['after_widget'];
	}

	public function form( $instance ) {

		$title   = '';
		$address = '';
		$phone   = '';
		$hours     = '';
		$email   = '';

		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = esc_html__( 'Contact', 'dent-all' );
		}

		if ( isset( $instance['address'] ) ) {
			$address = $instance['address'];
		}

		if ( isset( $instance['email'] ) ) {
			$email = $instance['email'];
		}

		if ( isset( $instance['phone'] ) ) {
			$phone = $instance['phone'];
		}

		if ( isset( $instance['hours'] ) ) {
			$hours = $instance['hours'];
		}

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'dent-all' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Address:', 'dent-all' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>"><?php echo esc_textarea( $address ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'E-mail:', 'dent-all' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" value="<?php echo sanitize_email( $email ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone:', 'dent-all' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>"><?php echo esc_textarea( $phone ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'hours' ) ); ?>"><?php esc_html_e( 'Hours:', 'dent-all' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hours' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hours' ) ); ?>"><?php echo esc_textarea( $hours ); ?></textarea>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance            = array();
		$instance['title']   = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $new_instance['address'] ) ) ) : '';
		$instance['email']   = ( ! empty( $new_instance['email'] ) ) ? sanitize_email( $new_instance['email'] ) : '';
		$instance['phone']   = ( ! empty( $new_instance['phone'] ) ) ? implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $new_instance['phone'] ) ) ) : '';
		$instance['hours']     = ( ! empty( $new_instance['hours'] ) ) ? implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $new_instance['hours'] ) ) ) : '';

		return $instance;
	}

}

function register_contacts_widget() {
	register_widget( 'Stm_Contacts_Widget' );
}

add_action( 'widgets_init', 'register_contacts_widget' );