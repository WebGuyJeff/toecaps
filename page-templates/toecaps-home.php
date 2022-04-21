<?php

/**
 * Template Name: Landing Page Home
 *
 * @package Toecaps
 * @author   Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

wp_enqueue_style( 'category_css' );

get_header( 'home' ); ?>

<main>

	<?php the_content(); ?>

	<section class="follow">
		<div="container">
			<div class="follow_contents">
				<h3>Follow</h3>
				<div class="follow_social">
					<?php get_template_part( 'template-parts/social-links-colour' ); ?>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
	get_template_part( 'template-parts/modal', 'contact' );
	get_footer();
?>
