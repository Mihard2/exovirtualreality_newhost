<div class="wrap about-wrap mkdf-core-dashboard">
	<h1 class="mkdf-cd-title"><?php esc_html_e('Import', 'foton-core'); ?></h1>
	<h4 class="mkdf-cd-subtitle"><?php esc_html_e('You can import the theme demo content here.', 'foton-core'); ?></h4>
	<div class="mkdf-core-dashboard-inner">
		<div class="mkdf-core-dashboard-column">
			<div class="mkdf-core-dashboard-box mkdf-cd-import-box">
				<?php
				if(!empty(FotonCoreDashboard::get_instance()->get_purchased_code())) {?>
					<div class="mkdf-cd-box-title-holder">
						<h3><?php esc_html_e('Import demo content', 'foton-core'); ?></h3>
						<p><?php esc_html_e('Start the demo import process by choosing which content you wish to import. ', 'foton-core'); ?></p>
					</div>
					<div class="mkdf-cd-box-inner">
						<form method="post" class="mkdf-cd-import-form" data-confirm-message="<?php esc_attr_e('Are you sure, you want to import Demo Data now?', 'foton-core'); ?>">
							<div class="mkdf-cd-box-form-section">
								<?php echo foton_core_get_module_template_part('core-dashboard/sub-pages/import', 'notice', ''); ?>
								<label class="mkdf-cd-label"><?php esc_html_e('Select Demo to import', 'foton-core'); ?></label>
								<select name="demo" class="mkdf-import-demo">
									<option value="foton-wpbakery" data-thumb="<?php echo FOTON_CORE_URL_PATH . '/core-dashboard/assets/img/demo.png'; ?>"><?php esc_html_e('Foton', 'foton-core'); ?></option>
									<option value="foton-elementor" data-thumb="<?php echo FOTON_CORE_URL_PATH . '/core-dashboard/assets/img/demo-elementor.png'; ?>"><?php esc_html_e('Foton Elementor', 'foton-core'); ?></option>
								</select>
							</div>
							<div class="mkdf-cd-box-form-section mkdf-cd-box-form-section-columns">
								<div class="mkdf-cd-box-form-section-column">
									<label class="mkdf-cd-label"><?php esc_html_e('Select Import Option', 'foton-core'); ?></label>
									<select name="import_option" class="mkdf-cd-import-option" data-option-name="import_option" data-option-type="selectbox">
										<option value="none"><?php esc_html_e('Please Select', 'foton-core'); ?></option>
										<option value="complete"><?php esc_html_e('All', 'foton-core'); ?></option>
										<option value="content"><?php esc_html_e('Content', 'foton-core'); ?></option>
										<option value="widgets"><?php esc_html_e('Widgets', 'foton-core'); ?></option>
										<option value="options"><?php esc_html_e('Options', 'foton-core'); ?></option>
<!--										<option value="single-page">--><?php //esc_html_e('Single Page', 'foton-core'); ?><!--</option>-->
									</select>
								</div>
								<div class="mkdf-cd-box-form-section-column">
									<label class="mkdf-cd-label"><?php esc_html_e('Import Attachments', 'foton-core'); ?></label>
									<div class="mkdf-cd-switch">
										<label class="mkdf-cd-cb-enable selected"><span><?php esc_html_e('Yes', 'foton-core'); ?></span></label>
										<label class="mkdf-cd-cb-disable"><span><?php esc_html_e('No', 'foton-core'); ?></span></label>
										<input type="checkbox" class="mkdf-cd-import-attachments checkbox" name="import_attachments" value="1" checked="checked">
									</div>
								</div>
							</div>
							<div class="mkdf-cd-box-form-section mkdf-cd-box-form-section-dependency"></div>
							<div class="mkdf-cd-box-form-section mkdf-cd-box-form-section-progress">
								<span><?php esc_html_e('The import process may take some time. Please be patient.', 'foton-core') ?></span>
								<progress id="mkdf-progress-bar" value="0" max="100"></progress>
								<span class="mkdf-cd-progress-percent"><?php esc_attr_e('0%', 'foton-core'); ?></span>
							</div>
							<div class="mkdf-cd-box-form-section mkdf-cd-box-form-last-section">
								<span class="mkdf-cd-import-is-completed"><?php esc_html_e('Import is completed', 'foton-core') ?></span>
								<input type="submit" class="mkdf-cd-button" value="<?php esc_attr_e('Import', 'foton-core'); ?>" name="import" id="mkdf-<?php echo esc_attr($submit); ?>" />
							</div>
							<?php wp_nonce_field("mkdf_cd_import_nonce","mkdf_cd_import_nonce") ?>
						</form>
					</div>
				<?php } else { ?>
					<div class="mkdf-cd-box-title-holder">
						<h3><?php esc_html_e('Import demo content', 'foton-core'); ?></h3>
						<p><?php esc_html_e('Please activate your copy of the theme by registering the theme so you could proceed with the demo import process. ', 'foton-core'); ?></p>
					</div>
					<div class="mkdf-cd-box-inner">
						<div class="mkdf-cd-box-section">
							<div class="mkdf-cd-field-holder">
								<a href="<?php echo admin_url('admin.php?page=foton_core_dashboard'); ?>" class="mkdf-cd-button"><?php esc_attr_e('Activate your theme copy', 'foton-core'); ?></a>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>