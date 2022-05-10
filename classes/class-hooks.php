<?php
/**
 * Class Hooks
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Toecaps
 */
class Hooks {

	/**
	 * Init the class on each new instance.
	 */
	public function __construct() {

		add_filter( 'body_class', array( $this, 'add_body_classes' ) );
		add_action( 'wp_head', array( $this, 'add_pingback_header' ) );
	}


	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param  array $classes Classes for the body element.
	 * @return array
	 */
	public function add_body_classes( $classes ) {

		global $post;

		// Page type.
		if ( is_page() && ! $post->post_parent && ! empty( get_pages( array( 'child_of' => get_queried_object_id() ) ) )
			|| is_page() && $post->post_parent ) {
			// Category page (parent or child).
			$classes[] = 'tc_page-category';

		} elseif ( empty( get_pages( array( 'child_of' => get_queried_object_id() ) ) ) ) {
			// Orphan page.
			$classes[] = 'tc_page-orphan';

		}

		if ( is_front_page() || is_home() ) {
			// Home page.
			$classes[] = 'tc_page-home';

		} else {
			// NOT home page.
			$classes[] = 'tc_page-notHome';
		}

		// Template.
		if ( is_page_template( 'toecaps-full-width' ) ) {
			// Full-width page template.
			$classes[] = 'tc_page-fullWidth';
		}

		return $classes;
	}


	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	public function add_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}


}//end class
