<?php
	if ( !defined( 'ABSPATH' ) ) {
		exit;
	}

global $product;
?>
<?php global $count_class; ?>
<div class="<?php echo $count_class; ?> product">
	<?php do_action('woocommerce_before_shop_loop_item'); ?>

	<?php do_action('woocommerce_before_shop_loop_item_title'); ?>

	<?php do_action('woocommerce_shop_loop_item_title'); ?>

	<?php do_action('woocommerce_after_shop_loop_item_title'); ?>

	<?php do_action('woocommerce_after_shop_loop_item'); ?>
</div>