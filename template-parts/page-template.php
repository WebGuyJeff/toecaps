<?php
/**
 * Toecaps Template File - Page Template.
 *
 * This is a special content template to act as a unified source for all themed page-templates.
 * Note - this template calls the header and footer and most likely shouldn't be used for any other
 * purpose than stated.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

// use BigupWeb\Toecaps\Helpers;
use BigupWeb\Toecaps\Tags;

get_header();

?>

<main id="post-<?php the_ID(); ?>">

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
				wp_kses_post( get_the_title() )
			)
		);
		?>
	</div>

	<section class="follow">
		<div="container">
			<div class="follow_contents">
				<h3>Follow</h3>
				<div class="follow_social">
					<?php get_template_part( 'template-parts/social-links', 'colour' ); ?>
				</div>
			</div>
		</div>
	</section>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<div class="container">
				<?php
				Tags::print_edit_post_link();
				?>
			</div>
		</footer>
	<?php endif ?>

</main>

<?php
get_footer();
