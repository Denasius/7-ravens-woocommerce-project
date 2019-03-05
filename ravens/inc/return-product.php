<?php 

add_action('wp_ajax_cansel_order_form', 'cansel_order_form');


function cansel_order_form()
{
	print_r($_POST);
	if ( isset($_POST['ravens_form_cansel_order']) ) {
		setcookie('ravens_id_order', (int)$_POST['order_id'], time() - 3600, '/');

		$to = get_option('admin_email');

		$subject = 'Заявка на возврат';

		
		$message = load_template_part('template-parts/content-cansel-product');

		remove_all_filters( 'wp_mail_from' );
	    remove_all_filters( 'wp_mail_from_name' );

	    wp_mail( $to, $subject, $message );
	    wp_die();
	}
}

function load_template_part($template_name, $part_name=null) {
    ob_start();
    get_template_part($template_name, $part_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}