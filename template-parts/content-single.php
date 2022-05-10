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

<!-- DELETEME -->
<h1>Content-Single.php</h1>

<article class="blog-post ">

	<?php if ( ! is_singular() ) : ?>
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header>
	<?php endif; ?>

	<?php Tags::print_html_post_thumbnail_wrapper(); ?>

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

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<div class="container">
				<?php Tags::print_edit_post_link(); ?>
			</div>
		</footer>
	<?php endif; ?>

</article>
