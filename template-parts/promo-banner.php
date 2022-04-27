<?php
/**
 * Toecaps Template File - Promo Banner.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

?>

<div role="banner" class="promoBanner">
	<div class="container">

		<div class="promoBanner_contact">
			<?php
			$email = get_option( 'email' );
			if ( $email ) {
				?>
				<a
					class="promoBanner_link"
					href="mailto:<?php echo esc_html( get_option( 'email' ) ); ?>?subject=New%20Website%20Enquiry"
					aria-label="<?php esc_html_e( 'Email us', 'toecaps' ); ?>"
					title="<?php esc_html_e( 'Email us', 'toecaps' ); ?>"
				>
					<i class="fa-solid fa-envelope"></i>
					<?php echo esc_html( get_option( 'email' ) ); ?>
				</a>
				<?php
			}

			$phone = get_option( 'phone' );
			if ( $phone ) {
				?>
				<a
					class="promoBanner_link"
					href="tel:<?php echo esc_attr( get_option( 'phone' ) ); ?>"
					aria-label="<?php esc_html_e( 'Phone us', 'toecaps' ); ?>"
					title="<?php esc_html_e( 'Phone us', 'toecaps' ); ?>"
				>
					<i class="fa-solid fa-phone"></i>
					<?php echo esc_attr( get_option( 'phone' ) ); ?>
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
