<div
    class="swiper-container mkdf-horizontal-layer-slider full-page" <?php foton_mikado_inline_style($slider_styles); ?> <?php echo foton_mikado_get_inline_attrs($data_params); ?>>
    <div class="swiper-wrapper">
        <?php foreach ($horizontal_layers as $layer) :
            $slide_styles = array();
            $slide_styles[] = 'background-image: url(' . wp_get_attachment_url($layer['background_image']) . ')';
            ?>

            <div class="swiper-slide" <?php foton_mikado_inline_style($slide_styles);?>>
                <?php if (!empty($layer['parallax_image'])) { ?>
                    <div class="mkdf-slide-parallax-image-holder">
                        <div class="mkdf-slide-parallax-image" data-swiper-parallax="-50%">
                            <?php echo wp_get_attachment_image($layer['parallax_image'], 'full'); ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if (!empty($layer['link'])) { ?>
                    <a href="<?php echo esc_url($layer['link']) ?>"
                       target="<?php echo esc_attr($layer['target']) ?>">
                    </a>
                <?php } ?>
            </div>

        <?php endforeach; ?>
    </div>

    <div class="swiper-navigation">
        <span class="mkdf-swiper-button-prev mkdf-swiper-button"><span class="arrow_carrot-left"></span></span>
        <span class="mkdf-swiper-button-next mkdf-swiper-button"><span class="arrow_carrot-right"></span></span>
    </div>

</div>