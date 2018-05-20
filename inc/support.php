<?php

include('Endpoint.php');

// endpoint == user area page
$support   = new Custom_Endpoint('support');
$discounts = new Custom_Endpoint('discounts');

// Flush rewrite rules on plugin activation.
// register_activation_hook( __FILE__, array( 'Custom_Endpoint', 'install' ) );
// $endpoint->install();
Custom_Endpoint::install();


/**
* Handle support submit
*/
add_action( 'template_redirect', 'submit_support' );

function submit_support(){

  if ( empty($_POST['support_msg']) || empty( $_POST['action'] )) {
    return;
  }

  $ceo = ('submit_message_ceo' == $_POST['action']) ? true : false;

  $name  = $_POST['support_name'];
  $phone = $_POST['support_phone'];
  $email = $_POST['support_email'];
  $msg   = $_POST['support_msg'];
  $recap = $_POST['g-recaptcha-response'];

  $fields = [$name, $phone, $email, $msg, $recap];
  foreach ($fields as $field) {
    if (empty($field)) {
      wc_add_notice( __( 'Обязательное поле не заполнено', 'fstore' ), 'error');
      return;
    }
  }

  if(!validateRecap('6LcgCyUUAAAAAFr3VYpTeeSK0yXLmj8oZveimpFi')) {
    wc_add_notice( __( 'Подтвердите, что вы не робот', 'fstore' ), 'error');
    return false;
  }

  $date = date_i18n( 'd F Y', current_time('timestamp') );
  $icon = base64_encode(file_get_contents(FROOT.'/img/clock.png'));
  // $to = 'subkhangulova_e@podryad.tv, cmo@podryad.tv, april504@yandex.ru';
  $to = get_option('support-emails');
  $subj = __('New support message','fstore');
  if ($ceo === true) {
    $to .= ', '.get_option('ceo-emails');
    $subj = __('New message for CEO','fstore');
  }

  include('partials/support-email.php');

  // html please
  function mail_content_type(){
    return "text/html";
  };
  add_filter( 'wp_mail_content_type','mail_content_type' );

  if (wp_mail( $to, $subj, $body)) {
         wc_add_notice( __( 'Message sent', 'fstore' ));
  } else wc_add_notice( __( 'Something went wrong. Try later', 'fstore' ), 'error');

}

/**
 * options screen
 */

add_action('admin_menu','support_options');
function support_options(){
	 add_submenu_page('options-general.php','Настройки email\'ов','Настройки email\'ов','read','main-conf',function(){
		 include('partials/support-options.php');
	 });
}
