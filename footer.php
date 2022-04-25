<?php
/**
 * Toecaps Template - Footer.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

?>

<footer class="footer">
	<div class="container">
		<div class="footer_contents">
			<div class="footer_menu">
				<?php
				Menu_Walker::output_theme_location_menu(
					array(
						'theme_location'   => 'footer-menu',
						'menu_class'       => 'mainMenu',
						'nav_or_div'       => 'nav',
						'nav_aria_label'   => 'Main Menu',
						'html_tab_indents' => 3,
						'button_class'     => 'mainMenu',
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

	<!-- insert address here -->

			<?php
			$phone = get_option( 'phone' );
			if ( $phone ) {
				?>
				<a
					class="footer_phone"
					href="tel:<?php echo esc_attr( get_option( 'phone' ) ); ?>"
					aria-label="<?php esc_html_e( 'Phone us', 'toecaps' ); ?>"
					title="<?php esc_html_e( 'Phone us', 'toecaps' ); ?>"
				>
					<?php echo esc_attr( get_option( 'phone' ) ); ?>
				</a>
				<?php
			}
			$email = get_option( 'email' );
			if ( $email ) {
				?>
				<a
					class="footer_email"
					href="mailto:<?php echo esc_html( get_option( 'email' ) ); ?>?subject=New%20Website%20Enquiry"
					aria-label="<?php esc_html_e( 'Email us', 'toecaps' ); ?>"
					title="<?php esc_html_e( 'Email us', 'toecaps' ); ?>"
				>
					<?php echo esc_html( get_option( 'email' ) ); ?>
				</a>
				<?php
			}
			?>

			<p class="footer_label">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
