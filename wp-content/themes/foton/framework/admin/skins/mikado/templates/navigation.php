<div class="mkdf-tabs-navigation-wrapper">
    <ul class="nav nav-tabs">
        <?php
        foreach (foton_mikado_options()->adminPages as $key => $page ) {
            $slug = "";
            if (!empty($page->slug)) $slug = "_tab".$page->slug;
            ?>
            <li<?php if ($page->slug == $tab) echo " class=\"active\""; ?>>
                <a href="<?php echo esc_url(get_admin_url().'admin.php?page='.MIKADO_OPTIONS_SLUG.$slug); ?>">
                    <?php if($page->icon !== '') { ?>
                        <i class="<?php echo esc_attr($page->icon); ?> mkdf-tooltip mkdf-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php echo esc_attr($page->title); ?>"></i>
                    <?php } ?>
                    <span><?php echo esc_html($page->title); ?></span>
                </a>
            </li>
        <?php
        }
        ?>
	    <?php if (foton_mikado_core_plugin_installed()) { ?>
			<li <?php if($isBackupOptionsPage) { echo "class='active'"; } ?>><a href="<?php echo esc_url(get_admin_url().'admin.php?page='.MIKADO_OPTIONS_SLUG.'_backup_options'); ?>"><i class="fa fa-download mkdf-tooltip mkdf-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php esc_attr_e('Backup Options','foton'); ?>"></i><span><?php esc_html_e('Backup Options','foton'); ?></span></a></li>
	        <li <?php if($isImportPage) { echo "class='active'"; } ?>><a href="<?php echo esc_url(get_admin_url().'admin.php?page='.MIKADO_OPTIONS_SLUG.'_tabimport'); ?>"><i class="fa fa-download mkdf-tooltip mkdf-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php esc_attr_e('Import','foton'); ?>"></i><span><?php esc_html_e('Import','foton'); ?></span></a></li>
	    <?php } ?>
    </ul>
</div>