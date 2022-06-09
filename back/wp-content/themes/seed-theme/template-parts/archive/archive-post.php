<?php

$post_type = 'post';

do_action('Templates::theHeaderSection', 'archive', $post_type, 'options');
do_action('Templates::theMainSection', 'archive', $post_type, 'options');
do_action('Templates::theContentSection', 'archive', $post_type, 'options');
do_action('Templates::theFooterSection', 'archive', $post_type, 'options');
