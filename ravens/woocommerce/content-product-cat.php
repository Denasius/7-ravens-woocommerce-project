<?php
	if ( !defined( 'ABSPATH' ) ) {
		exit;
	}

global $product;

if ( empty($product) || !$product->is_visible()) {
	return;
}
?>

<div class="col-12 col-sm-6 col-md-4 sec product">
	<?php do_action('woocommerce_before_shop_loop_item'); ?>

	<?php do_action('woocommerce_before_shop_loop_item_title'); ?>

	<?php do_action('woocommerce_shop_loop_item_title'); ?>

	<?php do_action('woocommerce_after_shop_loop_item_title'); ?>

	<?php do_action('woocommerce_after_shop_loop_item'); ?>
</div>