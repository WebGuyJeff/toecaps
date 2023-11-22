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

	if ( ! isset( $menu_slug ) ) {
		return;
	}
	?>

	<div class="container">
		<div class="accordian">
			<button
				class="accordian_title button"
				aria-haspopup="menu"
				aria-expanded="false"
				aria-controls="accordian_contents-1"
				aria-pressed="false"
				id="accordian_button-1"
			>
				<?php echo esc_html( get_the_title( wp_get_post_parent_id() ) ); ?>
				<i class="accordian_toggleIcon fa-solid fa-chevron-down"></i>
			</button>
			<input class="accordian_toggle" type="checkbox" id="accordian1">
			<div class="accordian_contents" id="accordian_contents-1" role="menu" aria-labelledby="accordian_button-1">
				<?php
				Menu_Walker::output_theme_location_menu(
					array(
						'theme_location'   => $menu_slug,
						'menu_class'       => 'categoryMenu',
						'nav_or_div'       => 'nav',
						'nav_aria_label'   => 'Category Menu',
						'html_tab_indents' => 5,
					)
				);
				?>
			</div>
		</div>
	</div>

	<?php
}
