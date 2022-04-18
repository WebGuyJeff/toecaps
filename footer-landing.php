<?php
namespace BigupWeb\JoineryTheme;

/**
 * Joinery Theme Template - Footer Variant for Landing Pages.
 *
 * @package   Joinery_Theme
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */
?>

<footer class="footer">
    <div class="footer_inner">


        <?php
        Menu_Walker::output_theme_location_menu(
            array(
                'theme_location'    => 'landing-page-secondary-menu',
                'menu_class'        => 'footer_nav',
                'nav_or_div'        => 'div',
                'nav_aria_label'    => '',
                'html_tab_indents'  => 3,
                'button_class'        => 'button button-noback',
            ) 
        );
        ?>


        <div class="footer_legalLinks">
            <?php
                Menu_Walker::output_theme_location_menu(
                    array(
                    'theme_location'    => 'global-legal-links',
                    'nav_or_div'        => false,
                    'nav_aria_label'    => '',
                    'html_tab_indents'  => 3,
                    'button_class'        => 'button button-noback',
                    ) 
                );

                $sitename = get_bloginfo('name', 'raw');
                echo "<p class=\"footer_label\">&copy; " . date("Y") . " {$sitename}</p>";
                ?>
        </div>

    </div>
</footer>

<?php get_template_part('template-parts/nav', 'mobile');?>

<?php wp_footer(); ?>

</body>
</html>
<!--<script> console.log( 'wp-template: footer-landing.php' );</script>-->
