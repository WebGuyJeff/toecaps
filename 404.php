<?php
/**
 * Toecaps Template - Page.php
 *
 * This template is used for static pages and should be able to handle the following:
 *
 * - Display page title and page content.
 * - Display comment list and comment form (unless comments are off).
 * - Include wp_link_pages() to support navigation links within a page.
 * - Metadata such as tags, categories, date and author should not be displayed.
 * - Display an "Edit" link for logged-in users with edit permissions.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */


header( 'HTTP/1.0 404 Not Found' );

get_header(); ?>

<main>

	<div class="container">

		<a id="page_not_found">
			<h2>Oops! 🤕</h2>
		</a>
		<p>
			We couldn't find the page you were looking for. If you believe this is an error,
			please let us know. Otherwise use the search and links below to get back on
			track.
		</p>

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

</main>


<?php

get_footer();
