<div class="mkdf-floating-images-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-fi-inner">
        <div class="mkdf-fi-image-holder mkdf-fi-main-image-holder">
            <div class="mkdf-fi-image-wrapper" <?php echo foton_mikado_get_inline_attrs($main_image_parallax_data); ?>>
                <img class="mkdf-fi-main-image" 
                    <?php echo foton_mikado_get_inline_attrs($main_image_position_data); ?> 
                    <?php foton_mikado_inline_style($main_image_styles); ?>
                    src="<?php echo wp_get_attachment_url($main_image); ?>" 
                    alt="<?php echo get_the_title($main_image) ?>" />
            </div>
        </div>
        <div class="mkdf-fi-image-holder mkdf-fi-aux-image-holder">
            <div class="mkdf-fi-image-wrapper" <?php echo foton_mikado_get_inline_attrs($aux_image_parallax_data); ?>>
                <img class="mkdf-fi-aux-image" 
                    <?php echo foton_mikado_get_inline_attrs($aux_image_position_data); ?> 
                    <?php foton_mikado_inline_style($aux_image_styles); ?>
                    src="<?php echo wp_get_attachment_url($aux_image); ?>" 
                    alt="<?php echo get_the_title($aux_image) ?>" />
            </div>
        </div>
        <?php if (!empty($image_overlay)) { ?>
            <?php 
                $bgrnd_img_style = "background-image: url(" . wp_get_attachment_url($image_overlay) . ");"; 
            ?>
            <div class="mkdf-fi-image-overlay" <?php foton_mikado_inline_style($bgrnd_img_style); ?> <?php echo foton_mikado_get_inline_attrs($overlay_image_parallax_data);?>></div>
        <?php } ?>
    </div>
</div>
