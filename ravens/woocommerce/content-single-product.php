 <?php
  if ( !defined( 'ABSPATH' ) ) {
    exit;
  }
  global $product;
  $columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
  'woocommerce-product-gallery',
  'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
  'woocommerce-product-gallery--columns-' . absint( $columns ),
  'images',
) );
 ?>

  <?php do_action('woocommerce_before_single_product'); ?>
 <div class="flexslider">
    <div class="container">
    	<div class="row product">
    		<div class="col-12 col-lg-6 <?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>">
  			   <?php do_action('woocommerce_before_single_product_summary') ?>
    		</div>

    		<div class="col-12 col-lg-6 <?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?> mt-ravens">
  			   <?php do_action('woocommerce_single_product_summary'); ?>
    			</div>

    		</div>
    	</div>
    </div>
  </div>