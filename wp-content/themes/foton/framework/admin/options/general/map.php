<?php

if ( ! function_exists( 'foton_mikado_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function foton_mikado_general_options_map() {
		
		foton_mikado_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'foton' ),
				'icon'  => 'fa fa-institution'
			)
		);
		
		$panel_design_style = foton_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Design Style', 'foton' )
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'foton' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'foton' ),
				'parent'        => $panel_design_style
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'foton' ),
				'parent'        => $panel_design_style
			)
		);
		
		$additional_google_fonts_container = foton_mikado_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'additional_google_fonts_container',
				'dependency' => array(
					'show' => array(
						'additional_google_fonts'  => 'yes'
					)
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'foton' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'foton' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'foton' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'foton' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'foton' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'foton' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'foton' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'foton' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'foton' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'foton' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'foton' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'foton' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'100'  => esc_html__( '100 Thin', 'foton' ),
					'100i' => esc_html__( '100 Thin Italic', 'foton' ),
					'200'  => esc_html__( '200 Extra-Light', 'foton' ),
					'200i' => esc_html__( '200 Extra-Light Italic', 'foton' ),
					'300'  => esc_html__( '300 Light', 'foton' ),
					'300i' => esc_html__( '300 Light Italic', 'foton' ),
					'400'  => esc_html__( '400 Regular', 'foton' ),
					'400i' => esc_html__( '400 Regular Italic', 'foton' ),
					'500'  => esc_html__( '500 Medium', 'foton' ),
					'500i' => esc_html__( '500 Medium Italic', 'foton' ),
					'600'  => esc_html__( '600 Semi-Bold', 'foton' ),
					'600i' => esc_html__( '600 Semi-Bold Italic', 'foton' ),
					'700'  => esc_html__( '700 Bold', 'foton' ),
					'700i' => esc_html__( '700 Bold Italic', 'foton' ),
					'800'  => esc_html__( '800 Extra-Bold', 'foton' ),
					'800i' => esc_html__( '800 Extra-Bold Italic', 'foton' ),
					'900'  => esc_html__( '900 Ultra-Bold', 'foton' ),
					'900i' => esc_html__( '900 Ultra-Bold Italic', 'foton' )
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'foton' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'foton' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'foton' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'foton' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'foton' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'foton' ),
					'greek'        => esc_html__( 'Greek', 'foton' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'foton' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'foton' )
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'foton' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is #ff8a73', 'foton' ),
				'parent'      => $panel_design_style
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'foton' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'foton' ),
				'parent'      => $panel_design_style
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'        => 'page_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Page Background Image', 'foton' ),
				'description' => esc_html__( 'Choose the background image for page content', 'foton' ),
				'parent'      => $panel_design_style
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'page_background_image_repeat',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Page Background Image Repeat', 'foton' ),
				'description'   => esc_html__( 'Enabling this option will set page background image as pattern in otherwise will be cover background image', 'foton' ),
				'parent'        => $panel_design_style
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'foton' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'foton' ),
				'parent'      => $panel_design_style
			)
		);
		
		/***************** Passepartout Layout - begin **********************/
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'foton' ),
				'parent'        => $panel_design_style
			)
		);
		
			$boxed_container = foton_mikado_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'boxed_container',
					'dependency' => array(
						'show' => array(
							'boxed'  => 'yes'
						)
					)
				)
			);
		
				foton_mikado_add_admin_field(
					array(
						'name'        => 'page_background_color_in_box',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'foton' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'foton' ),
						'parent'      => $boxed_container
					)
				);
				
				foton_mikado_add_admin_field(
					array(
						'name'        => 'boxed_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'foton' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'foton' ),
						'parent'      => $boxed_container
					)
				);
				
				foton_mikado_add_admin_field(
					array(
						'name'        => 'boxed_pattern_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'foton' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'foton' ),
						'parent'      => $boxed_container
					)
				);
				
				foton_mikado_add_admin_field(
					array(
						'name'          => 'boxed_background_image_attachment',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'foton' ),
						'description'   => esc_html__( 'Choose background image attachment', 'foton' ),
						'parent'        => $boxed_container,
						'options'       => array(
							''       => esc_html__( 'Default', 'foton' ),
							'fixed'  => esc_html__( 'Fixed', 'foton' ),
							'scroll' => esc_html__( 'Scroll', 'foton' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'foton' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'foton' ),
				'parent'        => $panel_design_style
			)
		);
		
			$paspartu_container = foton_mikado_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'paspartu_container',
					'dependency' => array(
						'show' => array(
							'paspartu'  => 'yes'
						)
					)
				)
			);
		
				foton_mikado_add_admin_field(
					array(
						'name'        => 'paspartu_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'foton' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'foton' ),
						'parent'      => $paspartu_container
					)
				);
				
				foton_mikado_add_admin_field(
					array(
						'name'        => 'paspartu_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'foton' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'foton' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				foton_mikado_add_admin_field(
					array(
						'name'        => 'paspartu_responsive_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'foton' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'foton' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				foton_mikado_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'disable_top_paspartu',
						'label'         => esc_html__( 'Disable Top Passepartout', 'foton' )
					)
				);
		
				foton_mikado_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'enable_fixed_paspartu',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'foton' ),
						'description' => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'foton' )
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => 'mkdf-grid-1300',
				'label'         => esc_html__( 'Initial Width of Content', 'foton' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'foton' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'mkdf-grid-1100' => esc_html__( '1100px - default', 'foton' ),
					'mkdf-grid-1300' => esc_html__( '1300px', 'foton' ),
					'mkdf-grid-1200' => esc_html__( '1200px', 'foton' ),
					'mkdf-grid-1000' => esc_html__( '1000px', 'foton' ),
					'mkdf-grid-800'  => esc_html__( '800px', 'foton' )
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'preload_pattern_image',
				'type'          => 'image',
				'label'         => esc_html__( 'Preload Pattern Image', 'foton' ),
				'description'   => esc_html__( 'Choose preload pattern image to be displayed until images are loaded', 'foton' ),
				'parent'        => $panel_design_style
			)
		);
		
		/***************** Content Layout - end **********************/
		
		$panel_settings = foton_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Settings', 'foton' )
			)
		);
		
		/***************** Smooth Scroll Layout - begin **********************/
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'page_smooth_scroll',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Scroll', 'foton' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'foton' ),
				'parent'        => $panel_settings
			)
		);
		
		/***************** Smooth Scroll Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'foton' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'foton' ),
				'parent'        => $panel_settings
			)
		);
		
			$page_transitions_container = foton_mikado_add_admin_container(
				array(
					'parent'          => $panel_settings,
					'name'            => 'page_transitions_container',
					'dependency' => array(
						'show' => array(
							'smooth_page_transitions'  => 'yes'
						)
					)
				)
			);
		
				foton_mikado_add_admin_field(
					array(
						'name'          => 'page_transition_preloader',
						'type'          => 'yesno',
						'default_value' => 'no',
						'label'         => esc_html__( 'Enable Preloading Animation', 'foton' ),
						'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'foton' ),
						'parent'        => $page_transitions_container
					)
				);
				
				$page_transition_preloader_container = foton_mikado_add_admin_container(
					array(
						'parent'          => $page_transitions_container,
						'name'            => 'page_transition_preloader_container',
						'dependency' => array(
							'show' => array(
								'page_transition_preloader'  => 'yes'
							)
						)
					)
				);
				
					foton_mikado_add_admin_field(
						array(
							'name'   => 'smooth_pt_bgnd_color',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'foton' ),
							'parent' => $page_transition_preloader_container
						)
					);
					
					$group_pt_spinner_animation = foton_mikado_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation',
							'title'       => esc_html__( 'Loader Style', 'foton' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'foton' ),
							'parent'      => $page_transition_preloader_container
						)
					);
					
					$row_pt_spinner_animation = foton_mikado_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation',
							'parent' => $group_pt_spinner_animation
						)
					);
					
					foton_mikado_add_admin_field(
						array(
							'type'          => 'selectsimple',
							'name'          => 'smooth_pt_spinner_type',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Type', 'foton' ),
							'parent'        => $row_pt_spinner_animation,
							'options'       => array(
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

					foton_mikado_add_admin_field(
						array(
							'type' => 'textsimple',
							'name' => 'logo_letter_val',
							'default_value' => esc_html__('', 'foton'),
							'label' => esc_html__('Logo Letter', 'foton'),
							'parent' => $row_pt_spinner_animation,
							'dependency' => array(
								'show' => array(
									'smooth_pt_spinner_type' => 'logo_letter'
								)
							)
						)
					);
					
					foton_mikado_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'smooth_pt_spinner_color',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Color', 'foton' ),
							'parent'        => $row_pt_spinner_animation
						)
					);
					
					foton_mikado_add_admin_field(
						array(
							'name'          => 'page_transition_fadeout',
							'type'          => 'yesno',
							'default_value' => 'no',
							'label'         => esc_html__( 'Enable Fade Out Animation', 'foton' ),
							'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'foton' ),
							'parent'        => $page_transitions_container
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'foton' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'foton' ),
				'parent'        => $panel_settings
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'foton' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'foton' ),
				'parent'        => $panel_settings
			)
		);
		
		$panel_custom_code = foton_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'foton' )
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'foton' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'foton' ),
				'parent'      => $panel_custom_code
			)
		);
		
		$panel_google_api = foton_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'foton' )
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'foton' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'foton' ),
				'parent'      => $panel_google_api
			)
		);
	}
	
	add_action( 'foton_mikado_action_options_map', 'foton_mikado_general_options_map', foton_mikado_set_options_map_position( 'general' ) );
}

if ( ! function_exists( 'foton_mikado_page_general_style' ) ) {
	/**
	 * Function that prints page general inline styles
	 */
	function foton_mikado_page_general_style( $style ) {
		$current_style = '';
		$page_id       = foton_mikado_get_page_id();
		$class_prefix  = foton_mikado_get_unique_page_class( $page_id );
		
		$boxed_background_style = array();
		
		$boxed_page_background_color = foton_mikado_get_meta_field_intersect( 'page_background_color_in_box', $page_id );
		if ( ! empty( $boxed_page_background_color ) ) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
		
		$boxed_page_background_image = foton_mikado_get_meta_field_intersect( 'boxed_background_image', $page_id );
		if ( ! empty( $boxed_page_background_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_image ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}
		
		$boxed_page_background_pattern_image = foton_mikado_get_meta_field_intersect( 'boxed_pattern_background_image', $page_id );
		if ( ! empty( $boxed_page_background_pattern_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_pattern_image ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}
		
		$boxed_page_background_attachment = foton_mikado_get_meta_field_intersect( 'boxed_background_image_attachment', $page_id );
		if ( ! empty( $boxed_page_background_attachment ) ) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}
		
		$boxed_background_selector = $class_prefix . '.mkdf-boxed .mkdf-wrapper';
		
		if ( ! empty( $boxed_background_style ) ) {
			$current_style .= foton_mikado_dynamic_css( $boxed_background_selector, $boxed_background_style );
		}
		
		$paspartu_style     = array();
		$paspartu_res_style = array();
		$paspartu_res_start = '@media only screen and (max-width: 1024px) {';
		$paspartu_res_end   = '}';
		
		$paspartu_header_selector                = array(
			'.mkdf-paspartu-enabled .mkdf-page-header .mkdf-fixed-wrapper.fixed',
			'.mkdf-paspartu-enabled .mkdf-sticky-header',
			'.mkdf-paspartu-enabled .mkdf-mobile-header.mobile-header-appear .mkdf-mobile-header-inner'
		);
		$paspartu_header_appear_selector         = array(
			'.mkdf-paspartu-enabled.mkdf-fixed-paspartu-enabled .mkdf-page-header .mkdf-fixed-wrapper.fixed',
			'.mkdf-paspartu-enabled.mkdf-fixed-paspartu-enabled .mkdf-sticky-header.header-appear',
			'.mkdf-paspartu-enabled.mkdf-fixed-paspartu-enabled .mkdf-mobile-header.mobile-header-appear .mkdf-mobile-header-inner'
		);
		
		$paspartu_header_style                   = array();
		$paspartu_header_appear_style            = array();
		$paspartu_header_responsive_style        = array();
		$paspartu_header_appear_responsive_style = array();
		
		$paspartu_color = foton_mikado_get_meta_field_intersect( 'paspartu_color', $page_id );
		if ( ! empty( $paspartu_color ) ) {
			$paspartu_style['background-color'] = $paspartu_color;
		}
		
		$paspartu_width = foton_mikado_get_meta_field_intersect( 'paspartu_width', $page_id );
		if ( $paspartu_width !== '' ) {
			if ( foton_mikado_string_ends_with( $paspartu_width, '%' ) || foton_mikado_string_ends_with( $paspartu_width, 'px' ) ) {
				$paspartu_style['padding'] = $paspartu_width;
				
				$paspartu_clean_width      = foton_mikado_string_ends_with( $paspartu_width, '%' ) ? foton_mikado_filter_suffix( $paspartu_width, '%' ) : foton_mikado_filter_suffix( $paspartu_width, 'px' );
				$paspartu_clean_width_mark = foton_mikado_string_ends_with( $paspartu_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_style['left']              = $paspartu_width;
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width;
			} else {
				$paspartu_style['padding'] = $paspartu_width . 'px';
				
				$paspartu_header_style['left']              = $paspartu_width . 'px';
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_width ) . 'px)';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width . 'px';
			}
		}
		
		$paspartu_selector = $class_prefix . '.mkdf-paspartu-enabled .mkdf-wrapper';
		
		if ( ! empty( $paspartu_style ) ) {
			$current_style .= foton_mikado_dynamic_css( $paspartu_selector, $paspartu_style );
		}
		
		if ( ! empty( $paspartu_header_style ) ) {
			$current_style .= foton_mikado_dynamic_css( $paspartu_header_selector, $paspartu_header_style );
			$current_style .= foton_mikado_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_style );
		}
		
		$paspartu_responsive_width = foton_mikado_get_meta_field_intersect( 'paspartu_responsive_width', $page_id );
		if ( $paspartu_responsive_width !== '' ) {
			if ( foton_mikado_string_ends_with( $paspartu_responsive_width, '%' ) || foton_mikado_string_ends_with( $paspartu_responsive_width, 'px' ) ) {
				$paspartu_res_style['padding'] = $paspartu_responsive_width;
				
				$paspartu_clean_width      = foton_mikado_string_ends_with( $paspartu_responsive_width, '%' ) ? foton_mikado_filter_suffix( $paspartu_responsive_width, '%' ) : foton_mikado_filter_suffix( $paspartu_responsive_width, 'px' );
				$paspartu_clean_width_mark = foton_mikado_string_ends_with( $paspartu_responsive_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width;
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width;
			} else {
				$paspartu_res_style['padding'] = $paspartu_responsive_width . 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width . 'px';
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_responsive_width ) . 'px)';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width . 'px';
			}
		}
		
		if ( ! empty( $paspartu_res_style ) ) {
			$current_style .= $paspartu_res_start . foton_mikado_dynamic_css( $paspartu_selector, $paspartu_res_style ) . $paspartu_res_end;
		}
		
		if ( ! empty( $paspartu_header_responsive_style ) ) {
			$current_style .= $paspartu_res_start . foton_mikado_dynamic_css( $paspartu_header_selector, $paspartu_header_responsive_style ) . $paspartu_res_end;
			$current_style .= $paspartu_res_start . foton_mikado_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_responsive_style ) . $paspartu_res_end;
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'foton_mikado_filter_add_page_custom_style', 'foton_mikado_page_general_style' );
}