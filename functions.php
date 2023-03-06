<?php
/**
 * Functions for the theme.
 *
 * @package WordPress
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

require get_template_directory() . '/includes/class-my-theme-walker-nav-menu.php';

/**
 * Echo the main menu.
 */
function echo_my_theme_main_menu(): void {

	wp_nav_menu(
		array(
			'menu'       => 'Primary',
			'container'  => 'ul',
			'menu_class' => 'navbar-nav ms-auto mb-2 mb-lg-0',
			'walker'     => new My_Theme_Walker_Nav_Menu(),
		)
	);
}

/**
 * Add new features not included by default.
 */
function add_features(): void {

	// Post thumbnails support.
	add_theme_support( 'post-thumbnails' );

	// Custom image sizes.
	add_image_size( 'my_theme_thumbnail', 700, 350, true );
	add_image_size( 'my_theme_feature_image', 900, 400, true );

}

add_action( 'after_setup_theme', 'add_features' );

/**
 * Load css stylesheets and js scripts.
 */
function add_assets(): void {

	wp_enqueue_style(
		'my-blog-style',
		get_stylesheet_uri(),
		array(),
		'1.0.0'
	);

}

add_action( 'wp_enqueue_scripts', 'add_assets' );

/**
 * Sanitize search query to avoid XSS attacks.
 *
 * @param WP_Query $query_object The current query.
 */
function sanitize_search( $query_object ): void {

	if ( ! is_search() ) {
		return;
	}

	$sanitized_query = wp_kses( $query_object->get( 's' ), array() );
	$query_object->set( 's', $sanitized_query );

}

add_action( 'parse_query', 'sanitize_search' );

/**
 * Add Book custom post type.
 */
function register_book_post_type() {

	$labels = array(
		'name'          => __( 'Books', '' ),
		'singular_name' => __( 'book', '' ),
	);

	$args = array(
		'label'                 => __( 'Books', '' ),
		'labels'                => $labels,
		'description'           => '',
		'public'                => true,
		'publicly_queryable'    => true,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'rest_base'             => '',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'has_archive'           => true,
		'show_in_menu'          => true,
		'show_in_nav_menus'     => true,
		'delete_with_user'      => false,
		'exclude_from_search'   => false,
		'capability_type'       => 'post',
		'map_meta_cap'          => true,
		'hierarchical'          => false,
		'rewrite'               => array(
			'slug'       => 'libro',
			'with_front' => true,
		),
		'query_var'             => true,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'show_in_graphql'       => false,
	);

	register_post_type( 'books', $args );

}

add_action( 'init', 'register_book_post_type' );
