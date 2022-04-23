<?php
/**
 * Toecaps Template - Page.php
 * 
 * Used to display all single posts of type 'page' unless overridden by a specified page template
 * in the editor, or a template with a filename 'page-{slug}.php' matches the page post title.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

wp_enqueue_style( 'category_css' );
get_header();

?>

<main>

<h1><?php get_post_format(); ?></h1>

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
