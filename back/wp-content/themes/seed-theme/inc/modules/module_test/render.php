<?php

namespace GoodRebels\Theme;


$module_name = basename(__DIR__);

add_action("Module::theView({$module_name})", function () use ($module_name) {
    $content = get_sub_field('text_content');
    if (empty($content)) { return; }

    ?>
        <section <?php do_action('Module::theClasses', 'test'); ?>>
            <div class="module__content">
                <?php echo $content; ?>
            </div>
        </section>
    <?php
});
