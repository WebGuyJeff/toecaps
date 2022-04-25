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


global $post; // if outside the loop.

if ( is_front_page() || is_home() ) {
	// This is the front page.
	Menu_Walker::output_theme_location_menu(
		array(
			'theme_location'   => 'homepage-menu',
			'menu_class'       => 'mainMenu',
			'nav_or_div'       => 'nav',
			'nav_aria_label'   => 'Main Menu',
			'html_tab_indents' => 5,
			'button_class'     => 'mainMenu_link menu_item',
		)
	);

} elseif ( is_page() && ! $post->post_parent && ! empty( get_pages( array( 'child_of' => get_queried_object_id() ) ) ) ) {
	// This is a parent page.
	echo '<p>NO PARENT PAGE MENU CONFIGURED!</p>';

} elseif ( is_page() && $post->post_parent ) {
	// This is a child page.
	echo '<p>NO CHILD PAGE MENU CONFIGURED!</p>';

} else {
	// This is an orphaned page.
	Menu_Walker::output_theme_location_menu(
		array(
			'theme_location'   => 'homepage-menu',
			'menu_class'       => 'mainMenu',
			'nav_or_div'       => 'nav',
			'nav_aria_label'   => 'Main Menu',
			'html_tab_indents' => 5,
			'button_class'     => 'mainMenu_link menu_item',
		)
	);
}
