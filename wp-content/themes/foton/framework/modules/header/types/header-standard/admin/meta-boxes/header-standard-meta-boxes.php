<?php

if ( ! function_exists( 'foton_mikado_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function foton_mikado_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'foton_mikado_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'foton_mikado_header_standard_meta_map' ) ) {
	function foton_mikado_header_standard_meta_map( $parent ) {
		$hide_dep_options = foton_mikado_get_hide_dep_for_header_standard_meta_boxes();
		
		foton_mikado_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'mkdf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'foton' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'foton' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'foton' ),
					'left'   => esc_html__( 'Left', 'foton' ),
					'right'  => esc_html__( 'Right', 'foton' ),
					'center' => esc_html__( 'Center', 'foton' )
				),
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'foton_mikado_action_additional_header_area_meta_boxes_map', 'foton_mikado_header_standard_meta_map' );
}