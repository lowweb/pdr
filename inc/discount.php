<?php

/**
* user discount meta ui
*/
add_action('show_user_profile','flake_discount_field');
add_action('edit_user_profile','flake_discount_field');
function flake_discount_field($user){ ?>
  <h2><?php _e('Client discount','fstore') ?></h2>
  <table class="form-table">
    <tr class="user-discount-wrap">
    	<th><label for="url"><?php _e('Client discount (%)','fstore')?></label></th>
    	<td><input type="number" name="discount" id="discount" value="<?php echo get_user_meta($user->ID,'discount',true) ?>" class=""></td>
    </tr>
  </table>
<?php }

/**
* user discount meta save
*/
add_action('personal_options_update','flake_save_discount_field');
add_action('edit_user_profile_update','flake_save_discount_field');
function flake_save_discount_field($user_id) {
  // if ( !current_user_can( 'edit_user', $user_id ) )
  //   return false;

  update_user_meta($user_id,'discount',$_POST['discount']);
}

/**
* get discount percentage
*/
function get_user_discount($user_id){
  if (!get_user_meta($user_id,'discount',true)) return 0;
  return get_user_meta($user_id,'discount',true);
}

/**
* the main thing
*/
add_filter('woocommerce_get_discounted_price','flake_discount',10,3);
function flake_discount($price,$vals,$inst) {
  // $price - default product price
  // $vals - product object
  // $inst - cart object
  $percentage = get_user_discount(get_current_user_id());
  $discount = $price * $percentage / 100;

  $inst->discount_cart += $discount;

  return $price - $discount;
}

add_action('flake_display_discount','display_discount');
function display_discount(){
  if (get_user_discount(get_current_user_id()) != 0) {?>
    <div class="cart-discount" id="user-discount">
      <?php _e('Your discount: ','fstore'); ?>
      <?php echo " ".get_user_discount(get_current_user_id()).'%'?>
  	</div>
    <?php  
  }
}
