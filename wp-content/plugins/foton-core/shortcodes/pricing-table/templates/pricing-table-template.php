<div class="mkdf-price-table mkdf-item-space <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-pt-inner" <?php echo foton_mikado_get_inline_style($holder_styles); ?>>
        <ul>
            <li class="mkdf-pt-prices">
                <sup class="mkdf-pt-value" <?php echo foton_mikado_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></sup>
                <span class="mkdf-pt-price" <?php echo foton_mikado_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
                <span class="mkdf-pt-mark" <?php echo foton_mikado_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></span>
            </li>
            <li class="mkdf-pt-content-holder">
                <ul>
                    <li class="mkdf-pt-title-holder">
                        <span class="mkdf-pt-title" <?php echo foton_mikado_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></span>
                    </li>
                    <li class="mkdf-pt-additional-title-holder">
                        <span class="mkdf-pt-additional-title" <?php echo foton_mikado_get_inline_style($additional_title_styles); ?>><?php echo esc_html($additional_title); ?></span>
                    </li>
                    <li class="mkdf-pt-content">
                        <?php echo do_shortcode($content); ?>
                    </li>
                    <?php
                    if (!empty($button_text)) { ?>
                        <li class="mkdf-pt-button">
                            <?php echo foton_mikado_get_button_html(array(
                                'link'                   => $link,
                                'text'                   => $button_text,
                                'type'                   => $button_type,
                                'size'                   => 'large',
                                'color'                  => $button_color,
                                'hover_color'            => $button_hover_color,
                                'background_color'       => $button_background_color,
                                'hover_background_color' => $button_hover_background_color,
                                'border_color'           => $button_border_color,
                                'hover_border_color'     => $button_hover_border_color,
                            )); ?>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        </ul>
    </div>
</div>