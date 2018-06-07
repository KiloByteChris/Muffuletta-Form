<?php
/*
Plugin Name: My First Widget
Plugin URI: http://clark.edu
Description: My Awesome widget
Author: Bruce
Version: 1.0
*/
// Block direct requests
// This prevents somebody from opening the URL directly to the widget itself
if ( !defined('ABSPATH') )
	die('-1');

// Register the widget
// See Codex https://codex.wordpress.org/Function_Reference/register_widget
// Takes a class as a parameter
add_action( 'widgets_init', function(){
     register_widget( 'My_Widget' );
});
/**
 * Adds My_Widget widget.
 */
// Codex: https://developer.wordpress.org/reference/classes/wp_widget/
class My_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	// Class constructor
	function __construct() {
		parent::__construct(
			'My_Widget', // Base ID
			__('My Widget', 'text_domain'), // Name
			array( 'description' => __( 'My Awesome widget!', 'text_domain' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		// Codex: https://codex.wordpress.org/Widgets_API#Example
     	echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		echo __( 'Hello, World!', 'text_domain' );
		echo $args['after_widget'];
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // class My_Widget
