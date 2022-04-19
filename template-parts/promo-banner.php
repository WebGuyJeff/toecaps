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

		$facebook = get_option( 'facebook' );
		$facebook = esc_url( $facebook );
		if ( $facebook ) {
			$facebook_link  = "<a class=\"promoBanner_link\" rel=\"noopener\" role=\"link\" aria-label=\"Facebook\" href=\"{$facebook}\">\n";
			$facebook_link .= "\t<i class=\"fa fa-brands fa-facebook-square\"></i>\n";
			$facebook_link .= "</a>\n";
			echo $facebook_link;
		}

		$instagram = get_option( 'instagram' );
		$instagram = esc_url( $instagram );
		if ( $instagram ) {
			$instagram_link  = "<a class=\"promoBanner_link\" rel=\"noopener\" role=\"link\" aria-label=\"Instagram\" href=\"{$instagram}\">\n";
			$instagram_link .= "\t<i class=\"fa fa-brands fa-instagram-square\"></i>\n";
			$instagram_link .= "</a>\n";
			echo $instagram_link;
		}

		$linkedin = get_option( 'linkedin' );
		$linkedin = esc_url( $linkedin );
		if ( $linkedin ) {
			$linkedin_link  = "<a class=\"promoBanner_link\" rel=\"noopener\" role=\"link\" aria-label=\"LinkedIn\" href=\"{$linkedin}\">\n";
			$linkedin_link .= "\t<i class=\"fa fa-brands fa-linkedin\"></i>\n";
			$linkedin_link .= "</a>\n";
			echo $linkedin_link;
		}

		$pinterest = get_option( 'pinterest' );
		$pinterest = esc_url( $pinterest );
		if ( $pinterest ) {
			$pinterest_link  = "<a class=\"promoBanner_link\" rel=\"noopener\" role=\"link\" aria-label=\"Pinterest\" href=\"{$pinterest}\">\n";
			$pinterest_link .= "\t<i class=\"fa fa-brands fa-pinterest-square\"></i>\n";
			$pinterest_link .= "</a>\n";
			echo $pinterest_link;
		}

		echo "</div>\n"
		?>

	</div>
</div>
