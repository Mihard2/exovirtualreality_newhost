<?php do_action('foton_mikado_action_before_page_header'); ?>

<header class="mkdf-page-header">
	<?php do_action('foton_mikado_action_after_page_header_html_open'); ?>
	
	<?php if($show_fixed_wrapper) : ?>
		<div class="mkdf-fixed-wrapper">
	<?php endif; ?>
			
	<div class="mkdf-menu-area">
		<?php do_action('foton_mikado_action_after_header_menu_area_html_open'); ?>
		
		<?php if($menu_area_in_grid) : ?>
			<div class="mkdf-grid">
		<?php endif; ?>
				
			<div class="mkdf-vertical-align-containers">
				<div class="mkdf-position-left"><!--
				 --><div class="mkdf-position-left-inner">
						<?php if(!$hide_logo) {
							foton_mikado_get_logo();
						} ?>
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
				
		<?php if($menu_area_in_grid) : ?>
			</div>
		<?php endif; ?>
	</div>
			
	<?php if($show_fixed_wrapper) { ?>
		</div>
	<?php } ?>
	
	<?php if($show_sticky) {
		foton_mikado_get_sticky_header('minimal', 'header/types/header-minimal');
	} ?>
	
	<?php do_action('foton_mikado_action_before_page_header_html_close'); ?>
</header>