<?php

/**
 * Template Name: Toecaps Full Width
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
