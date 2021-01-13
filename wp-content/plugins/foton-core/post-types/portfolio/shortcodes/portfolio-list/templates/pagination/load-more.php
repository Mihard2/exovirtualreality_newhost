<?php if($query_results->max_num_pages > 1) {
	$holder_styles = $this_object->getLoadMoreStyles($params);
	?>
	<div class="mkdf-pl-loading">
		<div class="mkdf-pl-loading-bounce1"></div>
		<div class="mkdf-pl-loading-bounce2"></div>
		<div class="mkdf-pl-loading-bounce3"></div>
	</div>
	<div class="mkdf-pl-load-more-holder">
		<div class="mkdf-pl-load-more" <?php foton_mikado_inline_style($holder_styles); ?>>
			<?php 
				echo foton_mikado_get_button_html(array(
					'link' => 'javascript: void(0)',
					'size' => '',
					'text' => esc_html__('LOAD MORE', 'foton-core')
				));
			?>
		</div>
	</div>
<?php }