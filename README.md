# Toecaps

## A WordPress theme for tradespeople and manufacturers.

This theme provides a homepage landing template and a category landing page template.

More details to follow as the magic unfolds...



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