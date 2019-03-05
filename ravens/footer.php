<footer class="page-footer" role="contentinfo">  
    <div class="page-footer__container">
      <div class="container">
      	<div class="row">
          <?php dynamic_sidebar('menu_bottom_footer') ?>
          <?php dynamic_sidebar('menu_bottom_footer_about_company') ?>
      		<?php if (function_exists('dynamic_sidebar')) : ?>
            <div class="col-2 col-md-6 col-lg-3 offset-lg-3">
              <ul class="social-list">
                <?php dynamic_sidebar( 'socials' ) ?>
              </ul>
            </div>
          <?php endif; ?>
      	</div>
      </div>
    </div>
  </footer>
<?php if ( !is_user_logged_in() ) : ?>
  <script type="text/javascript">
    jQuery(document).ready(function ($) {
      $('#disabled_if_user_non_logged, #disabled_if_user_non_logged_order_end').on('click', function (event) {
        event.preventDefault();
        $('.popup-reg').toggleClass('activate-registration');
        $('.overlay_for_reg').toggleClass('activate-overlay');
      });
    });
  </script>
<?php endif; ?>
  <?php wp_footer(); ?>

</body>

</html>