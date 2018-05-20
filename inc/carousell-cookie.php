<?php

function custom_track_product_view() {
    if ( ! is_singular( 'product' ) ) {
        return;
    }

    global $post;

    if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) )
        $viewed_products = array();
    else
        $viewed_products = (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] );

    if ( ! in_array( $post->ID, $viewed_products ) ) {
        $viewed_products[] = $post->ID;
    }

    if ( sizeof( $viewed_products ) > 15 ) {
        array_shift( $viewed_products );
    }

    // Store for session only
    wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}

add_action( 'template_redirect', 'custom_track_product_view', 20 );

?>
