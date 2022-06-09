<?php

namespace GoodRebels\Theme;


add_action('after_setup_theme', function () {
    $slug = basename(__DIR__);

    // Restrict front access only to administrator users
    add_action('template_redirect', function() use ($slug) {
        $post_type = apply_filters('PostTypes::getPostType', false);
        if (($post_type === $slug) && !is_user_logged_in()) {
            if (!current_user_can('administrator') && !get_option('options_is_public', false)) {
                wp_redirect(home_url());
                exit();
            }
        }
    });

    // Remove from sitemaps
    add_filter('wp_sitemaps_post_types', function ($post_types) use ($slug) {
       if (isset($post_types[$slug])) {
            unset($post_types[$slug]);
       }
        return $post_types;
    });


    add_action('init', function () use ($slug) {
        if (apply_filters('PostTypes::getPostType', false) !== $slug) {
            return;
        }

        add_filter('Module::getView', function($result, $module_name) use ($slug) {
            $info = apply_filters("Module::getInfo({$module_name})", false);
            if (is_array($info)) {
                $list = array();
                if (isset($info['label'])) {
                    $link = get_post_type_archive_link($slug);
                    $list[] = sprintf('<li style="font-size: 1.2em;"><b><a href="%s" style="color: #000 !important;">%s</a> | %s</b></li>', $link, __('Module', 'seed-theme'), $info['label']);
                }
                $list[] = sprintf('<li>%s: %s</li>', __('Name', 'seed-theme'), $module_name);
                if (isset($info['description'])) {
                    $list[] = sprintf('<li>%s: %s</li>', __('Description', 'seed-theme'), $info['description']);
                }

                if (!empty($list)) {
                    $result = sprintf(
                        '<div class="dev-info" style="border-top: 2px solid black; color: #000 !important;"><div class="container"><ul style="padding: 40px 0 20px;">%s</ul></div></div>%s',
                        implode('', $list),
                        $result
                    );
                }
            }
            return $result;
        }, 10, 2);
    }, 9999);

    add_filter('Templates::getMainSection', function ($result, $_type, $_slug) use ($slug) {
        if (($_slug !== $slug) || ($_type !== 'archive')) {
            return $result;
        }

        $args = array(
            'post_type'      => $slug,
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'post_title',
            'order'          => 'ASC'
        );
        $query = new \WP_Query($args);
        if ($query->have_posts()) {
            printf('<div class="container" style="font-size: 3rem; padding-top: 18rem; padding-bottom: 8rem;"><ul class="col-12">');
            $posts = (array) $query->posts;
            foreach ($posts as $post) {
                printf(
                    '<li style="padding-bottom: 20px;"><a href="%s">%s</a></li>',
                    get_permalink($post),
                    $post->post_title
                );
            }
            printf('</ul></div>');
        }

    }, 10, 3);

}, 30);
