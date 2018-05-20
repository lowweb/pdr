<?php
/**
 * Displayed when no products are found matching the current query
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/no-products-found.php.
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
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_sidebar();
?>

<main>

	<div class="search-contact">
		<?php echo do_shortcode('[search]'); ?>
		<?php echo do_shortcode('[contact]'); ?>
	</div>

	<?php woocommerce_breadcrumb(); ?>


	<div id="shop">

		<?php woocommerce_catalog_ordering() ?>

		<p class="search-info">
			<?php if (isset($_REQUEST['s'])) printf(esc_html__( 'Unfortunately, nothing was found by "%s" search.', 'fstore'), $_REQUEST['s'] );
			else _e( 'Unfortunately, nothing was found', 'fstore');
			?>
		</p>

		<div id="search-featured">
			<h2 class="section-heading"><?php _e('Maybe you\'d like something else:','fstore') ?></h2>
				<!-- Возможно вы имели ввиду: -->
				<?php echo do_shortcode('[featured_products per_page="4"]') ?>
			</div>
	</div>

</main>
