<?php

add_filter( 'single_template', 'tth_load_projects_template' );
function tth_load_projects_template( $template ) {
	global $post;

	if ( 'projects' === $post->post_type ) {
		$custom_template = plugin_dir_path( __DIR__ ) . '/single-projects.php';

		if ( file_exists( $custom_template ) ) {
			return plugin_dir_path( __DIR__ ) . '/single-projects.php';
		}
	}

	return $template;
}
