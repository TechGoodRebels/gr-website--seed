<?php

namespace GoodRebels\Theme;


add_action('init', function () {
    ACF::startScope('gtm');
    $container_id = get_field(ACF::getName('container_id'), 'option');
    ACF::endScope();

    if (empty($container_id)) {
        return;
    }

    add_action('Theme::theHead', function() use ($container_id) {
        ?>
            <!-- Google Tag Manager -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','<?php echo $container_id; ?>');</script>
            <!-- End Google Tag Manager -->
        <?php
    }, 0);

    add_action('Theme::preHeader', function() use ($container_id) {
        ?>
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $container_id; ?>"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
        <?php
    }, 0);

}, 999);
