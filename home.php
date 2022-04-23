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

namespace BigupWeb\Toecaps;

get_header( 'home' );

?>

<main>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'toecaps' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_bloginfo( 'name' ) )
			)
		);
		?>
	</div>

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

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<div class="container">
				<?php Tags::print_edit_post_link(); ?>
			</div>
		</footer>
	<?php endif; ?>

</main>

<?php

get_footer();
