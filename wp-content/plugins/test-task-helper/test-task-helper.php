<?php
/*
 * Plugin Name:       Test Task Helper
 * Description:       Helper functions and definitions for the EMRG WordPress developer test task.
 * Version:           1.0
 * Author:            Mykhailo Barsukov
 * Author URI:        https://github.com/Barsukov-m
 * Text Domain:       test-task-helper
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Register the "Project" custom post type
 */
function tth_setup_post_type() {
	$labels = array(
		'name'					=> __( 'Projects', 'test-task-helper' ),
		'singular_name'			=> __( 'Project', 'test-task-helper' ),
		'menu_name'				=> __( 'Projects', 'test-task-helper' ),
		'name_admin_bar'		=> __( 'Project', 'test-task-helper' ),
		'add_new'				=> __( 'Add New', 'test-task-helper' ),
		'add_new_item'			=> __( 'Add New Project', 'test-task-helper' ),
		'new_item'				=> __( 'New Project', 'test-task-helper' ),
		'edit_item'				=> __( 'Edit Project', 'test-task-helper' ),
		'view_item'				=> __( 'View Project', 'test-task-helper' ),
		'all_items'				=> __( 'All Projects', 'test-task-helper' ),
		'search_items'			=> __( 'Search Projects', 'test-task-helper' ),
		'not_found'				=> __( 'No projects found.', 'test-task-helper' ),
		'not_found_in_trash'	=> __( 'No projects found in Trash.', 'test-task-helper' ),
	);

	register_post_type( 'projects', array(
		'labels'		=> $labels,
		'public'		=> true,
		'rewrite'		=> array( 'slug' => 'project' ),
		'supports'		=> array( 'title', 'editor', 'excerpt', 'author', 'category', 'thumbnail', 'comments' ),
		'has_archive'	=> true,
		'menu_icon'		=> 'dashicons-open-folder',
	) ); 
} 
add_action( 'init', 'tth_setup_post_type' );


/**
 * Activate the plugin.
 */
function tth_activate() { 
	// Trigger our function that registers the custom post type plugin.
	tth_setup_post_type(); 
	// Clear the permalinks after the post type has been registered.
	flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'tth_activate' );


/**
 * Deactivation hook.
 */
function tth_deactivate() {
	// Unregister the post type, so the rules are no longer in memory.
	unregister_post_type( 'projects' );
	// Clear the permalinks to remove our post type's rules from the database.
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'tth_deactivate' );


/**
 * Enqueue scripts.
 */
require 'includes/enqueue.php';


/**
 * Template functions.
 */
require 'includes/template-functions.php';


/**
 * Shortcodes
 */
require 'includes/shortcodes.php';


/**
 * Load Projects CPT template pages
 */
require 'includes/load-projects-templates.php';


/**
 * WooCommerce template hooks.
 */
require 'includes/woocommerce-template-hooks.php';