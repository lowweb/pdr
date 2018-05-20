<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_edit_account_form' ); ?>

<div class="edit-account-wrap">
	<div class="account-user-data">
		<form class="woocommerce-EditAccountForm edit-account" action="" method="post">
			<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
			<p class="woocommerce-form-row form-row">
				<label for="account_first_name"><?php _e( 'First name', 'woocommerce' ); ?></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
			</p>
			<p class="woocommerce-form-row form-row">
				<label for="account_last_name"><?php _e( 'Last name', 'woocommerce' ); ?></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
			</p>
			<p class="woocommerce-form-row form-row">
				<label for="account_billing_phone"><?php _e( 'Phone number', 'fstore' ); ?></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--tel input-tel" name="account_billing_phone" id="account_billing_phone" value="<?php echo esc_attr( $user->billing_phone ); ?>" />
			</p>
			<p class="woocommerce-form-row form-row">
				<label for="account_shipping_city"><?php _e( 'City', 'fstore' ); ?></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_shipping_city" id="account_shipping_city" value="<?php echo esc_attr( $user->shipping_city ); ?>" />
			</p>
			<p class="woocommerce-form-row form-row">
				<label for="account_shipping_address_1"><?php _e( 'Shipping address', 'fstore' ); ?></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_shipping_address_1" id="account_shipping_address_1" value="<?php echo esc_attr( $user->shipping_address_1 ); ?>" />
			</p>
			<p class="woocommerce-form-row form-row">
				<label for="account_email"><?php _e( 'Email address', 'woocommerce' ); ?></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
			</p>
			<?php wp_nonce_field( 'save_account_details' ); ?>
			<input type="submit" class="woocommerce-Button button dark save-account" name="save_account_details" value="<?php esc_attr_e( 'Save', 'fstore' ); ?>" />
			<input type="hidden" name="action" value="save_account_details" />
		</form>
	</div>

	<div class="account-password">
		<form class="woocommerce-EditAccountForm edit-account" action="" method="post">
			<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
				<p class="woocommerce-form-row form-row">
					<label for="password_1"><?php _e( 'New password', 'fstore' ); ?></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" />
				</p>
				<p class="woocommerce-form-row form-row">
					<label for="password_2"><?php _e( 'Confirm new password', 'fstore' ); ?></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" />
				</p>
				<p class="woocommerce-form-row form-row">
					<label for="password_current"><?php _e( 'Current password', 'fstore' ); ?></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="new-password" />
				</p>
				<?php wp_nonce_field( 'change_password' ); ?>
				<button type="submit" class="woocommerce-Button button password-btn dark" name="change_password" value="<?php esc_attr_e( 'Change password', 'fstore' ) ?>" ><?php _e( 'Change password', 'fstore' ) ?></button>
				<input type="hidden" name="action" value="change_password" />
		</form>
	</div>
</div>
