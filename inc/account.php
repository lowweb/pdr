<?php

/**
* UserName shortcode
*/
add_shortcode('username','username_shortcode');
function username_shortcode(){
  $uid = get_current_user_id();
  if ($uid == 0) return;
  $udata = get_userdata( $uid );
  return $udata->user_login;
};

/**
* Modify my account navigation
*/
function my_account_order() {
 return array(
 'edit-account' => __( 'My Details', 'fstore' ),
 'orders' => __( 'Orders', 'fstore' ),
 // 'discounts' => __( 'Discounts', 'fstore' ),
 'support' => __( 'Support', 'fstore' ),
 'customer-logout' => __( 'Logout', 'woocommerce' ),
 // 'dashboard' => __( 'Dashboard', 'woocommerce' ),
 // 'edit-address' => __( 'Addresses', 'woocommerce' ),
);}
add_filter( 'woocommerce_account_menu_items', 'my_account_order' );


/**
* Get endpoint icon
* val equals symbol id in sprites.svg
*/
function endpoint_icon($endpoint){
  $icons = array(
    'edit-account' => 'user2',
    'orders' => 'log',
    'discounts' => 'percent',
    'support' => 'chat',
    'customer-logout' => 'exit'
  );

  echo '#'.$icons[$endpoint];
}

/**
* Saving custom fields
*/
add_action( 'woocommerce_save_account_details', 'save_account_details' );
function save_account_details(){

  $user_id = get_current_user_id();

  if($_POST['account_billing_phone']) {
    update_user_meta($user_id,'billing_phone',$_POST['account_billing_phone']);
  }

  if($_POST['account_shipping_city']) {
    update_user_meta($user_id,'shipping_city',$_POST['account_shipping_city']);
  }

  if($_POST['account_shipping_address_1']) {
    update_user_meta($user_id,'shipping_address_1',$_POST['account_shipping_address_1']);
  }
}

/**
* Custom password change
*/
add_action( 'template_redirect', 'change_password' );

function change_password(){

  if ( empty( $_POST['action'] ) || 'change_password' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'change_password' ) ) {
    return;
  }

  $errors = new WP_Error();
  $user   = new stdClass();

  $user->ID     = (int) get_current_user_id();
  $current_user = get_user_by( 'id', $user->ID );

  if ( $user->ID <= 0 ) {
    return;
  }

  $pass_cur           = ! empty( $_POST['password_current'] ) ? $_POST['password_current'] : '';
	$pass1              = ! empty( $_POST['password_1'] ) ? $_POST['password_1'] : '';
	$pass2              = ! empty( $_POST['password_2'] ) ? $_POST['password_2'] : '';
	$save_pass          = true;

  if ( ! empty( $pass_cur ) && empty( $pass1 ) && empty( $pass2 ) ) {
    wc_add_notice( __( 'Please fill out all password fields.', 'woocommerce' ), 'error' );
    $save_pass = false;
  } elseif ( ! empty( $pass1 ) && empty( $pass_cur ) ) {
    wc_add_notice( __( 'Please enter your current password.', 'woocommerce' ), 'error' );
    $save_pass = false;
  } elseif ( ! empty( $pass1 ) && empty( $pass2 ) ) {
    wc_add_notice( __( 'Please re-enter your password.', 'woocommerce' ), 'error' );
    $save_pass = false;
  } elseif ( ( ! empty( $pass1 ) || ! empty( $pass2 ) ) && $pass1 !== $pass2 ) {
    wc_add_notice( __( 'New passwords do not match.', 'woocommerce' ), 'error' );
    $save_pass = false;
  } elseif ( ! empty( $pass1 ) && ! wp_check_password( $pass_cur, $current_user->user_pass, $current_user->ID ) ) {
    wc_add_notice( __( 'Your current password is incorrect.', 'woocommerce' ), 'error' );
    $save_pass = false;
  }

  if ( $pass1 && $save_pass ) {
    $user->user_pass = $pass1;
  }

  if ( $errors->get_error_messages() ) {
    foreach ( $errors->get_error_messages() as $error ) {
      wc_add_notice( $error, 'error' );
    }
  }

  if ( wc_notice_count( 'error' ) === 0 ) {
    wp_update_user( $user );
    wc_add_notice( __( 'Password changed successfully.', 'woocommerce' ) );
    do_action( 'woocommerce_save_account_details', $user->ID );
    wp_safe_redirect( wc_get_page_permalink( 'myaccount' ) );
    exit;
  }

}

/**
 * Redeclare my account content output without 'dashboard'.
 */
function woocommerce_account_content() {
  global $wp;
  foreach ( $wp->query_vars as $key => $value ) {
    // Ignore pagename param.
    if ( 'pagename' === $key ) {
      continue;
    }
    if ( has_action( 'woocommerce_account_' . $key . '_endpoint' ) ) {
      do_action( 'woocommerce_account_' . $key . '_endpoint', $value );
      return;
    }
  }
  // Default to account details.
  do_action( 'woocommerce_account_edit-account_endpoint', 'edit-account' );
}

/**
* Support endpoint page
*/
include('support.php');
