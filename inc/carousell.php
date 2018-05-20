<?php

function cs_load_scripts() {
	wp_enqueue_script('cs-js', get_template_directory_uri() . '/js/carousell.min.js',['jquery','owl-script'],null,true);
}
add_action('wp_enqueue_scripts','cs_load_scripts');

/**
* homepage shortcode
*/
function carousel_shortcode(){
	return '
	<div class="carousel-shortcode">
		<div class="carousel-heading">
			<nav class="carousel-tabs"><button class="active carousel-tab" data-type="featured">'.__('Featured','fstore').'</button>
							<i class="carousel-bs"></i>
							<button class="carousel-tab" data-type="sale">'.__('Sale','fstore').'</button>
							<i class="carousel-bs"></i>
							<button class="carousel-tab" data-type="recent">'.__('Recent','fstore').'</button></nav>
			<nav class="carousel-nav"></nav>
		</div>
		<div class="prod-carousel owl-carousel woocommerce tabbed"></div>
	</div>
	';
}
add_shortcode('carousel','carousel_shortcode');

include('carousell-cookie.php');

/**
* recently viewed shortcode
*/
function carousel_recent_shortcode(){

	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
	$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );

	if ( empty( $viewed_products ) ) {
		return;
	}

	$query_args = array(
		'posts_per_page' => 6,
		'no_found_rows'  => 1,
		'post_status'    => 'publish',
		'post_type'      => 'product',
		'post__in'       => $viewed_products,
		'orderby'        => 'post__in',
	);

	$r = new WP_Query( $query_args );

	ob_start();

	if ($r->have_posts()) :
		while ( $r->have_posts() ) : $r->the_post(); global $product;
			wc_get_template_part( 'content', 'product' );
		endwhile;
		wp_reset_query();
	else:
		get_template_part('content','none');
	endif;

	return '
	<div class="carousel-shortcode recent">
		<div class="carousel-heading">
			<h3 class="carousel-tabs">'.__('Recently viewed','fstore').'</h3>
			<nav class="carousel-nav"></nav>
		</div>
		<div class="prod-carousel owl-carousel woocommerce recent">'.ob_get_clean().'</div>
	</div>
	';
}
add_shortcode('carousel-recent','carousel_recent_shortcode');

/**
* related shortcode
*/
function carousel_related_shortcode(){
	global $product;
	$related_products = wc_get_related_products( $product->get_id(), 6, $product->get_upsell_ids() );

	if ( empty( $related_products ) ) {
		return;
	}

	$query_args = array(
		'posts_per_page' => 6,
		'no_found_rows'  => 1,
		'post_status'    => 'publish',
		'post_type'      => 'product',
		'post__in'       => $related_products,
		'orderby'        => 'post__in',
	);

	$rel = new WP_Query( $query_args );

	ob_start();

	if ($rel->have_posts()) :
		while ( $rel->have_posts() ) : $rel->the_post();
			wc_get_template_part( 'content', 'product' );
		endwhile;
		wp_reset_query();
	else:
		get_template_part('content','none');
	endif;

	return '
	<div class="carousel-shortcode related">
		<div class="carousel-heading">
			<h3 class="carousel-tabs">'.__('Related','fstore').'</h3>
			<nav class="carousel-nav"></nav>
		</div>
		<div class="prod-carousel owl-carousel woocommerce related">'.ob_get_clean().'</div>
	</div>
	';
}
add_shortcode('carousel-related','carousel_related_shortcode');

/**
* featured action
*/
add_action('wp_ajax_load_featured','load_featured');
add_action('wp_ajax_nopriv_load_featured','load_featured');

function load_featured(){
  $meta_query  = WC()->query->get_meta_query();
	$tax_query   = WC()->query->get_tax_query();
	$tax_query[] = array(
		'taxonomy' => 'product_visibility',
		'field'    => 'name',
		'terms'    => 'featured',
		'operator' => 'IN',
	);

	$args = array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
		'meta_query'          => $meta_query,
		'tax_query'           => $tax_query,
	);

		$featured = new WP_Query( $args );

		ob_start();

    if ($featured->have_posts()) :
  		while ( $featured->have_posts() ) : $featured->the_post(); global $product;
  			// echo the_title()."<br>";
  			wc_get_template_part( 'content', 'product' );
  		endwhile;
      wp_reset_query();
    else:
      get_template_part('content','none');
    endif;

    $content = ob_get_clean();

  	echo $content;
  	die();

}

/**
* sale action
*/
add_action('wp_ajax_load_sale','load_sale');
add_action('wp_ajax_nopriv_load_sale','load_sale');

function load_sale(){
  $args = array(
    'no_found_rows'  => 1,
    'post_status'    => 'publish',
    'post_type'      => 'product',
    'meta_query'     => WC()->query->get_meta_query(),
    'tax_query'      => WC()->query->get_tax_query(),
    'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
  );

		$sale = new WP_Query( $args );

		ob_start();

    if ($sale->have_posts()) :
  		while ( $sale->have_posts() ) : $sale->the_post(); global $product;
  			wc_get_template_part( 'content', 'product' );
  		endwhile;
      wp_reset_query();
    else:
      get_template_part('content','none');
      // echo "тут ничего нет";
    endif;

    $content = ob_get_clean();

  	echo $content;
  	die();

}

/**
* recent action
*/
add_action('wp_ajax_load_recent','load_recent');
add_action('wp_ajax_nopriv_load_recent','load_recent');

function load_recent(){
  $args = array(
    'post_type'           => 'product',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
    'posts_per_page'      => 12,
    'meta_query'          => WC()->query->get_meta_query(),
    'tax_query'           => WC()->query->get_tax_query(),
  );

		$recent = new WP_Query( $args );

		ob_start();

    if ($recent->have_posts()) :
  		while ( $recent->have_posts() ) : $recent->the_post(); global $product;
  			wc_get_template_part( 'content', 'product' );
  		endwhile;
      wp_reset_query();
    else:
      get_template_part('content','none');
    endif;

    $content = ob_get_clean();

  	echo $content;
  	die();

}

?>
