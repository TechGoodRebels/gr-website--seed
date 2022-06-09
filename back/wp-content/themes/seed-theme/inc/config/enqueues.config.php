<?php

namespace GoodRebels\Theme;


add_filter('wp_enqueue_scripts', function () {
    $name    = Theme::$baseName;
    $uri     = untrailingslashit(Theme::$uri);
    $version = Theme::$version;
    // wp_enqueue_style("{$name}-main.css", "{$uri}/dist/css/main.css", false, $version, false);
    // wp_enqueue_script("{$name}-main.js", "{$uri}/dist/js/main/main.js", null, $version, true);
}, 100);
