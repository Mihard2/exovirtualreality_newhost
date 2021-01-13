<?php

if ( ! function_exists( 'foton_mikado_logo_meta_box_map' ) ) {
	function foton_mikado_logo_meta_box_map() {
		
		$logo_meta_box = foton_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'foton_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'foton' ),
				'name'  => 'logo_meta'
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'foton' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'foton' ),
				'parent'      => $logo_meta_box
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'foton' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'foton' ),
				'parent'      => $logo_meta_box
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'foton' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'foton' ),
				'parent'      => $logo_meta_box
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'foton' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'foton' ),
				'parent'      => $logo_meta_box
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'foton' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'foton' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_mikado_logo_meta_box_map', 47 );
}