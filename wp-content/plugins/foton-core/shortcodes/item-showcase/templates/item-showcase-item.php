<div class="mkdf-is-item <?php echo esc_attr($showcase_item_class); ?>">
	<div class="mkdf-item-inner">
        <?php if ( $item_position == 'right') { ?>
            <div class="mkdf-is-icon">
				<?php if(!empty($custom_icon)) : ?>
					<?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
				<?php else: ?>
					<?php echo foton_mikado_execute_shortcode('mkdf_icon', $icon_params); ?>
				<?php endif; ?>
            </div>
        <?php } ?>
        <div class="mkdf-is-content">
		<?php if (!empty($item_title)) { ?>
			<<?php echo esc_attr($item_title_tag); ?> class="mkdf-is-title" <?php echo foton_mikado_get_inline_style($item_title_styles); ?>>
				<?php if (!empty($item_link)) { ?><a href="<?php echo esc_url($item_link); ?>" target="<?php echo esc_attr($item_target); ?>"><?php } ?>
				<?php echo esc_html($item_title); ?>
				<?php if (!empty($item_link)) { ?></a><?php } ?>
			</<?php echo esc_attr($item_title_tag); ?>>
		<?php } ?>
		<?php if (!empty($item_text)) { ?>
			<p class="mkdf-is-text" <?php echo foton_mikado_get_inline_style($item_text_styles); ?>><?php echo esc_html($item_text); ?></p>
		<?php } ?>
        </div>
        <?php if($item_position == 'left') { ?>
			<div class="mkdf-is-icon">
			<?php if(!empty($custom_icon)) : ?>
				<?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
			<?php else: ?>
				<?php echo foton_mikado_execute_shortcode('mkdf_icon', $icon_params); ?>
			<?php endif; ?>
			</div>
    <?php } ?>
	</div>
</div>