<?php

namespace GoodRebels\Theme;


add_action('init', function () {
    if (!function_exists('\acf_add_local_field_group')) {
        return;
    }

    $slug       = basename(__DIR__);
    $type       = 'single';
    $group_name = "{$slug}_{$slug}_{$type}";

    $module_infos = apply_filters("Modules::getInfos", array());
    $module_infos = wp_filter_object_list($module_infos, array('flex_module' => false), 'not');
    $module_names = array_filter(array_keys($module_infos));
    if (empty($module_names)) {
        return;
    }

    $modules = apply_filters(
        'Modules::getModulesFields',
        array(),
        $module_names,
        $group_name
    );

    acf_add_local_field_group(
        ACF::_fieldGroup(
            $group_name,
            __('Main content', 'seed-theme'),
            array_merge(
                $modules
            ),
            array(
                'position'   => 'acf_after_title',
                'menu_order' => 10,
                'location'   => ACF::locationAny($slug),
            )
        )
    );

}, 9900);
