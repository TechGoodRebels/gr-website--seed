<?php get_header(); ?>
    <main class="the-main">
        <?php get_template_part('template-parts/single/single', get_post_type()); ?>
    </main>
<?php get_footer(); ?>
