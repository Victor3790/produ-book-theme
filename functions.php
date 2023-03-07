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
	add_image_size( 'my_theme_book_thumbnail', 250, 300, false );
	add_image_size( 'my_theme_book_feature_image', 500, 600, false );

}

add_action( 'after_setup_theme', 'add_features' );

/**
 * Load css stylesheets and js scripts.
 */
function add_assets(): void {

	// TODO: Optimize asset loading.

	wp_enqueue_style(
		'my-blog-style',
		get_stylesheet_uri(),
		array(),
		'1.0.0'
	);

	wp_enqueue_style(
		'my-blog-slider',
		'//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css',
		array(),
		'1.0.0'
	);

	wp_enqueue_style(
		'my-blog-star-rating-styles',
		get_stylesheet_directory_uri() . '/assets/star-rating-svg/css/star-rating-svg.css',
		array(),
		'1.0.0'
	);

	wp_enqueue_script(
		'my-blog-star-rating',
		get_stylesheet_directory_uri() . '/assets/star-rating-svg/jquery.star-rating-svg.min.js',
		array( 'jquery' ),
		'1.3.0',
		true
	);

	wp_enqueue_script(
		'my-blog-script',
		get_stylesheet_directory_uri() . '/assets/js/my-theme-script.js',
		array( 'my-blog-star-rating', 'jquery', 'jquery-ui-core', 'jquery-ui-slider' ),
		'1.0.0',
		true
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
 * Add Book custom post type and its categories.
 */
function register_book_post_type(): void {

	// Register post type.
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
			'slug'       => 'book',
			'with_front' => true,
		),
		'query_var'             => true,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments' ),
		'show_in_graphql'       => false,
	);

	register_post_type( 'books', $args );

	// Register categories.
	$category_labels = array(
		'name'          => __( 'Book categories', '' ),
		'singular_name' => __( 'Category', '' ),
	);

	$category_args = array(
		'label'                 => __( 'Categories', '' ),
		'labels'                => $category_labels,
		'public'                => true,
		'publicly_queryable'    => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_nav_menus'     => true,
		'query_var'             => true,
		'rewrite'               => array(
			'slug'       => 'book_categories',
			'with_front' => true,
		),
		'show_admin_column'     => false,
		'show_in_rest'          => true,
		'rest_base'             => 'book_categories',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_in_quick_edit'    => false,
		'show_in_graphql'       => false,
	);

	register_taxonomy( 'book_categories', array( 'books' ), $category_args );

}

add_action( 'init', 'register_book_post_type' );

/**
 * Save rating data.
 *
 * @param int        $comment_id The comment id.
 * @param int|string $comment_approved 1 if the comment is approved, 0 if not, 'spam' if spam.
 * @param array      $comment_data Comment data.
 *
 * @throws Exception Throws an exception if the nonce is not correct.
 */
function save_rating_data( $comment_id, $comment_approved, $comment_data ): void {

	if ( empty( $_POST['book-rating'] ) ) {

		return;

	}

	if ( ! empty( $_POST['_wp_unfiltered_html_comment'] ) ) {

		$nonce = sanitize_text_field( wp_unslash( $_POST['_wp_unfiltered_html_comment'] ) );

		if ( ! wp_verify_nonce( $nonce, 'unfiltered-html-comment_' . $comment_data['comment_post_ID'] ) ) {

			throw new Exception( 'Error Processing comment, incorrect nonce.', 1 );
		}
	}

	$rating = sanitize_text_field( wp_unslash( $_POST['book-rating'] ) );
	add_comment_meta( $comment_id, 'book-rating', $rating );

}

add_action( 'comment_post', 'save_rating_data', 10, 3 );

/**
 * Add custom query vars for book search.
 *
 * @param array $vars The query variables.
 */
function add_search_query_vars( $vars ): array {

	$vars[] = 'book_author';
	$vars[] = 'book_category';
	$vars[] = 'min-price';
	$vars[] = 'max-price';

	return $vars;

}

add_filter( 'query_vars', 'add_search_query_vars' );

/**
 * Perform the book custom search.
 *
 * @param WP_Query $query The WordPress query.
 */
function customize_search_query( $query ): void {

	if ( ! is_search() ) {
		return;
	}

	$author    = sanitize_text_field( get_query_var( 'book_author' ) );
	$category  = sanitize_text_field( get_query_var( 'book_category' ) );
	$min_price = sanitize_text_field( get_query_var( 'min-price' ) );
	$max_price = sanitize_text_field( get_query_var( 'max-price' ) );

	$tax_query  = array();
	$meta_query = array();

	// Assign custom queries.
	if ( ! empty( $category ) ) {
		$tax_query[] = array(
			'taxonomy' => 'book_categories',
			'field'    => 'slug',
			'terms'    => $category,
		);
	}

	if ( ! empty( $min_price ) && ! empty( $max_price ) ) {
		$meta_query[] = array(
			'key'     => 'precio',
			'value'   => array( $min_price, $max_price ),
			'compare' => 'BETWEEN',
			'type'    => 'NUMERIC',
		);
	}

	if ( ! empty( $author ) ) {
		$meta_query[] = array(
			'key'   => 'autor',
			'value' => $author,
		);
	}

	// Set custom query parameters.
	if ( count( $meta_query ) > 1 ) {
		$meta_query['relation'] = 'AND';
	}

	if ( count( $meta_query ) > 0 ) {
		$query->set( 'meta_query', $meta_query );
	}

	if ( count( $tax_query ) > 0 ) {
		$query->set( 'tax_query', $tax_query );
	}

}

add_action( 'pre_get_posts', 'customize_search_query' );
