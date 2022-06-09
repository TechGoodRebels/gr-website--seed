<?php

namespace GoodRebels\Theme;


add_filter('Options::getFields(pages)', function ($fields = array(), $scope = array()) {

    return array_merge(
        ACF::startScope($scope, 'pages'),
        ACF::_tabLeft(__('Pages', 'seed-theme')),
            ACF::_postObject(
                'page-404',
                __('Page not found (404)', 'seed-theme'),
                array(
                    'page',
                ),
                array(
                    'required' => true,
                )
            ),
        ACF::endScope(),
    );

}, 10, 2);
