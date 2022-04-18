<?php

/**
 * Template Name: Landing Page Category
 *
 * @package   Joinery_Theme
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

wp_enqueue_style('category_css');


get_header('landing');

?>

<main class="main-landing">

    <section class="welcome">
        <?php get_template_part('template-parts/page-sections/welcome'); ?>
    </section>

    <section class="services" id="section-services">
        <?php get_template_part('template-parts/page-sections/services'); ?>
    </section>

    <section class="usp" id="working-with-me">
        <?php get_template_part('template-parts/page-sections/usp'); ?>
    </section>

    <section class="contact" id="section-contact">
        <?php get_template_part('template-parts/page-sections/contact'); ?>
    </section>

</main>

<?php

get_template_part('template-parts/modal', 'contact');

get_footer('landing');

?>

<!--<script> console.log( 'wp-template: landing-page.php' );</script>-->
