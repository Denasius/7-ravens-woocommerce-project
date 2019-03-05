<?php 
/*
Template Name: Политика конфидинциальности
*/
?>
<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<h1 style="text-align: center;"><?php the_title(); ?></h1>
			<?php the_post(); the_content(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>