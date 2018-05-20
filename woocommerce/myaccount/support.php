<?php
/**
 * Support form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<form class="account-support" action="" method="post">
  <div class="support-col">
    <p class="woocommerce-form-row form-row">
  		<label for="support_name"><?php _e( 'First name', 'woocommerce' ); ?></label>
  		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
      name="support_name" id="support_name"
      value="<?php echo esc_attr( $user->first_name ); ?>" />
  	</p>
  	<p class="woocommerce-form-row form-row">
  		<label for="support_phone"><?php _e( 'Phone number', 'fstore' ); ?></label>
  		<input type="text" class="woocommerce-Input woocommerce-Input--tel input-tel"
      name="support_phone" id="support_phone"
      value="<?php echo esc_attr( $user->billing_phone ); ?>" />
  	</p>
  	<p class="woocommerce-form-row form-row">
  		<label for="support_email"><?php _e( 'Email address', 'fstore' ); ?></label>
  		<input type="email" class="woocommerce-Input woocommerce-Input--email input-text"
      name="support_email" id="support_email"
      value="<?php echo esc_attr( $user->user_email ); ?>" />
  	</p>
  </div>
  <div class="support-col-wide">
    <p class="woocommerce-form-row form-row form-row-wide">
      <label for="account_email">
        <?php _e( 'Describe your question or leave a testimonial', 'fstore' ) ?>
      </label>
  		<textarea class="woocommerce-Input woocommerce-Input--textarea input-textarea"
      name="support_msg" id="support_msg"></textarea>
    </p>
    <p>
      <input type="submit" class="woocommerce-Button button blue submit-support"
      name="submit_support" value="<?php esc_attr_e( 'Send', 'fstore' ); ?>" />
      <input type="hidden" name="action" value="submit_support" />
    </p>
  </div>
</form>
