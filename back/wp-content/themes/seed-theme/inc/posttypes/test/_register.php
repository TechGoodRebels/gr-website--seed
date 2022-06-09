<?php

namespace GoodRebels\Theme;


add_action('after_setup_theme', function () {

    $slug = basename(__DIR__);

    $name     = _x('Module tests', 'post type general name', 'seed-theme');
    $singular = _x('Module test', 'post type general name', 'seed-theme');

    $labels = array(
        'name'                  => $name,
        'singular_name'         => $singular,
        'menu_name'             => $name,
        'name_admin_bar'        => $singular,
        'all_items'             => __('All module tests', 'seed-theme'),
        'add_new_item'          => __('Add new module test', 'seed-theme'),
        'add_new'               => __('Add new', 'seed-theme'),
        'new_item'              => __('New module test', 'seed-theme'),
        'edit_item'             => __('Edit module test', 'seed-theme'),
        'update_item'           => __('Update module test', 'seed-theme'),
        'view_item'             => __('View module test', 'seed-theme'),
        'search_items'          => __('Search module test', 'seed-theme'),
        'not_found'             => __('Not found', 'seed-theme'),
        'not_found_in_trash'    => __('Not found in Trash', 'seed-theme'),
    );

    $args = array(
        'labels'          => $labels,
        'description'     => __('Description', 'seed-theme'),
        'public'          => true,
        'has_archive'     => true,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'query_var'       => true,
        'map_meta_cap'    => true,
        'hierarchical'    => false,
        'menu_position'   => 39,
        'menu_icon'       => 'dashicons-feedback',
        'capability_type' => 'post',
        'rewrite'         => array(
            'slug'       => 'module-test',
            'with_front' => false,
        ),
        'supports'      => array(
            'title',
        ),
    );

    $options = array(
        'options' => sprintf('%s', __('Settings', 'seed-theme'), $name),
    );
    do_action('PostTypes::register', $slug, $name, $args, $options, 999, 'post-types', 'manage_options');

});
