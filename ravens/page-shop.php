<?php 
/*
Template Name: Shop
*/
?>

<?php get_header(); ?>

<?php get_template_part('home', 'slider'); ?>

<?php do_action('woocommerce_before_main_content'); ?>
 
 <?php do_action('woocommerce_archive_description'); ?>

<?php
	$args = array(
		'post_type' => 'product',
		'post_per_page' => 8
	);

	global $wp_query;
	$wp_query = new WP_Query($args);

?>
<?php if ($wp_query->have_posts()) : ?>
  	<?php woocommerce_product_loop_start(); ?>
  			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
  				<?php wc_get_template_part('content', 'product'); ?>
  			<?php endwhile; ?>
  	<?php woocommerce_product_loop_end(); ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php do_action('woocommerce_after_main_content') ?>

  <?php get_sidebar( 'content-widget' ); ?>

  <?php get_template_part('content', 'blog'); ?>

  <?php get_template_part('content', 'subscribe'); ?>

  <?php get_footer(); ?>
