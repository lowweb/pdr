<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$origin_options = [
	'' => 'Все',
	'russia' => 'Россия',
	'china' => 'Китай'
];

$filter_origin = !empty($_GET['filter_origin']) ? $_GET['filter_origin'] : null;

$status_options = [
	'' => 'Любое',
	'vl' => 'В наличии',
	'order' => 'Под заказ'
];

$status = !empty($_GET['status']) ? $_GET['status'] : null;

?>
<form class="woocommerce-ordering" method="get">

	<label class="filter-control">Сортировать:
		<select name="orderby" class="orderby">
			<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
	</label>

	<label class="filter-control">Производство:
		<select name="filter_origin" class="orderby">
			<?php foreach ( $origin_options as $id => $name ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $filter_origin, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
			<!-- <option value="">Все</option>
			<option value="russia">Россия</option>
			<option value="china">КНР</option> -->
		</select>
	</label>

	<label class="filter-control">Наличие:
		<select name="status" class="orderby">
			<?php foreach ( $status_options as $id => $name ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $status, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
			<!-- <option value="">Любое</option>
			<option value="vl">В наличии</option>
			<option value="order">Под заказ</option> -->
		</select>
	</label>

	<!-- <input type="hidden" name="paged" value="1" /> -->
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page', 'status', 'filter_origin' ) ); ?>
</form>
