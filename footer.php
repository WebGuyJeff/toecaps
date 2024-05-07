<?php
/**
 * Toecaps Template - Footer.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

use BigupWeb\Toecaps\Helpers;

$tc_settings       = get_option( 'tc_theme_array' ); // Serialized array of all options.
$tc_phone          = ( isset( $tc_settings['tc_phone_number'] ) ) ? $tc_settings['tc_phone_number'] : '';
$tc_email          = ( isset( $tc_settings['tc_email_address'] ) ) ? $tc_settings['tc_email_address'] : '';
$tc_street_address = ( isset( $tc_settings['tc_street_address'] ) ) ? $tc_settings['tc_street_address'] : '';

?>

<footer class="footer">
	<div class="container">
		<div class="footer_contents">
			<div class="footer_menu">
				<?php
				Menu_Walker::output_theme_location_menu(
					array(
						'theme_location'    => 'footer-menu',
						'menu_class'        => 'mainMenu',
						'nav_or_div'        => 'nav',
						'nav_aria_label'    => 'Site Navigation',
						'html_tab_indents'  => 4,
						'top_level_classes' => '',
					)
				);
				?>
			</div>
			<div class="footer_social">
				<?php get_template_part( 'template-parts/social-links' ); ?>
			</div>

			<div class="footer_identity">
				<span><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
				<span>&#124;</span>
				<span><?php echo esc_html( get_bloginfo( 'description' ) ); ?></span>
			</div>

			<?php
			if ( $tc_street_address || $tc_phone || $tc_email ) {
				echo wp_kses( '<address class="footer_contact">', array( 'address' => array( 'class' => array() ) ) );

				if ( $tc_street_address ) {
					$html_address = Helpers::line_breaks_or_commas_to_html( $tc_street_address );
					?>
					
					<a
						class="footer_address"
						href="/contact#find-us"
						aria-label="<?php esc_html_e( 'Find us', 'toecaps' ); ?>"
						title="<?php esc_html_e( 'Find us', 'toecaps' ); ?>"
					>
						<?php
						echo wp_kses( $html_address, array( 'p' => array( 'class' => array() ) ) );
						?>
					</a>

					<?php
				}
				if ( $tc_phone ) {
					?>
					<a
						class="footer_phone"
						href="tel:<?php echo esc_attr( $tc_phone ); ?>"
						aria-label="<?php esc_html_e( 'Phone us', 'toecaps' ); ?>"
						title="<?php esc_html_e( 'Phone us', 'toecaps' ); ?>"
					>
						<?php echo esc_attr( $tc_phone ); ?>
					</a>
					<?php
				}
				if ( $tc_email ) {
					?>
					<a
						class="footer_email"
						href="mailto:<?php echo esc_html( $tc_email ); ?>?subject=New%20Website%20Enquiry"
						aria-label="<?php esc_html_e( 'Email us', 'toecaps' ); ?>"
						title="<?php esc_html_e( 'Email us', 'toecaps' ); ?>"
					>
						<?php echo esc_html( $tc_email ); ?>
					</a>
					<?php
				}

				echo wp_kses( '</address>', array( 'address' => array() ) );
			}
			?>

			<p class="footer_label">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?></p>
			<p class="footer_label">Website by <a style="color:#fbfc00;text-decoration:none" target="_blank" href="https://jeffersonreal.uk/">Jefferson Real</a></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
