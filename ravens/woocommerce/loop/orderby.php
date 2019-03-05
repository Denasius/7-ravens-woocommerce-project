<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$url_explode = explode('/', $_SERVER['REQUEST_URI']);
?>
<div class="shop-products-filter">
<form class="woocommerce-ordering" method="get">
	<select name="orderby" class="orderby">
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>
</div>
</div>
</div>
</div>  <!-- конец блока row (фильрта) -->

<?php if ( get_queried_object()->slug == 'designers' || get_queried_object()->slug == 'designers-en' ) : ?>
	<!-- начало блока с дизайнерами -->
<div class="row all_designers">

<?php
	$cat = get_queried_object();
    $cat_id = $cat->term_id;

	$taxonomies = array(
	   'product_cat'
	);
	$args = array(
	   'orderby'           => 'name',
	   'order'             => 'ASC',
	   'hide_empty'        => false,
	   'exclude'           => array(),
	   'exclude_tree'      => array(),
	   'include'           => array(),
	   'number'            => '',
	   'fields'            => 'all',
	   'slug'              => '',
	   'parent'            => '',
	   'hierarchical'      => true,
	   'child_of'          =>  $cat_id,
	   'childless'         => false,
	   'get'               => '',
	   'name__like'        => '',
	   'description__like' => '',
	   'pad_counts'        => false,
	   'offset'            => '',
	   'search'            => '',
	   'cache_domain'      => 'core'
	);

	$terms = get_terms($taxonomies, $args);

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
	   foreach ( $terms as $term ) {?>

			<div class="col-12 col-sm-6 col-md-4">
				<div class="designer_image">
					<a href="<?php echo get_category_link($term->term_id); ?>">
						<div class="name_designer">
							<?php echo $term->name; ?>
						</div>
						<div class="country_designer">
							<?php if ($url_explode[1] !== 'en') {
									if ( get_field('designer_country', $term->taxonomy . '_' . $term->term_id) ) {
										echo get_field('designer_country', $term->taxonomy . '_' . $term->term_id);
									}
								}else{
									if ( get_field('designer_country_en', $term->taxonomy . '_' . $term->term_id) ) {
										echo get_field('designer_country_en', $term->taxonomy . '_' . $term->term_id);
									}
								} ?>
						</div>
					</a>
				</div>

			</div>

		<?php

	 	}
	}
?>

</div>
<!-- конец блока с дизайнерами -->
<?php endif; ?>

<div class="products_all">
	<?php if( is_tax( 'product_cat' ) ) : ?>
		<?php $cat = get_queried_object(); if( 0 < $cat->parent ) :
			$cat = get_queried_object();
		    $cat_id = $cat->term_id;
		   $parentcats = get_ancestors($cat_id, 'product_cat');
		   $term = get_term_by( 'slug', 'designers', 'product_cat', 'ARRAY_A' );
		   $term_en = get_term_by( 'slug', 'designers-en', 'product_cat', 'ARRAY_A' );

			if ( $term['term_id'] == $parentcats[0] || $term_en['term_id'] == $parentcats[0] ): ?>
			<?php if (get_field('short_description', 'product_cat' . '_' . $cat_id) ) : ?>
				<div class="description_designer">
					<?php if ($url_explode[1] !== 'en') {
							the_field('short_description', 'product_cat' . '_' . $cat_id);
						}else{
							the_field('short_description_en', 'product_cat' . '_' . $cat_id);
						} ?>
				</div>
			<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
<div class="row">
