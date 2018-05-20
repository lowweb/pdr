<?php

// Display Fields
add_action( 'woocommerce_product_options_stock', 'woo_add_custom_general_fields' );

function woo_add_custom_general_fields() {

  global $woocommerce, $post;

  echo '<div class="options_group">';

  // Select
  woocommerce_wp_select(
  array(
  	'id'      => 'prod_location',
  	'label'   => __( 'Product location', 'fstore' ),
  	'options' => array(
      null   => __( 'Not specified', 'fstore' ),
      'vl'    => __( 'Vladivostok', 'fstore' ),
      'china' => __( 'Available in China', 'fstore' ),
  		'order' => __( 'Order', 'fstore' ),
  		)
  	)
  );

  echo '</div>';

}

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

function woo_add_custom_general_fields_save( $post_id ){
  // Select
	$woocommerce_select = $_POST['prod_location'];
	if( !empty( $woocommerce_select ) )
		update_post_meta( $post_id, 'prod_location', esc_attr( $woocommerce_select ) );
}

/**
* Output stock location & status
*/
function after_product_heading(){
	global $product;
	echo '<div class="stock-status">';

  if ($product->is_in_stock()) {
    // echo '<div class="chip stock">'.__('In stock!','fstore').'</div>';

    // if ($product->get_meta('prod_location') && $product->get_meta('prod_location') != "Не указано"  )
    // 	echo '<div class="stock-loc">'.__('Available at:', 'fstore').' '.$product->get_meta('prod_location').'</div>';

    if ($product->get_meta('prod_location')) {
      $status = $product->get_meta('prod_location');
      if ($status == "vl") {
        echo '<div class="chip stock">'.__('In stock!','fstore').'</div>';
        echo '<div class="stock-loc">'.__('Available at:', 'fstore').' Владивосток</div>';
      } else if ($status == "china") {
        echo '<div class="chip stock na">'.__('Order', 'fstore').'</div>';
        echo '<div class="stock-loc">'.__('Available at:', 'fstore').' КНР</div>';
      } else if ($status == "order") {
        echo '<div class="chip stock na">'.__('Order', 'fstore').'</div>';
      }
    }

  } else if (!$product->is_in_stock())
    echo '<div class="chip stock na">'.__('Not available!','fstore').'</div>';

	echo '</div>';
}

/**
 * Render stock location & status
 */
function renderStatus($product){
  if ($product->is_in_stock()) {
    // echo '<div class="chip stock">'.__('In stock!','fstore').'</div>';

    // if ($product->get_meta('prod_location') && $product->get_meta('prod_location') != "Не указано"  )
    // 	echo '<div class="stock-loc">'.__('Available at:', 'fstore').' '.$product->get_meta('prod_location').'</div>';

    if ($product->get_meta('prod_location')) {
      $status = $product->get_meta('prod_location');
      // echo $status;
      if ($status == "vl") {
        echo '<div class="chip stock">'.__('In stock!','fstore').'</div>';
        // echo '<div class="stock-loc">'.__('Available at:', 'fstore').' Владивосток</div>';
      } else {
        echo '<div class="chip stock na">'.__('Order', 'fstore').'</div>';
        // echo '<div class="stock-loc">'.__('Available at:', 'fstore').' КНР</div>';
      }
    }

  } else if (!$product->is_in_stock())
    echo '<div class="chip stock na">'.__('Not available!','fstore').'</div>';
}
