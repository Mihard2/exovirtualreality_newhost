<<?php echo esc_attr($title_tag); ?> class="mkdf-accordion-title">
	<span class="mkdf-tab-title"><?php echo esc_html($title); ?></span>
    <span class="mkdf-accordion-mark">
		<span class="mkdf_icon_plus icon_plus"></span>
		<span class="mkdf_icon_minus icon_minus-06"></span>
	</span>
</<?php echo esc_attr($title_tag); ?>>
<div class="mkdf-accordion-content">
	<div class="mkdf-accordion-content-inner">
		<p class="mkdf-tab-text"><?php echo foton_mikado_get_module_part($text); ?></p>
	</div>
</div>