<?php

namespace GoodRebels\Theme;


add_filter('Options::getFields(footer)', function ($fields = array(), $scope = array()) {

    return array_merge(
        ACF::startScope($scope, 'footer'),
            ACF::_tabLeft(
                __('Footer', 'seed-theme')
            ),
            ACF::_textarea(
                'attribution',
                __('Attribution', 'seed-theme'),
                array(
                    'instructions' => __('Add {year} to show the current year.', 'seed-theme'),
                    'rows'         => 1,
                )
            ),
        ACF::endScope(),
    );

}, 10, 2);
