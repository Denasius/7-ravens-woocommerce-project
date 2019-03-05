<?php 
  $query = new WP_Query(array(
    'category_name' => 'info_blog',
    'posts_per_page' => 3
  ));
  if ( $query->have_posts() ) :
?>
<div class="page-info">
  	<div class="container">
  		<div class="row">
      <?php while ( $query->have_posts() ) : $query->the_post() ?>
  			<div class="col-12 col-md-4">
  				<div class="page-info-section">
  					<div class="title">
  						<div class="icon">
  							<span class="<?php echo the_field('icon_info'); ?>"></span>
  						</div>
  						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
  					</div>
  					<div class="text">
  						<?php the_excerpt(); ?>
  					</div>
  				</div>
  			</div>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
  		</div>
  	</div>
  </div>
<?php endif; ?>