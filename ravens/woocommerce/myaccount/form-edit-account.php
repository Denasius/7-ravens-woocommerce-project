<?php

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?>" >
	<p class="form_title"><?php pll_e('Личные данные'); ?></p>

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
		 <label for="account_first_name"><?php esc_html_e( 'Name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
	<label for="account_last_name"><?php esc_html_e( 'Surname', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
	</p>
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide" style="display: none;">
		<label for="account_display_name"><?php esc_html_e( 'Display name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" /> <span><em><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'woocommerce' ); ?></em></span>
	</p>
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="account_email"><?php esc_html_e( 'Email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
	</p>

	<div class="fieldset">
		<p><?php esc_html_e( 'Password change', 'woocommerce' ); ?></p>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" placeholder="<?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?>" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" placeholder="<?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?>" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_2"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" placeholder="<?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?>" />
		</p>
	</div>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<p>
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>

<?php
// get the user meta
$userMeta = get_user_meta(get_current_user_id());

// get the form fields
$countries = new WC_Countries();
$billing_fields = $countries->get_address_fields( '', 'billing_' );
$shipping_fields = $countries->get_address_fields( '', 'shipping_' );
?>

<!-- billing form -->
<?php
$load_address = 'billing';
$page_title   = __( 'Delivery address', 'woocommerce' );
?>
<form action="/my-account/edit-address/billing/" id="ravens-custom-edit-account-address" class="edit-account" method="post">

    <p class="form_title"><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></p>

    <?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

    <?php foreach ( $billing_fields as $key => $field ) : ?>

        <?php woocommerce_form_field( $key, $field, $userMeta[$key][0] ); ?>

    <?php endforeach; ?>

    <?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

    <p>
        <input type="submit" class="button" name="save_address" value="<?php esc_attr_e( 'Save Address', 'woocommerce' ); ?>" />
        <?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
        <input type="hidden" name="action" value="edit_address" />
    </p>

</form>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		
		$('.woocommerce-edit-account .edit-account .woocommerce-input-wrapper input').each(function () {
			var $label = $(this).closest('.form-row-wide').find('label').text();
			$(this).attr('placeholder', $label);
		});

		<?php $url_explode = explode('/', $_SERVER['REQUEST_URI']);
		if ($url_explode[1] !== 'en') : ?>
			$('.woocommerce-edit-account .edit-account [name="save_address"]').attr('value', 'Сохранить изменения');
		<?php endif; ?>

		<?php if ( get_locale() == 'ru_RU' ) : ?>
		$('#ravens-custom-edit-account-address p.form_title').text('Адрес доставки');
		<?php endif; ?>
	});
</script>


