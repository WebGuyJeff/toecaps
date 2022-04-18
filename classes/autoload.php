<?php
/**
 * Class Autoloader for the Joinery Theme Project
 *
 * After registering this autoload function with SPL, the following line
 * would cause the function to attempt to load the \Brand\Project\Sub_Project\Class class
 * from /path/to/project/src/sub_project/class.php:
 *
 *      new \Brand\Project\Sub_Project\Class;
 *
 * @param string $class The fully-qualified class name.
 */
spl_autoload_register(
    function ( $class ) {

        $namespace = 'BigupWeb\\JoineryTheme\\';
        $root_dir = get_template_directory();
        $sub_dir = str_replace($root_dir, '', dirname(__FILE__));
        $filename_prefix = 'class-';

        // does the class use the namespace prefix?
        $namespace_length = strlen($namespace);
        if (strncmp($namespace, $class, $namespace_length) !== 0) {
              // no, move to the next registered autoloader

              /* jeffDebug */
              error_log('############################################');
              error_log($class);

              return;
        }

        $relative_classname = substr($class, $namespace_length);
        $classname = array_reverse(explode('\\', $class))[0];
        $sub_namespace = str_replace($classname, '', $relative_classname);

        $filename = str_replace('\\', DIRECTORY_SEPARATOR, $sub_namespace . DIRECTORY_SEPARATOR . $filename_prefix . $classname . '.php');
        $class_filepath = strtolower(str_replace('_', '-', $root_dir . $sub_dir . $filename));

        // if the file exists, require it
        if (file_exists($class_filepath) ) {
            include $class_filepath;
        } else {
            echo '<script>console.log("ERROR: joinery-theme php autoload | Class not found: ' . $classname . '");</script>';
        }
    }
);