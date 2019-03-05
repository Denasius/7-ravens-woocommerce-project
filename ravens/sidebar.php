<?php if ( !is_search() ) : ?>

	<div class="col-12 col-lg-3">
		<div class="sidebar">
			<div class="panel"><i class="fa fa-bars" aria-hidden="true"></i></div>
	    <?php dynamic_sidebar( 'menu_sidebar' ) ?>

			<div class="filters">
				<div class="prdt-right">
					<div class="w_sidebar">
						<section  class="sky-form">
							<h4><?php pll_e('Дизайнеры'); ?> <span class="res"><?php pll_e('Сбросить'); ?></span></h4>
							<div id="scroll-bar" class="row scroll-pane">
								<div class="col-12">
									<ul>
										<?php dynamic_sidebar('filer_designers'); ?>
									</ul>
								</div>
							</div>
						</section>

						<section  class="sky-form">
							<h4><?php pll_e('Цвет'); ?> <span class="res"><?php pll_e('Сбросить'); ?></span></h4>
							<div id="scroll-bar" class="row scroll-pane">
								<div class="col-12">								
									<ul>
										<?php dynamic_sidebar('filter_by_colors'); ?>
									</ul>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>