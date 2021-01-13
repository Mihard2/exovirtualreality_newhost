<div class="mkdf-blog-list-holder mkdf-grid-list mkdf-grid-masonry-list mkdf-disable-bottom-space <?php echo esc_attr( $holder_classes ); ?>" <?php echo wp_kses( $holder_data, array( 'data' ) ); ?>>
	<div class="mkdf-bl-wrapper mkdf-outer-space">
		<ul class="mkdf-blog-list mkdf-masonry-list-wrapper">
			<li class="mkdf-masonry-grid-sizer"></li>
			<li class="mkdf-masonry-grid-gutter"></li>
			<?php
			if ( $query_result->have_posts() ):
				while ( $query_result->have_posts() ) : $query_result->the_post();
					foton_mikado_get_module_template_part( 'shortcodes/blog-list/layout-collections/post', 'blog', $type, $params );
				endwhile;
			else:
				foton_mikado_get_module_template_part( 'templates/parts/no-posts', 'blog', '', $params );
			endif;
			
			wp_reset_postdata();
			?>
		</ul>
	</div>
	<?php foton_mikado_get_module_template_part( 'templates/parts/pagination/' . $params['pagination_type'], 'blog', '', $params ); ?>
</div>