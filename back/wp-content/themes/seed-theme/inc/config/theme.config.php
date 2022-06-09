<?php

namespace GoodRebels\Theme;


add_filter("Theme::getHeadlines", function ($headline = array()) {
    $headline = is_array($headline) ? $headline : array();
    return array_merge(
        array(
            'h1'   => 'h1',
            'h2'   => 'h2',
            'h3'   => 'h3',
            'h4'   => 'h4',
            'h5'   => 'h5',
            'h6'   => 'h6',
            'div'  => 'div',
        ),
        $headline
    );
});

add_filter('Theme::getButtonClasses', function ($buttons = array()) {
    $buttons = is_array($buttons) ? $buttons : array();
    return array_merge(
        array(
            // 'btn-solid'  => __('Button (Solid)', 'seed-theme'),
            // 'btn-border' => __('Button (Border)', 'seed-theme'),
            // 'link'       => __('Text link', 'seed-theme'),
        ),
        $buttons
    );
});
