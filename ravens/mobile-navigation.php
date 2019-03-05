
<div class="mobile-menu">
    <div class="menu-panels-wrap">
        <h3><?php pll_e('Главное меню'); ?></h3>
        <a href="#" class="close">x</a>
    </div>
    <div class="menu-panels">
        <?php wp_nav_menu( array(
            'theme_location'  => 'top_menu',
            'container' => '',
            'container_class' => 'main-menu',
            'menu_class' => 'main-nav'
        )); ?>
    </div>
</div>