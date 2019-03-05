<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div class="main-price">
	<p><?php echo $product->get_price_html(); ?></p>
</div>
<?php if ( $product->get_attribute('color') ) : ?>
<div class="color">
	<p style="font-size: 16px; margin: 0;"><?php echo $product->get_attribute('color'); ?></p>
</div>
<?php endif; ?>

