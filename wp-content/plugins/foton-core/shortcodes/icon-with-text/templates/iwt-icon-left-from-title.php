<div class="mkdf-iwt">
    <div <?php foton_mikado_class_attribute($inner_holder_classes); ?> <?php foton_mikado_inline_style($padding_styles); ?>>
        <div class="mkdf-iwt-content" <?php foton_mikado_inline_style($content_styles); ?>>
            <?php if(!empty($title)) { ?>
                <<?php echo esc_attr($title_tag); ?> class="mkdf-iwt-title" <?php foton_mikado_inline_style($title_styles); ?>>
                    <?php if(!empty($link)) : ?>
                        <a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
                    <?php endif; ?>
                        <span class="mkdf-iwt-icon">
                            <?php if(!empty($custom_icon)) : ?>
                                <?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
                                <?php if(!empty($custom_hover_icon)) : ?>
                                    <?php echo wp_get_attachment_image($custom_hover_icon, 'full'); ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php echo foton_core_get_shortcode_module_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
                            <?php endif; ?>
                        </span>
                        <span class="mkdf-iwt-title-text"><?php echo esc_html($title); ?></span>
                    <?php if(!empty($link)) : ?>
                        </a>
                    <?php endif; ?>
                </<?php echo esc_attr($title_tag); ?>>
            <?php } ?>
            <?php if(!empty($text)) { ?>
                <p class="mkdf-iwt-text" <?php foton_mikado_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
            <?php } ?>
        </div>
    </div>
</div>