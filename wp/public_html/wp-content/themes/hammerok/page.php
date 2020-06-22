<?php get_header(); ?>
<div class="content">
    <h1 class="title-page"><?=$post->post_title;?></h1>
    <?=$post->post_content;?>
    <div class="page-navigation">
        <div class="page-navigation-wrap">
            <a href="<?=get_permalink(get_previous_post());?>" class="page-navigation__prev-page">
                <i class="icon icon-angle-double-left"></i>Предыдущая статья
            </a>
        </div>
        <div class="page-navigation-wrap">
            <a href="<?=get_permalink(get_next_post());?>" class="page-navigation__next-page">
                Следующая статья <i class="icon icon-angle-double-right"></i>
            </a>
        </div>
    </div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>