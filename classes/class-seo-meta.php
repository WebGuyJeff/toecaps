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

/**
 * SEO Meta.
 *
 * Scrape WordPress for metadata and generate meta HTML output ready to insert into the HTML <head>.
 * Tries to select the most appropriate values for the page being queried.
 */
class Seo_Meta {


	/**
	 * Metadata variables
	 *
	 * @var array The metadata values scraped from WordPress.
	 */
	public $meta;


	/**
	 * Head meta variable.
	 *
	 * @var string HTML output ready to inset into <head>.
	 */
	public $head_meta;


	/**
	 * Construct the class.
	 *
	 * Scrape WordPress for metadata then generate the <head> meta HTML output.
	 */
	public function __construct() {
		$this->meta      = $this->build_meta_vars();
		$this->head_meta = $this->generate_head_meta( $this->meta );
	}


	/**
	 * Output the head meta.
	 */
	public function print_head_meta() {
		echo $this->head_meta;
	}


	/**
	 * Enforce forward slash.
	 *
	 * Append forward slash to strings where not already present.
	 *
	 * @param string $url The URL to process.
	 * @return string The URL with a forward slash or empty string if no URL passed.
	 */
	public function enforce_forward_slash( $url ) {
		if ( $url !== '' && substr( $url, -1 ) !== '/' ) {
			$url = $url . '/';
		}
		return $url;
	}


	/**
	 * Find first non-empty value.
	 *
	 * @param array $array The values to be checked.
	 * @return string The first non-empty value, or empty string if no value found.
	 */
	public function first_not_empty( $array ) {
		$string = '';
		if ( is_array( $array ) ) {
			foreach ( $array as &$value ) {
				$trimmed = trim( $value, ' ' );
				if ( ! empty( $trimmed ) ) {
					$string = $trimmed;
					break;
				}
			}
			unset( $value );
			if ( empty( $string ) ) {
				$string = '';
			}
		}
		return $string;
	}


	/**
	 * Extract inline image from content.
	 *
	 * @param string $content HTML content to be parsed with regular expression to find an image.
	 * @return string The cleaned URL without quotes.
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
				$match     = $matches[0][0];
				$url_parts = explode( '"', $match, 3 );
				$url       = $url_parts[1];

			} else {
				$url = '';
			}
		} else {
			$url = '';
		}
			return $url;
	}


	/**
	 * Get name of parent post.
	 *
	 * @param string $ID ID of the post to check for a parent.
	 * @return string The name of the parent post of empty string if no parent is found.
	 */
	private function get_parent_post_name( $id ) {
		$parent_post = get_post_parent( $id );
		if ( $parent_post === null ) {
			return '';
		} else {
			return apply_filters( 'the_title', $parent_post->post_title );
		}
	}


	/**
	 * Get text content of first <P> after a <H2>.
	 *
	 * @param string $content The HTML to parse.
	 * @return string The content of the first <p> found after a <h2>.
	 */
	private function get_first_p_after_a_h2( $content ) {
		$pattern_first_p_after_a_h2 = '/(?<=<h2).*?<p.*?>(.*?)([\.!?]|<\/p)/ms';
		if ( preg_match( $pattern_first_p_after_a_h2, $content, $matches ) ) {
			return $matches[1];
		} else {
			return '';
		}
	}


	/**
	 * Build meta variables.
	 *
	 * Process and select the most suitable meta values for the page.
	 *
	 * @return array An array of meta variables.
	 */
	public function build_meta_vars() {

		/* Constants (need a source) */
		$site_author = 'Joinery Team';
		$locale_alt  = 'en_US';
		$object_type = 'website';
		$robots      = 'index, follow, nocache, noarchive';

		/* Sitewide */
		$site_name    = wp_strip_all_tags( get_bloginfo( 'name', 'display' ) );
		$blog_title   = wp_strip_all_tags( get_the_title( get_option( 'page_for_posts', true ) ) );
		$site_tagline = wp_strip_all_tags( get_bloginfo( 'description', 'display' ) );
		$site_url     = esc_url( home_url( $path = '/', $scheme = 'https' ) );
		$logo         = esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) );
		$locale       = wp_strip_all_tags( get_bloginfo( 'language' ) );
		$charset      = wp_strip_all_tags( get_bloginfo( 'charset' ) );
		$theme_uri    = get_template_directory_uri();

		/* Page-Specific */
		$post = get_post();
		setup_postdata( $post );
		$post_id           = get_the_ID();
		$post_content      = get_post_field( 'post_content', $post_id, '' );
		$post_inline_img   = esc_url( $this->extract_image_from_content( $post_content ) );
		$post_title        = wp_strip_all_tags( get_the_title() );
		$post_parent_title = $this->get_parent_post_name( $post_id );
		$post_url          = esc_url( get_permalink() );

		/* Set scope */
		$category_excerpt = '';
		$archive_title    = '';
		$post_excerpt     = '';
		$post_author      = '';

		/* scrape conditionally by page type */
		if ( is_category() ) { // User may have set desc.
			$category_excerpt = preg_split( '/[.?!]/', wp_strip_all_tags( category_description(), true ) )[0] . '.';
		}

		if ( is_archive() ) { // Also matches categories (don't set vars twice).
			$archive_title  = wp_strip_all_tags( post_type_archive_title( '', false ) );
			$post_thumbnail = esc_url( get_the_post_thumbnail_url( $post_id ) );
		} else {
			$post_excerpt   = $this->get_first_p_after_a_h2( $post_content );
			$post_author    = wp_strip_all_tags( get_the_author() );
			$post_thumbnail = esc_url( get_the_post_thumbnail_url( $post_id ) );
		}

		/* choose the most suitable scraped value with preference order by page type */
		if ( is_front_page() ) { // Homepage.
			$meta_desc      = ucfirst( $this->first_not_empty( array( $site_tagline, $post_excerpt ) ) );
			$meta_title     = ucwords( $site_name . ' | ' . $meta_desc );
			$meta_author    = ucwords( $this->first_not_empty( array( $site_author, $post_author ) ) );
			$meta_canonical = $this->enforce_forward_slash( $site_url );
			$meta_og_image  = $this->first_not_empty( array( $logo, $post_thumbnail, $post_inline_img ) );

		} elseif ( is_home() ) { // Posts Page.
			$meta_desc      = ucfirst( $this->first_not_empty( array( $post_excerpt, $site_tagline ) ) );
			$meta_title     = ucwords( $this->first_not_empty( array( $blog_title, $site_name ) ) . ' | ' . $meta_desc );
			$meta_author    = ucwords( $site_author );
			$meta_canonical = $this->enforce_forward_slash( $post_url );
			$meta_og_image  = $this->first_not_empty( array( $post_thumbnail, $logo, $post_inline_img ) );

		} elseif ( is_category() ) {
			$meta_title     = ucwords( $this->first_not_empty( array( $archive_title, $post_title ) ) );
			$meta_desc      = ucfirst( $this->first_not_empty( array( $category_excerpt, $post_excerpt, $site_tagline ) ) );
			$meta_author    = ucwords( $this->first_not_empty( array( $post_author, $site_author ) ) );
			$meta_canonical = $this->enforce_forward_slash( $post_url );
			$meta_og_image  = $this->first_not_empty( array( $post_thumbnail, $post_inline_img, $logo ) );

		} elseif ( is_archive() ) { // Auto-generated categories.
			$meta_title     = ucwords( $this->first_not_empty( array( $archive_title, $post_title ) ) );
			$meta_desc      = ucfirst( $this->first_not_empty( array( $category_excerpt, $post_excerpt, $site_tagline ) ) );
			$meta_author    = ucwords( $this->first_not_empty( array( $post_author, $site_author ) ) );
			$meta_canonical = $this->enforce_forward_slash( $post_url );
			$meta_og_image  = $this->first_not_empty( array( $post_thumbnail, $post_inline_img, $logo ) );

		} elseif ( is_singular() ) { // All single posts types: posts, pages, attachments etc.
			$meta_title     = ucwords( $post_title . ' | ' . $this->first_not_empty( array( $post_parent_title, $site_name ) ) );
			$meta_desc      = ucfirst( $this->first_not_empty( array( $post_excerpt, $site_tagline ) ) );
			$meta_author    = ucwords( $post_author );
			$meta_canonical = $this->enforce_forward_slash( $post_url );
			$meta_og_image  = $this->first_not_empty( array( $post_inline_img, $post_thumbnail, $logo ) );

		} elseif ( is_search() ) {
			$meta_title     = ucwords( 'Search Results' );
			$meta_desc      = ucfirst( 'We are here to help you find what you\'re looking for.' );
			$meta_author    = ucwords( $site_author );
			$meta_canonical = $this->enforce_forward_slash( $post_url );
			$meta_og_image  = $this->first_not_empty( array( $post_inline_img, $post_thumbnail, $logo ) );

		} else {
			echo '<!-- META FALLBACK - CHECK THEME-SEO TEMPLATE FUNCTIONS -->';
			$meta_title     = ucwords( $this->first_not_empty( array( $post_title, $archive_title, $site_name ) ) );
			$meta_desc      = ucfirst( $this->first_not_empty( array( $post_excerpt, $category_excerpt, $site_tagline ) ) );
			$meta_author    = ucwords( $this->first_not_empty( array( $post_author, $site_author ) ) );
			$meta_canonical = $this->enforce_forward_slash( $post_url );
			$meta_og_image  = $this->first_not_empty( array( $post_thumbnail, $post_inline_img, $logo ) );
		}

		return $meta = array(
			'title'          => $meta_title,
			'desc'           => $meta_desc,
			'author'         => $meta_author,
			'canonical'      => $meta_canonical,
			'robots'         => $robots,
			'charset'        => $charset,
			'theme_uri'      => $theme_uri,
			'og_image'       => $meta_og_image,
			'og_title'       => $meta_title,
			'og_type'        => $object_type,
			'og_url'         => $meta_canonical,
			'og_locale'      => $locale,
			'og_localealt'   => $locale_alt,
			'og_description' => $meta_desc,
			'og_sitename'    => $site_name,
		);

	}

	/**
	 * Generate the head meta.
	 *
	 * @param array $meta The metadata scraped from WordPress.
	 * @return string Head meta HTML.
	 */
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
<link rel="canonical" href="{$meta["canonical"]}">
<!-- Open Graph Meta - <html> namespace must match og:type -->
<meta property="og:title" content="{$meta["og_title"]}">
<meta property="og:type" content="{$meta["og_type"]}">
<meta property="og:image" content="{$meta["og_image"]}">
<meta property="og:url" content="{$meta["og_url"]}">
<meta property="og:locale" content="{$meta["og_locale"]}">
<meta property="og:locale:alternate" content="{$meta["og_localealt"]}">
<meta property="og:description" content="{$meta["og_description"]}">
<meta property="og:site_name" content="{$meta["og_sitename"]}">
<!-- Branding Meta -->
<!-- Favicon and Web App Definitions -->
<meta name="application-name" content="{$meta["title"]}">
<meta name="msapplication-TileColor" content="#fff">
<meta name="msapplication-TileImage" content="{$meta["theme_uri"]}/imagery/favicon/mstile-144x144.png">
<meta name="msapplication-square70x70logo" content="{$meta["theme_uri"]}/imagery/favicon/mstile-70x70.png">
<meta name="msapplication-square150x150logo" content="{$meta["theme_uri"]}/imagery/favicon/mstile-150x150.png">
<meta name="msapplication-wide310x150logo" content="{$meta["theme_uri"]}/imagery/favicon/mstile-310x150.png">
<meta name="msapplication-square310x310logo" content="{$meta["theme_uri"]}/imagery/favicon/mstile-310x310.png">
<!-- Mobile Browser Colours -->
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#29a367"/>
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#29a367">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="#29a367">
<!-- Favicons and vendor-specific icons -->
<link rel="icon" type="image/png" href="{$meta["theme_uri"]}/imagery/favicon/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="{$meta["theme_uri"]}/imagery/favicon/favicon-16x16.png" sizes="16x16">
<!-- hb_head end -->
EOF;

		return $head_meta;

	}

}
