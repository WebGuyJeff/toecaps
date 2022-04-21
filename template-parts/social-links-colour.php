<?php
/**
 * Toecaps Template File - Social Links.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

$facebook = get_option( 'facebook' );
if ( $facebook ) {
	?>
	<a
		class="social_link"
		target="_blank"
		rel="noopener"
		role="link"
		aria-label="<?php esc_html_e( 'Facebook', 'toecaps' ); ?>"
		href="<?php echo esc_url( get_option( 'facebook' ) ); ?>"
		title="<?php esc_html_e( 'Facebook', 'toecaps' ); ?>"
	>
		<?php echo file_get_contents( get_theme_file_path( 'imagery/icons_social/social-facebook-radius.svg' ) ); ?>
	</a>
	<?php
}

$instagram = get_option( 'instagram' );
if ( $instagram ) {
	?>
	<a
		class="social_link"
		target="_blank"
		rel="noopener"
		role="link"
		aria-label="<?php esc_html_e( 'Instagram', 'toecaps' ); ?>"
		href="<?php echo esc_url( get_option( 'instagram' ) ); ?>"
		title="<?php esc_html_e( 'Instagram', 'toecaps' ); ?>"
	>
		<?php echo file_get_contents( get_theme_file_path( 'imagery/icons_social/social-instagram-radius.svg' ) ); ?>
	</a>
	<?php
}

$linkedin = get_option( 'linkedin' );
if ( $linkedin ) {
	?>
	<a
		class="social_link"
		target="_blank"
		rel="noopener"
		role="link"
		aria-label="<?php esc_html_e( 'LinkedIn', 'toecaps' ); ?>"
		href="<?php echo esc_url( get_option( 'linkedin' ) ); ?>"
		title="<?php esc_html_e( 'LinkedIn', 'toecaps' ); ?>"
	>
		<?php echo file_get_contents( get_theme_file_path( 'imagery/icons_social/social-linkedin-radius.svg' ) ); ?>
	</a>
	<?php
}

$pinterest = get_option( 'pinterest' );
if ( $pinterest ) {
	?>
	<a
		class="social_link"
		target="_blank"
		rel="noopener"
		role="link"
		aria-label="<?php esc_html_e( 'Pinterest', 'toecaps' ); ?>"
		href="<?php echo esc_url( get_option( 'pinterest' ) ); ?>"
		title="<?php esc_html_e( 'Pinterest', 'toecaps' ); ?>"
	>
		<?php echo file_get_contents( get_theme_file_path( 'imagery/icons_social/social-pinterest-radius.svg' ) ); ?>
	</a>
	<?php
}
