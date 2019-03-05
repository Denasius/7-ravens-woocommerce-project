<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Скоро открытие</title>
	<style>
	@font-face {
	  font-family: 'Roboto';
	  font-style: normal;
	  font-weight: 400;
	  font-display: swap;
	  src: local("Roboto-Regular"), local("Roboto-Regular"), url("./assets/fonts/Roboto-Regular.woff2") format("woff2"), url("./assets/fonts/Roboto-Regular.woff") format("woff"), url("./assets/fonts/Roboto-Regular.ttf") format("truetype"); 
		}
		body{
			font-family: "Roboto";
		}
		.wrapper{
			width: 100%;
			text-align: center;
		}
		.wrapper img{
			width: 100%;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<img src="<?php echo get_template_directory_uri(); ?>/assets/img/0001_1.jpg" alt="Логотип">
	</div>
</body>
</html>