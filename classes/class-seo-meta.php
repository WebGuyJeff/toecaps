<?php
/**
 * PHP Class: Seo_Meta
 *
 * Note to self: This would be better suited to a function in functions.php or a standalone plugin.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

class Seo_Meta {


	// array of meta vars
	public $meta;
	// complete output ready for <head>
	public $head_meta;

	// init the class on each new instance
	function __construct() {
		$this->meta      = $this->build_meta_vars();
		$this->head_meta = $this->generate_head_meta( $this->meta );
	}//end __construct()


	// to be called inside the html head
	public function print_head_meta() {
		echo $this->head_meta;
	}


	/**
	 * Function enforce_forward_slash
	 *
	 * Append forward slash to strings where not already present, return same value if arg is empty.
	 * Serving multiple versions of the same url i.e url.com/ and url.com can lead to cannibalisation.
	 * This function serves to ensure trailing slashes are present. This should be controlled by a top-
	 * level SEO setting where the site owner can set slashes on or off.
	 */
	public function enforce_forward_slash( $url ) {
		if ( $url !== '' && substr( $url, -1 ) !== '/' ) {
			$url = $url . '/';
		}
		return $url;
	}


	/**
	 * function first_not_empty
	 *
	 * Accepts an array of values and returns the first non-empty value as a string.
	 * Returns empty string on failure.
	 */
	public function first_not_empty( $array ) {
		$string = '';
		if ( is_array( $array ) ) {
			foreach ( $array as &$value ) {
				$trimmed = trim( $value, ' ' );
				if ( ! empty( $trimmed ) ) {
					$string = $trimmed;
					goto end;
				}
			}
			end:
			unset( $value ); // Cleanup
			if ( empty( $string ) ) {
				$string = '';
			}
		}
		return $string;
	}//end first_not_empty()


	/**
	 * Function extract_image_from_content
	 *
	 * Accepts post content to be parsed with regular expression to find an image src.
	 * It doesn't care what context the image is in, it's attributes or otherwise, it
	 * just returns the first image found.
	 * The cleaned URL is returned without quotes.
	 */
	public function extract_image_from_content( $content ) {
		$url = '';

		if ( isset( $content ) && $content !== '' ) {

			if ( is_array( $content ) ) {
				implode( $content );
			}

			$regex = '/src="([^"]*)"/';
			preg_match_all( $regex, $content, $matches, PREG_PATTERN_ORDER );

			if ( isset( $matches[0][0] ) ) {
				$match    = $matches[0][0];
				$urlParts = explode( '"', $match, 3 );
				$url      = $urlParts[1];

			} else {
				$url = '';
			}
		} else {
			$url = '';
		}
			return $url;
	}//end extract_image_from_content()


	public function build_meta_vars() {

		/* Constants (need a source) */
		$bw_siteauthor = 'Joinery Team';
		$bw_localealt  = 'en_US';
		$bw_objecttype = 'website';
		$bw_robots     = 'index, follow, nocache, noarchive';

		/* Sitewide */
		$bw_identity = wp_strip_all_tags( get_bloginfo( 'name', 'display' ) );
		$bw_blogtitle = wp_strip_all_tags( get_the_title( get_option( 'page_for_posts', true ) ) );
		$bw_sitedesc  = wp_strip_all_tags( get_bloginfo( 'description', 'display' ) );
		$bw_siteurl   = esc_url( home_url( $path = '/', $scheme = 'https' ) );
		$bw_sitelogo  = esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) );
		$bw_locale    = wp_strip_all_tags( get_bloginfo( 'language' ) );
		$bw_charset   = wp_strip_all_tags( get_bloginfo( 'charset' ) );
		$bw_themeuri  = get_template_directory_uri();

		/* Page-Specific */
		$post = get_post(); // Set up the post manually.
		setup_postdata( $post );
		$bw_postid      = get_the_ID();
		$bw_postcontent = get_post_field( 'post_content', $bw_postid, '' );
		$bw_postimage   = esc_url( $this->extract_image_from_content( $bw_postcontent ) );
		$bw_posttitle   = wp_strip_all_tags( get_the_title() );
		$bw_permalink   = esc_url( get_permalink() );

		/* Set scope */
		$bw_catexcerpt   = '';
		$bw_archivetitle = '';
		$bw_postexcerpt  = '';
		$bw_postauthor   = '';

		/* scrape conditionally by page type */
		if ( is_category() ) { // User may have set desc
			$bw_catexcerpt = preg_split( '/[.?!]/', wp_strip_all_tags( category_description(), true ) )[0] . '.';
		}
		if ( is_archive() ) { // Also matches categories (don't set vars twice)
			$bw_archivetitle = wp_strip_all_tags( post_type_archive_title( '', false ) );
			$bw_thumbnail    = esc_url( get_the_post_thumbnail_url( $bw_postid ) );
		} else {
			$bw_postexcerpt = preg_split( '/[.?!]/', wp_strip_all_tags( $bw_postcontent, true ) )[0] . '.';
			$bw_postauthor  = wp_strip_all_tags( get_the_author() );
			$bw_thumbnail   = esc_url( get_the_post_thumbnail_url( $bw_postid ) );
		}

		/* choose the most suitable scraped value with preference order by page type */
		if ( is_front_page() ) { // Homepage
			$bw_title   = ucwords( $bw_identity );
			$bw_desc    = ucfirst( $this->first_not_empty( array( $bw_sitedesc, $bw_postexcerpt ) ) );
			$bw_author  = ucwords( $this->first_not_empty( array( $bw_siteauthor, $bw_postauthor ) ) );
			$bw_canon   = $this->enforce_forward_slash( $bw_siteurl );
			$bw_ogimage = $this->first_not_empty( array( $bw_sitelogo, $bw_thumbnail, $bw_postimage ) );
		} elseif ( is_home() ) { // Posts Page
			$bw_title   = ucwords( $this->first_not_empty( array( $bw_blogtitle, $bw_identity ) ) );
			$bw_desc    = ucfirst( $this->first_not_empty( array( $bw_postexcerpt, $bw_sitedesc ) ) );
			$bw_author  = ucwords( $bw_siteauthor );
			$bw_canon   = $this->enforce_forward_slash( $bw_permalink );
			$bw_ogimage = $this->first_not_empty( array( $bw_thumbnail, $bw_sitelogo, $bw_postimage ) );
		} elseif ( is_category() ) {
			$bw_title   = ucwords( $this->first_not_empty( array( $bw_archivetitle, $bw_posttitle ) ) );
			$bw_desc    = ucfirst( $this->first_not_empty( array( $bw_catexcerpt, $bw_postexcerpt, $bw_sitedesc ) ) );
			$bw_author  = ucwords( $this->first_not_empty( array( $bw_postauthor, $bw_siteauthor ) ) );
			$bw_canon   = $this->enforce_forward_slash( $bw_permalink );
			$bw_ogimage = $this->first_not_empty( array( $bw_thumbnail, $bw_postimage, $bw_sitelogo ) );
		} elseif ( is_archive() ) { // Auto-gen 'cats'
			$bw_title   = ucwords( $this->first_not_empty( array( $bw_archivetitle, $bw_posttitle ) ) );
			$bw_desc    = ucfirst( $this->first_not_empty( array( $bw_catexcerpt, $bw_postexcerpt, $bw_sitedesc ) ) );
			$bw_author  = ucwords( $this->first_not_empty( array( $bw_postauthor, $bw_siteauthor ) ) );
			$bw_canon   = $this->enforce_forward_slash( $bw_permalink );
			$bw_ogimage = $this->first_not_empty( array( $bw_thumbnail, $bw_postimage, $bw_sitelogo ) );
		} elseif ( is_singular() ) { // These vars should be reliable
			$bw_title   = ucwords( $bw_posttitle );
			$bw_desc    = ucfirst( $bw_postexcerpt );
			$bw_author  = ucwords( $bw_postauthor );
			$bw_canon   = $this->enforce_forward_slash( $bw_permalink );
			$bw_ogimage = $this->first_not_empty( array( $bw_postimage, $bw_thumbnail, $bw_sitelogo ) );
		} elseif ( is_search() ) {
			$bw_title   = ucwords( 'Search Results' );
			$bw_desc    = ucfirst( 'We are here to help you find what you\'re looking for.' );
			$bw_author  = ucwords( $bw_siteauthor );
			$bw_canon   = $this->enforce_forward_slash( $bw_permalink );
			$bw_ogimage = $this->first_not_empty( array( $bw_postimage, $bw_thumbnail, $bw_sitelogo ) );
		} else {
			echo '<!-- META FALLBACK - CHECK THEME-SEO TEMPLATE FUNCTIONS -->';
			$bw_title   = ucwords( $this->first_not_empty( array( $bw_posttitle, $bw_archivetitle, $bw_identity ) ) );
			$bw_desc    = ucfirst( $this->first_not_empty( array( $bw_postexcerpt, $bw_catexcerpt, $bw_sitedesc ) ) );
			$bw_author  = ucwords( $this->first_not_empty( array( $bw_postauthor, $bw_siteauthor ) ) );
			$bw_canon   = $this->enforce_forward_slash( $bw_permalink );
			$bw_ogimage = $this->first_not_empty( array( $bw_thumbnail, $bw_postimage, $bw_sitelogo ) );
		}

		return $meta = array(
			'title'       => $bw_title,
			'desc'        => $bw_desc,
			'author'      => $bw_author,
			'canon'       => $bw_canon,
			'ogimage'     => $bw_ogimage,
			'ogtitle'     => $bw_title,
			'robots'      => $bw_robots,
			'ogtype'      => $bw_objecttype,
			'ogurl'       => $bw_canon,
			'oglocale'    => $bw_locale,
			'oglocalealt' => $bw_localealt,
			'ogdesc'      => $bw_desc,
			'ogsitename'  => $bw_identity,
			'charset'     => $bw_charset,
			'themeuri'    => $bw_themeuri,
		);

	}//end build_meta_vars()



	public static function generate_head_meta( $meta ) {

		$head_meta = <<<EOF
<meta charset="{$meta["charset"]}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Site verification (to be removed from this template) -->
<meta name="google-site-verification" content="g9mEcBrJ4uTyVj7KYmGbbuAzqRkeMA2jIJth4hM5Dns" />
<meta name="msvalidate.01" content="0245B24FF2B31489A65C5541B284D4D8" />
<!-- SEO Meta -->
<title>{$meta["title"]}</title>
<meta name="description" content="{$meta["desc"]}">
<meta name="author" content="{$meta["author"]}">
<meta name="robots" content="{$meta["robots"]}">
<link rel="canonical" href="{$meta["canon"]}">
<!-- Open Graph Meta - <html> namespace must match og:type -->
<meta property="og:title" content="{$meta["ogtitle"]}">
<meta property="og:type" content="{$meta["ogtype"]}">
<meta property="og:image" content="{$meta["ogimage"]}">
<meta property="og:url" content="{$meta["ogurl"]}">
<meta property="og:locale" content="{$meta["oglocale"]}">
<meta property="og:locale:alternate" content="{$meta["oglocalealt"]}">
<meta property="og:description" content="{$meta["ogdesc"]}">
<meta property="og:site_name" content="{$meta["ogsitename"]}">
<!-- Branding Meta -->
<!-- Favicon and Web App Definitions -->
<meta name="application-name" content="{$meta["title"]}">
<meta name="msapplication-TileColor" content="#fff">
<meta name="msapplication-TileImage" content="{$meta["themeuri"]}/imagery/favicon/mstile-144x144.png">
<meta name="msapplication-square70x70logo" content="{$meta["themeuri"]}/imagery/favicon/mstile-70x70.png">
<meta name="msapplication-square150x150logo" content="{$meta["themeuri"]}/imagery/favicon/mstile-150x150.png">
<meta name="msapplication-wide310x150logo" content="{$meta["themeuri"]}/imagery/favicon/mstile-310x150.png">
<meta name="msapplication-square310x310logo" content="{$meta["themeuri"]}/imagery/favicon/mstile-310x310.png">
<!-- Mobile Browser Colours -->
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#29a367"/>
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#29a367">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="#29a367">
<!-- Favicons and vendor-specific icons -->
<link rel="icon" type="image/png" href="{$meta["themeuri"]}/imagery/favicon/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="{$meta["themeuri"]}/imagery/favicon/favicon-16x16.png" sizes="16x16">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- hb_head end -->
EOF;

		return $head_meta;

	}//end generate_head_meta()

}//end class
