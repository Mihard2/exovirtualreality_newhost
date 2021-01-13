<?php

if ( ! function_exists( 'foton_mikado_get_hide_dep_for_header_vertical_area_meta_boxes' ) ) {
	function foton_mikado_get_hide_dep_for_header_vertical_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'foton_mikado_filter_header_vertical_hide_meta_boxes', $hide_dep_options = array( '' => '' ) );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'foton_mikado_header_vertical_area_meta_options_map' ) ) {
	function foton_mikado_header_vertical_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = foton_mikado_get_hide_dep_for_header_vertical_area_meta_boxes();
		
		$header_vertical_area_meta_container = foton_mikado_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'header_vertical_area_container',
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta' => $hide_dep_options
					)
				)
			)
		);
		
		foton_mikado_add_admin_section_title(
			array(
				'parent' => $header_vertical_area_meta_container,
				'name'   => 'vertical_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'foton' )
			)
		);
		
		$foton_custom_sidebars = foton_mikado_get_custom_sidebars();
		if ( count( $foton_custom_sidebars ) > 0 ) {
			foton_mikado_create_meta_box_field(
				array(
					'name'        => 'mkdf_custom_vertical_area_sidebar_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area in Vertical area', 'foton' ),
					'description' => esc_html__( 'Choose custom widget area to display in vertical menu"', 'foton' ),
					'parent'      => $header_vertical_area_meta_container,
					'options'     => $foton_custom_sidebars
				)
			);
		}
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_vertical_header_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'foton' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'foton' ),
				'parent'      => $header_vertical_area_meta_container
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_vertical_header_background_image_meta',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'foton' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'foton' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_disable_vertical_header_background_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Background Image', 'foton' ),
				'description'   => esc_html__( 'Enabling this option will hide background image in Vertical Menu', 'foton' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_vertical_header_shadow_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Shadow', 'foton' ),
				'description'   => esc_html__( 'Set shadow on vertical menu', 'foton' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => foton_mikado_get_yes_no_select_array()
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_vertical_header_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Vertical Area Border', 'foton' ),
				'description'   => esc_html__( 'Set border on vertical area', 'foton' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => foton_mikado_get_yes_no_select_array()
			)
		);
		
		$vertical_header_border_container = foton_mikado_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'vertical_header_border_container',
				'parent'          => $header_vertical_area_meta_container,
				'dependency' => array(
					'show' => array(
						'mkdf_vertical_header_border_meta'  => 'yes'
					)
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_vertical_header_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'foton' ),
				'description' => esc_html__( 'Choose color of border', 'foton' ),
				'parent'      => $vertical_header_border_container
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_vertical_header_center_content_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Center Content', 'foton' ),
				'description'   => esc_html__( 'Set content in vertical center', 'foton' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => foton_mikado_get_yes_no_select_array()
			)
		);
	}
	
	add_action( 'foton_mikado_action_additional_header_area_meta_boxes_map', 'foton_mikado_header_vertical_area_meta_options_map', 10, 1 );
}