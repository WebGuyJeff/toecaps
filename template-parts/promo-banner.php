<?php
/**
 * Toecaps Template File - Promo Banner.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

$tc_settings = get_option( 'tc_theme_array' ); // Serialized array of all options.
$tc_phone    = $tc_settings['tc_phone_number'];
$tc_email    = $tc_settings['tc_email_address'];

?>

<div role="banner" class="promoBanner">
	<div class="container">

		<div class="promoBanner_contact">
			<?php
			if ( $tc_email ) {
				?>
				<a
					class="promoBanner_link"
					href="mailto:<?php echo esc_html( $tc_email ); ?>?subject=New%20Website%20Enquiry"
					aria-label="<?php esc_html_e( 'Email us', 'toecaps' ); ?>"
					title="<?php esc_html_e( 'Email us', 'toecaps' ); ?>"
				>
					<i class="fa-solid fa-envelope"></i>
					<?php echo esc_html( $tc_email ); ?>
				</a>
				<?php
			}

			if ( $tc_phone ) {
				?>
				<a
					class="promoBanner_link"
					href="tel:<?php echo esc_attr( $tc_phone ); ?>"
					aria-label="<?php esc_html_e( 'Phone us', 'toecaps' ); ?>"
					title="<?php esc_html_e( 'Phone us', 'toecaps' ); ?>"
				>
					<i class="fa-solid fa-phone"></i>
					<?php echo esc_attr( $tc_phone ); ?>
				</a>
				<?php
			}
			?>
		</div>
		<div class="promoBanner_social">
			<?php get_template_part( 'template-parts/social-links' ); ?>
		</div>

	</div>
</div>
