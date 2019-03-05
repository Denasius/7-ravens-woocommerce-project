<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

$url_explode = explode('/', $_SERVER['REQUEST_URI']);
?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

		<h3><?php _e( 'Billing details', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper">
		<?php
			$fields = $checkout->get_checkout_fields( 'billing' );

			foreach ( $fields as $key => $field ) {
				if ( isset( $field['country_field'], $fields[ $field['country_field'] ] ) ) {
					$field['country'] = $checkout->get_value( $field['country_field'] );
				}
				woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
			}
		?>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ) ?> type="checkbox" name="createaccount" value="1" /> <span><?php _e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
<?php $ravens_option = get_option('ravens_theme_options'); ?>

<?php if ( !empty( $ravens_option['ravens_theme_options_text']) ) : ?>
	<div class="wrapper-gift">
		<input type="checkbox" id="option_for_wrap_gift" name="option_for_wrap_gift" value="1" <?php if (isset($_COOKIE['ravens_custom_cookies'])) {
			echo 'checked';
		} ?> >
		<?php if ($url_explode[1] == 'en') : ?>
		<p class="gift_p"><label for="option_for_wrap_gift"><?php echo $ravens_option['ravens_theme_options_text_en']; ?></label></p>
		<?php else : ?>
			<p class="gift_p"><label for="option_for_wrap_gift"><?php echo $ravens_option['ravens_theme_options_text']; ?></label></p>
		<?php endif; ?>
		<!-- <?php //if ( $_COOKIE['wmc_current_currency'] == 'EUR' ) : ?>
			
			<div class="rub_currency">
				<p>
					<?php //echo '('; ?>
					<?php// echo get_woocommerce_currency_symbol(); ?>
					<?php// echo $ravens_option['ravens_theme_options_price_eur'] ?>
					<?php //echo ')'; ?>					
				</p>
			</div>
		<?php //else : ?>
			
			<div class="eur_currency">
				<p>
					<?php //echo '('; ?>
					<?php //echo $ravens_option['ravens_theme_options_price_rub']; ?>
					<?php //echo get_woocommerce_currency_symbol(); ?>
					<?php //echo ')'; ?>
				</p>
			</div>
		<?php //endif; ?> -->
		
	</div>
	
<?php endif; ?>
<?php if ( !empty( $ravens_option['ravens_theme_options_text_standart_wrap'] ) ) : ?>
	<div class="wrapper-standart">
		<input type="checkbox" id="option_for_standart_wrap" name="option_for_standart_wrap" <?php if ( isset( $_COOKIE['rav_cookie_standart_wrap'] ) ) echo 'checked'; ?>>

		<?php if ($url_explode[1] == 'en') : ?>
			<p class"gift_p">
				<label for="option_for_standart_wrap"><?php echo $ravens_option['ravens_theme_options_text_en_standart_wrap']; ?></label>
			</p>
		<?php else : ?>
			<p class="gift_p">
				<label for="option_for_standart_wrap"><?php echo $ravens_option['ravens_theme_options_text_standart_wrap']; ?></label>
			</p>
		<?php endif; ?>
	</div>
<?php endif; ?>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		var url = '<?php echo admin_url('admin-ajax.php?action=set_cookies_for_wrapper_gift') ?>',
			url_for_standart_wrap = '<?php echo admin_url('admin-ajax.php?action=set_cookies_for_standart_wrapper'); ?>';	

		// Обрабатываю клик по подарочной упаковке	
		$('#option_for_wrap_gift').change( function () {
			$(this).attr('checked', 'checked');
			var checked = '';
			if ( $(this).is(':checked') ) {
				checked = 'checked';
			}else{
				checked = 'not_checked';
			}

			$.ajax({
				url: url,
				data: {'checked': checked},
				type: 'POST',
				error: function (request, errorStatus, errorThrown) {
					console.log(request);
					console.log(errorStatus);
					console.log(errorThrown);
				},
				beforeSend: function () {
					$('.wrapper-gift > input, .wrapper-gift > p, .wrapper-gift > div').hide();
					$('.wrapper-gift').append('<img src="<?php echo get_template_directory_uri(); ?>/assets/img/103.gif" alt="Загрузка" style="height:26px; width: 190px;">');
				},
				success: function (res) {
					console.log(res);
					$('.wrapper-gift > input, .wrapper-gift > p, .wrapper-gift > div').show();
					$('.wrapper-gift > img').hide();
					$('#ravens_result_checkout').load('<?php echo $_SERVER['REQUEST_URI'] ?>, #ravens_result_checkout > *');
				}
			})
		});

		// Обрабатываю клик по стандартной упаковке
		$('#option_for_standart_wrap').change(function () {
			$(this).attr('checked', 'checked');
			var checked_standart_wrap = '';
			if ( $(this).is(':checked') ) {
				checked_standart_wrap = 'checked';
			}else{
				checked_standart_wrap = 'not_checked';
			}

			$.ajax({
				type: 'POST',
				url: url_for_standart_wrap,
				data: {'checked': checked_standart_wrap},
				error: function (request, errorStatus, errorThrown) {
					console.log(request);
					console.log(errorStatus);
					console.log(errorThrown);
				},
				beforeSend: function () {
					$('.wrapper-standart > input, .wrapper-standart > p, .wrapper-standart > div').hide();
					$('.wrapper-standart').append('<img src="<?php echo get_template_directory_uri(); ?>/assets/img/103.gif" alt="Загрузка" style="height:26px; width: 190px;">');
				},
				success: function (res) {
					console.log(res);
					$('.wrapper-standart > input, .wrapper-standart > p, .wrapper-standart > div').show();
					$('.wrapper-standart > img').hide();
					$('#ravens_result_checkout').load('<?php echo $_SERVER['REQUEST_URI'] ?>, #ravens_result_checkout > *');
				}
			})
		});
	});
</script>