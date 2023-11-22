<?php
/**
 * Toecaps Template File - Social Links.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

$tc_settings  = get_option( 'tc_theme_array' ); // Serialized array of all options.
$tc_facebook  = ( isset( $tc_settings['tc_social_url_facebook'] ) ) ? $tc_settings['tc_social_url_facebook'] : '';
$tc_instagram = ( isset( $tc_settings['tc_social_url_instagram'] ) ) ? $tc_settings['tc_social_url_instagram'] : '';
$tc_pinterest = ( isset( $tc_settings['tc_social_url_pinterest'] ) ) ? $tc_settings['tc_social_url_pinterest'] : '';
$tc_linkedin  = ( isset( $tc_settings['tc_social_url_linkedin'] ) ) ? $tc_settings['tc_social_url_linkedin'] : '';

if ( $tc_facebook ) {
	?>
	<a
		class="social_link"
		target="_blank"
		rel="noopener"
		aria-label="<?php esc_html_e( 'Facebook', 'toecaps' ); ?>"
		href="<?php echo esc_url( $tc_facebook ); ?>"
		title="<?php esc_html_e( 'Facebook', 'toecaps' ); ?>"
	>
		<?php echo file_get_contents( get_theme_file_path( 'imagery/icons_social/social-facebook-radius.svg' ) ); ?>
	</a>
	<?php
}

if ( $tc_instagram ) {
	?>
	<a
		class="social_link"
		target="_blank"
		rel="noopener"
		aria-label="<?php esc_html_e( 'Instagram', 'toecaps' ); ?>"
		href="<?php echo esc_url( $tc_instagram ); ?>"
		title="<?php esc_html_e( 'Instagram', 'toecaps' ); ?>"
	>
		<?php echo file_get_contents( get_theme_file_path( 'imagery/icons_social/social-instagram-radius.svg' ) ); ?>
	</a>
	<?php
}

if ( $tc_linkedin ) {
	?>
	<a
		class="social_link"
		target="_blank"
		rel="noopener"
		aria-label="<?php esc_html_e( 'LinkedIn', 'toecaps' ); ?>"
		href="<?php echo esc_url( $tc_linkedin ); ?>"
		title="<?php esc_html_e( 'LinkedIn', 'toecaps' ); ?>"
	>
		<?php echo file_get_contents( get_theme_file_path( 'imagery/icons_social/social-linkedin-radius.svg' ) ); ?>
	</a>
	<?php
}

if ( $tc_pinterest ) {
	?>
	<a
		class="social_link"
		target="_blank"
		rel="noopener"
		aria-label="<?php esc_html_e( 'Pinterest', 'toecaps' ); ?>"
		href="<?php echo esc_url( $tc_pinterest ); ?>"
		title="<?php esc_html_e( 'Pinterest', 'toecaps' ); ?>"
	>
		<?php echo file_get_contents( get_theme_file_path( 'imagery/icons_social/social-pinterest-radius.svg' ) ); ?>
	</a>
	<?php
}
