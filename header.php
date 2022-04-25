<?php
/**
 * Toecaps Template - Header.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

use BigupWeb\Toecaps\Helpers;

get_template_part( 'template-parts/css-loader' );

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

<?php get_template_part( 'template-parts/promo-banner' ); ?>

	<header class="header">
		<div class="container">
			<a class="identity" href="<?php echo esc_url( get_bloginfo( 'wpurl' ) ); ?>" aria-label="Home">
				<?php
				if ( has_custom_logo() ) {
					$logo_id  = get_theme_mod( 'custom_logo' );
					$logo_src = wp_get_attachment_image_src( $logo_id, 'full' );
					echo '<img class="identity_logo" src="' . esc_url( $logo_src[0] ) . '">';
				}
				?>
			</a>
		</div>

		<div class="header_menu">
			<label class="fullscreenMenu_open" for="fullscreenMenu_toggle">
				<i class="fullscreenMenu_icon fa fa-solid fa-bars"></i>
			</label>
			<input id="fullscreenMenu_toggle" class="fullscreenMenu_toggle" type="checkbox">
			<div class="fullscreenMenu">
				<div class="container">
					<div class="fullscreenMenu_contents">
						<button class="fullscreenMenu_close" onclick="document.getElementById('fullscreenMenu_toggle').click()">
							<i class="fullscreenMenu_icon fa-solid fa-xmark"></i>
						</button>

						<?php get_template_part( 'template-parts/menu' ); ?>

						<div class="fullscreenMenu_social">
							<?php get_template_part( 'template-parts/social-links' ); ?>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="header_hero">

			<?php

			if ( has_post_thumbnail() ) {

				$attributes = array(
					'class' => 'header_image',
				);
				the_post_thumbnail( 'post-thumbnail', $attributes );

			} else {
				?>

					<img
						class="header_image header_image-fade wp-post-image"
						width="1920"
						height="960"
						src="http://localhost:8001/wp-content/uploads/2022/04/hero-background.webp"
						alt="Joinery Workshop"
						loading="lazy"
						srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/imagery/rasters/hero-fallback/hero-fallback.webp 1920w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/imagery/rasters/hero-fallback/hero-fallback-300x150.webp 300w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/imagery/rasters/hero-fallback/hero-fallback-1024x512.webp 1024w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/imagery/rasters/hero-fallback/hero-fallback-768x384.webp 768w,
								<?php echo esc_url( get_template_directory_uri() ); ?>/imagery/rasters/hero-fallback/hero-fallback-1536x768.webp 1536w"
						sizes="(max-width: 1920px) 100vw, 1920px"
					>

				<?php
			}

			?>

			<div class="container">
				<?php get_template_part( 'template-parts/h1' ); ?>
			</h1>

		</div>

	</header>
