<?php

if ( ! function_exists( 'foton_mikado_map_sidebar_meta' ) ) {
	function foton_mikado_map_sidebar_meta() {
		$mkdf_sidebar_meta_box = foton_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'foton_mikado_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'foton' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'foton' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'foton' ),
				'parent'      => $mkdf_sidebar_meta_box,
                'options'       => foton_mikado_get_custom_sidebars_options( true )
			)
		);
		
		$mkdf_custom_sidebars = foton_mikado_get_custom_sidebars();
		if ( count( $mkdf_custom_sidebars ) > 0 ) {
			foton_mikado_create_meta_box_field(
				array(
					'name'        => 'mkdf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'foton' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'foton' ),
					'parent'      => $mkdf_sidebar_meta_box,
					'options'     => $mkdf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_mikado_map_sidebar_meta', 31 );
}