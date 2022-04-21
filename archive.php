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

<main class="main">

	<div class="base"> <?php // MAIN CONTENT COLUMN ?>

		<section class="container">
			<div >

				<h1 id="title" >
				Archive.php
				</h1>
				
			</div>
		</section>

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
					<ul class="pager">
						<li><?php next_posts_link( 'Previous' ); ?></li>
						<li><?php previous_posts_link( 'Next' ); ?></li>
					</ul>
				</nav>
					<?php
				endif;
				?>

			</div>
		</section>

	</div> <?php // MAIN CONTENT COLUMN END ?>
	
</main>

<?php
get_sidebar();
get_footer();
