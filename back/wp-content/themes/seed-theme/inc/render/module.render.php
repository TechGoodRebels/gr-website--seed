<?php

namespace GoodRebels\Theme;


add_filter('Module::getClasses', function ($result, $module = '', $classes = array(), $layout = null) {
    $result = array('module');
    if (!empty($module)) {
        $result[] = "module--{$module}";
    }
    if (is_null($layout)) {
        $layout = get_sub_field('layout');
    }
    if (!empty($layout) && is_string($layout)) {
        $result[] = "layout-{$layout}";
    }
    if (!empty($classes) && is_array($classes)) {
        $result = array_merge($result, $classes);
    }
    return $result;
}, 10, 4);

add_action('Module::theClasses', function ($module = '', $classes = array(), $layout = null) {
    $classes = apply_filters('Module::getClasses', array(), $module, $classes, $layout);
    if (is_array($classes) && !empty($classes)) {
        printf('class="%s"', implode(' ', $classes));
    }
}, 10, 3);
