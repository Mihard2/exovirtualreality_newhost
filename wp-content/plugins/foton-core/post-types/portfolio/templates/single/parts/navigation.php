<?php if(foton_mikado_options()->getOptionValue('portfolio_single_hide_pagination') !== 'yes') : ?>
    <?php
    $back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
    $nav_same_category = foton_mikado_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';
    ?>
    <div class="mkdf-ps-navigation">
        <?php if(get_previous_post() !== '') : ?>
            <div class="mkdf-ps-prev">
                <?php if($nav_same_category) {
	                previous_post_link('%link','<span class="arrow_carrot-left"></span>', true, '', 'portfolio-category');
                } else {
	                previous_post_link('%link','<span class="arrow_carrot-left"></span>');
                } ?>
                <span><?php esc_html_e( 'Previous Project', 'foton' ); ?></span>
            </div>
        <?php endif; ?>

        <?php if($back_to_link !== '') : ?>
            <div class="mkdf-ps-back-btn">
                <a itemprop="url" href="<?php echo esc_url(get_permalink($back_to_link)); ?>">
                    <span class="icon_grid-2x2"></span>
                </a>
            </div>
        <?php endif; ?>

        <?php if(get_next_post() !== '') : ?>
            <div class="mkdf-ps-next">
                <span><?php esc_html_e( 'Next Project', 'foton' ); ?></span>
                <?php if($nav_same_category) {
                    next_post_link('%link', '<span class="arrow_carrot-right"></span>', true, '', 'portfolio-category');
                } else {
                    next_post_link('%link', '<span class="arrow_carrot-right"></span>');
                } ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>