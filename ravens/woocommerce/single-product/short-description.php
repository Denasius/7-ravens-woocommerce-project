<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post, $product;

$content_description = apply_filters( 'woocommerce_short_description', $post->post_content );
$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}
if ( !$content_description ) {
	return;
}

?>
<?php if (  !$product->is_in_stock() ) : ?>
	<span class="not_in_stock"><?php pll_e('Нет в наличии'); ?></span>
<?php endif; ?>
<div class="shering"> 
	<p><?php pll_e('Поделиться'); ?>: 
		<a target="_blank" rel="nofollow" href="whatsapp://send?text=<?php the_permalink(); ?>%0D%0A%0D%0A<?php the_title(); ?>" class="whatsapp" aria-label="Отправить в Ватсап" title="Отправить в Ватсап"><i class="fa fa-whatsapp"></i></a>

		<a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>" class="social-facebook" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
		
		<a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" class="social-pinterest" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
		
	</p> 
</div>

<div class="main-description">
	<h3><?php pll_e('Описание'); ?></h3>
	<div><?php echo $content_description; // WPCS: XSS ok. ?></div>
</div>
<div class="details">
	<h3><?php pll_e('Детали'); ?></h3>
	<div><?php echo $short_description; ?></div>
</div>
