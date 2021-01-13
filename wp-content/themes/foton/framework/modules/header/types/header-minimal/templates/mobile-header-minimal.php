<?php do_action('foton_mikado_action_before_mobile_header'); ?>

<header class="mkdf-mobile-header">
	<?php do_action('foton_mikado_action_after_mobile_header_html_open'); ?>
	
	<div class="mkdf-mobile-header-inner">
		<div class="mkdf-mobile-header-holder">
			<div class="mkdf-grid">
				<div class="mkdf-vertical-align-containers">
					<div class="mkdf-position-left"><!--
					 --><div class="mkdf-position-left-inner">
							<?php foton_mikado_get_mobile_logo(); ?>
						</div>
					</div>
					<div class="mkdf-position-right"><!--
					 --><div class="mkdf-position-right-inner">
							<a href="javascript:void(0)" <?php foton_mikado_class_attribute( $fullscreen_menu_icon_class ); ?>>
								<span class="mkdf-fullscreen-menu-close-icon">
									<?php echo foton_mikado_get_icon_sources_html( 'fullscreen_menu', true ); ?>
								</span>
								<span class="mkdf-fullscreen-menu-opener-icon">
                                    <?php echo foton_mikado_get_icon_sources_html( 'fullscreen_menu' ); ?>
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php do_action('foton_mikado_action_before_mobile_header_html_close'); ?>
</header>

<?php do_action('foton_mikado_action_after_mobile_header'); ?>