<?php 
if ( !defined( 'ABSPATH' ) ) {
		exit;
	}

	get_header();
?>

 <div class="breadcrumbs-nav">

    <?php woocommerce_breadcrumb(); ?>

  </div>

  <?php while ( have_posts() ) : the_post() ?>

  	<?php wc_get_template_part('content', 'single-product'); ?>

  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>

<div class="hot">
	<?php dynamic_sidebar( 'recomended' ); ?>
</div>
</div> <!-- end hot -->

  <?php get_template_part('content', 'subscribe'); ?>

  <?php get_template_part('content', 'info'); ?>

<?php get_footer(); ?>