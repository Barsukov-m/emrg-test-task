<?php
/**
 * Template functions.
 */

/**
 * Get theme header.
 */
if ( ! function_exists( 'tth_get_theme_header' ) ) {
	function tth_get_theme_header() {
		wp_head();

		$header = get_template_directory() . '/parts/header.html';

		if ( ! file_exists( $header ) ) {
			return;
		} else {
			$header_content = file_get_contents( $header );
			$header_blocks = parse_blocks( $header_content );

			foreach ( $header_blocks as $block ) {
				echo '<div class="site-header">';
				echo render_block( $block );
				echo '</div>';
			}
		}
	}
}


/**
 * Get theme footer.
 */
if ( ! function_exists( 'tth_get_theme_footer' ) ) {
	function tth_get_theme_footer() {
		$footer = get_template_directory() . '/parts/footer.html';

		echo '<div class="site-footer">';

		if ( ! file_exists( $footer ) ) {
			return;
		} else {
			$footer_content = file_get_contents( $footer );
			$footer_blocks = parse_blocks( $footer_content );

			foreach ( $footer_blocks as $block ) {
				echo render_block( $block );
			}
		}
		
		echo '</div>';
		
		wp_footer();
	}
}