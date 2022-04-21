<?php
/**
 * Template part for displaying a single post and used by single.php.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

?>


<article class="container">
	<div class="blog-post ">

		<h1 id="title" >
		Content-single.php
		</h1>

		
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		}
		?>

		<h2 class="blog-post-title">
			<?php the_title(); ?>
		</h2>

		<p class="blog-post-meta">
			<?php the_date(); ?> by <a href="#"><?php the_author(); ?></a>
		</p>

		<?php the_content(); ?>

	</div>
</article>
