<?php
/**
 * Toecaps Template File - Left Sidebar.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

if ( ! is_active_sidebar( 'sidebar-main' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-main' ); ?>
</aside>
