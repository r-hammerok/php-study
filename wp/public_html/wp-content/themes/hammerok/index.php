<?php get_header(); ?>
<div class="content">
<h1 class="title-page">
    <?php if (is_search()) : ?>
        Результат поиска по "<?=get_search_query()?>":
    <?php else : ?>
        Последние новости и акции из мира туризма
    <?php endif; ?>
</h1>
<div class="posts-list">
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <!-- post-mini-->
        <div class="post-wrap">
            <div class="post-thumbnail">
                <?php the_post_thumbnail('medium', [
                    'class' => 'post-thumbnail__image',
                    'alt' => 'Image поста'
                ]); ?>
            </div>
            <div class="post-content">
                <div class="post-content__post-info">
                    <div class="post-date"><?= get_the_date('d.m.Y'); ?></div>
                </div>
                <div class="post-content__post-text">
                    <div class="post-title">
                        <?php the_title(); ?>
                    </div>
                    <?php the_excerpt(); ?>
                </div>
                <div class="post-content__post-control">
                    <a href="<?php the_permalink(); ?>" class="btn-read-post">Читать далее >></a>
                </div>
            </div>
        </div>
        <!-- post-mini_end-->
    <?php endwhile; ?>
<?php else : ?>
<p>Ничего не найдено</p>
<?php endif; ?>
<?php
$args = [
    'prev_text' => __('<i class="icon icon-angle-double-left"></i>'),
    'next_text' => __('<i class="icon icon-angle-double-right"></i>'),
];
the_posts_pagination($args);
?>
</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
