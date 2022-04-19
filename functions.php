<?php
/**
 * Toecaps Functions.php config file.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

/**
 * Load the PHP autoloader from it's own file
 */
require_once get_template_directory() . '/classes/autoload.php';


/**
 * WordPress hooks for this theme.
 */

use BigupWeb\Toecaps\Hooks;

$hooks = new Hooks();


/**
 * Enqueue scripts and styles
 */
function enqueue_scripts_and_styles() {
	wp_enqueue_style(
		'style_css',
		get_template_directory_uri() . '/style.css',
		array(),
		filemtime( get_template_directory() . '/style.css' ),
		'all'
	);
	wp_enqueue_style(
		'joinery_css',
		get_template_directory_uri() . '/css/joinery.css',
		array( 'style_css' ),
		filemtime( get_template_directory() . '/css/joinery.css' ),
		'all'
	);
	wp_enqueue_style(
		'godaddy_css',
		get_template_directory_uri() . '/css/godaddy.css',
		array( 'style_css' ),
		filemtime( get_template_directory() . '/css/godaddy.css' ),
		'all'
	);
	// If not in admin area.
	if ( 'wp-login.php' !== $GLOBALS['pagenow'] && ! is_admin() ) {
		wp_register_style( 'category_css', get_template_directory_uri() . '/css/category-css.css', array( 'joinery_css' ), filemtime( get_template_directory() . '/css/category-css.css' ), 'all' );
		// wp_register_style( 'hb_landingdev_css', get_template_directory_uri() . '/css/landing-dev.css', array( 'category_css' ), filemtime( get_template_directory() . '/css/landing-dev.css' ), 'all' );

		wp_enqueue_script( 'hb_screenclass_js', get_template_directory_uri() . '/js/hb_screenclass.js', array(), '0.1', true );
		// De-register wp jquery and use CDN.
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), '3.6.0', true );
		// Other front end resources.
		wp_enqueue_script( 'hb_mobile-popup-menu', get_template_directory_uri() . '/js/hb_mobile-popup-menu.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'hb_dropdownToggle', get_template_directory_uri() . '/js/hb_dropdown-menu.js', array(), '1.0', true );
		wp_register_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js', array( 'jquery' ), '3.9.1', true );
		// CSSRule this is part of core but there's a separate CDN?
		wp_register_script( 'gsap_cssrule', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/CSSRulePlugin.min.js', array( 'gsap' ), '3.9.1', true );
		wp_register_script( 'gsap_scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js', array( 'gsap' ), '3.9.1', true );
		wp_register_script( 'svgWheel_js', get_template_directory_uri() . '/animation/svgWheel/svgWheel.js', array( 'gsap_cssrule' ), '1.0', true );
		wp_register_script( 'hb_modal_js', get_template_directory_uri() . '/js/hb_modal.js', array(), '0.1', true );
		wp_register_script( 'hb_hideheader_js', get_template_directory_uri() . '/js/hb_hideheader.js', array( 'gsap_cssrule' ), '0.2', true );
		wp_register_script( 'hb_usp_js', get_template_directory_uri() . '/js/hb_usp.js', array(), '0.1', true );
		// wp_enqueue_style( 'jetbrains', 'https://fonts.googleapis.com/css2?family=JetBrains+Mono&display=swap', array(), time() , 'all');
	}
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_and_styles' );


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
				'mobile-popup-menu'           => esc_html__( 'Mobile Popup Menu', 'toecaps' ),
				'global-primary-menu'         => esc_html__( 'Global Header Menu', 'toecaps' ),
				'global-secondary-menu'       => esc_html__( 'Global Footer Menu', 'toecaps' ),
				'global-legal-links'          => esc_html__( 'Global Legal Links', 'toecaps' ),
				'home-primary-menu'   => esc_html__( 'Landing Page Header Menu', 'toecaps' )
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
// rss feeds
// remove_action( 'wp_head', 'feed_links', 2 );
// remove_action( 'wp_head', 'feed_links_extra', 3 );
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

// ================================================== Toecaps admin settings


/**
 * Add Toecaps admin menu option to sidebar
 */
function theme_settings_add_menu() {

	$jt__icon = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwMCIgaGVpZ2h0PSIxMDAwIiB2aWV3Qm94PSIwIDAgMjY1IDI2NSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBmaWxsPSJjdXJyZW50Q29sb3IiIGQ9Ik02MSAyMzVjLTEwLTItMzctOS00Ni0xMy0xMC0zLTEwLTQtMTAtOWwxLTcgMTUgNGMyMyA4IDM4IDEwIDYyIDEwIDI1IDAgMzMtMSA2NS05bDIxLTYgMTggMmExNzIgMTcyIDAgMCAwIDcyLTZsLTEgMTItMSAxMi0xMSAzYy0xMiAzLTQ4IDYtNjAgNC03LTEtOC0yLTgtNi0xLTUtMS02LTctNmwtMjIgNC0yOSA4Yy0xMiAyLTQ5IDQtNTkgM3ptMi0yMmMtMTUtMi0zMS02LTQ0LTExLTEyLTQtMTItNC0xMi05IDYtMjIgOC0zNCAzMy0zOSAyNi01IDQzIDMgNjAtOCAyNS0xNyA1NC0zNCA0Ni03Ni00LTE0LTYtMjYtNS00MCAyOC00IDM0IDE0IDM0IDE0IDUxLTE0IDY4IDMgNjkgMTYtNCAyNi00IDUxIDEgNjUgMTEgMzAgMTMgMzUgMTQgNTIgMSAxOSAzIDE3LTE3IDIxLTE4IDQtMzMgNS01NCAyaC0yNmwtMjMgNmMtMjkgOC01MyAxMC03NiA3eiIvPjwvc3ZnPgo=';


	add_menu_page(
		'Toecaps Settings',   // page_title.
		'Toecaps',            // menu_title.
		'manage_options',           // capability.
		'toecaps-settings',   // menu_slug.
		'',                         // function.
		$jt__icon,                  // icon_url.
		4                           // position.
	);

	add_submenu_page(
		'toecaps-settings',    // parent_slug.
		'Toecaps Settings',    // page_title.
		'Theme Settings',            // menu_title.
		'manage_options',            // capability.
		'toecaps-settings',    // menu_slug.
		'theme_settings_page',       // function.
		1                            // position.
	);
}
add_action( 'admin_menu', 'theme_settings_add_menu' );

/**
 * Create Toecaps Global Settings Page
 */
function theme_settings_page() {

	$jt__icon = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwMCIgaGVpZ2h0PSIxMDAwIiB2aWV3Qm94PSIwIDAgMjY1IDI2NSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBmaWxsPSJjdXJyZW50Q29sb3IiIGQ9Ik02MSAyMzVjLTEwLTItMzctOS00Ni0xMy0xMC0zLTEwLTQtMTAtOWwxLTcgMTUgNGMyMyA4IDM4IDEwIDYyIDEwIDI1IDAgMzMtMSA2NS05bDIxLTYgMTggMmExNzIgMTcyIDAgMCAwIDcyLTZsLTEgMTItMSAxMi0xMSAzYy0xMiAzLTQ4IDYtNjAgNC03LTEtOC0yLTgtNi0xLTUtMS02LTctNmwtMjIgNC0yOSA4Yy0xMiAyLTQ5IDQtNTkgM3ptMi0yMmMtMTUtMi0zMS02LTQ0LTExLTEyLTQtMTItNC0xMi05IDYtMjIgOC0zNCAzMy0zOSAyNi01IDQzIDMgNjAtOCAyNS0xNyA1NC0zNCA0Ni03Ni00LTE0LTYtMjYtNS00MCAyOC00IDM0IDE0IDM0IDE0IDUxLTE0IDY4IDMgNjkgMTYtNCAyNi00IDUxIDEgNjUgMTEgMzAgMTMgMzUgMTQgNTIgMSAxOSAzIDE3LTE3IDIxLTE4IDQtMzMgNS01NCAyaC0yNmwtMjMgNmMtMjkgOC01MyAxMC03NiA3eiIvPjwvc3ZnPgo=';

	?>
	<div class="wrap">
		<h1>
			<span>
				<img style="max-height: 1em;margin-right: 0.5em;vertical-align: middle;" src="
					<?php echo $jt__icon; ?>" />
			</span>
			Toecaps Settings
		</h1>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'section' );
			do_settings_sections( 'theme-options' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Add phone number option field to the admin page.
 */
function setting_phone() {
	?>
	<input type="text" name="phone" id="phone" value="<?php echo get_option( 'phone' ); ?>" />
	<?php
}
/**
 * Add email address option field to the admin page.
 */
function setting_email() {
	?>
	<input type="text" name="email" id="email" value="<?php echo get_option( 'email' ); ?>" />
	<?php
}
/**
 * Add LinkedIn option field to the admin page
 */
function setting_linkedin() {
	?>
	<input type="text" name="linkedin" id="linkedin" value="<?php echo get_option( 'linkedin' ); ?>" />
	<?php
}
/**
 * Add Instagram option field to the admin page
 */
function setting_instagram() {
	?>
	<input type="text" name="instagram" id="instagram" value="<?php echo get_option( 'instagram' ); ?>" />
	<?php
}
/**
 * Add Facebook option field to the admin page
 */
function setting_facebook() {
	?>
	<input type="text" name="facebook" id="facebook" value="<?php echo get_option( 'facebook' ); ?>" />
	<?php
}
/**
 * Add Pinterest option field to the admin page
 */
function setting_pinterest() {
	?>
	<input type="text" name="pinterest" id="pinterest" value="<?php echo get_option( 'pinterest' ); ?>" />
	<?php
}

/**
 * Tell WordPress to build the admin page
 */
function theme_settings_page_setup() {

	add_settings_section( 'section', 'Contact Info', null, 'theme-options' );
		add_settings_field( 'phone', 'Phone Number', 'setting_phone', 'theme-options', 'section' );
		add_settings_field( 'email', 'Email Address', 'setting_email', 'theme-options', 'section' );
		register_setting( 'section', 'phone' );
		register_setting( 'section', 'email' );

	add_settings_section( 'section', 'Social Links', null, 'theme-options' );
		add_settings_field( 'linkedin', 'LinkedIn URL', 'setting_linkedin', 'theme-options', 'section' );
		add_settings_field( 'instagram', 'Instagram URL', 'setting_instagram', 'theme-options', 'section' );
		add_settings_field( 'facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'section' );
		add_settings_field( 'pinterest', 'Pinterest URL', 'setting_pinterest', 'theme-options', 'section' );
		register_setting( 'section', 'linkedin' );
		register_setting( 'section', 'instagram' );
		register_setting( 'section', 'facebook' );
		register_setting( 'section', 'pinterest' );
}
add_action( 'admin_init', 'theme_settings_page_setup' );