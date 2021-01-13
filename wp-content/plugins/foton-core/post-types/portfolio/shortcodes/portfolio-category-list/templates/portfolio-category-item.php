<article class="mkdf-pcl-item mkdf-item-space">
	<div class="mkdf-pcl-item-inner">
		<?php echo foton_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-category-list', 'parts/image', '', $params); ?>
		
		<div class="mkdf-pcli-text-holder">
			<div class="mkdf-pcli-text-wrapper">
				<div class="mkdf-pcli-text">
					<?php echo foton_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-category-list', 'parts/title', '', $params); ?>
				</div>
			</div>
		</div>
		
		<a itemprop="url" class="mkdf-pcl-link" href="<?php echo get_the_permalink(); ?>"></a>
	</div>
</article>