<?php

namespace GoodRebels\Theme;


add_action('init', function () {
    if (!function_exists('\acf_add_local_field_group')) {
        return;
    }

    $group_name = "all";

    $module_infos = apply_filters("Modules::getInfos", array());
    $module_infos = wp_filter_object_list($module_infos, array('flex_module' => false), 'not');
    $module_names = array_filter(array_keys($module_infos));
    if (empty($module_names)) {
        return;
    }

    $modules = apply_filters(
        'Modules::getMandatoryFields',
        array(),
        $module_names,
        ''
    );

    $modules_groups = wp_filter_object_list($modules, array('type' => 'group'));
    $module_keys    = wp_list_pluck($modules_groups, 'key');
    add_filter('Modules::getAvailableClones', function ($keys) use ($module_keys) {
        $keys = is_array($keys) ? $keys : array();
        return array_merge($keys, $module_keys);
    });

    acf_add_local_field_group(
        ACF::_fieldGroup(
            $group_name,
            __('All modules', 'seed-theme'),
            $modules,
            array( // HIDE, uses for set module fields for clones
                // 'position'   => 'acf_after_title',
                // 'menu_order' => 10,
                // 'location'   => ACF::locationAny("options-test", '==', 'options_page'),
            )
        )
    );

}, 9800);
