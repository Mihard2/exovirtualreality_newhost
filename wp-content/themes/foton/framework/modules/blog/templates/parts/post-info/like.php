<?php if(foton_mikado_core_plugin_installed()) { ?>
    <div class="mkdf-blog-like">
        <?php if( function_exists('foton_mikado_get_like') ) foton_mikado_get_like(); ?>
    </div>
<?php } ?>