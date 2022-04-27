<?php
/**
 * Toecaps Template - Identity.
 *
 * This template will dynamicallay display the site identity header section.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

if ( is_front_page() || is_home() ) {
	// This is the homepage.
	?>

	<a class="identity" href="<?php echo esc_url( get_bloginfo( 'wpurl' ) ); ?>" aria-label="Home">
		<?php
		if ( has_custom_logo() ) {
			$logo_id  = get_theme_mod( 'custom_logo' );
			$logo_src = wp_get_attachment_image_src( $logo_id, 'full' );
			echo '<img class="identity_logo" src="' . esc_url( $logo_src[0] ) . '">';
		}
		?>
	</a>

	<?php

} else {

	if ( is_page() && $post->post_parent || empty( get_pages( array( 'child_of' => get_queried_object_id() ) ) ) ) {
		// This is a child or orphan page.

		?>

		<a class="identity identity-child" href="<?php echo esc_url( get_bloginfo( 'wpurl' ) ); ?>" aria-label="Home">
			<?php
			if ( has_custom_logo() ) {
				$logo_id  = get_theme_mod( 'custom_logo' );
				$logo_src = wp_get_attachment_image_src( $logo_id, 'full' );
				echo '<img class="identity_logo" src="' . esc_url( $logo_src[0] ) . '">';
			}
			?>
		</a>

		<?php
	} else {
		// This is a parent page.

		?>

		<a class="identity identity-parent" href="<?php echo esc_url( get_bloginfo( 'wpurl' ) ); ?>" aria-label="Home">
			<?php
			if ( has_custom_logo() ) {
				$logo_id  = get_theme_mod( 'custom_logo' );
				$logo_src = wp_get_attachment_image_src( $logo_id, 'full' );
				echo '<img class="identity_logo" src="' . esc_url( $logo_src[0] ) . '">';
			}
			?>
		</a>

		<?php
	}

}