<?php do_action('foton_mikado_action_before_sticky_header'); ?>

<div class="mkdf-sticky-header">
    <?php do_action( 'foton_mikado_action_after_sticky_menu_html_open' ); ?>
    <div class="mkdf-sticky-holder <?php echo esc_attr($menu_area_class); ?>">
        <?php if($sticky_header_in_grid) : ?>
        <div class="mkdf-grid">
            <?php endif; ?>
            <div class="mkdf-vertical-align-containers">
                <div class="mkdf-position-left"><!--
                 --><div class="mkdf-position-left-inner">
                        <?php if(!$hide_logo) {
                            foton_mikado_get_logo('sticky');
                        } ?>
                        <?php if($menu_area_position === 'left') : ?>
                            <?php foton_mikado_get_sticky_menu('mkdf-sticky-nav'); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($menu_area_position === 'center') : ?>
                    <div class="mkdf-position-center"><!--
                     --><div class="mkdf-position-center-inner">
                            <?php foton_mikado_get_sticky_menu('mkdf-sticky-nav'); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="mkdf-position-right"><!--
                 --><div class="mkdf-position-right-inner">
                        <?php if($menu_area_position === 'right') : ?>
                            <?php foton_mikado_get_sticky_menu('mkdf-sticky-nav'); ?>
                        <?php endif; ?>
                        <?php foton_mikado_get_sticky_header_widget_menu_area(); ?>
                    </div>
                </div>
            </div>
            <?php if($sticky_header_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
	<?php do_action( 'foton_mikado_action_before_sticky_menu_html_close' ); ?>
</div>

<?php do_action('foton_mikado_action_after_sticky_header'); ?>