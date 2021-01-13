<?php

if ( ! function_exists( 'foton_mikado_sidebar_options_map' ) ) {
	function foton_mikado_sidebar_options_map() {
		
		foton_mikado_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'foton' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = foton_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'foton' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		foton_mikado_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'foton' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'foton' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => foton_mikado_get_custom_sidebars_options()
		) );
		
		$foton_custom_sidebars = foton_mikado_get_custom_sidebars();
		if ( count( $foton_custom_sidebars ) > 0 ) {
			foton_mikado_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'foton' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'foton' ),
				'parent'      => $sidebar_panel,
				'options'     => $foton_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'foton_mikado_action_options_map', 'foton_mikado_sidebar_options_map', foton_mikado_set_options_map_position( 'sidebar' ) );
}