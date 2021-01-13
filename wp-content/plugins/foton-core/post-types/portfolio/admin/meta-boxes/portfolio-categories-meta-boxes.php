<?php

if ( ! function_exists( 'foton_mikado_portfolio_category_additional_fields' ) ) {
	function foton_mikado_portfolio_category_additional_fields() {
		
		$fields = foton_mikado_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		foton_mikado_add_taxonomy_field(
			array(
				'name'   => 'mkdf_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'foton-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'foton_mikado_action_custom_taxonomy_fields', 'foton_mikado_portfolio_category_additional_fields' );
}