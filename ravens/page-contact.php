<?php 
/*
Template Name: Контакты
*/
?>

<?php get_header(); ?>
<?php
	if ( get_the_post_thumbnail_url() ) {
		$img_page = get_the_post_thumbnail_url();
	}else{
		$img_page = get_template_directory_uri() . '/assets/img/Layer-1.jpg';
	}
?>
<div class="header-title">
  	<header style="background-image: url(<?php echo $img_page; ?>);">
  		<div class="page-title">
  			<h1><?php the_title(); ?></h1>
  		</div>
  	</header>
  	<div class="breadcrumbs-nav">
  		<?php woocommerce_breadcrumb(); ?>
  	</div>
  	<main>
  		<h3><?php echo the_field('contact_us'); ?></h3>
      <?php the_post(); the_content(); ?>
  	</main>	
  </div>
  <?php get_template_part('content', 'subscribe'); ?>

  <?php get_template_part('content', 'info'); ?>
<?php get_footer() ?>