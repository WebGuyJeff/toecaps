<?php
/**
 * Toecaps Template - Header Variant for Landing Pages.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

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

<?php get_template_part( 'template-parts/promo-banner', 'contact' ); ?>

	<header class="header">
		<div class="container">
			<a class="siteTitle" href="<?php echo get_bloginfo( 'wpurl' ); ?>" aria-label="Home">
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
			<div class="container">
				<?php
					Menu_Walker::output_theme_location_menu(
						array(
							'theme_location'   => 'global-primary-menu',
							'menu_class'       => 'mainMenu',
							'nav_or_div'       => 'nav',
							'nav_aria_label'   => 'Main Menu',
							'html_tab_indents' => 3,
							'button_class'     => 'mainMenu_link',
						)
					);
				?>
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
						<?php echo get_bloginfo( 'name' ); ?>
					</h1>
					<span class="siteTitle_tagline">
						<?php echo get_bloginfo( 'description' ); ?>
					</span>
					<?php
					$phone = get_option( 'phone' );
					if ( $phone ) {
						$phone       = sanitize_title( $phone );
						$phone_link  = "<button class=\"siteTitle_button button\" href=\"tel:{$phone}\" target=\"\" rel=\"\" aria-label=\"{$phone}\">\n";
						$phone_link .= "\t<span>Call Now</span>\n";
						$phone_link .= "</button\n";
						echo $phone_link;
					}
					?>
				</div>
			</div>
		</div>

	</header>