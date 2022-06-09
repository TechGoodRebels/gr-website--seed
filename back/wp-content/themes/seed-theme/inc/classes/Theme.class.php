<?php

namespace GoodRebels\Theme;


if (!class_exists(__NAMESPACE__ . '\Theme')) {
    abstract class Theme
    {
        static $name;
        static $baseName;
        static $version;
        static $textDomain;
        static $uri;
        static $path;

        public static function start()
        {
            $themesDir  = wp_normalize_path(dirname(get_template_directory()));
            $currentDir = wp_normalize_path(__DIR__);
            $dirParts   = explode('/', str_replace($themesDir, '', $currentDir));
            $themeName  = current(array_filter($dirParts));
            if (!empty($themeName) && is_string($themeName)) {
                $theme = wp_get_theme($themeName);
                if (is_a($theme, 'WP_Theme')) {
                    self::$name        = $themeName;
                    self::$baseName    = $themeName;
                    self::$version     = $theme->get('Version');
                    self::$textDomain  = $theme->get('TextDomain');
                    self::$uri         = $theme->get_stylesheet_directory_uri();
                    self::$path        = $theme->get_stylesheet_directory();

                    add_action('after_setup_theme', array(static::class, 'loadTextDomain'));
                }
            }
        }

        public static function loadTextDomain()
        {
            if (!function_exists('\load_theme_textdomain')) {
                require_once ABSPATH . WPINC . '/l10n.php';
            }
            $path = self::$path . '/languages';
            if (file_exists($path)) {
                load_theme_textdomain(self::$textDomain, $path);
            }
        }

    }
    Theme::start();
}
