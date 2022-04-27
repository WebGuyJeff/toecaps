<?php

/**
 * Template Name: Toecaps Full Width
 * 
 * This should serve as a generic template for all non-category specific pages, e.g. contact,
 * privacy policy etc.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

wp_enqueue_style( 'category_css' );
get_header();

?>

<main>

	<?php the_content(); ?>

</main>

<?php

get_footer();
