<?php

/**
 * Template Name: Landing Page Home
 *
 * @package herringbone
 * @author Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

get_header( 'landing' ); ?>

<main class="main-landing">

    <section class="problem">
        <?php get_template_part( 'template-parts/page-sections/problem'); ?>
    </section>
    <section class="solution">
        <?php get_template_part( 'template-parts/page-sections/solution'); ?>
    </section>
    <section class="target-market">
        <?php get_template_part( 'template-parts/page-sections/target-market'); ?>
    </section>
    <section class="competition">
        <?php get_template_part( 'template-parts/page-sections/competition'); ?>
    </section>
    <section class="working-with-me">
        <?php get_template_part( 'template-parts/page-sections/working-with-me'); ?>
    </section>
    <section class="cost">
        <?php get_template_part( 'template-parts/page-sections/cost'); ?>
    </section>
    <section class="process">
        <?php get_template_part( 'template-parts/page-sections/process'); ?>
    </section>

</main>

<?php
	get_template_part( 'template-parts/modal', 'contact' );
	get_footer( 'landing' );
?>

<!--<script> console.log( 'wp-template: landing-page-business.php' );</script>-->
