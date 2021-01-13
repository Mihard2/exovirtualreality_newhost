<?php

if ( ! function_exists( 'foton_mikado_get_title_types_meta_boxes' ) ) {
	function foton_mikado_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'foton_mikado_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'foton' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'foton_mikado_map_title_meta' ) ) {
	function foton_mikado_map_title_meta() {
		$title_type_meta_boxes = foton_mikado_get_title_types_meta_boxes();
		
		$title_meta_box = foton_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'foton_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'foton' ),
				'name'  => 'title_meta'
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'foton' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'foton' ),
				'parent'        => $title_meta_box,
				'options'       => foton_mikado_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = foton_mikado_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'mkdf_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'mkdf_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				foton_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'foton' ),
						'description'   => esc_html__( 'Choose title type', 'foton' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				foton_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'foton' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'foton' ),
						'options'       => foton_mikado_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				foton_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'foton' ),
						'description' => esc_html__( 'Set a height for Title Area', 'foton' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				foton_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'foton' ),
						'description' => esc_html__( 'Choose a background color for title area', 'foton' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				foton_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'foton' ),
						'description' => esc_html__( 'Choose an Image for title area', 'foton' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				foton_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'foton' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'foton' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'foton' ),
							'hide'                => esc_html__( 'Hide Image', 'foton' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'foton' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'foton' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'foton' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'foton' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'foton' )
						)
					)
				);
				
				foton_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'foton' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'foton' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'foton' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'foton' ),
							'window-top'    => esc_html__( 'From Window Top', 'foton' )
						)
					)
				);
				
				foton_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'foton' ),
						'options'       => foton_mikado_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				foton_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'foton' ),
						'description' => esc_html__( 'Choose a color for title text', 'foton' ),
						'parent'      => $show_title_area_meta_container
					)
				);

                foton_mikado_create_meta_box_field(
                    array(
                        'name'        => 'mkdf_title_area_title_width_meta',
                        'type'        => 'text',
                        'label'       => esc_html__('Title Width', 'foton'),
                        'description' => esc_html__('Set a width for Title Area. Meant to be used with Standard type.', 'foton'),
                        'parent'      => $show_title_area_meta_container,
                        'args'        => array(
                            'col_width' => 2,
                            'suffix'    => '%'
                        )
                    )
                );
				
				foton_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'foton' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'foton' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				foton_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'foton' ),
						'options'       => foton_mikado_get_title_tag( true, array( 'p' => 'p', 'span' => 'span' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				foton_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'foton' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'foton' ),
						'parent'      => $show_title_area_meta_container
					)
				);

                foton_mikado_create_meta_box_field(
                    array(
                        'name'        => 'mkdf_title_area_subtitle_width_meta',
                        'type'        => 'text',
                        'label'       => esc_html__('Subtitle Width', 'foton'),
                        'description' => esc_html__('Set a width for Subtitle Area. Meant to be used with Standard type', 'foton'),
                        'parent'      => $show_title_area_meta_container,
                        'args'        => array(
                            'col_width' => 2,
                            'suffix'    => '%'
                        )
                    )
                );
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'foton_mikado_action_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_mikado_map_title_meta', 60 );
}