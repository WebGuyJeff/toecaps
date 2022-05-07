<?php

/**
 * Toecaps Template - Archive.php
 *
 * This template is the gateway to blog post history and should be able to handle
 * the following:
 *
 * - Display archive title (tag, category, date-based, or author archives).
 * - Display a list of posts in excerpt or full-length form. Choose one or the
 *   other as appropriate.
 * - Include wp_link_pages() to support navigation links within posts.
 *
 * @link https://codex.wordpress.org/Creating_an_Archive_Index#The_Archives_Page
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

get_header();
?>

<main>

	<section class="container">
		<div >

			<?php
			if ( have_posts() ) :
				
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_format() );
				endwhile;
			?>

			<nav>
				<?php next_posts_link( 'Previous' ); ?>
				<?php previous_posts_link( 'Next' ); ?>
			</nav>

			<?php
			endif;
			?>

		</div>
	</section>
	
</main>

<?php
get_footer();
