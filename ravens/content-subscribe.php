<div class="subscription">
  	<div class="container">
  		<div class="row">
        <?php
          $url = $_SERVER['REQUEST_URI'];
          $url_explode = explode('/', $url);
        ?>
        <script>
          jQuery(document).ready(function ($) {
            $('.wysija-input').attr('placeholder', " <?php if ($url_explode[1] == 'en'){
              echo 'Enter your E-mail';
            }else{
              echo 'Напишите Ваш E-mail';
            } ?> ");

            <?php
              if ( $url_explode[1] != 'en' ) {
                ?>
                $('.widget_wysija_cont .wysija-submit').attr('value', "Подписаться");
                <?php
              }
            ?>
          });
          
        </script>
  			<div class="col-12">
          <?php dynamic_sidebar('mailpoet_newsletter_form'); ?>
  			</div>
  		</div>
  	</div>
  </div>