<?php

namespace GoodRebels\Theme;

add_action('init', function () {

    $parent_menu = Theme::$name;
    $name = basename(__FILE__, '.option.php');
    $menu = "{$parent_menu}_{$name}";

    $args = array(
        'page_title'  => __('General options', 'seed-theme'),
        'menu_title'  => __('General options', 'seed-theme'),
        'parent_slug' => $parent_menu,
        'menu_slug'   => $menu,
        'position'    => 1,
    );
    apply_filters("OptionPages::addSubMenu", $menu, $args);

    $scope = array();

    acf_add_local_field_group(
        ACF::_fieldGroup(
            $menu,
            __('Theme options', 'seed-theme'),
            array_merge(
                (array) apply_filters('Options::getFields(header)', array(), $scope),
                (array) apply_filters('Options::getFields(footer)', array(), $scope),
                (array) apply_filters('Options::getFields(social)', array(), $scope),
                (array) apply_filters('Options::getFields(pages)', array(), $scope),
                (array) apply_filters('Options::getFields(gtm)', array(), $scope)
            ),
            array(
                'location' => ACF::locationAny($menu, '==', 'options_page'),
            )
        )
    );

});
