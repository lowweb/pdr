<?php

function slider_post_type(){
	$labels = array(
		'name'                  => __( 'Slider', 'fstore' ),
		'singular_name'         => __( 'Slide', 'fstore' ),
		'menu_name'             => __( 'Slides', 'fstore' ),
		'name_admin_bar'        => __( 'Slide', 'fstore' ),
		'archives'              => __( 'Slide Archives', 'fstore' ),
		'edit_item'             => __( 'Edit This Slide', 'fstore' )
	);
	$args = array(
		'label'                 => __( 'Slide', 'fstore' ),
		'description'           => __( 'Slides', 'fstore' ),
		'labels'                => $labels,
		'supports'              => array('title', 'editor', 'thumbnail'),
		//'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-format-gallery',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
	);
	register_post_type( 'slider', $args );
}

add_action( 'init', 'slider_post_type', 0 );

/**
* Link meta box
*/
function slide_link( $meta_boxes ) {
	$prefix = 'slide_';

	$meta_boxes[] = array(
		'id' => 'slide_link',
		'title' => __( 'Meta', 'fstore' ),
		'post_types' => array( 'slider' ),
		'context' => 'advanced',
		'priority' => 'default',
		'autosave' => false,
		'fields' => array(
			array(
				'id' => $prefix . 'link',
				'type' => 'text',
				'name' => __( 'Link', 'fstore' ),
				'placeholder' => __('http://...', 'fstore')
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'slide_link' );


add_shortcode('slider','slider_shortcode');
function slider_shortcode(){

  $query_args = array(
		// 'posts_per_page' => 6,
		'post_status'    => 'publish',
		'post_type'      => 'slider',
	);

	$s = new WP_Query( $query_args );

	ob_start();

	if ($s->have_posts()) :
		while ( $s->have_posts() ) : $s->the_post();?>
      <a class="slide" href="<?php echo rwmb_meta( 'slide_link' ) ?>">
        <?php the_post_thumbnail([920,300]); ?>
      </a>
    <?php
		endwhile;
		wp_reset_query();
	else:
		get_template_part('content','none');
		return false;
	endif;

	return '
	<div class="slider-shortcode">
		<div class="slider-carousel owl-carousel">'.ob_get_clean().'</div>
	</div>
	';
}
