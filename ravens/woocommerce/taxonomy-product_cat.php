<?php
	if ( !defined( 'ABSPATH' ) ) {
		exit;
	}
?>
<?php get_header(); ?>
  <div class="baner">
    <?php $thumb_ID = get_woocommerce_term_meta( get_queried_object()->term_id, 'thumbnail_id', true );
    $image = wp_get_attachment_url($thumb_ID);?>
  	<?php if ( !is_search() ) : ?>
      <div class="woocommerce-banner page-banner" style="background-image: url(<?php if ($image) {
      echo $image;
    }else{
      echo get_template_directory_uri() . '/assets/img/banner.jpg';
    } ?>);">
      <div class="container">
        <h2 class="page-title">
          <?php echo get_queried_object()->name; ?>
        </h2>
      </div>
    </div>
    <?php endif; ?>
  	<div class="main-wrapper">
      <div class="container-fluid">
        <?php woocommerce_breadcrumb(); ?>
      </div>
  		<div class="container">
  			
  			<div class="row">
  				<?php get_sidebar(); ?>
  				<div class="<?php
            if ( !is_search() ) {
              echo 'col-12 col-lg-9 wcapf-before-products';
            }else{
              echo 'col-12 _search_page'; // на странице поиска вывожу блок с этим классом
            }
          ?>">

          <?php if(have_posts()) :?>
  					<div class="row <?php if (!is_search()) {echo 'justify-content-end';} ?><?php if (is_search()){echo 'products_all';} ?>">
  						<?php if ( !is_search() ) : ?> <!-- на странице поиска НЕ вывожу этот блок -->
                <div class="col-8 col-sm-5 col-md-4 col-lg-3">
              <?php endif; ?>
                <?php do_action('woocommerce_before_shop_loop') ?> 
              <?php if ( is_search() ) : ?> <!-- если страница поиска, то вывожу закрывающий div, чтобы не летела разметка на странице поиска -->
                </div>
              <?php endif; ?>

  						<?php while(have_posts()) : the_post();?>
  							<?php wc_get_template_part('content','product-cat');?>
  						<?php endwhile;?>
  							<?php if (  $wp_query->max_num_pages > 1 ) : ?>
                  <script>
                  var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                  var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
                  var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                  var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
                  </script>
                  <div id="true_loadmore" class="col-12"><a href="javascript:void(0)">Загрузить ещё</a></div>
                <?php endif; ?>
  						</div>   
  					</div>
  				<?php else : ?>
  				<?php wc_get_template('loop/no-products-found.php'); ?>
  				<?php endif; ?>
  				<?php wp_reset_postdata(); ?>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>

<?php get_template_part('content', 'subscribe'); ?>

<?php get_template_part('content', 'info'); ?>

<?php get_footer(); ?>