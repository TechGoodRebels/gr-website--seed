<?php


require_once trailingslashit(__DIR__) . 'modules.php';

foreach (glob(trailingslashit(__DIR__) . 'module_*', GLOB_ONLYDIR) as $dir) {
    $module_name = basename($dir);
    $pattern = wp_normalize_path("{$dir}/*.php");
    foreach (glob($pattern) as $file) {
        require_once $file;
    }

    do_action('Module::addModuleInfo', $module_name);
}
