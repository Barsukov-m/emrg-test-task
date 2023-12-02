<?php
/**
 * Shortcodes.
 */

/**
 * The [bags_products] shortcode.
 *
 * Accepts a number of products and displays a list of products
 * with the category "bags".
 *
 * @param array  $atts    Shortcode attributes. Default empty.
 * @param string $content Shortcode content. Default null.
 * @param string $tag     Shortcode tag (name). Default empty.
 * @return string Shortcode output.
 */
function bags_products_shortcode( $atts = [], $content = null, $tag = '' ) {
	// normalize attribute keys, lowercase
	$atts = array_change_key_case( (array) $atts, CASE_LOWER );

	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => $atts['per_page'] ?? 10,
		'product_cat'    => 'bags'
	);
	$loop = new WP_Query( $args );

	// output
	$o = '<div class="tth-shortcode-products">';

	while ( $loop->have_posts() ) : $loop->the_post();
		global $product;
		$permalink = get_permalink();

		$o .= '<div class="product">';
		$o .= '<a class="thumbnail" href="' . $permalink . '">';
		$o .= woocommerce_get_product_thumbnail();
		$o .= '</a>';
		$o .= '<a class="title" href="' . $permalink . '">' . get_the_title() . '</a>';
		$o .= '<div class="price">' . $product->get_price_html() . '</div>';
		$o .= '</div>';
	endwhile;

	$o .= '</div>';

	wp_reset_query();

	return $o;
}

/**
 * Central location to create all shortcodes.
 */
add_action( 'init', 'tth_shortcodes_init' );
function tth_shortcodes_init() {
	add_shortcode( 'bags_products', 'bags_products_shortcode' );
}
