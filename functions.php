<?php
/**
 * Functions fot the theme.
 *
 * @package WordPress
 */

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
