<?php

/**
 * Template Name: Landing Page Home
 *
 * @package Toecaps
 * @author   Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

wp_enqueue_style( 'category_css' );
wp_enqueue_style( 'godaddy_css' );

get_header( 'home' ); ?>

<main class="main-landing">

	<section class="welcome">
		<?php get_template_part( 'template-parts/page-sections/welcome' ); ?>
	</section>

	<section class="example" id="section-example">
		<?php get_template_part( 'template-parts/page-sections/example' ); ?>
	</section>

	<section class="contact" id="section-contact">
		<?php get_template_part( 'template-parts/page-sections/contact' ); ?>
	</section>

</main>

<?php
	get_template_part( 'template-parts/modal', 'contact' );
	get_footer();
?>
