<?php
/**
 * Toecaps Template - Header Variant for Landing Pages.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

use BigupWeb\Toecaps\Helpers;

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" prefix="og: https://ogp.me/ns/website#">

<head>
	<?php
	$seo = new Seo_Meta();
	echo $seo->head_meta;
	wp_head();
	?>
</head>

<body <?php body_class(); ?> >

<?php get_template_part( 'template-parts/promo-banner', '' ); ?>

	<header class="header">
		<div class="container">
			<a class="siteTitle" href="<?php echo esc_url( get_bloginfo( 'wpurl' ) ); ?>" aria-label="Home">
				<?php
				if ( has_custom_logo() ) {
					$logo_id  = get_theme_mod( 'custom_logo' );
					$logo_src = wp_get_attachment_image_src( $logo_id, 'full' );
					echo '<img class="siteTitle_logo" src="' . esc_url( $logo_src[0] ) . '">';
				}
				?>
			</a>
		</div>

		<div class="header_menu">
			<label class="fullscreenMenu_open" for="fullscreenMenu_toggle">
				<i class="fullscreenMenu_icon fa fa-solid fa-bars"></i>
			</label>
			<input id="fullscreenMenu_toggle" class="fullscreenMenu_toggle" type="checkbox" data-com.bitwarden.browser.user-edited="yes">
			<div class="fullscreenMenu">
				<div class="container">
					<div class="fullscreenMenu_contents">
						<button class="fullscreenMenu_close" onclick="document.getElementById('fullscreenMenu_toggle').checked = false;">
							<i class="fullscreenMenu_icon fa-solid fa-xmark"></i>
						</button>
						<?php
						Menu_Walker::output_theme_location_menu(
							array(
								'theme_location'   => 'global-primary-menu',
								'menu_class'       => 'mainMenu',
								'nav_or_div'       => 'nav',
								'nav_aria_label'   => 'Main Menu',
								'html_tab_indents' => 5,
								'button_class'     => 'mainMenu_link',
							)
						);
						?>
						<div class="fullscreenMenu_social">
							<?php get_template_part( 'template-parts/social-links' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="header_hero">
			<?php
				$attributes = array(
					'class' => 'header_image',
				);
				the_post_thumbnail( 'post-thumbnail', $attributes );
			?>
			<div class="header_cta">
				<div class="siteTitle_text">
					<h1 class="siteTitle_sitename">
						<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
					</h1>
					<span class="siteTitle_tagline">
						<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
					</span>
					<?php
					$phone = get_option( 'phone' );
					if ( $phone ) {
						?>
						<a class="siteTitle_button button" role="button" href="tel:<?php echo esc_attr( get_option( 'phone' ) ); ?>" aria-label="Phone us">
							<span>Call Now</span>
						</a>
						<?php
					}
					?>
				</div>
			</div>
		</div>

	</header>