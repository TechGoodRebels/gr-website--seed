<?php

$post_type = null;
if ($taxonomy = get_query_var('taxonomy')) {
    $obj = get_taxonomy($taxonomy);
    $post_type = current($obj->object_type);
}

if ($post_type) {
    do_action('Templates::theHeaderSection', 'archive', $post_type);
    do_action('Templates::theMainSection', 'archive', $post_type);
    do_action('Templates::theContentSection', 'archive', $post_type);
    do_action('Templates::theFooterSection', 'archive', $post_type);
}
