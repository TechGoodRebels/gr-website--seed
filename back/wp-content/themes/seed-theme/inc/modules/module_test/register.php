<?php

namespace GoodRebels\Theme;


$module_name = basename(__DIR__);

add_filter("Module::getInfo({$module_name})", function () use ($module_name) {
    return array(
        'slug'        => $module_name,
        'label'       => __('Module Test', 'seed-theme'),
    );
});

add_filter("Module::getFields({$module_name})", function ($fields, $name = null, $options = array()) use ($module_name) {
    $name = !empty($name) ? $name : $module_name;
    return array_merge(
        ACF::addScopeLevel($name),
            ACF::_tab(__('Content', 'seed-theme')),
                ACF::_wysiwygSmall(
                    'text_content',
                    __('Content', 'seed-theme'),
                    array(
                        'required' => true,
                    )
                ),
        ACF::removeScopeLevel()
    );
}, 10, 3);
