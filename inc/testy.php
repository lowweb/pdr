<?php
/*
Plugin Name: Flake Testimonials
Plugin URI:
Description: Testimonials plugin by Flake.ink
Version: 0.1
Author: vkrms
Author URI: vkrms.github.com
*/

// function testy_load_scripts() {
// 	// wp_enqueue_script('testy-js', plugin_dir_url(__FILE__) . 'testy.js',['jquery','owl-script'],null,true);
// }
// add_action('wp_enqueue_scripts','testy_load_scripts');


// echo load_plugin_textdomain('testy', false, get_template_directory_uri() . "/languages/") ? "here true " : "here false ";
// echo get_template_directory_uri() . "/languages/";

function testimonial_post_type(){
	$labels = array(
		'name'                  => __( 'Отзывы', 'testy' ),
		'singular_name'         => __( 'Отзыв', 'testy' ),
		'menu_name'             => __( 'Отзывы', 'testy' ),
		'name_admin_bar'        => __( 'Отзыв', 'testy' ),
		'archives'              => __( 'Архив отзывов', 'testy' ),
		'edit_item'             => __( 'Редактировать отзыв', 'testy' )
	);
	$args = array(
		'label'                 => __( 'Отзыв', 'testy' ),
		'description'           => __( 'Отзывы', 'testy' ),
		'labels'                => $labels,
		'supports'              => array('title', 'editor', 'thumbnail'),
		//'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-thumbs-up',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
	);
	register_post_type( 'testimonial', $args );

}

add_action( 'init', 'testimonial_post_type', 0 );

/// position metabox
function testy_position( $meta_boxes ) {
	$prefix = 'testy_';

	$meta_boxes[] = array(
		'id' => 'position',
		'title' => __( 'Meta', 'testy' ),
		'post_types' => array( 'testimonial' ),
		'context' => 'advanced',
		'priority' => 'default',
		'autosave' => false,
		'fields' => array(
			array(
				'id' => $prefix . 'position',
				'type' => 'text',
				'name' => __( 'Company & Position', 'testy' ),
				'placeholder' => __('Должность, название компании', 'testy')
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'testy_position' );


add_shortcode('testimonials','testy_shortcode');
function testy_shortcode() {

	$args = [
		'post_type' => 'testimonial'
	];

	$testy = new WP_Query( $args );

	if ($testy->have_posts()) {

		ob_start();

		while ($testy->have_posts()) : $testy->the_post() ?>
			<div class="testy-card">
				<div class="testy-thumb">
					<?php the_post_thumbnail()?>
				</div>
				<div class="testy-content">
					<h3><?php the_title()?></h3>
					<div class="testy_position">
						<?php echo rwmb_meta( 'testy_position' ); ?>
					</div>
					<?php the_content()?>
				</div>
			</div>
		<?php
		endwhile;
			wp_reset_query();

	} else return;

	return '
		<section id="testimonials">
			<div class="container">
				<div class="testy">
					<div class="testy-heading">
						<h2>'.__('Отзывы','testy').'</h2>
						<nav class="testy-nav"></nav>
					</div>
					<div class="owl-testy owl-carousel">'.ob_get_clean().'</div>
				</div>
			</div>
		</section>
	';
}
