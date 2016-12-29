<?php

class Stm_Socials_Widget extends WP_Widget {

	var $socials;

	function __construct() {
		parent::__construct( 'stm_socials', esc_html__( 'STM Socials', 'dent-all' ) );
		$this->socials = array(
			array(
				'id'    => 'facebook',
				'title' => esc_html__( 'Facebook', 'dent-all' ),
			),
			array(
				'id'    => 'twitter',
				'title' => esc_html__( 'Twitter', 'dent-all' ),
			),
			array(
				'id'    => 'instagram',
				'title' => esc_html__( 'Instagram', 'dent-all' ),
			),
			array(
				'id'    => 'behance',
				'title' => esc_html__( 'Behance', 'dent-all' ),
			),
			array(
				'id'    => 'dribbble',
				'title' => esc_html__( 'Dribbble', 'dent-all' ),
			),
			array(
				'id'    => 'flickr',
				'title' => esc_html__( 'Flickr', 'dent-all' ),
			),
			array(
				'id'    => 'git',
				'title' => esc_html__( 'Git', 'dent-all' ),
			),
			array(
				'id'    => 'linkedin',
				'title' => esc_html__( 'Linkedin', 'dent-all' ),
			),
			array(
				'id'    => 'pinterest',
				'title' => esc_html__( 'Pinterest', 'dent-all' ),
			),
			array(
				'id'    => 'yahoo',
				'title' => esc_html__( 'Yahoo', 'dent-all' ),
			),
			array(
				'id'    => 'delicious',
				'title' => esc_html__( 'Delicious', 'dent-all' ),
			),
			array(
				'id'    => 'dropbox',
				'title' => esc_html__( 'Dropbox', 'dent-all' ),
			),
			array(
				'id'    => 'reddit',
				'title' => esc_html__( 'Reddit', 'dent-all' ),
			),
			array(
				'id'    => 'soundcloud',
				'title' => esc_html__( 'Soundcloud', 'dent-all' ),
			),
			array(
				'id'    => 'google',
				'title' => esc_html__( 'Google', 'dent-all' ),
			),
			array(
				'id'    => 'skype',
				'title' => esc_html__( 'Skype', 'dent-all' ),
			),
			array(
				'id'    => 'youtube',
				'title' => esc_html__( 'Youtube', 'dent-all' ),
			),
			array(
				'id'    => 'tumblr',
				'title' => esc_html__( 'Tumblr', 'dent-all' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . esc_html( apply_filters( 'widget_title', $instance['title'] ) ) . $args['after_title'];
		}
		echo '<ul>';
		foreach ( $this->socials as $social ) {
			if ( ! empty( $instance[ $social['id'] ] ) ) {
				echo '<li><a href="' . esc_url( $instance[ $social['id'] ] ) . '"><i class="fa fa-' . esc_attr( $social['id'] ) . '"></i></a></li>';
			}
		}
		echo '</ul>';
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Our Social Pages', 'dent-all' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'dent-all' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		foreach ( $this->socials as $social ):
			$soc_val = ! empty( $instance[$social['id']] ) ? $instance[$social['id']] : '';
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( $social['id'] ) ); ?>"><?php echo esc_html( $social['title'] ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $social['id'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $social['id'] ) ); ?>" type="text" value="<?php echo esc_url( $soc_val ); ?>">
			</p>
		<?php endforeach;
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		foreach ( $this->socials as $social ) {
			if ( ! empty( $new_instance[ $social['id'] ] ) ) {
				$instance[ $social['id'] ] = esc_url( $new_instance[ $social['id'] ] );
			}else{
				$instance[ $social['id'] ] = '';
			}
		}
		return $instance;
	}

}

function register_stm_socials_widget() {
	register_widget( 'Stm_Socials_Widget' );
}
add_action( 'widgets_init', 'register_stm_socials_widget' );