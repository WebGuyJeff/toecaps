<?php
/**
 * Toecaps Template - H1.
 *
 * This template will dynamicallay display the page H1 content depending on the page being built.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

use BigupWeb\Toecaps\Helpers;

$tc_settings = get_option( 'tc_theme_array' ); // Serialized array of all options.
$tc_phone    = ( isset( $tc_settings['tc_phone_number'] ) ) ? $tc_settings['tc_phone_number'] : '';

global $post; // if outside the loop.

if ( is_front_page() || is_home() ) {

	?>
	<div class="header_cta">

		<div class="identity">
			<h1 class="identity_title">
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
			</h1>
			<span class="identity_tagline">
				<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
			</span>
		</div>

		<?php
		if ( $tc_phone ) {
			?>

			<a class="header_ctaButton button" role="button" href="tel:<?php echo esc_attr( $tc_phone ); ?>" aria-label="Phone us">
				<span>Call Now</span>
			</a>

			<?php
		}
		?>

	</div>

	<?php

} else {

	if ( is_page()
		&& ! empty( get_pages( array( 'child_of' => get_queried_object_id() ) ) ) ) {
		// This is a category ( parent ) page.

		?>
		<div class="header_cta theme_fill-opaque">

			<div class="identity">
				<h1 class="identity_title">
					<?php echo esc_html( get_the_title() ); ?>
				</h1>
				<span class="identity_tagline">
					<?php echo esc_html( Helpers::get_first_sentence( get_the_excerpt() ) ); ?>
				</span>
			</div>
			<?php

			if ( $tc_phone ) {

				?>
				<a class="header_ctaButton button" role="button" href="tel:<?php echo esc_attr( $tc_phone ); ?>" aria-label="Phone us">
					<span>Call Now</span>
				</a>
				<?php
			}
			?>

		</div>
		<?php

	} elseif ( is_search() ) {

		?>
		<h1 class="header_title">Search Results</h1>
		<?php

	} elseif ( is_404() ) {

		?>
		<h1 class="header_title">Page not found</h1>
		<?php

	} else {
		// Fallback for child, orphan, search etc.

		?>
		<h1 class="header_title">
			<?php echo esc_html( get_the_title() ); ?>
		</h1>
		<?php
	}

	?>
	</div>
	<?php

}
