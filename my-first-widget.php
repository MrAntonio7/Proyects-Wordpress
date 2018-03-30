<?php
/*
Plugin Name: My Widget
Plugin URI: http://wordpress.org/extend/plugins/#
Description: This is an example plugin 
Author: Antonio Jesus Alvarez Mlagon
Version: 1.0
*/
add_action( 'widgets_init', function(){
	register_widget( 'My_Widget' );
});

class My_Widget extends WP_Widget {
	
	// class constructor
	public function __construct() {
			$widget_ops = array( 
		'classname' => 'my_widget',
		'description' => 'A plugin for Kinsta blog readers',
	);
	parent::__construct( 'my_widget', 'My Widget', $widget_ops );
	}
	
	// output the widget content on the front-end
	public function widget( $args, $instance ) {
			echo $args['before_widget'];
	if ( ! empty( $instance['title'] ) ) {
		echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
	}

	if( ! empty( $instance['selected_posts'] ) && is_array( $instance['selected_posts'] ) ){ 

		$selected_posts = get_posts( array( 'post__in' => $instance['selected_posts'] ) );
		?>
		<ul>
		<?php foreach ( $selected_posts as $post ) { ?>
			<li><a href="<?php echo get_permalink( $post->ID ); ?>">
			<?php echo $post->post_title; ?>
			</a></li>		
		<?php } ?>
		</ul>
		<?php 
		
	}else{
		echo esc_html__( 'No posts selected!', 'text_domain' );	
	}

	echo $args['after_widget'];
	}

	// output the option form field in admin Widgets screen
	public function form( $instance ) {
	$posts = get_posts( array( 
			'posts_per_page' => 20,
			'offset' => 0
		) );
	$selected_posts = ! empty( $instance['selected_posts'] ) ? $instance['selected_posts'] : array();
	?>
	<div style="max-height: 120px; overflow: auto;">
	<ul>
	<?php foreach ( $posts as $post ) { ?>

		<li><input 
			type="checkbox" 
			name="<?php echo esc_attr( $this->get_field_name( 'selected_posts' ) ); ?>[]" 
			value="<?php echo $post->ID; ?>" 
			<?php checked( ( in_array( $post->ID, $selected_posts ) ) ? $post->ID : '', $post->ID ); ?> />
			<?php echo get_the_title( $post->ID ); ?></li>

	<?php } ?>
	</ul>
	</div>
	<?php
	}

	// save options
	public function update( $new_instance, $old_instance ) {
			$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		
	$selected_posts = ( ! empty ( $new_instance['selected_posts'] ) ) ? (array) $new_instance['selected_posts'] : array();
	$instance['selected_posts'] = array_map( 'sanitize_text_field', $selected_posts );

	return $instance;
	}
}