<?php

if ( ! function_exists( 'foton_mikado_breadcrumbs_title_type_options_meta_boxes' ) ) {
	function foton_mikado_breadcrumbs_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_breadcrumbs_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Breadcrumbs Color', 'foton' ),
				'description' => esc_html__( 'Choose a color for breadcrumbs text', 'foton' ),
				'parent'      => $show_title_area_meta_container
			)
		);
	}
	
	add_action( 'foton_mikado_action_additional_title_area_meta_boxes', 'foton_mikado_breadcrumbs_title_type_options_meta_boxes' );
}