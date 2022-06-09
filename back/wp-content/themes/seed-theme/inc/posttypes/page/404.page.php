<?php

namespace GoodRebels\Theme;


add_action('after_setup_theme', function () {

    $page_id = get_option('options_page-404');
    if (!$page_id) {
        return;
    }

    $slug = basename(__DIR__);
    $type = 'single';
    $group_name = "{$slug}_{$type}";

    $location_name = 'page-404';
    $group_name    = "{$group_name}_{$location_name}";

    $location = ACF::locationAny($page_id, '==', $slug);

    add_filter("PostTypes::getExculdeLocations{$slug}", function($locations) use ($page_id, $slug) {
        $locations = is_array($locations) ? $locations : array();
        $locations[] = current(current(ACF::locationAny($page_id, '!=', $slug)));
        return $locations;
    });

    add_filter("PostTypes::getSearchExcludesIDs", function($excludes) use ($page_id) {
        $excludes = is_array($excludes) ? $excludes : array();
        $excludes[] = $page_id;
        return $excludes;
    });

    $check_function = function() use ($page_id) {
        return (is_404() || (get_the_ID() === (int) $page_id));
    };
    do_action('PostTypes::addLocation', $slug, $location_name, $location, $check_function, 1);

    $options = array(
        'header' => array(
            //'module_header-404' => array(),
        ),
    );
    do_action('Templates::setTemplate', $slug, $group_name, $options, $type, $location_name);

    add_filter('body_class', function($classes) use ($page_id) {
        $classes = is_array($classes) ? $classes : array();
        if (get_the_ID() === (int) $page_id) {
            $classes[] = 'error404';
        }
        return $classes;
    });

}, 12);
