<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( have_posts() ) {
	wc_get_template('taxonomy-product_cat.php');
	wp_reset_postdata();
}else{
	get_header();
?>
	<h1 style="text-align: center;"><?php
		$url = $_SERVER['REQUEST_URI'];
		$url_explode = explode('/', $url);
		if ( $url_explode[1] != 'en' ) {
			_e('По запросу <span class="nothing_found">"'.get_search_query().'"</span> ничего не найдено', '7-ravens');
		}else{
			_e('Nothing found on request <span class="nothing_found">"'.get_search_query().'"</span>', '7-ravens');
		}
	?></h1>
	<div class="hot">
		<?php dynamic_sidebar('hot_product'); ?>
	</div>
<?php
	get_footer();
}