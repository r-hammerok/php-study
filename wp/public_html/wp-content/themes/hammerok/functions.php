<?php

// Подключаем стили и скрипты
add_action('wp_enqueue_scripts', 'connectStyles');
add_action('wp_enqueue_scripts', 'connectScripts');
function connectStyles()
{
    wp_enqueue_style('libs', get_stylesheet_directory_uri() . '/css/libs.min.css', [], time());
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.css', [], time());
    wp_enqueue_style('media', get_stylesheet_directory_uri() . '/css/media.css', [], time());
}
function connectScripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('main', get_stylesheet_directory_uri() . '/js/main.js', [], false, true);
}

// Регистрируем места расположения меню
add_action('after_setup_theme', function () {
    register_nav_menus([
        'headerMenu' => 'Меню в шапке',
        'footerMenu' => 'Меню в подвале'
    ]);
});

// Меняем класс у пунктов меню (обертка <li>)
add_filter('nav_menu_css_class', 'changeMenuItemCSS', 10, 4);
function changeMenuItemCSS($classes, $item, $args, $depth)
{
    if ($args->theme_location === 'headerMenu') {
        $classes = ['nav-list__nav-item'];
    }
    if ($args->theme_location === 'footerMenu') {
        $classes = ['b-menu__list__item'];
    }

    return $classes;
}

// Меняем класс у элементов <a> пунктов меню
add_filter('nav_menu_link_attributes', 'changeLinkItemCSS', 10, 4);
function changeLinkItemCSS($atts, $item, $args, $depth)
{
    if ($args->theme_location === 'headerMenu') {
        $atts['class'] = 'nav-list__nav-item__nav-link';
    }
    if ($args->theme_location === 'footerMenu') {
        $atts['class'] = 'b-menu__list__item__link';
    }

    return $atts;
}

// Регистрируем поддержку миниатюры в посте
add_theme_support('post-thumbnails');

// Меняем шаблон пагинации
add_filter('navigation_markup_template', 'navigationTemplate', 10, 2);
function navigationTemplate($template, $class)
{
    return '
	<nav class="navigation %1$s" role="navigation">
		<div class="pagenavi-post-wrap nav-links">%3$s</div>
	</nav>    
	';
}