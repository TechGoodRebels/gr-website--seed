<?php

namespace GoodRebels\Theme;


add_action('Theme::theFooterAttribution', function () {
    ACF::startScope('footer');
    $attribution = get_field(ACF::getName('attribution'), 'option');
    if (!empty($attribution)) {
        $attribution = str_replace('{year}', date('Y'), (string) $attribution);
        printf('<span class="attribution">%s</span>', $attribution);
    }
    ACF::endScope();
});

add_action('Theme::theFooterMenu', function ($menu_name, $classes = '') {
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
