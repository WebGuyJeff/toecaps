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
		<i class="fa fa-brands fa-facebook-square"></i>
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
		<i class="fa fa-brands fa-instagram-square"></i>
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
		<i class="fa fa-brands fa-linkedin"></i>
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
		<i class="fa fa-brands fa-pinterest-square"></i>
	</a>
	<?php
}
