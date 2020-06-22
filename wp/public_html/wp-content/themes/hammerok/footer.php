</div>
<!-- content-wrapper end -->
</div>
<!-- main-content end -->
<footer class="main-footer">
    <div class="content-footer">
        <?php wp_nav_menu([
            'theme_location' => 'footerMenu',
            'menu' => 'Меню в подвале',
            'container' => 'div',
            'container_class' => 'bottom-menu',
            'menu_class' => 'b-menu__list',
        ]); ?>
        <div class="copyright-wrap">
            <div class="copyright-text">Туристик<a href="#" class="copyright-text__link"> loftschool 2020</a></div>
        </div>
    </div>
</footer>
    </div>
    <!-- wrapper_end-->
    <?php wp_footer(); ?>
  </body>
</html>
