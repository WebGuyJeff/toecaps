<?php
/**
 * Toecaps Functions.php config file.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

use BigupWeb\Toecaps\Helpers;
use BigupWeb\Toecaps\Hooks;
use BigupWeb\Toecaps\Admin_Settings;

/**
 * Load the PHP autoloader from it's own file
 */
require_once get_template_directory() . '/classes/autoload.php';


/**
 * WordPress hooks for this theme.
 */
$hooks = new Hooks();

/**
 * Theme Settings Page.
 */
if ( is_admin() ) {
	$admin_settings = new Admin_Settings();
}


/**
 * Enqueue scripts and styles
 */
function enqueue_scripts_and_styles() {
	wp_enqueue_style( 'style_css', get_template_directory_uri() . '/style.css', array(), filemtime( get_template_directory() . '/style.css' ), 'all' );
	wp_register_style( 'fontawesome_css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css', array(), '6.1.1', 'all' );
	// If not in admin area.
	if ( 'wp-login.php' !== $GLOBALS['pagenow'] && ! is_admin() ) {
		wp_enqueue_style( 'fontawesome_css' );
		// External js.
		wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js', array( 'jquery' ), '3.9.1', true );
		wp_enqueue_script( 'gsap_scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js', array( 'gsap' ), '3.9.1', true );
		// Local js.
		wp_enqueue_script( 'bundle_js', get_template_directory_uri() . '/js/bundle.js', array( 'gsap_scrolltrigger' ), filemtime( get_template_directory() . '/js/bundle.js' ), true );
	}
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_and_styles' );


/**
 * Enqueue admin scripts and styles
 */
function toecaps_load_admin_scripts_and_styles() {
	if ( ! wp_script_is( 'bigup_icons', 'registered' ) ) {
		wp_register_style( 'bigup_icons', get_template_directory_uri() . '/dashicons/css/bigup-icons.css', array(), filemtime( get_template_directory() . '/dashicons/css/bigup-icons.css' ), 'all' );
	}
	if ( ! wp_script_is( 'bigup_icons', 'enqueued' ) ) {
		wp_enqueue_style( 'bigup_icons' );
	}
	wp_enqueue_style( 'fontawesome_css' );
}
add_action( 'admin_enqueue_scripts', 'toecaps_load_admin_scripts_and_styles' );


// ======================================================= Basic WordPress setup

/**
 * Disable plugin auto updates
 */
add_filter( 'auto_update_plugin', '__return_false' );

/**
 * Disable theme auto updates
 */
add_filter( 'auto_update_theme', '__return_false' );

/**
 * Register widget area.
 */
function toecaps_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'toecaps' ),
			'id'            => 'sidebar-main',
			'description'   => esc_html__( 'Used for related content and unimportant stuff.', 'toecaps' ),
			'before_widget' => '<section id="%1$s" class="sauce widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget_title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'toecaps_widgets_init' );


if ( ! function_exists( 'toecaps_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function toecaps_setup() {
		/*
		 * Make theme available for translation.
		 * Translations to be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'toecaps', get_template_directory() . '/languages' );

		/**
		 * Let WordPress manage the document title.
		 * WordPress will dynamically populate the title tag using the page H1.
		 */
		// Handled by HB SEO functionality.
		// add_theme_support( 'title-tag' ).

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Register WordPress wp_nav_menu() locations
		 *
		 * This option exists in the wp_nav_menu function:
		 *
		 * "'fallback_cb'
		 * (callable|false) If the menu doesn't exist, a callback function will fire.
		 * Default is 'wp_page_menu'. Set to false for no fallback."
		 *
		 * This means where the user hasn't set a menu in the theme settings, for instance,
		 * straight after theme install, WP will display a meaninglesss pages menu which
		 * makes the theme look broken. TODO: A FALLBACK MUST BE PUT IN PLACE
		 */

		register_nav_menus(
			array(
				'homepage-menu' => esc_html__( 'Homepage Menu', 'toecaps' ),
				'footer-menu'   => esc_html__( 'Footer Menu', 'toecaps' ),
				'tan-menu'      => esc_html__( 'Tan Menu', 'toecaps' ),
				'teal-menu'     => esc_html__( 'Teal Menu', 'toecaps' ),
				'blue-menu'     => esc_html__( 'Blue Menu', 'toecaps' ),
				'yellow-menu'   => esc_html__( 'Yellow Menu', 'toecaps' ),
				'red-menu'      => esc_html__( 'Red Menu', 'toecaps' ),
				'green-menu'    => esc_html__( 'Green Menu', 'toecaps' ),
			)
		);

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		/**
		 * Add theme support for selective refresh for widgets.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 336,
				'width'       => 420,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'toecaps_setup' );


/**
 * Set the max content width sitewide.
 *
 * @see https://codex.wordpress.org/Content_Width
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1920;
}

/**
 * Allow full width editor.
 */
function hsc_editor_width_page() {
	echo '<style>
		body.page-editor-page .editor-post-title__block, body.page-editor-page .editor-default-block-appender, body.page-editor-page .editor-block-list__block {
			max-width: none !important;
		}
		.block-editor__container .wp-block {
			max-width: none !important;
		}
	</style>';
}
add_action( 'admin_head', 'hsc_editor_width_page' );


// ================================================================= SEO Cleanup


/**
 * Return a title without prefix for every type used in the get_the_archive_title().
 */
add_filter(
	'get_the_archive_title',
	function ( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_year() ) {
			$title = get_the_date( _x( 'Y', 'yearly archives date format' ) );
		} elseif ( is_month() ) {
			$title = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
		} elseif ( is_day() ) {
			$title = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Asides', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title' );
			}
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		} elseif ( is_tax() ) {
			$title = single_term_title( '', false );
		} else {
			$title = __( 'Archives' );
		}
		return $title;
	}
);


/**
 * Clean default WP bloat from wp_head hook
 */
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

/**
 * Remove default title meta function
 */
remove_action( 'wp_head', '_wp_render_title_tag', 1 );

/**
 * Remove USERS from sitemap
 */
add_filter(
	'wp_sitemaps_add_provider',
	function ( $provider, $name ) {
		return ( 'users' === $name ) ? false : $provider;
	},
	10,
	2
);

/**
 * Add custom image sizes.
 *
 * add_image_size( 'name-of-size', width, height, crop mode (true == hard) ).
 */
add_image_size( 'hero-banner-large', 1920, 250, true );
add_image_size( 'hero-banner-medium', 1024, 200, true );
add_image_size( 'hero-banner-small', 500, 200, true );
add_image_size( 'gallery', 700, 700 ); // Soft Crop Mode
