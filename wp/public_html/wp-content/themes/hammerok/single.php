<?php get_header(); the_post();?>
<div class="content">
    <div class="article-title title-page">
        <?php the_title(); ?>
    </div>
    <div class="article-image">
        <?php the_post_thumbnail('full', 'class=post-thumbnail__image&alt=Image поста');?>
    </div>
    <div class="article-info">
        <div class="post-date">
            <?php the_date('d.m.Y'); ?>
        </div>
    </div>
    <div class="article-text">
        <?php the_content();?>
    </div>
    <div class="article-pagination">
        <div class="article-pagination__block pagination-prev-left">
            <?php $anotherPage = get_previous_post(); ?>
            <a href="<?=get_permalink($anotherPage)?>" class="article-pagination__link">
                <i class="icon icon-angle-double-left"></i>Предыдущая статья
            </a>
            <div class="wrap-pagination-preview pagination-prev-left">
                <div class="preview-article__img">
                    <?= get_the_post_thumbnail($anotherPage, 'thumbnail', 'class=preview-article__image') ?>
                </div>
                <div class="preview-article__content">
                    <div class="preview-article__info">
                        <a href="<?=get_permalink($anotherPage)?>" class="post-date">
                            <?=get_the_date('d.m.Y', $anotherPage->ID);?>
                        </a>
                    </div>
                    <div class="preview-article__text"><?=$anotherPage->post_title;?></div>
                </div>
            </div>
        </div>
        <div class="article-pagination__block pagination-prev-right">
            <?php $anotherPage = get_next_post(); ?>
            <a href="<?=get_permalink($anotherPage)?>" class="article-pagination__link">
                Сдедующая статья<i class="icon icon-angle-double-right"></i>
            </a>
            <div class="wrap-pagination-preview pagination-prev-right">
                <div class="preview-article__img">
                    <?= get_the_post_thumbnail($anotherPage, 'thumbnail', 'class=preview-article__image') ?>
                </div>
                <div class="preview-article__content">
                    <div class="preview-article__info">
                        <a href="<?=get_permalink($anotherPage)?>" class="post-date">
                            <?=get_the_date('d.m.Y', $anotherPage->ID);?>
                        </a>
                    </div>
                    <div class="preview-article__text"><?=$anotherPage->post_title;?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
