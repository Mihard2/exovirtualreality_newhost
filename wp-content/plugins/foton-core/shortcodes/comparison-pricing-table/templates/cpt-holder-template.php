<?php if(is_array($features) && count($features)) : ?>
	<div <?php foton_mikado_class_attribute($holder_classes); ?>>
		<div class="mkdf-cpt-features-holder mkdf-cpt-table">
			<div class="mkdf-cpt-features-title-holder mkdf-cpt-table-head-holder">
				<div class="mkdf-cpt-table-head-holder-inner">
					<h4 class="mkdf-cpt-features-title"><?php echo wp_kses_post(preg_replace('#^<\/p>|<p>$#', '', $title)); ?></h4>
				</div>
			</div>
			<div class="mkdf-cpt-features-list-holder mkdf-cpt-table-content">
				<ul class="mkdf-cpt-features-list">
					<?php foreach($features as $feature) : ?>
						<li class="mkdf-cpt-features-item"><p><?php echo esc_html($feature); ?></p></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<?php echo do_shortcode($content); ?>

        <?php if($show_footer == 'yes') { ?>
            <div class="mkdf-cpt-footer-holder">
                <div class="mkdf-cpt-image-holder">
                    <?php echo wp_get_attachment_image($footer_image, 'full'); ?>
                </div>
                <span class="mkdf-cpt-text-holder">
                    <?php echo esc_html($footer_text); ?>
                </span>
            </div>
        <?php } ?>
	</div>
<?php endif; ?>