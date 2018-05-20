<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

date_default_timezone_set('Asia/Vladivostok');

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>

	<table class="custom-orders-table my_account_orders account-orders-table">

    <?php foreach ( $customer_orders->orders as $customer_order ) :
      $order      = wc_get_order( $customer_order );
      $item_count = $order->get_item_count();
      $date = strtotime($order->get_date_created());
    ?>

		<tr class="order-row">
			<td class="order-number"><?php echo _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number(); ?></td>
			<td class="order-status"><?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></td>
			<td class="order-date">
        <?php echo date_i18n('d.m.Y', $date) ?>
        <span class="order-time"><?php echo date_i18n('H:i', $date) ?></span>
      </td>
			<td class="order-total"><?php echo $order->get_formatted_order_total() ?></td>
			<td class="order-more"><a href="#" class="order-link" data-order="<?php echo $order->get_order_number() ?>">Посмотреть состав заказа</a></td>
		</tr>
    <tr class="order-items-row">
      <td colspan="5">
        <table class="order-items" data-order="<?php echo $order->get_order_number() ?>">
          <?php foreach ($order->get_items() as $item_id => $item) {
            $product = $item->get_product();
            ?>
            <tr class="order-item">
              <td colspan="4" class="order-item-name">
                <i class="order-item-count"><?php echo $item->get_quantity() ?></i>
                <?php echo $product->get_name() ?>
              </td>
              <td class="order-item-price">
                <?php echo $product->get_price() ?>
              </td>
            </tr>
            <?php } ?>
          </table>
      </td>
    </tr>


  <?php endforeach; ?>

	</table>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php _e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php _e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php _e( 'Go shop', 'woocommerce' ) ?>
		</a>
		<?php _e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
