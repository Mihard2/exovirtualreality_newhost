<div class="mkdf-footer-bottom-holder">
    <div class="mkdf-footer-bottom-inner <?php echo esc_attr($footer_bottom_grid_class); ?>">
        <div class="mkdf-grid-row <?php echo esc_attr($footer_bottom_classes); ?>">
            <?php for ($i = 0; $i < sizeof($footer_bottom_columns); $i++) { ?>
                <div class="mkdf-grid-col-<?php echo esc_attr($footer_bottom_columns[$i]); ?>">
                    <?php
                    if (is_active_sidebar('footer_bottom_column_' . ($i + 1))) {
                        dynamic_sidebar('footer_bottom_column_' . ($i + 1));
                    }
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>