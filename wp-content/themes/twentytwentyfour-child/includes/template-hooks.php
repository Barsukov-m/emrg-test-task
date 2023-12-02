<?php
/**
 * Template hooks.
 */

/**
 * Elementor - Append Author template under post content
 */
add_filter( 'the_content', 'twentytwentyfour_child_author_template' );
function twentytwentyfour_child_author_template( $content ) {
	if ( is_single() && get_post_type() === 'post' ) {
		$template_id = 63;
		$elementor_instance = \Elementor\Plugin::instance();
		$content .= $elementor_instance->frontend->get_builder_content_for_display( $template_id );
	}

	return $content;
}
