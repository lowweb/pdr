<?php
/**
 * Support form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if (empty($user)) {
	$user = new stdClass;
	$user->first_name = "";
	$user->billing_phone = "";
	$user->user_email = "";
}

?>

<?php wc_print_notices(); ?>

<h1 id="contact-ceo-heading" class="page-heading"><?php _e('Direct Message to CEO', 'fstore') ?></h1>
<form class="account-support" id="contact-ceo-form" action="" method="post">
  <div class="support-col">
    <p class="woocommerce-form-row form-row">
  		<label for="support_name"><?php _e( 'First name', 'woocommerce' ); ?></label>
  		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
      name="support_name" id="support_name"
      value="<?php echo esc_attr( $user->first_name ); ?>"
			required />
  	</p>
  	<p class="woocommerce-form-row form-row">
  		<label for="support_phone"><?php _e( 'Phone number', 'fstore' ); ?></label>
  		<input type="text" class="woocommerce-Input woocommerce-Input--tel input-tel"
      name="support_phone" id="support_phone"
      value="<?php echo esc_attr( $user->billing_phone ); ?>"
			required
			/>
  	</p>
  	<p class="woocommerce-form-row form-row">
  		<label for="support_email"><?php _e( 'Email address', 'fstore' ); ?></label>
  		<input type="email" class="woocommerce-Input woocommerce-Input--email input-text"
      name="support_email" id="support_email"
      value="<?php echo esc_attr( $user->user_email ); ?>"
			required/>
  	</p>


  </div>
  <div class="support-col-wide">
    <p class="woocommerce-form-row form-row form-row-wide">
      <label for="account_email">
        <?php _e( 'Describe your question or leave a testimonial', 'fstore' ) ?>
      </label>
  		<textarea class="woocommerce-Input woocommerce-Input--textarea input-textarea"
      	name="support_msg" id="support_msg_ceo" required><?php if (!empty($_POST['support_msg'])) echo $_POST['support_msg'] ?>
			</textarea>
			
			<div class="g-recaptcha" id="ceo-recaptcha" data-sitekey="6LcgCyUUAAAAAJytHQvH9uHbPbz9unE3WjXDQeBf"></div>
    </p>

    <input type="submit" class="woocommerce-Button button blue submit-support"
    name="submit_support" value="<?php esc_attr_e( 'Send', 'fstore' ); ?>" />
    <input type="hidden" name="action" value="submit_message_ceo" />
  </div>
</form>
