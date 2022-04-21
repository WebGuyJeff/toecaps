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
		$jt_siteauthor = 'Joinery Team';
		$jt_localealt  = 'en_US';
		$jt_objecttype = 'website';
		$jt_robots     = 'index, follow, nocache, noarchive';

		/* Sitewide */
		$jt_sitetitle = wp_strip_all_tags( get_bloginfo( 'name', 'display' ) );
		$jt_blogtitle = wp_strip_all_tags( get_the_title( get_option( 'page_for_posts', true ) ) );
		$jt_sitedesc  = wp_strip_all_tags( get_bloginfo( 'description', 'display' ) );
		$jt_siteurl   = esc_url( home_url( $path = '/', $scheme = 'https' ) );
		$jt_sitelogo  = esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) );
		$jt_locale    = wp_strip_all_tags( get_bloginfo( 'language' ) );
		$jt_charset   = wp_strip_all_tags( get_bloginfo( 'charset' ) );
		$jt_themeuri  = get_template_directory_uri();

		/* Page-Specific */
		$post = get_post();// Set up the post manually
		setup_postdata( $post );
		$jt_postid      = get_the_ID();
		$jt_postcontent = get_post_field( 'post_content', $jt_postid, '' );
		$jt_postimage   = esc_url( $this->extract_image_from_content( $jt_postcontent ) );
		$jt_posttitle   = wp_strip_all_tags( get_the_title() );
		$jt_permalink   = esc_url( get_permalink() );

		/* Set scope */
		$jt_catexcerpt   = '';
		$jt_archivetitle = '';
		$jt_postexcerpt  = '';
		$jt_postauthor   = '';

		/* scrape conditionally by page type */
		if ( is_category() ) { // User may have set desc
			$jt_catexcerpt = preg_split( '/[.?!]/', wp_strip_all_tags( category_description(), true ) )[0] . '.';
		}
		if ( is_archive() ) { // Also matches categories (don't set vars twice)
			$jt_archivetitle = wp_strip_all_tags( post_type_archive_title( '', false ) );
			$jt_thumbnail    = esc_url( get_the_post_thumbnail_url( $jt_postid ) );
		} else {
			$jt_postexcerpt = preg_split( '/[.?!]/', wp_strip_all_tags( $jt_postcontent, true ) )[0] . '.';
			$jt_postauthor  = wp_strip_all_tags( get_the_author() );
			$jt_thumbnail   = esc_url( get_the_post_thumbnail_url( $jt_postid ) );
		}

		/* choose the most suitable scraped value with preference order by page type */
		if ( is_front_page() ) { // Homepage
			$jt_title   = ucwords( $jt_sitetitle );
			$jt_desc    = ucfirst( $this->first_not_empty( array( $jt_sitedesc, $jt_postexcerpt ) ) );
			$jt_author  = ucwords( $this->first_not_empty( array( $jt_siteauthor, $jt_postauthor ) ) );
			$jt_canon   = $this->enforce_forward_slash( $jt_siteurl );
			$jt_ogimage = $this->first_not_empty( array( $jt_sitelogo, $jt_thumbnail, $jt_postimage ) );
		} elseif ( is_home() ) { // Posts Page
			$jt_title   = ucwords( $this->first_not_empty( array( $jt_blogtitle, $jt_sitetitle ) ) );
			$jt_desc    = ucfirst( $this->first_not_empty( array( $jt_postexcerpt, $jt_sitedesc ) ) );
			$jt_author  = ucwords( $jt_siteauthor );
			$jt_canon   = $this->enforce_forward_slash( $jt_permalink );
			$jt_ogimage = $this->first_not_empty( array( $jt_thumbnail, $jt_sitelogo, $jt_postimage ) );
		} elseif ( is_category() ) {
			$jt_title   = ucwords( $this->first_not_empty( array( $jt_archivetitle, $jt_posttitle ) ) );
			$jt_desc    = ucfirst( $this->first_not_empty( array( $jt_catexcerpt, $jt_postexcerpt, $jt_sitedesc ) ) );
			$jt_author  = ucwords( $this->first_not_empty( array( $jt_postauthor, $jt_siteauthor ) ) );
			$jt_canon   = $this->enforce_forward_slash( $jt_permalink );
			$jt_ogimage = $this->first_not_empty( array( $jt_thumbnail, $jt_postimage, $jt_sitelogo ) );
		} elseif ( is_archive() ) { // Auto-gen 'cats'
			$jt_title   = ucwords( $this->first_not_empty( array( $jt_archivetitle, $jt_posttitle ) ) );
			$jt_desc    = ucfirst( $this->first_not_empty( array( $jt_catexcerpt, $jt_postexcerpt, $jt_sitedesc ) ) );
			$jt_author  = ucwords( $this->first_not_empty( array( $jt_postauthor, $jt_siteauthor ) ) );
			$jt_canon   = $this->enforce_forward_slash( $jt_permalink );
			$jt_ogimage = $this->first_not_empty( array( $jt_thumbnail, $jt_postimage, $jt_sitelogo ) );
		} elseif ( is_singular() ) { // These vars should be reliable
			$jt_title   = ucwords( $jt_posttitle );
			$jt_desc    = ucfirst( $jt_postexcerpt );
			$jt_author  = ucwords( $jt_postauthor );
			$jt_canon   = $this->enforce_forward_slash( $jt_permalink );
			$jt_ogimage = $this->first_not_empty( array( $jt_postimage, $jt_thumbnail, $jt_sitelogo ) );
		} else {
			echo '<!-- META FALLBACK - CHECK THEME-SEO TEMPLATE FUNCTIONS -->';
			$jt_title   = ucwords( $this->first_not_empty( array( $jt_posttitle, $jt_archivetitle, $jt_sitetitle ) ) );
			$jt_desc    = ucfirst( $this->first_not_empty( array( $jt_postexcerpt, $jt_catexcerpt, $jt_sitedesc ) ) );
			$jt_author  = ucwords( $this->first_not_empty( array( $jt_postauthor, $jt_siteauthor ) ) );
			$jt_canon   = $this->enforce_forward_slash( $jt_permalink );
			$jt_ogimage = $this->first_not_empty( array( $jt_thumbnail, $jt_postimage, $jt_sitelogo ) );
		}

		return $meta = array(
			'title'       => $jt_title,
			'desc'        => $jt_desc,
			'author'      => $jt_author,
			'canon'       => $jt_canon,
			'ogimage'     => $jt_ogimage,
			'ogtitle'     => $jt_title,
			'robots'      => $jt_robots,
			'ogtype'      => $jt_objecttype,
			'ogurl'       => $jt_canon,
			'oglocale'    => $jt_locale,
			'oglocalealt' => $jt_localealt,
			'ogdesc'      => $jt_desc,
			'ogsitename'  => $jt_sitetitle,
			'charset'     => $jt_charset,
			'themeuri'    => $jt_themeuri,
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
<link rel="shortcut icon" href="{$meta["themeuri"]}/imagery/favicon/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" sizes="57x57" href="{$meta["themeuri"]}/imagery/favicon/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="114x114" href="{$meta["themeuri"]}/imagery/favicon/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="72x72" href="{$meta["themeuri"]}/imagery/favicon/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="144x144" href="{$meta["themeuri"]}/imagery/favicon/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="60x60" href="{$meta["themeuri"]}/imagery/favicon/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="120x120" href="{$meta["themeuri"]}/imagery/favicon/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="76x76" href="{$meta["themeuri"]}/imagery/favicon/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="152x152" href="{$meta["themeuri"]}/imagery/favicon/apple-touch-icon-152x152.png">
<link rel="icon" type="image/png" href="{$meta["themeuri"]}/imagery/favicon/favicon-196x196.png" sizes="196x196">
<link rel="icon" type="image/png" href="{$meta["themeuri"]}/imagery/favicon/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="{$meta["themeuri"]}/imagery/favicon/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="{$meta["themeuri"]}/imagery/favicon/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="{$meta["themeuri"]}/imagery/favicon/favicon-128.png" sizes="128x128">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- hb_head end -->
EOF;

		return $head_meta;

	}//end generate_head_meta()

}//end class
