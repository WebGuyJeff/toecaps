<?php
/**
 * Toecaps Template - Menu.
 *
 * This template will dynamicallay display a menu based on the page being built.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

use BigupWeb\Toecaps\Helpers;


if ( is_page() && ! $post->post_parent && ! empty( get_pages( array( 'child_of' => get_queried_object_id() ) ) )
	|| is_page() && $post->post_parent ) {

	// This is a category page (parent or child).

	$page_template = basename( get_page_template_slug(), '.php' );

	switch ( $page_template ) {

		case 'toecaps-green':
			$menu_slug = 'green-menu';
			break;

		case 'toecaps-tan':
			$menu_slug = 'tan-menu';
			break;

		case 'toecaps-yellow':
			$menu_slug = 'yellow-menu';
			break;

		case 'toecaps-blue':
			$menu_slug = 'blue-menu';
			break;

		case 'toecaps-teal':
			$menu_slug = 'teal-menu';
			break;

		case 'toecaps-red':
			$menu_slug = 'red-menu';
			break;
	}

	$menu_slug = ( isset( $menu_slug ) ) ? $menu_slug : 'homepage-menu';

} else {

	// This is the home page, an orphan page, or any other unnaccounted for page.
	$menu_slug = 'homepage-menu';

}

Menu_Walker::output_theme_location_menu(
	array(
		'theme_location'   => $menu_slug,
		'menu_class'       => 'mainMenu',
		'nav_or_div'       => 'nav',
		'nav_aria_label'   => 'Main Menu',
		'html_tab_indents' => 5,
	)
);
