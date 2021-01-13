<div class="mkdf-pl-holder mkdf-grid-list mkdf-grid-masonry-list mkdf-disable-bottom-space <?php echo esc_attr( $holder_classes ) ?>">
	<div class="mkdf-pl-outer mkdf-outer-space mkdf-masonry-list-wrapper">
		<div class="mkdf-masonry-grid-sizer"></div>
		<div class="mkdf-masonry-grid-gutter"></div>
		<?php if ( $query_result->have_posts() ): while ( $query_result->have_posts() ) : $query_result->the_post();
			echo foton_mikado_get_woo_shortcode_module_template_part( 'templates/parts/' . $info_position, 'product-list', '', $params );
		endwhile;
		else:
			foton_mikado_get_module_template_part( 'templates/parts/no-posts', 'woocommerce', '', $params );
		endif;
		wp_reset_postdata();
		?>
	</div>
</div>