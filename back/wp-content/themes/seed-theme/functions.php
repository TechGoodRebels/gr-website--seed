<?php

namespace GoodRebels\Theme;


add_action('BaseTheme::load', function () {
    if (!apply_filters('Theme::checkPlugins', true)) {
        return;
    }


    // Load Theme Pre-Configuration
    add_action('after_setup_theme', function () {
        $theme_dir = get_stylesheet_directory();
        $required_files = array(
            'inc/classes/Theme.class.php',

            'inc/classes/_loader.php',
            'inc/config/_loader.php',
            'inc/options/_loader.php',
            'inc/posttypes/_loader.php',
        );
        foreach ($required_files as $required_file) {
            $file = "{$theme_dir}/{$required_file}";
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }, 0);


    // Load Theme
    add_action('init', function () {
        $theme_dir = get_stylesheet_directory();
        $required_files = array(
            'inc/modules/_loader.php',
            'inc/render/_loader.php',
        );
        foreach ($required_files as $required_file) {
            $file = "{$theme_dir}/{$required_file}";
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }, 0);
});
