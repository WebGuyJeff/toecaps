<?php
/**
 * Toecaps Template - Page.php
 *
 * Used to display all single posts of type 'page' unless overridden by a specified page template
 * in the editor, or a template with a filename 'page-{slug}.php' matches the page post title.
 *
 * This template contains all content in a width-controlled <div class="container">. The page
 * template 'toecaps-full-width.php' provides the same template without a container element baked
 * into the template. This allows width control in the page editor and varied width content.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

use BigupWeb\Toecaps\Helpers;

wp_enqueue_style( 'category_css' );
get_header();

?>

<main>
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', get_post_format() );
		endwhile;
	endif;
	?>
</main>

<?php

get_footer();
