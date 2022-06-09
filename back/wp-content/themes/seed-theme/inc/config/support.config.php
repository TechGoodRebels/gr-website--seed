<?php

namespace GoodRebels\Theme;


add_action('after_setup_theme', function () {
    register_nav_menus(
        array(
            'main-menu'   => __('Main menu', 'seed-theme'),
            'footer-menu' => __('Footer menu', 'seed-theme'),
        )
    );

    add_image_size('xs-image', 220);
    add_image_size('sm-image', 300);
    add_image_size('md-image', 600);
    add_image_size('lg-image', 900);

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support(
        'html5',
        array(
            'search-form',
            'gallery',
            'caption',
        )
    );
});


// EXCERPT

add_filter('excerpt_more', function ($more) {
    return '…';
});

add_filter('excerpt_length', function($length) {
    return 18;
});


// FILTER The content

add_filter('the_content', function ($content) {
    return apply_filters('Tools::getCleanContent', $content);
}, 999, 1);

add_filter('get_the_content', function ($content) {
    return apply_filters('Tools::getCleanContent', $content);
}, 999, 1);
