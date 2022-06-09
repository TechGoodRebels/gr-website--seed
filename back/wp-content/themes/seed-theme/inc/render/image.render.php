<?php

namespace GoodRebels\Theme;


add_filter('Theme::getImageSVG', function ($content, $image) {
    $content = '';
    $image_id = false;
    if (is_numeric($image)) {
        $image_id = $image;
    } elseif (isset($image['ID'])) {
        $image_id = $image['ID'];
    }
    if (empty($image_id)) {
        return $content;
    }

    if (get_post_mime_type($image_id) == 'image/svg+xml') {
        $file = get_attached_file($image_id);
        $content = @file_get_contents($file) ?: '';
        $content = apply_filters('Tools::getCleanSVGContent', $content);
    }

    return $content;
}, 10, 2);
