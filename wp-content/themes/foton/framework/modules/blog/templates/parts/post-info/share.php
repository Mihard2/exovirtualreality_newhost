<?php
$share_type = isset($share_type) ? $share_type : 'list';
?>
<?php if(foton_mikado_core_plugin_installed() && foton_mikado_options()->getOptionValue('enable_social_share') === 'yes' && foton_mikado_options()->getOptionValue('enable_social_share_on_post') === 'yes') { ?>
    <div class="mkdf-blog-share">
        <span><?php esc_html_e( 'Share', 'foton' ); ?></span>
        <?php echo foton_mikado_get_social_share_html(array('type' => $share_type)); ?>
    </div>
<?php } ?>