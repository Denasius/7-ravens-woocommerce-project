<?php
	if ( !defined( 'ABSPATH' ) ) {
		exit;
	}
	global $product;

echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf( '<a href="%s" data-quantity="%s" class="%s product_type_simple_custom_ravens" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		esc_html( $product->add_to_cart_text() )
	),
$product, $args );
?>
<?php echo do_shortcode('[ti_wishlists_addtowishlist loop=yes]'); ?>


