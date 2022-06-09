<?php

$post_type = apply_filters('PostTypes::getPostType', false);

do_action('Templates::theHeaderSection', 'single', $post_type);
do_action('Templates::theMainSection', 'single', $post_type);
do_action('Templates::theContentSection', 'single', $post_type);
do_action('Templates::theFooterSection', 'single', $post_type);
