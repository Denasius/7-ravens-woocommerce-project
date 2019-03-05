<?php

$url_explode = explode('/', $_SERVER['REQUEST_URI']);
// actions are here
add_action( 'after_setup_theme', 'woocommerce_support' );
add_action('wp_enqueue_scripts', 'ravens_scripts');
add_action( 'wp_enqueue_scripts', 'true_loadmore_scripts' );
add_action('init', 'ravens_slider');
add_action('widgets_init', 'ravens_widgets');
add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');
add_action('get_header', 'product_page_one');
add_action('admin_menu', 'ravens_option_theme');
// переопределяю кастомный скрипт woocommerce для добавления товара в корзину
add_action('wp_enqueue_scripts', 'load_add_to_cart_script' , 9);
add_action( 'woocommerce_customer_save_address', 'action_woocommerce_customer_save_address', 99, 2 );
add_action('admin_init', 'ravens_admin_settings');
add_action('wp_ajax_set_cookies_for_wrapper_gift', 'set_cookies_for_wrapper_gift');
add_action('wp_ajax_nopriv_set_cookies_for_wrapper_gift', 'set_cookies_for_wrapper_gift');

add_action('wp_ajax_set_cookies_for_standart_wrapper', 'set_cookies_for_standart_wrapper');
add_action('wp_ajax_nopriv_set_cookies_for_standart_wrapper', 'set_cookies_for_standart_wrapper');

add_action('wp_ajax_set_cookies_for_cansel_order', 'set_cookies_for_cansel_order');
add_action('wp_ajax_nopriv_remove_cookies_for_cansel_order', 'remove_cookies_for_cansel_order');
add_action('wp_ajax_remove_cookies_for_cansel_order', 'remove_cookies_for_cansel_order');


// filters are here
add_filter('woocommerce_enqueue_styles', '__return_empty_array'); //deregister woocommerce custome styles
add_filter('excerpt_length', function () {
	return 20;
});
add_filter('excerpt_more', function () {
	return '...';
});
add_filter('widget_nav_menu_args', 'change_menu_footer', '', 4);
add_filter('dynamic_sidebar_params', 'check_sidebar_params');
// фильтер для отображения количества товаров в корзине без перезагрузки
add_filter('woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment');

// указываю сколько товаров выводить на странцие
add_filter('loop_shop_per_page', 'new_perpage');

// WooCommerce Checkout Fields Hook
add_filter( 'woocommerce_checkout_fields' , 'custom_wc_checkout_fields' );

// убираем завершающие нули в ценах.
add_filter( 'woocommerce_price_trim_zeros', 'wc_hide_trailing_zeros', 10, 1 );

// Вывожу изображения на странице order-view
add_filter( 'woocommerce_order_item_name', 'display_product_image_in_order_item', 20, 3 );

add_filter( 'body_class', 'ravens_wc_product_cats_css_body_class' );

add_action( 'wp_footer', 'bbloomer_cart_refresh_update_qty' );

add_filter("woocommerce_checkout_fields", "ravens_shipping_order_fields");
add_filter("woocommerce_checkout_fields", "ravens_billing_order_fields");

add_filter( 'woocommerce_gateway_icon', 'ravens_icons_for_bank_card', 10, 2 );


// выводим логотип через админку
add_theme_support('custom-logo');
add_theme_support( 'title-tag' );

// Удаляю название Единая ставка в оформлении заказа
add_filter( 'woocommerce_cart_shipping_method_full_label', 'bbloomer_remove_shipping_label', 10, 2 );
function bbloomer_remove_shipping_label($label, $method) {
	$new_label = preg_replace( '/^.+:/', '', $label );
	return $new_label;
}

// ф-ция для вывода страницы с навигацией
function get_navigation()
{
	$templates = array();
	$templates[] = 'navigation.php';

	locate_template( $templates, true );
}

function get_mobile_navigation()
{
	$arr = array();
	$arr[] = 'mobile-navigation.php';

	locate_template($arr, true);
}

function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

function ravens_scripts()
{
	wp_enqueue_style( 'main', get_stylesheet_uri() );
	wp_enqueue_style( 'custom', get_template_directory_uri() . '/assets/css/style.min.css' );

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', null, null, false);
	wp_enqueue_script('customjs', get_template_directory_uri() . '/assets/js/script.min.js', array('jquery'),null, true);

	if ( is_product() ) {
		wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css' );
		wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'),null, true);
	}
}

// ф-ция для подключения скрипта загрузки товаров AJAX'ом
function true_loadmore_scripts()
{
	wp_enqueue_script( 'true_loadmore', get_stylesheet_directory_uri() . '/assets/js/loadmore.js', array('jquery'), null, true );
}


function ravens_slider()
{
	register_post_type('slider', array(
		'public' => true,
		'supports' => array(
			'title',
			'editor',
			'thumbnail'
		),
		'menu_position' => 3,
		'menu_icon' => admin_url() . 'images/media-button-2x.png',
		'labels' => array(
			'name' => 'Слайдер',
			'all_items' => 'Слайды',
			'add_new' => 'Добавить новый слайд',
			'add_new_item' => 'Новый слайд'
		)
	));

	$option_cookie = get_option('ravens_theme_options');
	if (isset($_COOKIE['wmc_current_currency']) && $_COOKIE['wmc_current_currency'] == 'EUR') {
		setcookie('ravens_current_price', $option_cookie['ravens_theme_options_price_eur'], time() + 3600*24*7, '/');
	}else{
		setcookie('ravens_current_price', $option_cookie['ravens_theme_options_price_rub'], time() + 3600*24*7, '/');
	}
}

register_nav_menus(array(
	'top_menu' => 'Верхнее меню',
	'bottom_menu' => 'Меню футера',
	'bottom_menu_company' => 'Меню футера о компании',
	'mobile_menu' => 'Мобильное меню',
	'sidebar_menu' => 'Меню в сайдбаре'
));

// в файле находится виджет для отображения горячих товаров
include "fcollection/widget.php";

function ravens_widgets()
{
	// виджет для социальных сетей
	register_sidebar(array(
		'name' => 'Социальные сети',
		'id' => 'socials',
		'description' => 'Блок для социальных сетей'
	));

	register_sidebar(array(
		'name' => 'Поделиться в соц.сетях',
		'id' => 'wc_shering_widget',
		'description' => 'Виджет для шеринга'
	));

	// виджет для вывода горящих товаров
	register_sidebar(array(
		'name' => 'Горячие товары',
		'id' => 'hot_product',
		'description' => 'Блок для горящих товаров',
		'before_widget' => '',
		'after_widget' => ''
	));

	register_sidebar(array(
		'name' => 'Дизайнеры',
		'id' => 'filer_designers',
		'description' => 'Фильтрация по дизайнерам'
	));

	register_sidebar(array(
		'name' => 'Цвет',
		'id' => 'filter_by_colors',
		'description' => 'Фильтрация по цветам'
	));

	register_sidebar(array(
		'name' => 'Вам также может понравиться',
		'id' => 'recomended',
		'description' => 'Рекомендуемые товары на странице продукта',
		'before_widget' => '',
		'after_widget' => ''
	));

	// виджет для вывода двух меню в футере
	register_sidebar(array(
		'name' => 'Меню в футере сайта',
		'id' => 'menu_bottom_footer',
		'description' => 'Добавте меню в виджет',
		'before_widget' => '<div class="col-5 col-md-3"><div class="for-clients">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => 'Меню в футере сайта - о компании',
		'id' => 'menu_bottom_footer_about_company',
		'description' => 'Добавте меню в виджет о компании',
		'before_widget' => '<div class="col-5 col-md-3"><div class="about-company">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => 'Боковое меню для страницы категорий',
		'id' => 'menu_sidebar',
		'description' => 'Меню для страницы категорий',
		'before_widget' => '<div class="sidebar-menu">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => 'Форма подписки',
		'id' => 'mailpoet_newsletter_form',
		'descroption' => 'Виджет для размещения формы подписки',
		'before_widget' => '<div class="newsletter-form-wrap">',
		'after_widget' => '</div>'
	));

	register_sidebar(array(
		'name' => 'Мультивалютность',
		'id' => 'wc_currency_widget',
		'description' => 'Виджет для переключения валюты'
	));

	register_sidebar(array(
		'name' => 'Мультиязачность',
		'id' => 'wc_polylang_widget',
		'description' => 'Виджет для переключения языков'
	));
}

function woocommerce_template_loop_product_thumbnail()
{
	echo '<div class="the_latest">';
	echo woocommerce_get_product_thumbnail();
	echo '</div>';
}

function woocommerce_template_loop_product_title()
{
	global $product;
	echo '<div class="product-info"><h3 class="product-name product_title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3><h3 class="by_designer">by ';
	$subheadingvalues = get_the_terms( $product->id, 'pa_designer');
	if ($subheadingvalues) {
		foreach ($subheadingvalues as $attr) {
			echo $attr->name;
		}
	}
	echo '</h3></div>';

}

function change_menu_footer($nav_menu_args, $nav_menu, $args, $instance)
{
	if ($args['id'] == 'menu_sidebar') {
		$nav_menu_args['menu_class'] = 'sidebar-main-nav';
		$nav_menu_args['container'] = "";
	}
	$nav_menu_args['container'] = "";
	return $nav_menu_args;
}

// переопределяю кастомный скрипт woocommerce для добавления товара в корзину
function load_add_to_cart_script()
{
	wp_enqueue_script('wc-add-to-cart', get_template_directory_uri() . '/assets/js/add-to-cart.js', WC_VERSION, true);
}

function check_sidebar_params($params)
{
	if ($params[0]['id'] == 'menu_sidebar' && $params[0]['widget_id'] == 'nav_menu-' . $params[1]['number']) {
		$params[0]['before_widget'] = '<div class="sidebar-menu">';
		$params[0]['after_widget'] = '</div>';
	}

	return $params;
}


function woocommerce_breadcrumb( $args = array() ) {
	$args = wp_parse_args( $args, apply_filters( 'woocommerce_breadcrumb_defaults', array(
		'delimiter'   => '',
		'wrap_before' => '<ul class="woocommerce-breadcrumb breadcrumb">',
		'wrap_after'  => '</ul>',
		'before'      => '',
		'after'       => '',
		'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
	) ) );

	$breadcrumbs = new WC_Breadcrumb();

		if ( ! empty( $args['home'] ) ) {
			$breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
		}

		$args['breadcrumb'] = $breadcrumbs->generate();

		do_action( 'woocommerce_breadcrumb', $breadcrumbs, $args );

		wc_get_template( 'global/breadcrumb.php', $args );
}

if ( !is_shop() ) {
	remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
}

function woocommerce_catalog_ordering() {
		if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
			return;
		}
		$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
		$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
			'menu_order' => __( 'Default sorting', 'woocommerce' ),
			'popularity' => __( 'Sort by popularity', 'woocommerce' ),
			'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
			'price-desc' => __( 'Sort by price: high to low', 'woocommerce' ),
		) );

		$default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', '' ) );
		$orderby         = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby; // WPCS: sanitization ok, input var ok, CSRF ok.

		if ( wc_get_loop_prop( 'is_search' ) ) {
			$catalog_orderby_options = array_merge( array( 'relevance' => __( 'Relevance', 'woocommerce' ) ), $catalog_orderby_options );

			unset( $catalog_orderby_options['menu_order'] );
		}

		if ( ! $show_default_orderby ) {
			unset( $catalog_orderby_options['menu_order'] );
		}

		if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
			unset( $catalog_orderby_options['rating'] );
		}

		if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
			$orderby = current( array_keys( $catalog_orderby_options ) );
		}

		wc_get_template( 'loop/orderby.php', array(
			'catalog_orderby_options' => $catalog_orderby_options,
			'orderby'                 => $orderby,
			'show_default_orderby'    => $show_default_orderby,
		) );
	}

function new_perpage($cols)
{
	$cols = 45;
	return $cols;
}

// ф-ция для загрузки товаров с помощью AJAX
function true_load_posts(){

	$args = unserialize( stripslashes( $_POST['query'] ) );
	$args['paged'] = $_POST['page'] + 1; // следующая страница
	$args['post_status'] = 'publish';

	// обычно лучше использовать WP_Query, но не здесь
	query_posts( $args );
	// если посты есть
	if( have_posts() ) :

		// запускаем цикл
		while( have_posts() ): the_post();

			 wc_get_template_part('content','product-cat');

		endwhile;
		wp_reset_postdata();

	endif;
	die();
}

function product_page_one()
{
	if (is_product()) {
		// отвязываю хуки и формирую свои экшены для страницы продукта
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 35 );
	}
}


// Change order comments placeholder and label, and set billing phone number to not required.
function custom_wc_checkout_fields( $fields ) {
	$url_explode = explode('/', $_SERVER['REQUEST_URI']);
	if ($url_explode[1] == 'en') {
		$fields['billing']['billing_first_name']['placeholder'] = 'Your name';
		$fields['billing']['billing_last_name']['placeholder'] = 'Your lastname';
		$fields['billing']['billing_city']['placeholder'] = 'Your town';
		$fields['billing']['billing_state']['placeholder'] = 'Your region';
		$fields['billing']['billing_postcode']['placeholder'] = 'Your postcode';
		$fields['billing']['billing_phone']['placeholder'] = 'Your phone';
		$fields['billing']['billing_email']['placeholder'] = 'Your E-mail';
		$fields['billing']['billing_city']['placeholder'] = 'Your city';
		$fields['billing']['billing_city']['label'] = 'Your city';

		$fields['shipping']['shipping_first_name']['placeholder'] = 'Your name';
		$fields['shipping']['shipping_last_name']['placeholder'] = 'Your lastname';
		$fields['shipping']['shipping_city']['placeholder'] = 'Your town';
		$fields['shipping']['shipping_state']['placeholder'] = 'Your region';
		$fields['shipping']['shipping_postcode']['placeholder'] = 'Your postcode';
		$fields['shipping']['shipping_phone']['placeholder'] = 'Your phone';
		$fields['shipping']['shipping_email']['placeholder'] = 'Your E-mail';

		$fields['order']['order_comments']['label'] = 'Order detail';

	}else{
		$fields['billing']['billing_first_name']['placeholder'] = 'Имя';
		$fields['billing']['billing_last_name']['placeholder'] = 'Фамилия';
		$fields['billing']['billing_city']['placeholder'] = 'Населенный пункт';
		$fields['billing']['billing_state']['placeholder'] = 'Регион';
		$fields['billing']['billing_postcode']['placeholder'] = 'Почтовый индекс';
		$fields['billing']['billing_phone']['placeholder'] = 'Телефон';
		$fields['billing']['billing_email']['placeholder'] = 'Е-mail';
		$fields['billing']['billing_city']['placeholder'] = 'Город';
		$fields['billing']['billing_city']['label'] = 'Город';

		$fields['shipping']['shipping_first_name']['placeholder'] = 'Имя';
		$fields['shipping']['shipping_last_name']['placeholder'] = 'Фамилия';
		$fields['shipping']['shipping_city']['placeholder'] = 'Населенный пункт';
		$fields['shipping']['shipping_state']['placeholder'] = 'Регион';
		$fields['shipping']['shipping_postcode']['placeholder'] = 'Почтовый индекс';
		$fields['shipping']['shipping_phone']['placeholder'] = 'Телефон';
		$fields['shipping']['shipping_email']['placeholder'] = 'Е-mail';
		$fields['shipping']['shipping_city']['placeholder'] = 'Город';
		$fields['shipping']['shipping_city']['label'] = 'Город';

		$fields['order']['order_comments']['label'] = 'Детали заказа';
	}

    unset($fields['billing']['billing_company']);
    unset($fields['shipping']['shipping_company']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['shipping']['shipping_address_2']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['shipping']['shipping_postcode']);
    return $fields;
}
// функция для отображения количества товаров в корзине без перезагрузки
function header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <span class="count"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></span>
    <?php
    $fragments['.count'] = ob_get_clean();
    return $fragments;
}


// две функции для продсчета количества просмотров статьи
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// ф-ции для перевода отдельных строк
pll_register_string('not_found', 'Такой страницы не существует.');
pll_register_string('main_menu', 'Основное меню');
pll_register_string('main_menu_mobile', 'Главное меню');
pll_register_string('designers', 'Дизайнеры');
pll_register_string('gift_wrapper', 'Подарочная упаковка');
pll_register_string('standart_wrapper', 'Стандартная упаковка');
pll_register_string('color', 'Цвет');
pll_register_string('reset', 'Сбросить');
pll_register_string('read_more', 'Читать');
pll_register_string('blog', 'Блог');
pll_register_string('follow_the_link', 'Перейти по ссылке');
pll_register_string('the_latest', 'Последние поступления');
pll_register_string('share', 'Поделиться');
pll_register_string('description', 'Описание');
pll_register_string('specific', 'Детали');
pll_register_string('current_orders', 'Активные заказы');
pll_register_string('order_history', 'История заказов');
pll_register_string('cart', 'Корзина');
pll_register_string('add_to_cart', 'Добавить в корзину');
pll_register_string('order_registration', 'Оформление заказа');
pll_register_string('completed', 'Заказ завершен');
pll_register_string('registration', 'Регистрация');
pll_register_string('logout', 'Выход');
pll_register_string('billing-address', 'Адрес доставки');
pll_register_string('cansel_order', 'вернуть товар');
pll_register_string('next_button', 'Продолжить');
pll_register_string('unsubscribe', 'Вы успешно отписаны от рассылки');
pll_register_string('total_price', 'Сумма');
pll_register_string('personal_details', 'Личные данные');
pll_register_string('reset', 'Отмена');
pll_register_string('close_cansel_order', 'Закрыть');
pll_register_string('warning_after_reload_browser', 'Ранее вы нажали на кнопку вернуть товар. Подтвердите Ваши действия, или нажмите отмену');
pll_register_string('succsess_answer', 'Благодарим Вас за заявку. В ближайшем времени с Вами свяжуться наши менеджеры для уточнения деталей.');
pll_register_string('text_return', 'Товар можно вернуть только в истечении 14 дней');

if ($url_explode[1] == 'en'){
	add_filter( 'gettext', 'bbloomer_translate_woocommerce_strings', 999 );
	function bbloomer_translate_woocommerce_strings( $translated ) {
		$translated = str_ireplace( 'Единая ставка', 'Flat rate', $translated );

		return $translated;
	}
}

function wc_hide_trailing_zeros( $trim ) {return true;}

/*Устанавливаем вкладку "Текст" по умолчанию*/
/*add_filter('wp_default_editor', create_function('', 'return "html";'));*/

/*
** параметры для пользовательских настроек подарочной упаковки
*/
function ravens_admin_settings()
{
	// $option_group, $option_name, $args = array
	register_setting( 'ravens_theme_gift_wrap_options', 'ravens_theme_options', 'ravena_theme_options_sanitize' );

	// $id, $title, $callback, $page
	add_settings_section( 'ravens_theme_options_ID', 'Выберите опции настроек', '', 'ravens-admin-theme-options' );

	// $id, $title, $callback, $page, $section = 'default', $args = array
	add_settings_field( 'ravens_theme_options_text', 'Текст на русском (подарочная упаковка):', 'ravens_theme_options_text_function', 'ravens-admin-theme-options', 'ravens_theme_options_ID', array('label_for' => 'ravens_theme_options_text') );

	add_settings_field( 'ravens_theme_options_text_en', 'Текст на английском (подарочная упаковка):', 'ravens_theme_options_text_en_function', 'ravens-admin-theme-options', 'ravens_theme_options_ID', array('label_for' => 'ravens_theme_options_text_en') );

	add_settings_field( 'ravens_theme_options_text_standart_wrap', 'Текст на русском (стандартная упаковка):', 'ravens_theme_options_text_function_for_standart_wrap', 'ravens-admin-theme-options', 'ravens_theme_options_ID', array('label_for' => 'ravens_theme_options_text_standart_wrap') );

	add_settings_field( 'ravens_theme_options_text_en_standart_wrap', 'Текст на английском (стандартная упаковка):', 'ravens_theme_options_text_en_function_for_standart_wrap', 'ravens-admin-theme-options', 'ravens_theme_options_ID', array('label_for' => 'ravens_theme_options_text_en_standart_wrap') );

	/*add_settings_field( 'ravens_theme_options_price_rub', 'Цена в рублях:', 'ravens_theme_options_price_rub_function', 'ravens-admin-theme-options', 'ravens_theme_options_ID', array('label_for' => 'ravens_theme_options_price_rub') );

	add_settings_field( 'ravens_theme_options_price_eur', 'Цена в евро:', 'ravens_theme_options_price_eur_function', 'ravens-admin-theme-options', 'ravens_theme_options_ID', array('label_for' => 'ravens_theme_options_price_eur') );*/

}

function ravens_theme_options_text_function()
{
	$options = get_option('ravens_theme_options');
	?>
		<input type="text" name="ravens_theme_options[ravens_theme_options_text]" id="ravens_theme_options_text" value="<?php echo esc_attr($options['ravens_theme_options_text']) ?>" class="regular-text">
	<?php
}

function ravens_theme_options_text_en_function()
{
	$options = get_option('ravens_theme_options');
	?>
		<input type="text" name="ravens_theme_options[ravens_theme_options_text_en]" id="ravens_theme_options_text_en" value="<?php echo esc_attr($options['ravens_theme_options_text_en']) ?>" class="regular-text">
	<?php
}

function ravens_theme_options_text_function_for_standart_wrap()
{
	$options = get_option('ravens_theme_options');
	?>
		<input type="text" name="ravens_theme_options[ravens_theme_options_text_standart_wrap]" id="ravens_theme_options_text_standart_wrap" value="<?php echo esc_attr($options['ravens_theme_options_text_standart_wrap']) ?>" class="regular-text">
	<?php
}

function ravens_theme_options_text_en_function_for_standart_wrap()
{
	$options = get_option('ravens_theme_options');
	?>
		<input type="text" name="ravens_theme_options[ravens_theme_options_text_en_standart_wrap]" id="ravens_theme_options_text_en_standart_wrap" value="<?php echo esc_attr($options['ravens_theme_options_text_en_standart_wrap']) ?>" class="regular-text">
	<?php
}

/*function ravens_theme_options_price_rub_function()
{
	$options = get_option('ravens_theme_options');
	?>
		<input type="number" name="ravens_theme_options[ravens_theme_options_price_rub]" id="ravens_theme_options_price_rub" value="<?php echo esc_attr($options['ravens_theme_options_price_rub']) ?>" class="regular-text">
	<?php


}

function ravens_theme_options_price_eur_function()
{
	$options = get_option('ravens_theme_options');
	?>
		<input type="number" name="ravens_theme_options[ravens_theme_options_price_eur]" id="ravens_theme_options_price_eur" value="<?php echo esc_attr($options['ravens_theme_options_price_eur']) ?>" class="regular-text">
	<?php

}*/

function ravena_theme_options_sanitize($options)
{
	$clean_options = array();
	foreach ( $options as $k => $v ) {
		$clean_options[$k] = strip_tags($v);
	}
	return $clean_options;
}

function ravens_option_theme()
{
	add_options_page( 'Опции темы', 'Настройки подарочной упаковки', 'manage_options', 'ravens-admin-theme-options', 'ravens_option_page' );
}

function ravens_option_page()
{
	$options = get_option('ravens_theme_options');
	?>
		<div class="wrap">
			<h2>Настройки параметров подарочной упаковки</h2>
			<form action="<?php echo site_url(); ?>/wp-admin/options.php" method="post">

				<?php settings_fields('ravens_theme_gift_wrap_options'); ?>

				<?php do_settings_sections( 'ravens-admin-theme-options' ) ?>

				<?php submit_button(); ?>
			</form>
		</div>
	<?php
}

/*
** записываю в куки значение input для выбора подарочной упаковки
*/
function set_cookies_for_wrapper_gift()
{

	if ( isset($_POST['checked']) && $_POST['checked'] == 'checked' ) {
		setcookie('ravens_custom_cookies', 'gift', time() + 3600*24*7, '/');
	}else{
		setcookie('ravens_custom_cookies', 'gift', time() - 3600, '/');
	}


	wp_die();
}

function set_cookies_for_standart_wrapper()
{
	if ( isset($_POST['checked']) && $_POST['checked'] == 'checked' ) {
		setcookie('rav_cookie_standart_wrap', 'standart', time() + 3600*24*7, '/');
	}else{
		setcookie('rav_cookie_standart_wrap', 'standart', time() - 3600, '/');
	}


	wp_die();
}

// Записываю в куки ID заказа, если пользователь нажимает на возврат
function set_cookies_for_cansel_order()
{

	if ( isset($_POST['order_id']) ) {
		setcookie('ravens_id_order', (int)$_POST['order_id'], time() + 3600*7, '/');
	}
}

function remove_cookies_for_cansel_order()
{
	if ( isset($_POST['order_id_remove']) ) {
		setcookie('ravens_id_order', (int)$_POST['order_id'], time() - 3600, '/');
	}
}

/* фильтры, которые могут пригодиться при работе с упаковкой(формирование цены)

add_filter( 'woocommerce_get_formatted_order_total', 'filter_function_name_7064', 10);
add_filter('woocommerce_cart_total', 'ravens_filter_total');

*/

// добавляю поле в админке в заказах о желании клиента получить подарочную или стандартную упаковку, если в куках есть соответствующее поле

if ( isset( $_COOKIE['ravens_custom_cookies'] ) ) {
	add_action('woocommerce_admin_order_data_after_order_details', 'ravens_admin_order_data_for_gift_wrapper');
	function ravens_admin_order_data_for_gift_wrapper($order)
	{
		echo '<p style="float:left;clear:both;width:100%;font-size:16px; color:rgb(0,0,0)"><input style="margin-right:10px;" type="checkbox" checked><strong>Подарочная упаковка в комплекте к заказу.</strong></p>';
	}
}else if ( isset( $_COOKIE['rav_cookie_standart_wrap'] ) ) {
	add_action('woocommerce_admin_order_data_after_order_details', 'ravens_admin_order_data_for_standart_wrapper');
	function ravens_admin_order_data_for_standart_wrapper($order)
	{
		echo '<p style="float:left;clear:both;width:100%;font-size:16px; color:rgb(0,0,0)"><input style="margin-right:10px;" type="checkbox" checked><strong>Стандартная упаковка в комплекте к заказу.</strong></p>';
	}
}


function fix_request_query_args_for_woocommerce( $query_args ) {
    if ( isset( $query_args['post_status'] ) && empty( $query_args['post_status'] ) ) {
        unset( $query_args['post_status'] );
    }
    return $query_args;
}
add_filter( 'request', 'fix_request_query_args_for_woocommerce', 1, 1 );


// убираю ненужные страницы из аккаутна, оставляю консоль, заказы, данные и выход
if ( $url_explode[1] !== 'en' ) {
	add_filter( 'woocommerce_account_menu_items', 'filter_function_name_5778', 10, 2 );
	function filter_function_name_5778( $items, $endpoints ){
		$items = array(
			'edit-account'    => __( 'Личные данные', 'woocommerce' ),
			'orders'          => __( 'Заказы', 'woocommerce' ),
			'dashboard'       => __( 'Рассылка новостей', 'woocommerce' ),
			'wishlist' 	  => __( 'Избранное', 'woocommerce' ),
			'customer-logout' => __( 'Выход', 'woocommerce' )

		);

		return $items;
	}
}else{
	add_filter( 'woocommerce_account_menu_items', 'filter_function_name_5778', 10, 2 );
	function filter_function_name_5778( $items, $endpoints ){
		$items = array(
			'edit-account'    => __( 'Personal data', 'woocommerce' ),
			'orders'          => __( 'Orders', 'woocommerce' ),
			'dashboard'       => __( 'Subscriptions', 'woocommerce' ),
			'wishlist-2' 	  => __( 'Wish list', 'woocommerce' ),
			'customer-logout' => __( 'Log out', 'woocommerce' )

		);

		return $items;
	}
}

// выполняю переадресацию на странику аккаунта после соранения настроек адреса
function action_woocommerce_customer_save_address( $user_id, $load_address ) {
   wp_safe_redirect(wc_get_page_permalink('myaccount/edit-account'));
   exit;
};

// проверяем, если категория является дочерней, выводим в body класс subcategory
function ravens_wc_product_cats_css_body_class( $classes ){
if( is_tax( 'product_cat' ) ) {
    $cat = get_queried_object();
    if( 0 < $cat->parent  ) $classes[] = 'subcategory';
}
return $classes;
}

//  обновляю корзину путем нажатию на контролы, кнопку обновить корзину скрываю css стилями
function bbloomer_cart_refresh_update_qty() {
    if (is_cart()) {
        ?>
        <script type="text/javascript">
            jQuery('div.woocommerce').on('click', 'div.control .btn-number', function(){
            	jQuery('button[name="update_cart"]').prop('disabled', false);
                 setTimeout(function() {
	                jQuery('[name="update_cart"]').trigger('click');
	            }, 100 );
            });
        </script>
        <?php
    }

    if ( is_product() ) {
    	?>
			<script type="text/javascript">
	       jQuery(document).ready(function($) {

				  	$('.woocommerce-product-gallery__wrapper').magnificPopup({
				  		delegate: 'a',
						type: 'image',
						gallery:{
						    enabled:true
						  },
						disableOn: function () {
							$('.woocommerce-product-gallery__wrapper .sub_thumb a').on('click', function () {
								return false;
							});
							return true;
						}
				  	});
				});
	        </script>
    	<?php
    }
}

// меняю местами порядок вывода поле на странице оформления заказа
function ravens_billing_order_fields($fields) {

    $order = array(
        "billing_first_name",
        "billing_last_name",
        "billing_country",
        "billing_city",
        "billing_state",
        "billing_phone",
        "billing_email"
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }

    $fields["billing"] = $ordered_fields;
    return $fields;
}

function ravens_shipping_order_fields($fields) {

    $order = array(
        "shipping_first_name",
        "shipping_last_name",
        "shipping_country",
        "shipping_city",
        "shipping_state",
        "shipping_phone",
        "shipping_email"
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["shipping"][$field];
    }

    $fields["shipping"] = $ordered_fields;
    return $fields;
}

// добавляю иконки электронных платежей для страницы checkout
function ravens_icons_for_bank_card( $icon_html, $id ){
	$icon_html  .= '<img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/visa.png' . '" alt="Visa" />';
	$icon_html  .= '<img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/mastercard.png' . '" alt="mastercard" />';
	$icon_html  .= '<img src="' . trailingslashit( get_template_directory_uri() ) . 'assets/img/mir.png' . '" alt="mir" />';

	return $icon_html;
}

// Вывожу изображения товаров на страницу order-view
function display_product_image_in_order_item( $item_name, $item, $is_visible ) {
    // Targeting view order pages only
    if( is_wc_endpoint_url( 'view-order' ) ) {
        $product   = $item->get_product(); // Get the WC_Product object (from order item)
        $thumbnail = $product->get_image(array( 100, 100)); // Get the product thumbnail (from product object)
        if( $product->get_image_id() > 0 )
            $item_name = '<div class="item-thumbnail">' . $thumbnail . '</div>' . $item_name;
    }
    return $item_name;
}

require get_template_directory() . '/inc/return-product.php';
require get_template_directory() . '/inc/states_for_rissia.php';
require get_template_directory() . '/inc/mails_customs.php';
require get_template_directory() . '/inc/orders_status_changed.php';