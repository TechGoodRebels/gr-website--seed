<?php

namespace GoodRebels\Theme;


add_action('init', function () {

    $menu = Theme::$name;
    $args = array(
        'page_title' => __('Theme settings', 'seed-theme'),
        'menu_title' => __('Theme settings', 'seed-theme'),
        'menu_slug'  => $menu,
        'capability' => 'manage_options',
        'position'   => 99,
        'icon_url'   => 'dashicons-admin-settings',
        'redirect'   => true,
    );
    apply_filters('OptionPages::addMenu', $menu, $args);

});
