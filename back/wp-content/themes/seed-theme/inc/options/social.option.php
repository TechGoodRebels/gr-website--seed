<?php

namespace GoodRebels\Theme;


add_filter('Options::getFields(social)', function ($fields = array(), $scope = array()) {

    return array_merge(
        ACF::startScope($scope, 'social'),
            ACF::_tabLeft(
                __('Social', 'seed-theme')
            ),
            ACF::_repeater(
                'social_items',
                __('Social networks', 'seed-theme'),
                array_merge(
                    ACF::addScopeLevel('social_items'),
                        ACF::_select(
                            'social_type',
                            __('Social network', 'seed-theme'),
                            array(
                                'facebook'  => __('Facebook', 'seed-theme'),
                                'twitter'   => __('Twitter', 'seed-theme'),
                                'linkedin'  => __('Linkedin', 'seed-theme'),
                                'youtube'   => __('Youtube', 'seed-theme'),
                                'instagram' => __('Instagram', 'seed-theme'),
                            ),
                            '',
                            array(
                                'required' => true,
                                'wrapper'  => array(
                                    'width' => (100 / 2),
                                ),
                            )
                        ),
                        ACF::_link(
                            'social_link',
                            __('Link', 'seed-theme'),
                            array(
                                'required' => true,
                                'wrapper'  => array(
                                    'width' => (100 / 2),
                                ),
                            )
                        ),
                    ACF::removeScopeLevel()
                ),
                array(
                    'button_label' => __('Add social link', 'seed-theme'),
                    'layout'       => 'block',
                    'collapsed'    => ACF::getCollapsedKey(array('social_items', 'social_type')),
                )
            ),
        ACF::endScope(),
    );

}, 10, 2);
