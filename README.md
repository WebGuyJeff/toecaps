# Toecaps

## A WordPress theme for tradespeople and manufacturers.

This theme provides a homepage landing template and a category landing page template.

 - Parent pages are automatically recognised as categories and the template applied as such.

 - Child pages are also recognized automatically as a normal content page with a reduced header.

 - The page templates (selectable in the page editor) change the colour of the theme. The idea, is
 you can use any of the preset theme colours, or a mix of them as required.

 - Lastly, the menus are dymanic and specific to the page templates. While the main menu remains the
same accross the entire site, the category menus specific to the templates will be diplayed in-page
below the header. These category menus are designed to show all child pages of the same parent
creating lateral navigation within the category. These are normal menus editable in the theme
customiser, so ultimately, they will display whatever you choose - but the intended experience is
as described.

 - All templated are 100% width with no padding/margin containers to allow Gut' blocks to have full
 control of the real estate. This theme can be used with the 'Bigup Container' plugin to create
 varied-width sections in the content.

### Other features

 - GSAP animated parallax hero header image.
 - Automatic call-to-action displayed on all category (parent) pages, linking to '/contact'. The
 first line of the page content and the page title are used as the H1/tagline.
 - Fully keyboard and screen reader accessible nav-bars and dropdowns.
 - All psuedo-buttons (.button) also have keyboard event listeners attached for accessiblity.
 - Fullscreen mobile menu with infinite nested menu depth.
 - Hidden search form toggled by the button in the header.
 - Social media links configurable in admin (currently FB, Insta, LinkedIn and Pinterest).
 - Email, phone and business address configurable in admin.
 - Unique selling points (USPs) bar configurable in admin settings.


### Linting

This project uses PHP_CodeSniffer (installed via Composer) to lint PHP. It also uses wpcs (WordPress coding standards) 'sniffs' to validate code in adherence with WP coding standards.

To install the project dependencies:
'composer install'

Register an added coding standard (wpcs):
'./vendor/bin/phpcs --config-set installed_paths /vendor/wp-coding-standards/wpcs'

Update your VS Code settings file:
'"./vendor/bin/phpcs.standard": "WordPress"'

Check the installed standards:
'./vendor/bin/phpcs -i'

#### Global install

Install PHP_CodeSniffer globally
'composer global require "squizlabs/php_codesniffer=*"'

Make sure you have the composer bin dir in your PATH. The default value is ~/.composer/vendor/bin/, but you can check the value that you need to use by running 'composer global config bin-dir --absolute'.


#### Usage

Check code
'./vendor/bin/phpcs **/*.php'

Fix Code
'./vendor/bin/phpcbf **/*.php'

Summarize large outputs:
'./vendor/bin/phpcs --report=summary **/*.php'

Specifying a Coding Standard:
'./vendor/bin/phpcs --standard=WordPress /path/to/code/myfile.inc'

[PHP_CodeSniffer Github](https://github.com/squizlabs/PHP_CodeSniffer#installation)
[WordPress Coding Standards for PHP_CodeSniffer Github](https://github.com/WordPress/WordPress-Coding-Standards#installation)

#### PHP8.0 Bugfix

See this README for patching instructions:

'./vendor-wpcs-php8-bugfix/wp-coding-standards/wpcs/WordPress/Sniffs/WhiteSpace/README.md'