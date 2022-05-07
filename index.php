<?php

/**
 * Toecaps Template - Index.php
 *
 * This template is the 'template mother' forming the ultimate fallback if no other
 * templates are matched by WordPress.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

get_header();
?>

<main>

	<div class="container">

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

get_footer();