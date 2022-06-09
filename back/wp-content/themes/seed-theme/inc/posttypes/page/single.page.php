<?php

namespace GoodRebels\Theme;


add_action('init', function () {
    if (!function_exists('\acf_add_local_field_group')) {
        return;
    }

    $slug       = basename(__DIR__);
    $type       = 'single';
    $scope      = "{$slug}_{$type}";
    $group_name = "{$slug}_{$scope}";


    $modules = apply_filters(
        'Modules::getModulesFields',
        array(),
        array(
            "module_text",
            "module_text-image",
            "module_image",
            "module_video",
            "module_numbers",
            "module_columns",
            "module_posts",
            "module_form",

            "module_reusable",
            "module_main-content",
        ),
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
                'location'   => apply_filters(
                    "PostTypes::getLocationFields({$group_name})",
                    ACF::locationAny($slug)
                ),
            )
        )
    );

}, 9900);
