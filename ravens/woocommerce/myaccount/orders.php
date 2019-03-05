<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$url_explode = explode('/', $_SERVER['REQUEST_URI']);
?>

<?php do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>

	<div class="tabs-orders">
		<a href="javascript:void(0);" id="ravens_active_orders"><?php pll_e('Активные заказы'); ?></a>
		<a href="javascript:void(0);" id="ravens_history_orders"><?php pll_e('История заказов'); ?></a>
	</div>

	<div class="table-section">

		<table class="wc_custom_orders_table woocommerce-orders-table woocommerce-orders-table-not-completed woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
			<thead>
				<tr>
					<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
						<th style="padding-bottom: 10px;" class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $customer_orders->orders as $customer_order ) :
					$order      = wc_get_order( $customer_order );
					$item_count = $order->get_item_count();
					?>
					<?php if ( $order->get_status() !== 'completed' ) : ?>
					<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
						<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
							<td style="padding-bottom: 20px;" class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
								<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
									<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

								<?php elseif ( 'order-number' === $column_id ) : ?>
									<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
										<?php echo _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number(); ?>
									</a>

								<?php elseif ( 'order-date' === $column_id ) : ?>
									<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

								<?php elseif ( 'order-status' === $column_id ) : ?>
									<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>

								<?php elseif ( 'order-total' === $column_id ) : ?>
									<?php
									/* translators: 1: formatted order total 2: total order items */
									printf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count );
									?>

								<?php elseif ( 'order-actions' === $column_id ) : ?>


									<?php $data_order = esc_attr( $order->get_date_created()->date( 'd-m-Y' ) );
									 $date_order = new DateTime($data_order); 
									 $date_plus = new DateTime($date_order->format('d-m-Y'));
									 $_date_plus = $date_plus->add(new DateInterval('P14D'));
									 $date_now = new DateTime('now');
									if ( $_date_plus > $date_now ) : ?>
										<button class="cansel_order_label"><?php pll_e('вернуть товар') ?></button>
									<?php else : ?>
										<button class="cansel_order_label" disabled title="<?php esc_html(pll_e('Товар можно вернуть только в истечении 14 дней')); ?>"><?php pll_e('вернуть товар') ?></button>
									<?php endif; ?>
									
									<input type="hidden" class="cansel_order_id" value="<?php echo $order->id; ?>">
									<input type="hidden" class="cansel_order_user_email" value="<?php $user_id = get_current_user_id(); $user_info = get_userdata($user_id); $mailadresje = $user_info->user_email; echo $mailadresje; ?>">
								<?php endif; ?>
							</td>
						<?php endforeach; ?>
					</tr>
					<?php endif; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
			
		<table class="wc_custom_orders_table woocommerce-orders-table woocommerce-orders-table-completed woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
			<thead>
				<tr>
					<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
						<th class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $customer_orders->orders as $orders ) :
				$order_completed     = wc_get_order( $orders );
				$item_count_completed = $order->get_item_count();
				if ( $order_completed->get_status() == 'completed' ) : ?>
				<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order_completed->get_status() ); ?> order">
					<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
						<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
							<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
								<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order_completed ); ?>

							<?php elseif ( 'order-number' === $column_id ) : ?>
								<a href="<?php echo esc_url( $order_completed->get_view_order_url() ); ?>">
									<?php echo _x( '#', 'hash before order number', 'woocommerce' ) . $order_completed->get_order_number(); ?>
								</a>

							<?php elseif ( 'order-date' === $column_id ) : ?>
								<time datetime="<?php echo esc_attr( $order_completed->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order_completed->get_date_created() ) ); ?></time>

							<?php elseif ( 'order-status' === $column_id ) : ?>
								<?php echo esc_html( wc_get_order_status_name( $order_completed->get_status() ) ); ?>

							<?php elseif ( 'order-total' === $column_id ) : ?>
								<?php
								/* translators: 1: formatted order total 2: total order items */
								printf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count_completed, 'woocommerce' ), $order_completed->get_formatted_order_total(), $item_count_completed );
								?>

							<?php elseif ( 'order-actions' === $column_id ) : ?>
								<?php
								$actions = wc_get_account_orders_actions( $order_completed );

								if ( ! empty( $actions ) ) {
									foreach ( $actions as $key => $action ) {
										echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
									}
								}
								?>
							<?php endif; ?>
						</td>
					<?php endforeach; ?>
				</tr>
					<?php endif; ?>
				<?php endforeach; ?>
			</tbody>
		</table>

			
	</div>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php _e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php _e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php _e( 'Go shop', 'woocommerce' ) ?>
		</a>
		<?php _e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>

<div class="col-12 myaccount-subscribe">
          	<?php dynamic_sidebar('mailpoet_newsletter_form'); ?>
  		</div>
<script tupe="text/javascript">
	jQuery(document).ready(function ($) {
		
		// Устанавливаю атрибут с номером id заказа для кнопки, чтобы записать номер в куки
		$('.woocommerce-orders-table-not-completed > tbody > .woocommerce-orders-table__row').each(function (index) {
			var $button_order_id = $(this).find('.cansel_order_label');
			$button_order_id.attr("data-order-id", "cansel_order-" + index);
		});
		
		// обрабатываю клик по кнопке вернуть товар
		$('.cansel_order_label').on('click', function () {
			// 1. Получаю id заказа и почту пользователя
			var $cansel_order_id = $(this).closest('td').find('.cansel_order_id').attr('value'),
					$id_button = $(this).attr('data-order-id');
					$cansel_order_user_email = $(this).closest('td').find('.cansel_order_user_email').attr('value');
			
			// 2. Записываю номер заказа в модальное окно и удаляю атрибут disabled для кнопки отправить модального окна
			$('.cansel_order_number').text($cansel_order_id);
			$('.cansel_order_modal input[type="submit"]').removeAttr('disabled');

			// 3. Вызываю модальное окно
			$('.cansel_order_modal_overlay').css({
				"display":"block",
				"z-index":"3"
			});
			$('.cansel_order_modal').css({
				"z-index":"4",
				"display":"block"
			});

			//4. Записываю в куки данные id заказа
			$.cookie("position_button", $id_button, {
					expires: 30
				});
			$.ajax({
				url: '<?php echo admin_url('admin-ajax.php?action=set_cookies_for_cansel_order') ?>',
				data: {'order_id': $cansel_order_id},
				type: 'POST',
				error: function (request, errorStatus, errorThrown) {
					console.log(request);
					console.log(errorStatus);
					console.log(errorThrown);
				}
			});
		});

		// обрабатываю клик по кнопке отменить возврат (отмена)
		$('#reset_form_cansel_order').on('click', function () {

			// 1. Удаляю модальное окно
			$('.cansel_order_modal_overlay').css({
				"display":"none",
				"z-index":"-999"
			});

			$('.cansel_order_modal').css({
				"display":"none",
				"z-index":"-999"
			});

			// 2. Устанавливаю значение disable для кнопки вернуть товар (в модальном окне)
			$('.cansel_order_modal input[type="submit"]').attr('disabled', 'disabled');

			// 3. Удаляю из кук id заказа
			$.ajax({
				type: 'POST',
				url: '<?php echo admin_url('admin-ajax.php?action=remove_cookies_for_cansel_order') ?>',
				data: {'order_id_remove': $.cookie("ravens_id_order")},
				error: function (request, errorStatus, errorThrown) {
					console.log(request);
					console.log(errorStatus);
					console.log(errorThrown);
				},
				success: function () {
					$.removeCookie("position_button");
				}
			});
		});

		// Отправляю на почту 
		$('form#cansel_order_modal_form_send').on('submit', function (e) {
			e.preventDefault();
			if ( $.cookie("ravens_id_order") ) {
				var $order_id = $.cookie("ravens_id_order"),
					
					$user_email = '<?php $user_id = get_current_user_id(); $user_info = get_userdata($user_id); $mailadresje = $user_info->user_email; echo $mailadresje; ?>';
					$user_text = $(this).find('#cansel_order_field_text').val();

				
				$.ajax({
					url: $(this).attr('action'),
					type: 'POST',
					data: {'ravens_form_cansel_order': $(this).find('#ravens_form_cansel_order').attr('value'), 
						'send_order_id': $order_id, 
						'send_user_email': $user_email, 
						'send_user_text': $user_text},
					error: function (request, errorStatus, errorThrown) {
						console.log(request);
						console.log(errorStatus);
						console.log(errorThrown);
					},
					success: function (res) {
						console.log(res);
						$.removeCookie("position_button");
						$('#cansel_order_modal_form_send input[type="submit"], #reset_form_cansel_order').attr('disabled', 'disabled');
						$('#cansel_order_modal_form_send .textarea').html('<p class="success-answer"><?php pll_e('Благодарим Вас за заявку. В ближайшем времени с Вами свяжуться наши менеджеры для уточнения деталей.'); ?></p>');
						$('#reset_form_cansel_order').hide();
						$('#close_cansel_order').css({"display":"inline-block"});
					}
				});
			}
			
		});

		// закрываю модальное окно
		$('#close_cansel_order').on('click', function () {
			$('.cansel_order_modal_overlay').css({
				"display":"none",
				"z-index":"-999"
			});

			$('.cansel_order_modal').css({
				"display":"none",
				"z-index":"-999"
			});
		});
	});
</script>
