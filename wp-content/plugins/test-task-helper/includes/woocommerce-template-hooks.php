<?php
/**
 * WooCommerce template hooks.
 */


/**
 * Show show more info button on each product in the shop loop.
 */
add_action( 'woocommerce_after_shop_loop_item_title', 'add_custom_info_button', 15 );
function add_custom_info_button() {
	echo '<a class="show-more-info-btn" href="#product_details" data-product_id="' . get_the_ID() . '">Show more info</a>';
}


/**
 * Product popup in footer.
 */
add_action( 'wp_footer', 'ttf_product_popup' );
function ttf_product_popup() {
	include __DIR__ . '/../parts/product-popup-template.php';
}


/**
 * AJAX handler - Fetch product info.
 */
add_action( 'wp_ajax_fetch_product_info', 'tth_fetch_product_info' );
add_action( 'wp_ajax_nopriv_fetch_product_info', 'tth_fetch_product_info' );
function tth_fetch_product_info() {
	$nonce = wp_verify_nonce( $_POST['nonce'], 'wc_product_nonce' );

	if ( ! $nonce ) {
		wp_send_json_error( array( 'message' => 'Security validation error.' ) );
		return;
	}

	$product_id = isset( $_POST['product_id'] ) ? sanitize_text_field( $_POST['product_id'] ) : '';

    if ( ! $product_id ) {
        wp_send_json_error( array( 'message' => 'Missing product ID.' ) );
        return;
    }

	$product = wc_get_product( $product_id );

	if ( ! $product ) {
		wp_send_json_error( array( 'message' => 'Invalid product.' ) );
        return;
    }

	$title = esc_html( $product->get_name() );
	$thumbnail = get_the_post_thumbnail_url( $product_id, 'woocommerce_thumbnail' );
	$description = wp_kses_post( $product->get_description() );

	$html  = '';

	if ( $thumbnail ) {
		$html .= '<div class="product-thumbnail">';
		$html .= '<img src="' . esc_url( $thumbnail ) . '" alt="' . $title . '">';
		$html .= '</div>';
	}

	$html .= '<div class="product-title">' . $title . '</div>';
	$html .= '<div class="product-desc">'. $description . '</div>';
	$html .= '<div class="close">&times;</div>';

	wp_send_json_success( array( 'html' => $html ) );
}
