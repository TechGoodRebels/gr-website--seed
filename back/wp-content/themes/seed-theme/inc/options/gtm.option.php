<?php

namespace GoodRebels\Theme;


add_filter('Options::getFields(gtm)', function ($fields = array(), $scope = array()) {

    return array_merge(
        ACF::startScope($scope, 'gtm'),
            ACF::_tabLeft(
                __('Google Tag Manager', 'seed-theme')
            ),
            ACF::_text(
                'container_id',
                __('Container ID', 'seed-theme')
            ),
        ACF::endScope(),
    );

}, 10, 2);
