<?php
/**
 * Toecaps Template File - Promo Banner.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */
?>

<div role="banner" class="promoBanner">
	<div class="container">

		<?php
		$email = get_option( 'email' );
		if ( $email ) {
			$email       = sanitize_email( $email );
			$email_link  = "<a class=\"promoBanner_link\" href=\"mailto:{$email}?subject=New%20Website%20Enquiry\" target=\"\" rel=\"\" aria-label=\"Send us an email\">\n";
			$email_link .= "\t{$email}\n";
			$email_link .= "</a>\n";
			echo $email_link;
		}

		$phone = get_option( 'phone' );
		if ( $phone ) {
			$phone       = sanitize_title( $phone );
			$phone_link  = "<a class=\"promoBanner_link\" href=\"tel:{$phone}\" target=\"\" rel=\"\" aria-label=\"{$phone}\">\n";
			$phone_link .= "\t{$phone}\n";
			$phone_link .= "</a>\n";
			echo $phone_link;
		}

		echo "<div class=\"promoBanner_social\">\n";
			get_template_part( 'template-parts/social-links' );
		echo "</div>\n"
		?>

	</div>
</div>
