<?php

/**
 * Toecaps Template - Single.php
 *
 * This template is used for single posts (not pages).
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

<<<<<<< HEAD

=======
wp_enqueue_style( 'category_css' );
>>>>>>> a58d6b62f1c9e9f2d0a0ae18073fab621b594639
get_header();

?>

<main>
	<div class="container">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_format() );
			endwhile;
		endif;
		?>
	</div>
</main>

<?php

get_footer();
