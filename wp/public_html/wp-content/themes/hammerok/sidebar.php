<!-- sidebar begin-->
<div class="sidebar">
    <?php if ($tags = get_terms(['taxonomy' => 'post_tag', 'hide_empty' => false])) : ?>
    <div class="sidebar__sidebar-item">
        <div class="sidebar-item__title">Теги</div>
        <div class="sidebar-item__content">
            <ul class="tags-list">
                <?php foreach ($tags as $tag) : ?>
                <li class="tags-list__item"><a href="<?=get_term_link($tag)?>" class="tags-list__item__link"><?= $tag->name?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
    <?php if ($tags = get_terms(['taxonomy' => 'category', 'hide_empty' => false])) : ?>
    <div class="sidebar__sidebar-item">
        <div class="sidebar-item__title">Категории</div>
        <div class="sidebar-item__content">
            <ul class="category-list">
                <?php foreach ($tags as $tag) : ?>
                <li class="category-list__item"><a href="<?=get_term_link($tag)?>" class="category-list__item__link"><?= $tag->name?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
</div>
<!-- sidebar end-->
