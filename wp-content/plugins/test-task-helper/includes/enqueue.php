<?php
/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'tth_enqueue_scripts' );
function tth_enqueue_scripts() {
	$main_css_ver = date( 'ymd-Gis', filemtime( plugin_dir_path( __DIR__ ) . 'assets/css/main.css' ));
	$product_info_popup_js_ver = date( 'ymd-Gis', filemtime( plugin_dir_path( __DIR__ ) . 'assets/js/productInfoPopup.js' ));

	wp_enqueue_style(
		'tth-main-css',
		plugins_url( '/assets/css/main.css', dirname( __FILE__ ) ),
		false,
		$main_css_ver );

	wp_enqueue_script(
		'tth-product-info-popup-js',
		plugins_url( '/assets/js/productInfoPopup.js', dirname( __FILE__ ) ),
		array( 'jquery' ),
		$product_info_popup_js_ver
	);

	wp_localize_script( 'tth-product-info-popup-js', 'tth_ajax', array(
		'ajax_url'	=> admin_url( 'admin-ajax.php' ),
		'nonce'		=> wp_create_nonce( 'wc_product_nonce' )
	) );
}
