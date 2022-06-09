<?php

$post_type = apply_filters('PostTypes::getPostType', '', $args);

do_action('Templates::theHeaderSection', 'archive', $post_type);
do_action('Templates::theMainSection', 'archive', $post_type);
do_action('Templates::theContentSection', 'archive', $post_type);
do_action('Templates::theFooterSection', 'archive', $post_type);
