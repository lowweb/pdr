<?php
/*
Plugin Name: Flake AJAX filter
Plugin URI:
Description: filters categories
Version: 0.3
Author: vkrms
Author URI: vkrms.github.com
*/

// function fjx_load_scripts() {
// 	wp_enqueue_script('fjx-js', get_template_directory_uri() . '/js/fjx.js',['jquery','theme-scripts'],null,true);
// }
// add_action('wp_enqueue_scripts','fjx_load_scripts');


/*Let's go!*/

class ajax_widget extends WP_Widget {
	/**
	* To create the example widget all four methods will be
  * nested inside this single instance of the WP_Widget class.
	*/

	public function __construct() {
		$widget_options = array(
			'classname' => 'flake_ajax_widget',
			'Description' => 'Ajax filter by Flake.ink',
		);
		parent::__construct('flake_ajax_widget', 'Flake AJAX Widget', $widget_options);
	}


	public function widget($args,$instance){
		if (!empty($instance['title']))
			$title = apply_filters('widget_title',$instance['title']);

		echo $args['before_widget'] . $args['before_title'] . "<a href='/shop/'>" . $title . "</a>" . $args['after_title'];

		$terms = get_terms([
			'taxonomy' => 'product_cat',
			'parent' 	 => 0
		]);

		foreach ($terms as $term) {
			$id = $term->term_id;
			$link = get_term_link($id);
			$is_special = get_term_meta($id,'is_special',true);
			$special = $is_special ? 'special' : '';
			$children = get_term_children( $term->term_id, 'product_cat' );

			$empty = count( $children ) <= 0 ? 'no-content' : '';

			echo "<li class='fjx-top $special $empty'>
							<a class='fjx top' href='$link'>$term->name</a>
							<a class='fjx-more'></a>
						</li>";

  		if ( count( $children ) > 0 ) {
	    	echo "<ul class='fjx-subcat'>";
				foreach ($children as $child) {
					$link = get_term_link($child);
					$child = get_term($child);
					echo "<li><a class='fjx sub' href='$link'>$child->name</a></li>";

				}
				echo "</ul>";
			}

		}

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

function flake_register_ajax_widget() {
	register_widget( 'ajax_widget' );
}

add_action('widgets_init','flake_register_ajax_widget');


 /**
  * add loadmore btn
  */
	add_action( 'woocommerce_after_shop_loop', 'add_loadmore' );
	function add_loadmore(){
		global $wp_query;
		$total 	 = $wp_query->max_num_pages;
		// $current = max( 1, get_query_var( 'paged' ) );
		$disabled = ($total == 1) ? 'disabled="disabled"' : '';
		$pc = $wp_query->post_count;
		$pf = $wp_query->found_posts;
		echo "<div id=\"items-count\"><span id=\"ic_showing\">$pc</span> из $pf</div>";
		echo "<button id=\"loadmore\" class='btn' data-total='$total' $disabled>загрузить ещё</button>";
	}
