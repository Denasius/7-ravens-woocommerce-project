 <?php
  if ( !defined( 'ABSPATH' ) ) {
    exit;
  }
 ?>

 <?php get_header(); ?>

	<div class="breadcrumbs-nav">
	
    <?php woocommerce_breadcrumb(); ?>

  </div>

  <?php if ( is_cart() || is_checkout() ) : ?>

    <div class="site-main main-container">
      <div class="container">

  <?php elseif ( is_wishlist() ) : ?>
     <?php echo do_shortcode('[ti_wishlistsview]'); ?>
      <?php get_template_part('content', 'subscribe'); ?>
      <?php get_template_part('content', 'info'); ?>
  <?php endif; ?>

  <?php while ( have_posts() ) : the_post(); ?>
    <?php if ( is_cart() || is_checkout() || is_checkout_pay_page() ) : ?>
      <ul class="list-order">
        <?php
          global $woocommerce;
          $curr_set_lan=get_locale();
          $woo_cart_page_id = get_option( 'woocommerce_cart_page_id' );
          $woo_checkout_page_id = get_option( 'woocommerce_checkout_page_id' );
        ?>
        <li class="item-checkout <?php echo is_cart() ? 'active' : ''; ?>"><a href="<?php the_permalink(pll_get_post($woo_cart_page_id, $curr_set_lan)); ?>"><span class="icon_bag icon"></span><?php pll_e('Корзина'); ?></a></li>
        <li id="disabled_if_user_non_logged" class="item-checkout <?php echo is_checkout() && !is_order_received_page() ? 'active' : '' ?>"><a href="<?php the_permalink(pll_get_post($woo_checkout_page_id, $curr_set_lan)); ?>"><span class="icon_ribbon icon"></span><?php pll_e('Оформление заказа'); ?></a></li>
        <li id="disabled_if_user_non_logged_order_end" class="item-checkout <?php echo is_order_received_page() ? 'active' : '' ?>"><a href="<?php the_permalink(pll_get_post($woo_checkout_page_id, $curr_set_lan)); ?>"><span class="icon_check_alt icon"></span><?php pll_e('Заказ завершен'); ?></a></li>
      </ul>
      <?php get_template_part( 'template-parts/content', 'page' ); ?>
    <?php elseif ( is_account_page() ) : ?>
      <?php get_template_part( 'template-parts/content', 'page' ); ?>
    <?php endif; ?>
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
  </div>
    </div>
 <?php get_footer(); ?>