<?php

  $blog_args = array(
    'category_name' => 'blog',
    'post_per_page' => 8
  );

  $blog_query = new WP_Query($blog_args);
?>

<?php if ( $blog_query->have_posts() ) : ?>
<div class="blog">
  	<h2><?php pll_e('Блог') ?></h2>
  	<div class="container">
  		<div class="row blog-slider">
      <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
        <?php
          if ( has_post_thumbnail() ) {
            $img_post_thumbnail = get_the_post_thumbnail();
          }else{
            $img_post_thumbnail = '<img src="'.get_template_directory_uri().'/assets/img/no_image_370x370.png" alt="NoImage">';
          }
        ?>
  			<div class="col-4 blog-section">
  				<div class="blog-img">
  					<?php echo $img_post_thumbnail; ?>            
  				</div>
  				<div class="info-blog">
  					<div class="title">
  						<h3><a href="#"><?php the_title(); ?></a></h3>
  					</div>
  					
  					<div class="post-content">
  						<p><?php the_excerpt(); ?></p>
  					</div>
  					<div class="readMore">
  						<a href="<?php the_permalink(); ?>"><?php pll_e('Читать'); ?></a>
  					</div>
  				</div>
          <div class="add-content-title">
            <div class="title">
              <h3><a href="#"><?php the_title(); ?></a></h3>
            </div>
           
          </div>
  			</div>
      <?php endwhile; ?>
  		</div>
  	</div>
  </div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>