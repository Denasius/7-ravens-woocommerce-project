<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<p class="ravens_my_account_hidden"><?php
	/* translators: 1: user display name 2: logout url */
	printf(
		__( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
	);
?></p>

<p class="ravens_my_account_hidden"><?php
	printf(
		__( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
?></p>
<div class="row">
		<div class="col-12 myaccount-subscribe">
          	<?php dynamic_sidebar('mailpoet_newsletter_form'); ?>
  		</div>
  		<?php $url_explode = explode('/', $_SERVER['REQUEST_URI']);
		if ($url_explode[1] !== 'en'): ?>
			<script type="text/javascript">
				jQuery(document).ready(function ($) {
					$('.myaccount-subscribe .widget_wysija_cont .wysija-submit').attr('value', 'Подписаться');
				});
			</script>
		<?php endif; ?>
	</div>
<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
