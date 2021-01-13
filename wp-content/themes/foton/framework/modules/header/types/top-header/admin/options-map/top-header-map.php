<?php

if ( ! function_exists( 'foton_mikado_get_hide_dep_for_top_header_options' ) ) {
	function foton_mikado_get_hide_dep_for_top_header_options() {
		$hide_dep_options = apply_filters( 'foton_mikado_filter_top_header_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'foton_mikado_header_top_options_map' ) ) {
	function foton_mikado_header_top_options_map( $panel_header ) {
		$hide_dep_options = foton_mikado_get_hide_dep_for_top_header_options();
		
		$top_header_container = foton_mikado_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $panel_header,
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'top_bar',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Top Bar', 'foton' ),
				'description'   => esc_html__( 'Enabling this option will show top bar area', 'foton' ),
				'parent'        => $top_header_container,
			)
		);
		
		$top_bar_container = foton_mikado_add_admin_container(
			array(
				'name'            => 'top_bar_container',
				'parent'          => $top_header_container,
				'dependency' => array(
					'hide' => array(
						'top_bar'  => 'no'
					)
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'top_bar_in_grid',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Top Bar in Grid', 'foton' ),
				'description'   => esc_html__( 'Set top bar content to be in grid', 'foton' ),
				'parent'        => $top_bar_container
			)
		);
		
		$top_bar_in_grid_container = foton_mikado_add_admin_container(
			array(
				'name'            => 'top_bar_in_grid_container',
				'parent'          => $top_bar_container,
				'dependency' => array(
					'hide' => array(
						'top_bar_in_grid'  => 'no'
					)
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'        => 'top_bar_grid_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Grid Background Color', 'foton' ),
				'description' => esc_html__( 'Set grid background color for top bar', 'foton' ),
				'parent'      => $top_bar_in_grid_container
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'        => 'top_bar_grid_background_transparency',
				'type'        => 'text',
				'label'       => esc_html__( 'Grid Background Transparency', 'foton' ),
				'description' => esc_html__( 'Set grid background transparency for top bar', 'foton' ),
				'parent'      => $top_bar_in_grid_container,
				'args'        => array( 'col_width' => 3 )
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'        => 'top_bar_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'foton' ),
				'description' => esc_html__( 'Set background color for top bar', 'foton' ),
				'parent'      => $top_bar_container
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'        => 'top_bar_background_transparency',
				'type'        => 'text',
				'label'       => esc_html__( 'Background Transparency', 'foton' ),
				'description' => esc_html__( 'Set background transparency for top bar', 'foton' ),
				'parent'      => $top_bar_container,
				'args'        => array( 'col_width' => 3 )
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'top_bar_border',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Top Bar Border', 'foton' ),
				'description'   => esc_html__( 'Set top bar border', 'foton' ),
				'parent'        => $top_bar_container
			)
		);
		
		$top_bar_border_container = foton_mikado_add_admin_container(
			array(
				'name'            => 'top_bar_border_container',
				'parent'          => $top_bar_container,
				'dependency' => array(
					'hide' => array(
						'top_bar_border'  => 'no'
					)
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'        => 'top_bar_border_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Top Bar Border Color', 'foton' ),
				'description' => esc_html__( 'Set border color for top bar', 'foton' ),
				'parent'      => $top_bar_border_container
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'        => 'top_bar_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Top Bar Height', 'foton' ),
				'description' => esc_html__( 'Enter top bar height (Default is 46px)', 'foton' ),
				'parent'      => $top_bar_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'   => 'top_bar_side_padding',
				'type'   => 'text',
				'label'  => esc_html__( 'Top Bar Side Padding', 'foton' ),
				'parent' => $top_bar_container,
				'args'   => array(
					'col_width' => 2,
					'suffix'    => esc_html__( 'px or %', 'foton' )
				)
			)
		);
	}
	
	add_action( 'foton_mikado_action_header_top_options_map', 'foton_mikado_header_top_options_map', 10, 1 );
}