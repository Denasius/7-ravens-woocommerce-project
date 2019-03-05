
<!DOCTYPE html>
<html lang="ru-RU">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title><?php bloginfo('name'); ?></title>
	</head>
	<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="background-color: rgb(255,255,255);">
		<div id="wrapper" dir="ltr" style="background-color: #ffffff; margin: 0; padding: 70px 0 70px 0; width: 100%; -webkit-text-size-adjust: none;">
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
				<tr>
					<td align="center" valign="top">
						<div id="template_header_image">
							<p style="margin-top: 0;"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-7.png" alt="<?php bloginfo('name'); ?>" style="border: none; display: inline-block; font-size: 14px; font-weight: bold; height: auto; outline: none; text-decoration: none; text-transform: capitalize; vertical-align: middle; margin-right: 10px;"></p>						</div>
						<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container" style="background-color: #ffffff; border: 1px solid #e5e5e5; box-shadow: 0 1px 4px rgba(0,0,0,0.1); border-radius: 3px;">
							
							<tr>
								<td align="center" valign="top">
									<!-- Body -->
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body">
										<tr>
											<td valign="top" id="body_content" style="background-color: #ffffff;">
												<!-- Content -->
												<table border="0" cellpadding="20" cellspacing="0" width="100%">
													<tr>
														<td valign="top" style="padding: 15px 30px 0;">
<div id="body_content_inner" style='color: #636363; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 14px; line-height: 150%; text-align: left;'>

<p style="margin: 0 0 16px; text-align: center;">Клиент <span style="color: red;"><?php echo $_POST['send_user_email'] ?></span></p>
<p style="margin: 0 0 16px; text-align: center; color: rgb(0,0,0);">Отправил запрос на возврат товара <br /> Заказ №<?php echo $_POST['send_order_id'] ?></p>


<div style="margin-bottom: 40px;">
	<p style="text-align: left;">Сообщение:</p>
	<p style="text-align: left;"><?php echo $_POST['send_user_text']; ?></p>
</div>

<p style="margin: 0 0 16px; text-align: center; color: rgb(0,0,0);">
Спасибо!</p>
															</div>
														</td>
													</tr>
												</table>
												<!-- End Content -->
											</td>
										</tr>
									</table>
									<!-- End Body -->
								</td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<!-- Footer -->
									<table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer">
										<tr>
											<td valign="top" style="padding: 0; -webkit-border-radius: 6px;">
												<table border="0" cellpadding="10" cellspacing="0" width="100%">
													<tr>
														<td colspan="2" valign="middle" id="credit" style="padding: 0 48px 48px 48px; -webkit-border-radius: 6px; border: 0; color: rgb(0,0,0); font-family: Arial; font-size: 14px; line-height: 125%; text-align: center;">
															<p style="color: rgb(0,0,0); font-size: 14px;">Это письмо было отправлено на email: <?php echo $_POST['send_user_email'] ?><br>С нами можно связаться по адресу INFO@7-RAVENS.COM.<br>Если вы хотите отписаться от рассылки, пожалуйста, нажмите здесь.<br>Чтобы не пропустить письмо от нас, добавьте NO-REPLY@7-RAVENS.COM в адресную книгу.<br>Ознакомиться с политикой конфиденциальности и обработки персональных данных можно по ссылке</p>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<!-- End Footer -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
