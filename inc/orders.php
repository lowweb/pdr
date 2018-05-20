<?php

add_action('wp_ajax_get_orders','get_orders');
function get_orders(){

  $customer_orders = get_posts( array(
    'numberposts' => -1,
    'meta_key'    => '_customer_user',
    'meta_value'  => get_current_user_id(),
    'post_type'   => wc_get_order_types(),
    'post_status' => array_keys( wc_get_order_statuses() ),
  ) );

  foreach ($customer_orders as $order) {
    $order = wc_get_order($order->ID);
    $date = $order->get_date_created();
    $return[] = [
      'number' => $order->get_order_number(),
      // 'status' => $order->get_status(),
      'status' => wc_get_order_status_name( $order->get_status() ),
      'date'   => date('d.m.Y', strtotime($date)),
      'time'   => gmdate('H:i', strtotime($date)),
      'total'  => $order->get_total()
    ];
  }

  echo json_encode($return, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  wp_die();
}

add_action('wp_ajax_get_order','get_order');
function get_order(){

  $order = wc_get_order($_POST['id']);
  foreach ( $order->get_items() as $item_id => $item ) {
    $product = $item->get_product();
    $return[] = [
      'qty' => $item->get_quantity(),
      'name' => $product->name,
      'price' => $product->price
    ];
  }
  echo json_encode($return, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT);
  wp_die();
}
