<?php

/**
* CEO message shortcode
*/
add_shortcode('message-ceo','ceo_shortcode');
function ceo_shortcode(){
	wc_get_template( 'myaccount/message-ceo.php', array('user' => get_user_by('id', get_current_user_id())));
	wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );
}

add_action( 'template_redirect', 'submit_support' );

/**
* Handle support submit
*/
// function submit_message_ceo(){
//
// }
