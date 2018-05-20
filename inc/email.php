<?php

/**
* styles
*/

add_filter( 'woocommerce_email_styles', 'email_styles' );
function email_styles( $css ) {

	$css .= "#template_header { background-color: #3f419a; }";
	$css .= "#template_header h1 {font-size: 22px; display: inline-block; max-width: 366px; }";
	$css .= "#template_header img {float: right; }";
	$css .= ".td { border: none; border-bottom: 1px solid #f1f1f2; }";
	$css .= "#customer_details { float: left; width: 50%; }";
	$css .= "table#addresses { width: 36%; float: right; }";
	$css .= "#addr-wrap { width: 36%; float: right; }";
	$css .= ".td.price { white-space: nowrap; }";
	$css .= ".td.price > span > span { font-family: 'cur'; }";
	$css .= "h2#customer_details-heading { font-weight:300; font-size: 22px; }";
	$css .= "ul#customer_details-list { list-style: none; padding: 0; }";
	$css .= ".discount-notice { font-size: 12px; color: #a7a9ac; }";
	return $css;
}


/**
*  Add a custom email to the list of emails WooCommerce should load
*
* @param array $email_classes available email classes
* @return array filtered available email classes
*/

function add_test_email($email_classes) {
	//  include custom class
	require('class-wc-test-email.php');

	// add the email class to the list of email classes that WC loads
	$email_classes['WC_Test_Email'] = new WC_Test_Email();

	return $email_classes;
}
add_filter('woocommerce_email_classes','add_test_email');
