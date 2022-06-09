<?php

namespace GoodRebels\Theme;


add_action('init', function () {
    if (!function_exists('\acf_add_local_field_group')) {
        return;
    }

    $slug       = basename(__DIR__);
    $type       = 'options';
    $scope      = "{$slug}_{$type}";
    $group_name = "{$slug}_{$scope}";

    do_action('PostTypes::addArchiveLink', $slug);

    acf_add_local_field_group(
        ACF::_fieldGroup(
            $group_name,
            __('Settings (Posts)', 'seed-theme'),
            array_merge(
                ACF::startScope($group_name),
                    ACF::_tab(__('General', 'seed-theme')),
                        ACF::_boolean(
                            'is_public',
                            __('Is public', 'seed-theme')
                        ),
                    ACF::removeScopeLevel(),
                ACF::endScope()
            ),
            array(
                'position'   => 'acf_after_title',
                'menu_order' => 10,
                'location'   => ACF::locationAny("{$type}-{$slug}", '==', 'options_page'),
            )
        )
    );

}, 30);
