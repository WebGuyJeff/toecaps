<?php
/**
 * Toecaps Template - CSS-Loader.
 *
 * This template will dynamicallay load styles depending on the page being built.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

if ( is_front_page() || is_home() ) {

	return;

} else {

	if ( is_page() && $post->post_parent ) {

		// This is a child page.
		wp_enqueue_style( 'parent_css' );

	} else {

		// This is a parent page.
		wp_enqueue_style( 'parent_css' );

	}
}
