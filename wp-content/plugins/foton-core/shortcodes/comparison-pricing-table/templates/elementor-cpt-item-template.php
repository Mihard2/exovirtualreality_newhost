<?php $icon_html = foton_mikado_icon_collections()->renderIcon($icon, $icon_pack, $params); ?>
<div <?php foton_mikado_class_attribute($table_classes); ?>>
	<div class="mkdf-cpt-table-holder-inner">
		<div class="mkdf-cpt-table-head-holder">
			<div class="mkdf-cpt-table-head-holder-inner">
                <div class="mkdf-cpt-icon-holder">
                    <?php echo wp_kses_post($icon_html); ?>
                </div>
				<?php if ($title !== '') : ?>
					<h4 class="mkdf-cpt-table-title"><?php echo esc_html($title); ?></h4>
				<?php endif; ?>
			</div>
		</div>

		<div class="mkdf-cpt-table-content">
			<?php echo foton_mikado_get_module_part( $content ); ?>
		</div>
		<?php if($show_button == 'yes') { ?>
			<div class="mkdf-cpt-table-footer">
				<?php echo foton_mikado_get_button_html($button_parameters); ?>
			</div>
		<?php } ?>
	</div>
</div>