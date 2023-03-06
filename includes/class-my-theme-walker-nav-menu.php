<?php
/**
 * Main manu walker.
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Walker navigation menu for the main menu in the theme.
 *
 * @link https://developer.wordpress.org/reference/classes/walker_nav_menu/
 */
class My_Theme_Walker_Nav_Menu extends Walker_Nav_Menu {

	/**
	 * Starts the element output.
	 *
	 * @param string  $output Used to append additional content.
	 * @param WP_Post $item Menu data object.
	 * @param int     $depth Depth of menu. Used for padding.
	 * @param mixed   $args An object of wp_nav_menu_arguments.
	 * @param int     $id ID of the current menu item.
	 *
	 * @link https://developer.wordpress.org/reference/classes/walker_nav_menu/start_el/
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ): void {

		$permalink = get_permalink( $item );

		$output .= '<li class="nav-item"><a class="nav-link" href="' . esc_url( $permalink ) . '">' . $item->post_title;
	}

	/**
	 * Ends the element output.
	 *
	 * @param string  $output Used to append additional content.
	 * @param WP_Post $item Menu item data object.
	 * @param int     $depth Depth of page.
	 * @param mixed   $args Menu arguments.
	 *
	 * @link https://developer.wordpress.org/reference/classes/walker_nav_menu/end_el/
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ): void {

		$output .= '</a></li>';
	}
}
