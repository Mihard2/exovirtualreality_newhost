<?php

if ( ! function_exists( 'foton_mikado_sticky_header_meta_boxes_options_map' ) ) {
	function foton_mikado_sticky_header_meta_boxes_options_map( $header_meta_box ) {
		
		$sticky_amount_container = foton_mikado_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'sticky_amount_container_meta_container',
				'dependency' => array(
					'hide' => array(
						'mkdf_header_behaviour_meta'  => array( '', 'no-behavior','fixed-on-scroll','sticky-header-on-scroll-up' )
					)
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_scroll_amount_for_sticky_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Scroll Amount for Sticky Header Appearance', 'foton' ),
				'description' => esc_html__( 'Define scroll amount for sticky header appearance', 'foton' ),
				'parent'      => $sticky_amount_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
		
		$foton_custom_sidebars = foton_mikado_get_custom_sidebars();
		if ( count( $foton_custom_sidebars ) > 0 ) {
			foton_mikado_create_meta_box_field(
				array(
					'name'        => 'mkdf_custom_sticky_menu_area_sidebar_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area In Sticky Header Menu Area', 'foton' ),
					'description' => esc_html__( 'Choose custom widget area to display in sticky header menu area"', 'foton' ),
					'parent'      => $header_meta_box,
					'options'     => $foton_custom_sidebars,
					'dependency' => array(
						'show' => array(
							'mkdf_header_behaviour_meta' => array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' )
						)
					)
				)
			);
		}
	}
	
	add_action( 'foton_mikado_action_additional_header_area_meta_boxes_map', 'foton_mikado_sticky_header_meta_boxes_options_map', 8, 1 );
}