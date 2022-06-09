<?php

namespace GoodRebels\Theme;


add_action('Theme::theSocial', function () {
    ACF::startScope('social');
    $field_name = ACF::getName('social_items', true, true);
    if (have_rows($field_name, 'options')) {
        $links = array();
        while (have_rows($field_name, 'options')) {
            the_row(true);

            $type = get_sub_field(ACF::getName('social_type'));
            $link = get_sub_field(ACF::getName('social_link'));

            if (empty($type) || empty($link)) {
                continue;
            }
            $url    = isset($link['url']) ? $link['url'] : '';
            $title  = isset($link['title']) ? $link['title'] : '';
            $target = isset($link['target']) ? $link['target'] : '_self';

            $links[] = sprintf(
                '<li class="%s"><a href="%s" target="%s">%s</a></li>',
                $type,
                esc_attr($url),
                esc_attr($target),
                $title,
            );
        }

        if (!empty($links)) {
            printf(
                '<ul class="social-links">%s</ul>',
                implode('', $links)
            );
        }
    }
    ACF::endScope();
});
