<?php
/**
 * Toecaps Template File - Social Links.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */


$facebook = get_option( 'facebook' );
$facebook = esc_url( $facebook );
if ( $facebook ) {
	$facebook_link  = "<a class=\"social_link\" rel=\"noopener\" role=\"link\" aria-label=\"Facebook\" href=\"{$facebook}\">\n";
	$facebook_link .= "\t<i class=\"fa fa-brands fa-facebook-square\"></i>\n";
	$facebook_link .= "</a>\n";
	echo $facebook_link;
}

$instagram = get_option( 'instagram' );
$instagram = esc_url( $instagram );
if ( $instagram ) {
	$instagram_link  = "<a class=\"social_link\" rel=\"noopener\" role=\"link\" aria-label=\"Instagram\" href=\"{$instagram}\">\n";
	$instagram_link .= "\t<i class=\"fa fa-brands fa-instagram-square\"></i>\n";
	$instagram_link .= "</a>\n";
	echo $instagram_link;
}

$linkedin = get_option( 'linkedin' );
$linkedin = esc_url( $linkedin );
if ( $linkedin ) {
	$linkedin_link  = "<a class=\"social_link\" rel=\"noopener\" role=\"link\" aria-label=\"LinkedIn\" href=\"{$linkedin}\">\n";
	$linkedin_link .= "\t<i class=\"fa fa-brands fa-linkedin\"></i>\n";
	$linkedin_link .= "</a>\n";
	echo $linkedin_link;
}

$pinterest = get_option( 'pinterest' );
$pinterest = esc_url( $pinterest );
if ( $pinterest ) {
	$pinterest_link  = "<a class=\"social_link\" rel=\"noopener\" role=\"link\" aria-label=\"Pinterest\" href=\"{$pinterest}\">\n";
	$pinterest_link .= "\t<i class=\"fa fa-brands fa-pinterest-square\"></i>\n";
	$pinterest_link .= "</a>\n";
	echo $pinterest_link;
}
