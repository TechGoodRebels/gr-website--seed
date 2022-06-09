<?php

namespace GoodRebels\Theme;


add_action('Theme::theHeaderLogo', function () {
    ACF::startScope('header');
    $logo = get_field(ACF::getName('logo'), 'option');
    $content = apply_filters('Theme::getImageSVG', '', $logo);
    if (!empty($content)) {
        printf(
            '<a href="%1$s" class="logo-link">%2$s</a>',
            get_home_url(),
            $content
        );
    }
    ACF::endScope();
});

add_action('Theme::theHeaderMenu', function ($menu_name, $classes = '') {
    if (!has_nav_menu($menu_name)) {
        return;
    }
    wp_nav_menu(array(
        'menu'           => $menu_name,
        'theme_location' => $menu_name,
        'menu_class'     => "{$menu_name} {$classes}",
        'container'      => '',
    ));
}, 10, 2);

add_action('Theme::theHeaderSearch', function () {
    get_search_form(true);
});
