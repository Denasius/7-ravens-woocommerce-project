<?php
  $slider = new WP_Query(array(
    'post_type' => 'slider'
  ));
?>

<?php if ( $slider->have_posts() ) : ?>

<div class="top-slider">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="slider">
        		<?php while ($slider->have_posts()) : $slider->the_post(); ?>
        		<?php
        			if ( has_post_thumbnail() ) {
						$img_post_url = get_the_post_thumbnail_url();
					}else{
						$img_post_url = 'https://via.placeholder.com/1770x800';
					}
        		?>
					<div class="item" style="background-image: url(<?php echo $img_post_url ?>);">
						<div class="row align-items-center height-100">
							<div class="col-12 col-sm-10 col-md-8 offset-sm-1 sm-padding">
								<h1><?php the_title(); ?></h1>
								<p><?php the_content(); ?></p>
								<?php if ( get_option('button_name') ) : ?>
									<a href="<?php echo the_field('link_for_button'); ?>"><?php pll_e('Перейти по ссылке');?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
        		<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>