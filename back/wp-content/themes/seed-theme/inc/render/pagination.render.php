<?php

namespace GoodRebels\Theme;


add_filter('Module::getPagination', function ($content = '', $args = array(), $query = null) {
    $content = '';
    $old_query = $GLOBALS['wp_query'];

    if (is_a($query, 'WP_Query')) {
        $GLOBALS['wp_query'] = $query;
    }

    $prev_text = sprintf(
        '<span class="sr-only">%s</span>',
        __('Prev', 'seed-theme')
    );
    $next_text = sprintf(
        '<span class="sr-only">%s</span>',
        __('Next', 'seed-theme')
    );
    $args = is_array($args) ? $args : array();

    if ($GLOBALS['wp_query']->max_num_pages > 1) {
        if (!empty($args['screen_reader_text']) && empty($args['aria_label'])) {
            $args['aria_label'] = $args['screen_reader_text'];
        }

        $paged = get_query_var('paged');
        $paged = max(1, (int) $paged);

        $args = wp_parse_args(
            array_merge(
                $args,
                array(
                    'type'      => 'array',
                    'prev_next' => true,
                    'prev_text' => $prev_text,
                    'next_text' => $next_text,
                    'current'   => $paged,
                )
            ),
            array(
                'end_size'           => 0,
                'mid_size'           => 2,
                'screen_reader_text' => ' ',
                'aria_label'         => __('Posts', 'seed-theme'),
                'class'              => 'pagination',
            )
        );

        $links = (array) paginate_links($args);

        if (!empty($links)) {
            $items = array();
            $total = count($links);
            foreach ($links as $index => $link) {
                if (strpos($link, '</span></a>') === false) {
                    $items[] = str_replace(array('">', '</a>', '</span>'), array('"><span>', '</span></a>', '</span></span>'), $link);
                } else {
                    $items[] = $link;
                }
            }
            $content = implode('', $items);
        }
    }

    if (!empty($content)) {
        return sprintf('<div class="the-pagination">%s</div>', $content);
    }

    $GLOBALS['wp_query'] = $old_query;
    return '';

}, 10, 3);

add_action('Module::thePagination', function ($args = array(), $query = null) {
    echo apply_filters('Module::getPagination', '', $args, $query);
}, 10, 2);
