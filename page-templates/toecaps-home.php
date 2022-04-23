<?php
/**
 * Template Name: Toecaps Home
 *
 * @package Toecaps
 * @author   Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

get_header( 'home' );

?>

<!-- DELETEME -->
<h1>
	<?php
		$post = get_post();
		setup_postdata( $post );
		$postid = get_the_ID();
		echo get_post_format( $postid );
	?>
</h1>

<main>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', get_post_format() );
		endwhile;
	endif;
	?>

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

</main>

<?php
get_footer();
