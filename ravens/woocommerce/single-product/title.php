<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;
?>
<div class="product-info">
	<div class="title">
		<?php the_title('<h1 class="main-title">', '</h1>'); ?> <div class="des"><p>by <?php echo $product->get_attribute('designer'); ?></p></div>