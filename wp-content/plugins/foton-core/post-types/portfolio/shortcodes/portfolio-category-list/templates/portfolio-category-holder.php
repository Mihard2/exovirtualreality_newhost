<div class="mkdf-portfolio-category-list-holder mkdf-grid-list <?php echo esc_attr( $holder_classes ); ?>">
	<div class="mkdf-pcl-inner mkdf-outer-space clearfix">
		<?php
			if ( ! empty( $query_results ) ) {
				foreach ( $query_results as $query ) {
					$termID            = $query->term_id;
					$params['image']   = get_term_meta( $termID, 'mkdf_portfolio_category_image_meta', true );
					$params['title']   = $query->name;
					$params['excerpt'] = $query->description;
					?>
					<article class="mkdf-pcl-item mkdf-item-space">
						<div class="mkdf-pcl-item-inner">
							<?php echo foton_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/image', '', $params ); ?>
							<div class="mkdf-pcli-text-holder">
								<div class="mkdf-pcli-text-wrapper">
									<div class="mkdf-pcli-text">
										<?php echo foton_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/title', '', $params ); ?>
										<?php echo foton_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/excerpt', '', $params ); ?>
									</div>
								</div>
							</div>
							<a itemprop="url" class="mkdf-pcli-link" href="<?php echo get_term_link( $termID ); ?>"></a>
						</div>
					</article>
				<?php }
			} else {
				echo foton_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/posts-not-found', '', $params );
			}
		?>
	</div>
</div>