<?php

if ( ! function_exists( 'foton_mikado_map_general_meta' ) ) {
	function foton_mikado_map_general_meta() {
		
		$general_meta_box = foton_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'foton_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'foton' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'foton' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'foton' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'foton' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'foton' ),
				'parent'        => $general_meta_box
			)
		);
		
		$mkdf_content_padding_group = foton_mikado_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Styles', 'foton' ),
				'description' => esc_html__( 'Define styles for Content area', 'foton' ),
				'parent'      => $general_meta_box
			)
		);
		
			$mkdf_content_padding_row = foton_mikado_add_admin_row(
				array(
					'name'   => 'mkdf_content_padding_row',
					'parent' => $mkdf_content_padding_group
				)
			);
			
				foton_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_page_background_color_meta',
						'type'        => 'colorsimple',
						'label'       => esc_html__( 'Page Background Color', 'foton' ),
						'parent'      => $mkdf_content_padding_row
					)
				);
				
				foton_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_page_background_image_meta',
						'type'          => 'imagesimple',
						'label'         => esc_html__( 'Page Background Image', 'foton' ),
						'parent'        => $mkdf_content_padding_row
					)
				);

				foton_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_page_background_repeat_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Background Image Repeat', 'foton' ),
						'options'       => foton_mikado_get_yes_no_select_array(),
						'parent'        => $mkdf_content_padding_row
					)
				);
		
			$mkdf_content_padding_row_1 = foton_mikado_add_admin_row(
				array(
					'name'   => 'mkdf_content_padding_row_1',
					'next'   => true,
					'parent' => $mkdf_content_padding_group
				)
			);
		
				foton_mikado_create_meta_box_field(
					array(
						'name'   => 'mkdf_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (eg. 10px 5px 10px 5px)', 'foton' ),
						'parent' => $mkdf_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
				
				foton_mikado_create_meta_box_field(
					array(
						'name'    => 'mkdf_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (eg. 10px 5px 10px 5px)', 'foton' ),
						'parent'  => $mkdf_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);

		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_page_dynamic_background_color',
				'type'        => 'yesno',
				'default_value' => 'no',
				'label'       => esc_html__( 'Dynamic Background Color', 'foton' ),
				'description' => esc_html__( 'Background color will change depending on the value set on the corresponding Row element - currently in viewport.', 'foton' ),
				'parent'      => $general_meta_box
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'foton' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'foton' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'foton' ),
					'mkdf-grid-1300' => esc_html__( '1300px', 'foton' ),
					'mkdf-grid-1200' => esc_html__( '1200px', 'foton' ),
					'mkdf-grid-1100' => esc_html__( '1100px', 'foton' ),
					'mkdf-grid-1000' => esc_html__( '1000px', 'foton' ),
					'mkdf-grid-800'  => esc_html__( '800px', 'foton' )
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_page_grid_space_meta',
				'type'        => 'select',
				'default_value' => '',
				'label'       => esc_html__( 'Grid Layout Space', 'foton' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for your page', 'foton' ),
				'options'     => foton_mikado_get_space_between_items_array( true ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		foton_mikado_create_meta_box_field(
			array(
				'name'    => 'mkdf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'foton' ),
				'parent'  => $general_meta_box,
				'options' => foton_mikado_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = foton_mikado_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'mkdf_boxed_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				foton_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'foton' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'foton' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				foton_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'foton' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'foton' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				foton_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'foton' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'foton' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				foton_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'foton' ),
						'description'   => esc_html__( 'Choose background image attachment', 'foton' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'foton' ),
							'fixed'  => esc_html__( 'Fixed', 'foton' ),
							'scroll' => esc_html__( 'Scroll', 'foton' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'foton' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'foton' ),
				'parent'        => $general_meta_box,
				'options'       => foton_mikado_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = foton_mikado_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'mkdf_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'mkdf_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				foton_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'foton' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'foton' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				foton_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'foton' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'foton' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				foton_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'foton' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'foton' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				foton_mikado_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'mkdf_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'foton' ),
						'options'       => foton_mikado_get_yes_no_select_array(),
					)
				);
		
				foton_mikado_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'mkdf_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'foton' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'foton' ),
						'options'       => foton_mikado_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'foton' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'foton' ),
				'parent'        => $general_meta_box,
				'options'       => foton_mikado_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = foton_mikado_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'mkdf_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				foton_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'foton' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'foton' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => foton_mikado_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = foton_mikado_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'mkdf_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					foton_mikado_create_meta_box_field(
						array(
							'name'   => 'mkdf_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'foton' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = foton_mikado_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'foton' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'foton' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = foton_mikado_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					foton_mikado_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'mkdf_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'foton' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'foton' ),
								'logo_letter'        	=> esc_html__( 'Logo Letter', 'foton' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'foton' ),
								'pulse'                 => esc_html__( 'Pulse', 'foton' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'foton' ),
								'cube'                  => esc_html__( 'Cube', 'foton' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'foton' ),
								'stripes'               => esc_html__( 'Stripes', 'foton' ),
								'wave'                  => esc_html__( 'Wave', 'foton' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'foton' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'foton' ),
								'atom'                  => esc_html__( 'Atom', 'foton' ),
								'clock'                 => esc_html__( 'Clock', 'foton' ),
								'mitosis'               => esc_html__( 'Mitosis', 'foton' ),
								'lines'                 => esc_html__( 'Lines', 'foton' ),
								'fussion'               => esc_html__( 'Fussion', 'foton' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'foton' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'foton' )
							)
						)
					);

					foton_mikado_create_meta_box_field(
						array(
							'type' => 'textsimple',
							'name' => 'mkdf_logo_letter_val_meta',
							'default_value' => esc_html__('', 'foton'),
							'label' => esc_html__('Logo Letter', 'foton'),
							'parent' => $row_pt_spinner_animation_meta,
							'dependency' => array(
								'show' => array(
									'mkdf_smooth_pt_spinner_type_meta' => 'logo_letter'
								)
							)
						)
					);
					
					foton_mikado_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'mkdf_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'foton' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					foton_mikado_create_meta_box_field(
						array(
							'name'        => 'mkdf_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'foton' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'foton' ),
							'options'     => foton_mikado_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'foton' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'foton' ),
				'parent'      => $general_meta_box,
				'options'     => foton_mikado_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_mikado_map_general_meta', 10 );
}

if ( ! function_exists( 'foton_mikado_container_background_style' ) ) {
	/**
	 * Function that return container style
	 */
	function foton_mikado_container_background_style( $style ) {
		$page_id      = foton_mikado_get_page_id();
		$class_prefix = foton_mikado_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .mkdf-content'
		);
		
		$container_class        = array();
		$page_background_color  = get_post_meta( $page_id, 'mkdf_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'mkdf_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'mkdf_page_background_repeat_meta', true );
		
		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}
		
		if ( ! empty( $page_background_image ) ) {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';
			
			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = '0 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}
		
		$current_style = foton_mikado_dynamic_css( $container_selector, $container_class );
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'foton_mikado_filter_add_page_custom_style', 'foton_mikado_container_background_style' );
}