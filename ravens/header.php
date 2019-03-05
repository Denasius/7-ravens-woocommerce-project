<?php
//global $current_user;
//get_currentuserinfo();
//if( !is_user_logged_in() && $current_user->user_login != 'ADMIN_NAME'){
//  get_template_part('coming_soon'); 
//  exit;
//}
?>
<!DOCTYPE html>
<html class="no-js page" lang="ru">

<head>
  <meta charset="utf-8">
  <?php
    $term = false;
    if (is_category()) $term = get_queried_object();
    ?>
    <meta name="description" content='<?php the_field('seo_description', $term) ?>'/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">

    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content='<?php the_field('seo_title', $term) ?>' />

    <?php
    $Path=$_SERVER['REQUEST_URI'];
    $URI=$_SERVER['SERVER_NAME'].$Path; 
    ?>
    <meta property="og:url" content='<?php echo $URI?>' />
    <meta property="og:site_name" content="webernetic" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content='<?php the_field('seo_description', $term) ?>' />
    <meta name="twitter:title" content='<?php the_field('seo_title', $term) ?>' />

  <?php wp_head(); ?>

  <script>
    document.documentElement.className = document.documentElement.className.replace('no-js', 'js');
    var ua = window.navigator.userAgent.toLowerCase(),
      isIE = (/trident/gi).test(ua) || (/msie/gi).test(ua);
    if (isIE) document.documentElement.classList.add('ie');

  </script>
  <?php if (is_shop()) : ?>
    <style>
      .available{
        display: none;
      }
      /* start prelaoder styles */
      .preload{
        width: 100%;
        height: 100%;
        position: absolute;
        background: rgb(255,255,255);
        z-index: 198;
      }
      .demo {
        width: 100px;
        height: 102px;
        border-radius: 100%;
        position: absolute;
        top: 45%;
        left: calc(50% - 50px);
        z-index: 200;
        position: fixed; }
      .circle {
        width: 100%;
        height: 100%;
        position: absolute; }
      .circle .inner {
          width: 100%;
          height: 100%;
          border-radius: 100%;
          border: 5px solid rgba(255,0,0, 0.7);
          border-right: none;
          border-top: none;
          backgroudn-clip: padding;
          -webkit-box-shadow: inset 0px 0px 10px rgba(255,0,0, 0.15);
                  box-shadow: inset 0px 0px 10px rgba(255,0,0, 0.15); }
      @-webkit-keyframes spin {
        from {
          -webkit-transform: rotate(0deg);
                  transform: rotate(0deg); }
        to {
          -webkit-transform: rotate(360deg);
                  transform: rotate(360deg); } }
      @keyframes spin {
        from {
          -webkit-transform: rotate(0deg);
                  transform: rotate(0deg); }
        to {
          -webkit-transform: rotate(360deg);
                  transform: rotate(360deg); } }
      .circle:nth-of-type(0) {
        -webkit-transform: rotate(0deg);
                transform: rotate(0deg); }
      .circle:nth-of-type(0) .inner {
          -webkit-animation: spin 2s infinite linear;
                  animation: spin 2s infinite linear; }
      .circle:nth-of-type(1) {
        -webkit-transform: rotate(70deg);
                transform: rotate(70deg); }
      .circle:nth-of-type(1) .inner {
          -webkit-animation: spin 2s infinite linear;
                  animation: spin 2s infinite linear; }
      .circle:nth-of-type(2) {
        -webkit-transform: rotate(140deg);
                transform: rotate(140deg); }
      .circle:nth-of-type(2) .inner {
          -webkit-animation: spin 2s infinite linear;
                  animation: spin 2s infinite linear; }
      .demo {
        -webkit-animation: spin 5s infinite linear;
                animation: spin 5s infinite linear; }
      /* end prelaoder styles */
    </style>
  <?php endif; ?>
  <?php if ( is_product() ) : ?>
    <style type="text/css">
      .woocommerce-notices-wrapper{
          width: 50%;
          margin: 0 auto;
          margin-top: 20px;
          padding: 10px;
          z-index: 20;}
      .woocommerce-notices-wrapper a{
        font-size: 14px;
        padding-right: 10px;
        color: #000;}
      .woocommerce-notices-wrapper .woocommerce-message{
        font-size: 14px;}
      .woocommerce-notices-wrapper a:hover{
        color: #000;}
      .woo-variation-product-gallery {
          max-width: 100% !important;
      }
      .woo-variation-gallery-wrapper .woo-variation-gallery-thumbnail-slider{
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: -o-flex;
        display: flex;
        -webkit-flex-direction: column;
        -moz-flex-direction: column;
        -ms-flex-direction: column;
        -o-flex-direction: column;
        flex-direction: column;
        height: 100%;
      }
      .wvg-gallery-image{
        margin-left: 110px;
      }
      .woo-variation-gallery-wrapper .wvg-gallery-thumbnail-image{
        opacity: 1 !important;
      }
      .pswp__bg{
        background: rgba(0,0,0,0.8);
      }
    </style>
  <?php endif; ?>
  <?php if ( is_cart() ) : ?>
    <style type="text/css">
      .woocommerce-message{
        margin-top: 20px;}
     .cart-empty{
      text-align: center;
      font-weight: bold;
      text-transform: uppercase;
      font-size: 36px;}
    .return-to-shop{
        text-align: center;}
      .return-to-shop a{
        color: rgb(255,255,255);
        font-size: 14px;
        background: rgb(0,0,0);
        -webkit-transition: all .3s ease;
        transition: all .3s ease;
        padding: 10px 30px;}
      .return-to-shop a:hover{
        background: #000;
        font-weight: normal;
        color: rgb(255,255,255) !important;}
    </style>
  <?php endif; ?>
  <?php if ( is_checkout() ) : ?>
    <style>
      .site-main thead th{
        font-size: 14px;
        padding: 6px 0;}
      .site-main thead th.product-name{
        font-weight: normal;
        width: 245px;
        text-align: left;}
      .site-main thead th.product-total{
        font-weight: normal;
        text-align: right;}
      .site-main tbody tr td{
        text-align: right;}
      .site-main table{
        font-size: 14px;}
      .site-main tbody tr td.product-name{
        padding: 15px 0; }
      .woocommerce-checkout-review-order-table tfoot .cart-subtotal th{
        text-align: left;}
      .woocommerce-checkout-review-order-table tfoot .woocommerce-shipping-totals{
        text-align: left;}
      .woocommerce-checkout-review-order-table tfoot .cart-subtotal td{
        text-align: right;}
      .site-main ul li{
        width: 100%;
        border-bottom-color: transparent;}
      #shipping_method{
        min-width: 200px;}
      #shipping_method li{
        text-align: right;}
      .order-total th{
        text-align: left;}
      .order-total td{
        text-align: right;}
      .payment_method_ppec_paypal p{
        text-align: left;
        font-size: 14px;}
      .woocommerce-privacy-policy-text p{
        font-size: 14px;}
      .woocommerce-privacy-policy-text p a{
        color: #000;}
    </style>
  <?php endif; ?>
  <?php if ( is_wishlist() ) : ?>
    <style type="text/css">
      .tinv-wishlist .product-remove button:hover{
        color: #000;
        border: 1px solid #000;}
      .tinv-header h2{
        text-align: center;
        font-weight: normal;}
      .tinv-wishlist .product-thumbnail img{
        width: 170px;}
      .tinv-wishlist .wishlist_item .product-name a{
        font-size: 14px;
        color: #111111;
        -webkit-transition: all .3s ease;
        transition: all .3s ease;}
      .tinv-wishlist .wishlist_item .product-name a:hover{
        color: #000;}
      .button.alt{
        border: none;
        background-color: rgb(0,0,0);
        font-size: 14px;
        -webkit-transition: all .3s ease;
        transition: all .3s ease;
        color: rgb(255,255,255);
        cursor: pointer;
        width: 100%;
        padding-top: 10px;
        padding-bottom: 10px;}
      .button.alt:hover{
        background: #000;}
      .tinv-wishlist tfoot .tinvwl-to-right button{
        width: 35%;
        margin: 0 auto;}
      .tinvwl-to-right button.button.alt{
        margin-left: 20px;}
      .tinvwl-break-checkbox{
        background: rgb(0,0,0);
        font-size: 14px;
        color: rgb(255,255,255);
        -webkit-transition: all .3s ease;
        transition: all .3s ease;
        border: none;
        padding: 10px;
        cursor: pointer;}
      .tinvwl-break-checkbox:hover{
        background-color: #000;}
        .tinv-wishlist .social-buttons{
          position: relative;
        }
      .tinv-wishlist .social-buttons li{
        margin: 0;}
      .tinv-wishlist .social-buttons li a{
        font-size: 16px;
        color: #c2c2c2;
        -webkit-transition: all .3s ease;
        transition: all .3s ease;}
      .tinv-wishlist .social-buttons li a:hover{
        color: #000;}
      .tinvwl-input-group .form-control, .tinvwl-input-group-addon, .tinvwl-input-group-btn{
        padding-left: 10px;}
      .cart-empty{
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 36px;}
      .return-to-shop{
        text-align: center;}
      .return-to-shop a{
        color: rgb(255,255,255);
        font-size: 14px;
        background: rgb(0,0,0);
        -webkit-transition: all .3s ease;
        transition: all .3s ease;
        padding: 10px 30px;}
      .return-to-shop a:hover{
        background: #000;
        color: rgb(255,255,255);}
      .page-header .backtotop.show{
        z-index: 200;
      }
      @media only screen and (max-width: 767px) {
        .page-template-default .tinv-wishlist form table .wishlist_item .product-remove{
          display: block;
        }
        .tinv-wishlist table.tinvwl-table-manage-list tbody td.product-remove, .tinv-wishlist table.tinvwl-table-manage-list thead th:not(.product-name) {
          display: none;}
        .tinv-wishlist table.tinvwl-table-manage-lists thead th:not(.wishlist-name) {
          display: none;}
        .tinv-wishlist thead th .tinvwl-full {
          display: none;}
        .tinv-wishlist table.tinvwl-table-manage-list thead th.product-name, .tinv-wishlist table.tinvwl-table-manage-lists thead th.wishlist-name {
          display: block;
          width: 100%;
          text-align: center;}
        .tinv-wishlist table thead th .tinvwl-mobile {
          display: block;}
        .tinv-wishlist table.tinvwl-table-manage-list tbody td {
          display: block;
          width: 100% !important;
          text-align: center;}
        .tinv-wishlist table.tinvwl-table-manage-lists tbody td, .tinv-wishlist table.tinvwl-table-manage-lists.tinvwl-public tbody td {
          display: block;
          width: 100% !important;
          text-align: center;}
        .tinv-wishlist table.tinvwl-table-manage-list tbody td:not(:last-child) {
          margin: 0 auto;
          border-bottom: 0;}
        .tinv-wishlist table.tinvwl-table-manage-lists tbody td:not(:last-child), .tinv-wishlist table.tinvwl-table-manage-lists.tinvwl-public tbody td:not(:last-child) {
          border-bottom: 0;}
        .tinv-wishlist .product-stock p {
          margin: 0 auto;}
        .tinv-wishlist .product-thumbnail img {
          margin: 0 auto;
          max-width: 80px;}
        .tinv-wishlist.woocommerce table .quantity .qty {
          text-align: center;
          width: 100%;}
        .tinv-wishlist .product-action .tinvwl_move_product_button {
          margin-top: 10px;}
        .tinv-wishlist table.tinvwl-table-manage-list tfoot td {
          display: block;
          width: 100%;}
        .tinv-wishlist table.tinvwl-table-manage-lists .wishlist-action button[value=manage_remove] {
          width: 100%;}
        .tinv-wishlist table.tinvwl-table-manage-lists .wishlist-name .tinvwl-rename-button {
          float: none;}
      }
    </style>
  <?php endif; ?>
  <?php if (is_user_logged_in()) : ?>
    <style type="text/css">
      
    </style>
  <?php endif; ?>
  <?php if (in_category('info_blog')) : ?>
    <style type="text/css">
      .breadcrumbs-nav{
        margin-top: 0;
      }
    </style>
  <?php endif; ?>

  <!-- <link rel="preload" href="fonts/*.woff2" as="font" type="font/woff2" crossorigin> -->
</head>
<body id="id-page" <?php body_class(); ?>>
  <div class="cansel_order_modal_overlay"
  <?php if ( isset($_COOKIE['ravens_id_order']) && is_wc_endpoint_url('orders') ) echo 'style="display: block; z-index: 3"'; ?>
  ></div>
    <form action="<?php echo admin_url('admin-ajax.php?action=cansel_order_form') ?>" id="cansel_order_modal_form_send">
    <div class="cansel_order_modal"
    <?php if ( isset($_COOKIE['ravens_id_order']) && is_wc_endpoint_url('orders') ) echo 'style="display: block; z-index: 4"'; ?>
    >
      <?php if ( isset( $_COOKIE['ravens_id_order'] ) ) : ?>
        <div class="warning_after_reload_browser">
          <span><?php pll_e('Ранее вы нажали на кнопку вернуть товар. Подтвердите Ваши действия, или нажмите отмену'); ?></span>
        </div>
      <?php endif; ?>
    <p class="cansel_order_title">Заявка на возврат товара<br />заказ №<span class="cansel_order_number">
      <?php if ( isset($_COOKIE['ravens_id_order']) ) echo $_COOKIE['ravens_id_order']; ?></span></p>
      <div class="textarea"><textarea id="cansel_order_field_text" placeholder="Напишите какой товар Вы хотите вернуть" required></textarea></div>
      <input type="submit" value="<?php pll_e('Вернуть товар'); ?>" disabled="disabled">
      <input type="reset" value="<?php pll_e('Отмена'); ?>" id="reset_form_cansel_order">
      <input type="reset" value="<?php pll_e('Закрыть'); ?>" id="close_cansel_order">
      <?php wp_nonce_field('ravens_security', 'ravens_form_cansel_order'); ?>
    </div>
  </form>
  <?php if ( is_shop() ) : ?>
    <!-- start preloader -->
    <!-- <div class="preload"></div>
    <div class="demo">
      <div class="circle">
        <div class="inner"></div>
      </div>
      <div class="circle">
        <div class="inner"></div>
      </div>
      <div class="circle">
        <div class="inner"></div>
      </div>
      <div class="circle">
        <div class="inner"></div>
      </div>
      <div class="circle">
        <div class="inner"></div>
      </div>
    </div> -->
    <script>
      jQuery(document).ready(function ($) {
        $(window).on('load', function () {
          $('.demo').delay(350).fadeOut('slow');
          $('.preload').delay(350).fadeOut('slow');
        });
      });
    </script>
    <!-- end preloader -->
  <?php endif; ?>

  <header class="page-header" role="banner">
    <div class="overlay_for_reg"></div>
      <a href="javascript:void(0);" class="backtotop"><span class="ti-angle-up"></span></a>
      <div class="overlay"></div>
      <?php get_mobile_navigation(); ?>
    <div class="page-header__container">
      <div class="container">
      	<div class="row">
      		<div class="col-12 center">
      			<div class="logo">
      				<?php the_custom_logo(); ?>
      			</div>
      		</div>
      	</div>
      </div>
      <div class="container-fluid">    	
      	<div class="navigation">
      		<div class="row">
      			<div class="col-12 col-sm-6 col-md-4 col-lg-3 order-3 order-sm-2 order-md-1">
      				<div class="current-lang-dropdown">
      					<ul class="dropdown dropdown-toggle-lang">
                  
      						<?php //dynamic_sidebar('wc_polylang_widget'); ?>
                  <?php 
                    $languages = pll_the_languages( array(
                      'display_names_as'       => 'slug',
                      'hide_if_no_translation' => 1,
                      'raw'                    => true
                    ) );
                    if ($languages['ru']['current_lang']) {
                        echo '<li><span>' . $languages['ru']['slug'] . ' <span class="toggle"><i class="fa fa-angle-down" aria-hidden="true"></i></span></span>';
                        echo '<ul><li><a href="'.$languages['en']['url'].'">'.$languages['en']['slug'].'</a></li></ul></li>';
                    }else {
                        echo '<li><span>' . $languages['en']['slug'] . ' <span class="toggle"><i class="fa fa-angle-down" aria-hidden="true"></i></span></span>';
                        echo '<ul><li><a href="'.$languages['ru']['url'].'">'.$languages['ru']['slug'].'</a></li></ul></li>';
                    }                    
                   ?>
                  
      					</ul>
                <ul class="dropdown dropdown-toggle-current">
                  <?php dynamic_sidebar('wc_currency_widget'); ?>
                </ul>
      				</div>
      			</div>
      			<div class="d-none d-lg-block col-6 order-md-2">
      				<?php get_navigation(); ?>
      			</div>
                  <div class="d-lg-none col-12 col-md-4 order-1 order-md-2">
                      <div class="mobile-block block-menu-bar">
                          <a href="javascript:void(0)" class="menu-bar menu-toggle"><span class="text"><?php pll_e('Основное меню') ?></span></a>
                      </div>
                  </div>
      			<div class="col-12 col-sm-6 col-md-4 col-lg-3 order-2 order-sm-3">
      				<div class="admin">
                <div class="search-icon">
                    <span class="icon_search icon"></span>
                </div>
                <?php get_search_form(); ?>
      					<div class="account">
                  <?php if ( is_user_logged_in() ) : ?>
                    <ul>
                      <li><a href="<?php echo wc_customer_edit_account_url(); ?>"><i class="fa fa-user-o" aria-hidden="true"></i><span class="toggle"><!--<i class="fa fa-angle-down" aria-hidden="true"></i> --></span></a>
                        <ul>
                          <li><?php
                            $home_page_url = home_url();
                            ?>
                              <a href="<?php echo wp_logout_url($home_page_url); ?>"><?php pll_e('Выход'); ?></a>
                            <?php
                          ?></li>
                        </ul>
                      </li>
                    </ul>
                  <?php else: ?>
                    <?php if (is_account_page() && !is_user_logged_in()) : ?>
                      123
                    <?php else : ?>
                      <ul>
                      <li><a href="#" id="my_account"><i class="fa fa-user-o" aria-hidden="true"></i></a></li>
                    </ul>
                    <?php endif; ?>
                    
                  <?php endif; ?>
      						
      					</div>

      					<div class="wishlist">
                  <?php echo do_shortcode('[ti_wishlist_products_counter]'); ?>  						
      					</div>
      					<div class="cart s-header__basket-wr woocommerce">
                  <?php global $woocommerce;
                        $curr_set_lan=get_locale();
                        $woo_cart_page_id = get_option( 'woocommerce_cart_page_id' );
                        
                  ?>
      						<a href="<?php the_permalink(pll_get_post($woo_cart_page_id, $curr_set_lan)); ?>"><i class="icon_bag_alt icon"></i>
  								<span class="count"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></span>
      						</a>    						
      					</div>
      				</div>
      			</div>
      		</div>
      	</div>
      </div>
    </div>
    <div class="popup-reg">
      <?php wc_get_template_part( 'myaccount/form', 'login' ) ?>
    </div>
  </header>