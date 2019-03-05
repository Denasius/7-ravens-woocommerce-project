<?php get_header(); ?>

<?php if (in_category('info_blog')) : ?>
	<?php
	if ( has_post_thumbnail() ) {
		$img_post_url = get_the_post_thumbnail_url();
	}else{
		$img_post_url = get_template_directory_uri() . '/assets/img/Layer-1.jpg';
	}
	?>
	<?php if (have_posts()) : ?>
		<div class="img-field-info" style="background-image: url(<?php echo $img_post_url; ?>);">
			<h1 class="info-title"><?php the_title(); ?></h1>
		</div>
		<div class="breadcrumbs-nav">
	  		<?php woocommerce_breadcrumb(); ?>
	  	</div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php the_post(); the_content(); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php else : ?>
	<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post() ?>
		<div class="blog-page">
		  	<h1><?php the_title(); ?></h1>
		  	<div class="ad-info">
		  		<p>  			
		  			<span class="author">by <?php the_author(); ?></span>  		
		  			<span class="date"><?php echo get_the_date(); ?></span></p>
		  	</div>
		  	<div class="container">
		  		<?php if (has_post_thumbnail()) : ?>
		  			<div class="blog-image" style="text-align: center;">
			  			<?php the_post_thumbnail(); ?>
			  		</div>
			  	<?php else : ?>
			  		<div class="blog-image">
			  			<img src="<?php get_template_directory_uri(); ?>/assets/img/1.jpg" alt="<?php the_title(); ?>">
			  		</div>
		  		<?php endif; ?>
		  		<div class="text">
		  			<?php the_content(); ?>
		  		</div>
		  		<div class="row">
		  			<?php
						$post_tags = get_the_tags();
					?>
					<?php if ($post_tags) : ?>
			  			<div class="col-6">
			  				<div class="labels">
			  					<ul>
									<?php foreach ( $post_tags as $tag ) : ?>
										<li><a href="<?php the_permalink(); ?>"><?php echo $tag->name; ?></a></li>
									<?php endforeach; ?>			  						
			  					</ul>
			  				</div>
			  			</div>
			  		<?php endif; ?>
		  			<div class="<?php if ( $post_tags ) {echo 'col-6';}else{echo 'col-12';} ?> shering-views">
		  				<div class="views">
		  					<i class="icon_chat_alt"></i>
		  					<?php setPostViews(get_the_ID()); ?>
		  					<?php echo getPostViews(get_the_ID()); ?>
		  				</div>
		  				<div class="shering">
		  					<ul class="social-list">
		  	    				<?php dynamic_sidebar( 'socials' ) ?> 				
		  	    			</ul>
		  				</div>
		  			</div>
		  		</div>
		  		<?php if (comments_open(get_the_ID())) : ?>
		  		<div class="container">
					<?php comments_template(); ?>
		  		</div>
		  		<?php endif; ?>
		  	</div>
		</div>
	<?php endwhile; ?>

<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php endif; ?>

  <?php get_template_part('content', 'subscribe'); ?>

  <?php get_template_part('content', 'info'); ?>
  
<?php get_footer() ?>