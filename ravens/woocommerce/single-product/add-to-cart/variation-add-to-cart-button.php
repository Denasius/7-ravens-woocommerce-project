<?php

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );

	do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>

	<div class="add-cart">
		<button type="submit" class="single_add_to_cart_button button alt variation_button_add_to_cart"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
		<?php echo do_shortcode('[ti_wishlists_addtowishlist]'); ?>
	</div>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
