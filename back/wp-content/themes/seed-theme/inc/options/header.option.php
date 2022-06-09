<?php

namespace GoodRebels\Theme;


add_filter('Options::getFields(header)', function ($fields = array(), $scope = array()) {

    return array_merge(
        ACF::startScope($scope, 'header'),
            ACF::_tabLeft(
                __('Header', 'seed-theme')
            ),
            ACF::_image(
                'logo',
                __('Logo', 'seed-theme'),
                array(
                    'required' => true,
                )
            ),
        ACF::endScope(),
    );

}, 10, 2);
