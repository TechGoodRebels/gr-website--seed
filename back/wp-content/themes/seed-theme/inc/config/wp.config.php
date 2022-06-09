<?php

namespace GoodRebels\Theme;


add_action('after_setup_theme', function () {
    add_filter('Theme::disableComments', '__return_true');
});
