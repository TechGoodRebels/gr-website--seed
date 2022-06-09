<?php

namespace GoodRebels\Theme;


add_action('after_setup_theme', function () {

    $slug = basename(__DIR__);
    $type = 'single';
    $group_name = "{$slug}_{$type}";

    $location_name = 'front_page';
    $group_name = "{$group_name}_{$location_name}";

    $location = ACF::locationAny('front_page', '==', 'page_type');

    add_filter("PostTypes::getExculdeLocations{$slug}", function($locations) {
        $locations = is_array($locations) ? $locations : array();
        $locations[] = current(current(ACF::locationAny('front_page', '!=', 'page_type')));
        return $locations;
    });

    $check_function = function() {
        return is_front_page();
    };
    do_action('PostTypes::addLocation', $slug, $location_name, $location, $check_function, 2);

    $options = array(
        'header' => array(
            // 'module_header-home' => array(),
        ),
    );
    do_action('Templates::setTemplate', $slug, $group_name, $options, $type, $location_name);

}, 12);
