<?php

/**
 * Template Name: Toecaps Parent Page
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

wp_enqueue_style( 'category_css' );
get_header( 'home' );
?>

<main>

	<div class="container">

		<h1 id="title" >Index.php</h1>

		<div>
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_format() );
				endwhile;
			endif;
			?>
		</div>

	</div>

</main>

<?php
get_template_part( 'template-parts/modal', 'contact' );
get_footer();
?>
