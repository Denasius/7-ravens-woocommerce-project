<?php


// удаляю стандартный вывод адреса и имени
add_action( 'woocommerce_email_customer_details', 'removing_customer_details_in_emails', 5, 4 );
function removing_customer_details_in_emails( $order, $sent_to_admin, $plain_text, $email )
{
    $mailer = WC()->mailer();
    remove_action( 'woocommerce_email_customer_details', array( $mailer, 'customer_details' ), 10, 4 );
    remove_action( 'woocommerce_email_customer_details', array( $mailer, 'email_addresses' ), 20, 4 );
}

// Оформляю шапку письма (имя, телефон, фдрес, метод оплаты)
add_action('woocommerce_email_before_order_table','add_content',10,4);
function add_content($order,$sent_to_admin, $plain_text, $email)
{

   echo '<div class="order_details_custom"><div class="one" style="display: inline-block; width: 260px;"><div class="name_r"><p style="text-align: left; margin-bottom: 0">Имя:</p><p style="color: red; text-align: left;">';
   echo $order->get_billing_first_name();
   echo '</p></div><div class="address_r"><p style="text-align: left; margin-bottom: 0">Адрес доставки:</p><p style="color: red; text-align: left;">';
   echo $order->get_billing_city() . ' ' . $order->get_billing_state();
   echo '</p></div></div><div class="two" style="display: inline-block; width: 260px;"><div class="phone_r"><p style="text-align: left; margin-bottom: 0">Телефон:</p><p style="color: red; text-align: left;">';
   echo esc_html( $order->get_billing_phone() );
   echo '</p></div><div class="method_r"><p style="text-align: left; margin-bottom: 0">Способ оплаты:</p><p style="color: red; text-align: left;">';
   echo $order->get_payment_method_title();
   echo '</p></div></div></div><hr style="margin-top: 10px; margin-bottom: -30px" />';
}

// удаляю стандартный футер
add_filter('woocommerce_email_footer_text','add_email_footer_text');
function add_email_footer_text()
{
   return ' ';
}

// добавляю свой футер
add_action( 'woocommerce_email_after_order_table', 'ravens_email_header', 10, 4 );
function ravens_email_header( $order, $sent_to_admin, $plain_text, $email )
{
	echo '<hr style="margin: -30px 0 20px 0;" /><p style="color: #000000; font-weight: bold; text-align: center;">ИТОГО: ';
	echo $order->get_formatted_order_total();
	echo '</p><hr style="margin: 20px 0 20px 0; " /><p style="text-align: center;">Проверить статус заказа вы можете в личном кабинете:<br>';
	echo '<a href="';
	echo get_permalink(wc_get_page_id('myaccount'));
	echo '" style="color: #ffffff; background-color: #000000;">ВХОД</a>';
	echo '</p><p style="text-align: center;">Это письмо было отправлено на email: <span style="color: red;">';
	echo $order->get_billing_email();
	echo '</span>.<br/><p style="text-align: center; font-size: 12px;">С нами можно связаться по адресу INFO@7-RAVENS.COM.<br />Если вы хотите отписаться от рассылки, пожалуйста, нажмите здесь.<br />Чтобы не пропустить письмо от нас, добавьте NO-REPLY@7-RAVENS.COM в адресную книгу.<br />Ознакомиться с политикой конфиденциальности и обработки персональных данных можно на нашем сайте</p>';
}