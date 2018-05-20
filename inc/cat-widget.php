<?php

class cat_widget extends WP_Widget {


	public function __construct() {
		$widget_options = array(
			'classname' => 'flake_cat_widget',
			'Description' => 'Product top level categories widget by Flake.ink',
		);
		parent::__construct('flake_cat_widget', 'Flake Categories Widget', $widget_options);
	}


	public function widget($args,$instance){
		if ($instance['title'])
			$title = apply_filters('widget_title',$instance['title']);

		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];

		$terms = get_terms([
			'taxonomy' => 'product_cat',
			'parent' 	 => 0,
      'hide_empty' => 0,
		]);

    echo "<div><ul>";
		foreach ($terms as $term) {
			$children = get_term_children( $term->term_id, 'product_cat' );

  		if ( count( $children ) > 0 ) {
				$link = get_term_link($term->term_id);
				echo "<li class='menu-item'><a href='$link'>$term->name</a></li>";
			}
		}
    echo "</ul></div>";

		// echo "<pre>";
		// print_r($child);
		// echo "</pre>";

		echo $args['after_widget'];

	}

	public function form($instance) {
		$title = ! empty($instance['title']) ? $instance['title'] : ''; ?>
		<p>
	    <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
	    <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
	  </p><?php
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

} //class end

function flake_register_cat_widget() {
	register_widget( 'cat_widget' );
}

add_action('widgets_init','flake_register_cat_widget');

?>
