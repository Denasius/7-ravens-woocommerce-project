<h2><?php echo $title; ?></h2>
<?php

	$meta_query = WC()->query->get_meta_query();
	$tax_query = WC()->query->get_tax_query();
	$tax_query[] = array(
		'taxonomy' => 'product_visibility',
		'field' => 'name',
		'terms' => 'featured',
		'operator' => 'IN'
	);

	$args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'post_per_page' => $pcount,
		'meta_query' => $meta_query,
		'tax_query' => $tax_query
	);

	$hot_query = new WP_Query($args);
?>
<?php if ($hot_query->have_posts()) : ?>
	<? $count = $hot_query->post_count;
		$count_class = '';
		if ($count == 1) {
			$count_class = 'col-12';
		}else if ( $count == 2 ) {
			$count_class = 'col-6';
		}else if ( $count == 3 ) {
			$count_class = 'col-4';
		}else{
			$count_class = 'col-3';
		}

	?>
  	<div class="container">
		<div class="row products">
		<?php while ( $hot_query->have_posts() ) : $hot_query->the_post(); ?>
			<div class="<?php echo $count_class; ?> product">
				
				<div class="the_latest">
					<a href="<?php echo get_the_permalink(); ?>">
						<?php echo get_the_post_thumbnail($featured_query->post->ID,'shop_catalog',['class' => 'img-responsive']);?>
						</a>
				</div>
				<div class="product-info">
					<h3 class="product-name product_title">
						<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
					</h3>
					<?php global $product; $subheadingvalues = get_the_terms( $product->id, 'pa_designer'); ?>
					<?php if ($subheadingvalues) {
						foreach ($subheadingvalues as $attr) {
							echo '<h3 class="by_designer">by ';
							echo $attr->name . '</h3>';
						}
					} ?>
				</div>
				<?php
				$class = implode( ' ', array_filter( array(
						'button',
						'product_type_' . $product->product_type,
						$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
						$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
				) ) );?>
				<?php if ( $price_html = $product->get_price_html() ) : ?>
					<span class="price"><?php echo $price_html; ?></span>
				<?php endif; ?>
				<a href="<?php echo esc_url($product->add_to_cart_url())?>" data-quantity="1" data-product_id="<?php echo $product->id; ?>" data-product_sku="<?php echo $product->get_sku(); ?>" class="item_add <?php echo $class; ?> product_type_simple_custom_ravens"><?php echo $product->add_to_cart_text(); ?></a>
				
				<?php echo do_shortcode('[ti_wishlists_addtowishlist loop=yes]'); ?>
			
			</div>
		<?php endwhile; ?>			
<?php endif; ?>
<?php wp_reset_postdata(); ?>