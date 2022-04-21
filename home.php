<?php

/**
 * Toecaps Template - Home.php
 *
 * This template is the default home page (unless set to a static page) and
 * forms the blog posts home page. When a static page is used as the site home
 * page, this template would normally be used, for example, as /blog.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

get_header();
?>

<main class="main">

	<div class="base"> <?php // MAIN CONTENT COLUMN. ?>

		<section class="container">
			<div >

				<h1 id="title" >
				Home.php
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

	</div> <?php // MAIN CONTENT COLUMN END. ?>

</main>


<?php
get_sidebar();
get_footer();
