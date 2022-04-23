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

wp_enqueue_style( 'category_css' );
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
