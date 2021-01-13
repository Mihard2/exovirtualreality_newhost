<div class="mkdf-image-with-text-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-iwt-image">
        <?php if ($image_behavior === 'lightbox') { ?>
            <a itemprop="image" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[iwt_pretty_photo]" title="<?php echo esc_attr($image['alt']); ?>">
        <?php } else if ($image_behavior === 'custom-link' && !empty($custom_link)) { ?>
	            <a itemprop="url" href="<?php echo esc_url($custom_link); ?>" target="<?php echo esc_attr($custom_link_target); ?>">
        <?php } ?>
            <?php if(is_array($image_size) && count($image_size)) : ?>
                <?php echo foton_mikado_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
            <?php else: ?>
                <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
            <?php endif; ?>
        <?php if ($image_behavior === 'lightbox' || $image_behavior === 'custom-link') { ?>
            </a>
        <?php } ?>
        <?php if ($enable_new === 'yes') { ?>
	        <div class="mkdf-iwt-enable-new"><?php esc_attr_e( 'New', 'foton-core' ); ?></div>
        <?php } ?>
    </div>
    <div class="mkdf-iwt-text-holder">
        <?php if(!empty($title)) { ?>
            <<?php echo esc_attr($title_tag); ?> class="mkdf-iwt-title" <?php echo foton_mikado_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
        <?php } ?>
		<?php if(!empty($text)) { ?>
            <p class="mkdf-iwt-text" <?php echo foton_mikado_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
        <?php } ?>
    </div>
    <?php if ($enable_bottom_buttons === 'yes') { ?>
    <div class="mkdf-iwt-bottom-buttons-holder">
        <?php if ($bakery_button_link !== "") { ?>
        <div class="mkdf-iwt-bottom-button mkdf-iwt-bottom-button-bakery">
            <a target="_blank" href="<?php echo esc_url($bakery_button_link); ?>" >
                <img src="<?php echo MIKADO_ASSETS_ROOT . "/img/bakery_logo.png"?>" alt="WP Bakery Logo">
            </a>
        </div>
        <?php } ?>
        <?php if ($elementor_button_link !== "") { ?>
        <div class="mkdf-iwt-bottom-button mkdf-iwt-bottom-button-elementor">
            <a target="_blank" href="<?php echo esc_url($elementor_button_link); ?>" >
                <img src="<?php echo MIKADO_ASSETS_ROOT . "/img/elementor_logo.png"?>" alt="Elementor Logo">
            </a>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
</div>