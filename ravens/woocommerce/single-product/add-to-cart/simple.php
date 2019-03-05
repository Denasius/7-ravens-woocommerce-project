<?php
defined( 'ABSPATH' ) || exit;
global $product;
global $post;

if ( ! $product->is_purchasable() ) {
	return;
}
$new_url = explode('/', $_SERVER['REQUEST_URI']);

if ( $product->is_in_stock() ) : ?>
<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<?php $colors_variations = get_field('colors_variation');?>
<?php if ( $colors_variations ) : ?>
	<?php foreach ($colors_variations as $color) : ?>

		<?php if ( $color['acf_fc_layout'] == 'color_block' ) : ?>
			<div class="ravens_variation">
			<?php foreach ( $color['rv_color'] as $item ) :?>
				<a href="<?php if ( $new_url[1] == 'en' ) {
					echo $item['link_en'];
				}else{
					echo $item['link'];
				} ?>">
				<?php if ( $item['color']->post_title == 'mix' ) : ?>
				<div class="ravens_swatch" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/mix.png); background-size: cover; background-repeat: no-repeat; background-position: center; opacity: 0.7;"></div>
				<?php else : ?>
					<div class="ravens_swatch <?php
							if ( $item['color']->post_title == 'white' ) {
								echo 'white-color';
							}
						?>" style="background-color: <?php echo $item['color']->post_title; ?>; opacity: 0.7; <?php if ( $item['color']->post_title == 'white' ) {
							echo 'border: 1px solid rgb(0,0,0);';
						} ?>"></div>
				<?php endif; ?>
					
				</a>
			<?php endforeach; ?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>

<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );

		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>

		<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
		<div class="add-cart">
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button product_type_simple button alt product_type_simple_custom_ravens"><?php pll_e('Добавить в корзину'); ?></button>
			
				<?php echo do_shortcode('[ti_wishlists_addtowishlist]'); ?>
		
		</div>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php endif; ?>