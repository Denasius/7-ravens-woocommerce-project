<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_script( 'tinvwl' );
?>
<div class="container">
	<div class="tinv-wishlist woocommerce tinv-wishlist-clear">
	<?php do_action( 'tinvwl_before_wishlist', $wishlist ); ?>
	<?php if ( function_exists( 'wc_print_notices' ) ) {
		wc_print_notices();
	} ?>
	<form action="<?php echo esc_url( tinv_url_wishlist() ); ?>" method="post" autocomplete="off">
		<?php do_action( 'tinvwl_before_wishlist_table', $wishlist ); ?>
		<div class="container">
			<div class="row ravens_wishlist_page">
				<?php do_action( 'tinvwl_wishlist_contents_before' ); ?>
				<?php
					foreach ( $products as $wl_product ) {
						$product = apply_filters( 'tinvwl_wishlist_item', $wl_product['data'] );
						unset( $wl_product['data'] );
						if ( $wl_product['quantity'] > 0 && apply_filters( 'tinvwl_wishlist_item_visible', true, $wl_product, $product ) ) {
							$product_url = apply_filters( 'tinvwl_wishlist_item_url', $product->get_permalink(), $wl_product, $product );
							do_action( 'tinvwl_wishlist_row_before', $wl_product, $product );
							?>
							<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 product <?php echo esc_attr( apply_filters( 'tinvwl_wishlist_item_class', 'wishlist_item', $wl_product, $product ) ); ?>">
				  				<div class="the_latest">
				  					<?php
									$thumbnail = apply_filters( 'tinvwl_wishlist_item_thumbnail', $product->get_image(), $wl_product, $product );

									if ( ! $product->is_visible() ) {
										echo $thumbnail; // WPCS: xss ok.
									} else {
										printf( '<a href="%s">%s</a>', esc_url( $product_url ), $thumbnail ); // WPCS: xss ok.
									}
									?>
				  				</div>
				  				<div class="product-info">
				  					<h3 class="product-name product_title">
				  						<?php
										if ( ! $product->is_visible() ) {
											echo apply_filters( 'tinvwl_wishlist_item_name', $product->get_title(), $wl_product, $product ) . '&nbsp;'; // WPCS: xss ok.
										} else {
											echo apply_filters( 'tinvwl_wishlist_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_url ), $product->get_title() ), $wl_product, $product ); // WPCS: xss ok.
										}

										echo apply_filters( 'tinvwl_wishlist_item_meta_data', tinv_wishlist_get_item_data( $product, $wl_product ), $wl_product, $product ); // WPCS: xss ok.
										?>
				  					</h3>
				  					<h3 class="by_designer">by <?php
				  						$subheadingvalues = get_the_terms( $product->id, 'pa_designer');
				  						if ( $subheadingvalues ) {
				  							foreach ( $subheadingvalues as $attr ) {
				  								echo $attr->name;
				  							}
				  						}
				  					?></h3>
				  				</div>
				  				
			  					<?php if ( isset( $wishlist_table_row['colm_price'] ) && $wishlist_table_row['colm_price'] ) { ?>
			  					<span class="price">
			  						<?php
									echo apply_filters( 'tinvwl_wishlist_item_price', $product->get_price_html(), $wl_product, $product ); // WPCS: xss ok.
									?>
			  					</span>
			  					<?php } ?>
				  				
				  				<?php
								if ( apply_filters( 'tinvwl_wishlist_item_action_add_to_cart', $wishlist_table_row['add_to_cart'], $wl_product, $product ) ) {
									?>
				  				<button class="button alt" name="tinvwl-add-to-cart"
									        value="<?php echo esc_attr( $wl_product['ID'] ); ?>"
									        title="<?php echo esc_html( apply_filters( 'tinvwl_wishlist_item_add_to_cart', $wishlist_table_row['text_add_to_cart'], $wl_product, $product ) ); ?>">
										<span
											class="tinvwl-txt"><?php echo esc_html( apply_filters( 'tinvwl_wishlist_item_add_to_cart', $wishlist_table_row['text_add_to_cart'], $wl_product, $product ) ); ?></span>
									</button>
				  				<?php } ?>
				  				<div class="product-remove">
				  					<button type="submit" name="tinvwl-remove"
								        value="<?php echo esc_attr( $wl_product['ID'] ); ?>"
								        title="<?php _e( 'Remove', 'ti-woocommerce-wishlist' ) ?>"><i
										class="ftinvwl ftinvwl-times"></i>
									</button>
				  				</div>
				  			</div>
							<?php
								do_action( 'tinvwl_wishlist_row_after', $wl_product, $product );
						} // End if().
					} // endforeach;
				?>
				<?php do_action( 'tinvwl_wishlist_contents_after' ); ?>
			</div>
		</div>
		<?php do_action( 'tinvwl_after_wishlist_table', $wishlist ); ?>
		<?php wp_nonce_field( 'tinvwl_wishlist_owner', 'wishlist_nonce' ); ?>
	</form>
	<div class="shering"> 
		<p><?php pll_e('Поделиться'); ?>: 
			<a target="_blank" rel="nofollow" href="whatsapp://send?text=<?php the_permalink(); ?>%0D%0A%0D%0A<?php the_title(); ?>" class="whatsapp" aria-label="Отправить в Ватсап" title="Отправить в Ватсап"><i class="fa fa-whatsapp"></i></a>

			<a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>" class="social-facebook" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			
			<a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" class="social-pinterest" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
			
		</p> 
	</div>
	<?php do_action( 'tinvwl_after_wishlist', $wishlist ); ?>
	<div class="tinv-lists-nav tinv-wishlist-clear">
		<?php do_action( 'tinvwl_pagenation_wishlist', $wishlist ); ?>
	</div>
</div>
</div>
