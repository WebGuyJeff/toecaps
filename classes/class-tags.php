<?php
/**
 * Custom template tags for this theme
 *
 * These methods provide common post html snippets:
 *
 * ### print_html_posted_on()
 *  - Prints HTML with meta information for the current post-date/time.
 * ### print_html_posted_by()
 *  - Prints HTML with meta information for the current author.
 * ### print_html_entry_footer()
 *  - Prints HTML with meta information for the categories, tags and comments.
 * ### print_html_post_thumbnail_wrapper()
 *  - Displays an optional post thumbnail, and wraps according to context.
 *
 * @package Toecaps
 */

namespace BigupWeb\Toecaps;

class Tags {


	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	public static function print_html_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
		/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'toecaps' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>';

	}


	/**
	 * Prints HTML with meta information for the current author.
	 */
	public static function print_html_posted_by() {

		$byline = sprintf(
		/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'toecaps' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>';

	}


	/**
	 * Prints HTML with an edit link for the current post.
	 */
	public static function print_edit_post_link() {

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'toecaps' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}



	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	public static function print_html_entry_footer() {

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'toecaps' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'toecaps' ) . '</span>', $categories_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'toecaps' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'toecaps' ) . '</span>', $tags_list );
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
					/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'toecaps' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'toecaps' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}


	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	public static function print_html_post_thumbnail_wrapper() {

		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail(
				'post-thumbnail',
				array(
					'alt' => the_title_attribute(
						array(
							'echo' => false,
						)
					),
				)
			);
			?>
			</a>

			<?php
		endif; // End is_singular().
	}


	/**
	 * Print the next and previous posts navigation.
	 */
	public static function print_html_previous_next_posts_navigation() {
		the_posts_pagination(
			array(
				'before_page_number' => esc_html__( 'Page', 'toecaps' ) . ' ',
				'mid_size'           => 0,
				'prev_text'          => sprintf(
					'%s <span class="nav-prev-text">%s</span>',
					is_rtl() ? '<i class="fa-solid fa-arrow-right"></i>' : '<i class="fa-solid fa-arrow-left"></i>',
					wp_kses(
						__( 'Newer <span class="nav-short">posts</span>', 'toecaps' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					)
				),
				'next_text'          => sprintf(
					'<span class="nav-next-text">%s</span> %s',
					wp_kses(
						__( 'Older <span class="nav-short">posts</span>', 'toecaps' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					is_rtl() ? '<i class="fa-solid fa-arrow-right"></i>' : '<i class="fa-solid fa-arrow-left"></i>'
				),
			)
		);
	}


	/**
	 * Print the breadcrumb.
	 */
	public static function print_html_breadcrumb() {
		$arrow = '<i class="breadcrumb_separator fa-solid fa-chevron-right"></i>';
		echo '<div class="breadcrumb">';
		echo '<div class="container">';
		echo '<a href="' . esc_url( home_url() ) . '" rel="nofollow">Home</a>';
		if ( is_category() || is_single() ) {
			echo $arrow;
			the_category( ' • ' );
			if ( is_single() ) {
				echo $arrow;
				the_title();
			}
		} elseif ( is_page() ) {
			echo $arrow;
			echo esc_html( the_title() );
		} elseif ( is_search() ) {
			echo $arrow;
			echo '<span>';
			echo esc_html( the_search_query() );
			echo '</span>';
		}
		echo '</div>';
		echo '</div>';
	}


}//end class
