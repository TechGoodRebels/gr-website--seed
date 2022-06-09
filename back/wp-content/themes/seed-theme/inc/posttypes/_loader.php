<?php

foreach (glob(trailingslashit(__DIR__) . '*', GLOB_ONLYDIR) as $dir) {
    $dir = untrailingslashit($dir);
    $register_file = wp_normalize_path("{$dir}/_register.php");
    if (file_exists($register_file)) {
        require_once $register_file;
    }

    $slug = basename($dir);
    $pattern = wp_normalize_path("{$dir}/*.{$slug}.php");
    foreach (glob($pattern) as $file) {
        require_once $file;
    }
}
