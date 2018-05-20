<?php

/**
 * Register new status
**/
function register_arrived_order_status() {
    register_post_status( 'wc-arrived', array(
        'label'                     => __('Arrived at Vladivostok','fstore'),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Awaiting shipment <span class="count">(%s)</span>', 'Awaiting shipment <span class="count">(%s)</span>' )
    ) );
}
add_action( 'init', 'register_arrived_order_status' );

// Add to list of WC Order statuses
add_filter( 'wc_order_statuses', 'add_arrived_to_order_statuses' );
function add_arrived_to_order_statuses( $order_statuses ) {
    $order_statuses['wc-arrived'] = __('Arrived at Vladivostok','fstore');
    return $order_statuses;
}


add_action( 'init' , 'initiate_woocommerce_email' );
function initiate_woocommerce_email(){
   // Just when you update the order_status on backoffice
   if( isset($_POST['order_status']) ) {
        WC()->mailer();
    }
}

/**
 * Adds icons for any custom order statuses
**/
add_action( 'wp_print_scripts', 'add_custom_order_status_icon' );
function add_custom_order_status_icon() {

	if( ! is_admin() ) {
		return;
	}

	?>
  <style>
		/* Add custom status order icons */
    .column-order_status mark.arrived {
        background: url(/wp-content/themes/fstore/img/status-arrived.png);
        background-size: contain;
    }
	</style> <?php
}
