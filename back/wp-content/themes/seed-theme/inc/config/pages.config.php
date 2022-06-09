<?php

namespace GoodRebels\Theme;


add_filter('Templates::getQueriedObject', function($obj) {
    if (is_404() && ($page_404 = get_field('page-404', 'options'))) {
        global $post;
        $post = get_post($page_404);
        setup_postdata($post);
        return $post;
    }
    return $obj;
});

add_filter('display_post_states', function ($post_states, $post) {
    if (get_field('page-404', 'options') === $post->ID) {
        $post_states['page-404'] = __('Page not found (404)', 'seed-theme');
    }
    return $post_states;
}, 10, 2);
