<?php
/**
 * Toecaps Template - Search.php
 *
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

use BigupWeb\Toecaps\Tags;


get_header();
?>

<div class="container">

	<div class="search_inPageWrap">
		<?php
		get_search_form(
			$args = array(
				'echo'       => true,
				'aria_label' => 'Search our website',
			)
		);
		?>
	</div>

	<?php
	if ( have_posts() ) {
		?>
		<header class="page-header alignwide">
			<h2 class="page-title">
				<?php
				printf(
					/* translators: %s: Search term. */
					esc_html__( 'Results for "%s"', 'twentytwentyone' ),
					'<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>
		</header><!-- .page-header -->

		<p class="search-result-count default-max-width">
			<?php
			printf(
				esc_html(
					/* translators: %d: The number of search results. */
					_n(
						'We found %d result for your search.',
						'We found %d results for your search.',
						(int) $wp_query->found_posts,
						'twentytwentyone'
					)
				),
				(int) $wp_query->found_posts
			);
			?>
		</p><!-- .search-result-count -->

		<div class="searchResults">

			<?php
			// Start the Loop.
			while ( have_posts() ) {
				the_post();
				?>
				<div class="searchResults_item">
					<a class="searchResults_url" href="<?php echo esc_url( get_permalink() ) ?>">
						<?php echo esc_url( get_permalink() ) ?>
					</a>
					<?php
					the_title( sprintf( '<h3 class="searchResults_title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' );
					?>
					<div class="searchResults_excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div>
				<?php
			} // End the loop.
			?>

		</div><!-- .search_resultList -->

		<?php
		// Previous/next page navigation.
		Tags::posts_navigation();


		// If no content, include the "No posts found" template.
	} else {
		get_template_part( 'template-parts/content/content-none' );
	}
	?>


	<h2><?php esc_html( _e( 'Can\'t find what you\'re looking for?', 'toecaps' ) ); ?></h2>
	<p><?php esc_html( _e( 'Try these links or use the site navigation at the top of the page.', 'toecaps' ) ); ?></p>

	<div class="sitemap">
		<?php
		wp_list_pages(
			array(
				'post_type' => 'page',
				'title_li'  => '<h3>Sitemap</h3>',
			)
		)
		?>
	</div>

</div>

<?php
get_footer();
