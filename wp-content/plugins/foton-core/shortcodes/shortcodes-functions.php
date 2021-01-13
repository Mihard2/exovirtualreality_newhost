<?php

if ( ! function_exists( 'foton_core_include_shortcodes_file' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function foton_core_include_shortcodes_file() {
		foreach ( glob( FOTON_CORE_SHORTCODES_PATH . '/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
		
		do_action( 'foton_core_action_include_shortcodes_file' );
	}
	
	add_action( 'init', 'foton_core_include_shortcodes_file', 6 ); // permission 6 is set to be before vc_before_init hook that has permission 9
}

if ( ! function_exists( 'foton_core_load_shortcodes' ) ) {
	function foton_core_load_shortcodes() {
		include_once FOTON_CORE_ABS_PATH . '/lib/shortcode-loader.php';
		
		FotonCore\Lib\ShortcodeLoader::getInstance()->load();
	}
	
	add_action( 'init', 'foton_core_load_shortcodes', 7 ); // permission 7 is set to be before vc_before_init hook that has permission 9 and after foton_core_include_shortcodes_file hook
}

if ( ! function_exists( 'foton_core_add_admin_shortcodes_styles' ) ) {
	/**
	 * Function that includes shortcodes core styles for admin
	 */
	function foton_core_add_admin_shortcodes_styles() {
		
		//include shortcode styles for Visual Composer
		wp_enqueue_style( 'foton-core-vc-shortcodes', FOTON_CORE_ASSETS_URL_PATH . '/css/admin/foton-vc-shortcodes.css' );
	}
	
	add_action( 'foton_mikado_action_admin_scripts_init', 'foton_core_add_admin_shortcodes_styles' );
}

if ( ! function_exists( 'foton_core_add_admin_shortcodes_custom_styles' ) ) {
	/**
	 * Function that print custom vc shortcodes style
	 */
	function foton_core_add_admin_shortcodes_custom_styles() {
		$style                  = apply_filters( 'foton_core_filter_add_vc_shortcodes_custom_style', $style = '' );
		$shortcodes_icon_styles = array();
		$shortcode_icon_size    = 32;
		$shortcode_position     = 0;
		
		$shortcodes_icon_class_array = apply_filters( 'foton_core_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array() );
		sort( $shortcodes_icon_class_array );
		
		if ( ! empty( $shortcodes_icon_class_array ) ) {
			foreach ( $shortcodes_icon_class_array as $shortcode_icon_class ) {
				$mark = $shortcode_position != 0 ? '-' : '';
				
				$shortcodes_icon_styles[] = '.vc_element-icon.extended-custom-icon' . esc_attr( $shortcode_icon_class ) . ' {
					background-position: ' . $mark . esc_attr( $shortcode_position * $shortcode_icon_size ) . 'px 0;
				}';
				
				$shortcode_position ++;
			}
		}
		
		if ( ! empty( $shortcodes_icon_styles ) ) {
			$style .= implode( ' ', $shortcodes_icon_styles );
		}
		
		if ( ! empty( $style ) ) {
			wp_add_inline_style( 'foton-core-vc-shortcodes', $style );
		}
	}
	
	add_action( 'foton_mikado_action_admin_scripts_init', 'foton_core_add_admin_shortcodes_custom_styles' );
}

if ( ! function_exists( 'foton_core_get_elementor_shortcodes_path' ) ) {
	function foton_core_get_elementor_shortcodes_path() {
		$shortcodes       = array();
		$shortcodes_paths = array(
			FOTON_CORE_SHORTCODES_PATH . '/*' => FOTON_CORE_URL_PATH,
			FOTON_CORE_CPT_PATH . '/**/shortcodes/*' => FOTON_CORE_URL_PATH,
			MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/**/shortcodes/*' => MIKADO_FRAMEWORK_ROOT . '/'
		);
		
		foreach ( $shortcodes_paths as $dir_path => $url_path ) {
			foreach ( glob( $dir_path, GLOB_ONLYDIR ) as $shortcode_dir_path ) {
				$shortcode_name     = basename( $shortcode_dir_path );
				$shortcode_url_path = $url_path . substr( $shortcode_dir_path, strpos( $shortcode_dir_path, basename( $url_path ) ) + strlen( basename( $url_path ) ) + 1 );
				
				$shortcodes[ $shortcode_name ] = array(
					'dir_path' => $shortcode_dir_path,
					'url_path' => $shortcode_url_path
				);
			}
		}
		
		return $shortcodes;
	}
}

if ( ! function_exists( 'foton_core_add_elementor_shortcodes_custom_styles' ) ) {
	function foton_core_add_elementor_shortcodes_custom_styles() {
		$style                  = '';
		$shortcodes_icon_styles = array();
		
		$shortcodes_icon_class_array = apply_filters( 'foton_core_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array() );
		sort( $shortcodes_icon_class_array );
		
		$shortcodes_path = foton_core_get_elementor_shortcodes_path();

		if ( ! empty( $shortcodes_icon_class_array ) ) {
			foreach ( $shortcodes_icon_class_array as $shortcode_icon_class ) {
				$shortcode_name = str_replace( '.icon-wpb-', '', esc_attr( $shortcode_icon_class ) );
				
				if ( key_exists( $shortcode_name, $shortcodes_path ) && file_exists( $shortcodes_path[ $shortcode_name ]['dir_path'] . '/assets/img/dashboard_icon.png' ) ) {
					$shortcodes_icon_styles[] = '.foton-elementor-custom-icon.foton-elementor-' . $shortcode_name . ' {
						background-image: url( "' . $shortcodes_path[ $shortcode_name ]['url_path'] . '/assets/img/dashboard_icon.png" );
					}';
				}
			}
		}
		
		if ( ! empty( $shortcodes_icon_styles ) ) {
			$style = implode( ' ', $shortcodes_icon_styles );
		}

		if ( ! empty( $style ) ) {
			wp_add_inline_style( 'foton-mikado-elementor-icons', $style );
		}
	}
	
	add_action( 'elementor/editor/before_enqueue_scripts', 'foton_core_add_elementor_shortcodes_custom_styles', 15 );
}

if ( ! function_exists( 'foton_core_load_elementor_shortcodes' ) ) {
	/**
	 * Function that loads elementor files inside shortcodes folder
	 */
	function foton_core_load_elementor_shortcodes() {
		if ( foton_core_theme_installed() && foton_mikado_is_elementor_installed() ) {
			foreach ( glob( FOTON_CORE_SHORTCODES_PATH . '/*/elementor-*.php' ) as $shortcode_load ) {
				include_once $shortcode_load;
			}
		}
	}
	
	add_action( 'init', 'foton_core_load_elementor_shortcodes' );
}

if ( ! function_exists( 'foton_core_add_elementor_widget_categories' ) ) {
	/**
	 * Registers category group
	 */
	function foton_core_add_elementor_widget_categories( $elements_manager ) {
		
		$elements_manager->add_category(
			'mikado',
			[
				'title' => esc_html__( 'Mikado', 'foton-core' ),
				'icon'  => 'fa fa-plug',
			]
		);
		
	}
	
	add_action( 'elementor/elements/categories_registered', 'foton_core_add_elementor_widget_categories' );
};

if ( ! function_exists( 'foton_core_return_elementor_templates' ) ) {
	/**
	 * Function that returns all Elementor saved templates
	 */
	function foton_core_return_elementor_templates() {
		return Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
	}
}

if ( ! function_exists( 'foton_core_generate_elementor_templates_control' ) ) {
	/**
	 * Function that adds Template Elementor Control
	 */
	function foton_core_generate_elementor_templates_control( $object ) {
		$templates = foton_core_return_elementor_templates();
		
		if ( ! empty( $templates ) ) {
			$options = [
				'0' => '— ' . esc_html__( 'Select', 'foton-core' ) . ' —',
			];
			
			$types = [];
			
			foreach ( $templates as $template ) {
				$options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
				$types[ $template['template_id'] ]   = $template['type'];
			}
			
			$object->add_control(
				'template_id',
				[
					'label'       => esc_html__( 'Choose Template', 'foton-core' ),
					'type'        => \Elementor\Controls_Manager::SELECT,
					'default'     => '0',
					'options'     => $options,
					'types'       => $types,
					'label_block' => 'true'
				]
			);
		};
	}
}

//function that maps "Dynamic Background" option for section
if ( ! function_exists( 'foton_core_map_section_dynamic_background_option' ) ) {
	function foton_core_map_section_dynamic_background_option( $section, $args ) {
		$section->start_controls_section(
			'section_mikado_dynamic_background',
			[
				'label' => esc_html__( 'Foton Dynamic Background', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);
		
		$section->add_control(
			'dynamic_background_color_value',
			[
				'label'       => esc_html__( 'Dynamic Background Color Value', 'foton-core' ),
				'type'        => Elementor\Controls_Manager::COLOR,
				'description' => esc_html__( 'This color value will be used if Dynamic Background Color metabox is set to Yes on this page.', 'foton' ),
			]
		);
		
		$section->end_controls_section();
	}
	
	add_action( 'elementor/element/section/_section_responsive/after_section_end', 'foton_core_map_section_dynamic_background_option', 10, 2 );
}

//frontend function for "Dynamic Background"
if ( ! function_exists( 'foton_core_render_section_dynamic_background_option' ) ) {
	function foton_core_render_section_dynamic_background_option( $element ) {
		if ( 'section' !== $element->get_name() ) {
			return;
		}
		
		$params = $element->get_settings_for_display();
		
		if ( ! empty( $params['dynamic_background_color_value'] ) ) {
			$bgrnd_color = ! empty( $params['dynamic_background_color_value'] ) ? $params['dynamic_background_color_value'] : '';
			
			$element->add_render_attribute( '_wrapper', 'data-dynamic-bgrnd', $bgrnd_color );
		}
	}
	
	add_action( 'elementor/frontend/section/before_render', 'foton_core_render_section_dynamic_background_option' );
}

//function that renders helper hidden input for parallax data attribute section
if ( ! function_exists( 'foton_core_generate_dynamic_background_helper' ) ) {
	function foton_core_generate_dynamic_background_helper( $template, $widget ) {
		if ( 'section' === $widget->get_name() ) {
			$template_preceding = "
            <# if( settings.dynamic_background_color_value !== '' ){
		        let dynamicColor = settings.dynamic_background_color_value;
	        #>
		        <input type='hidden' class='mikado-dynamic-background-helper-holder' data-dynamic-bgrnd='{{ dynamicColor }}'/>
		    <# } #>";
			$template           = $template_preceding . " " . $template;
		}
		
		return $template;
	}
	
	add_action( 'elementor/section/print_template', 'foton_core_generate_dynamic_background_helper', 10, 2 );
}

//function that maps "Parallax" option for section
if ( ! function_exists( 'foton_core_map_section_parallax_option' ) ) {
	function foton_core_map_section_parallax_option( $section, $args ) {
		$section->start_controls_section(
			'section_mikado_parallax',
			[
				'label' => esc_html__( 'Foton Parallax', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);
		
		$section->add_control(
			'mikado_enable_parallax',
			[
				'label'        => esc_html__( 'Enable Parallax', 'foton-core' ),
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options'      => [
					'no'     => esc_html__( 'No', 'foton-core' ),
					'holder' => esc_html__( 'Yes', 'foton-core' ),
				],
				'prefix_class' => 'mkdf-parallax-row-'
			]
		);
		
		$section->add_control(
			'mikado_parallax_image',
			[
				'label'              => esc_html__( 'Parallax Image', 'foton-core' ),
				'type'               => Elementor\Controls_Manager::MEDIA,
				'condition'          => [
					'mikado_enable_parallax' => 'holder'
				],
				'frontend_available' => true,
			]
		);
		
		$section->add_control(
			'mikado_parallax_speed',
			[
				'label'     => esc_html__( 'Parallax Speed', 'foton-core' ),
				'type'      => Elementor\Controls_Manager::TEXT,
				'condition' => [
					'mikado_enable_parallax' => 'holder'
				],
				'default'   => '0'
			]
		);
		
		$section->end_controls_section();
	}
	
	add_action( 'elementor/element/section/_section_responsive/after_section_end', 'foton_core_map_section_parallax_option', 10, 2 );
}

//frontend function for "Parallax"
if ( ! function_exists( 'foton_core_render_section_parallax_option' ) ) {
	function foton_core_render_section_parallax_option( $element ) {
		if ( 'section' !== $element->get_name() ) {
			return;
		}
		
		$params = $element->get_settings_for_display();
		
		if ( ! empty( $params['mikado_parallax_image']['id'] ) ) {
			$parallax_image_src = $params['mikado_parallax_image']['url'];
			$parallax_speed     = ! empty( $params['mikado_parallax_speed'] ) ? $params['mikado_parallax_speed'] : '0';
			
			$element->add_render_attribute( '_wrapper', 'class', 'mkdf-parallax-row-holder' );
			$element->add_render_attribute( '_wrapper', 'data-parallax-bg-speed', $parallax_speed );
			$element->add_render_attribute( '_wrapper', 'data-parallax-bg-image', $parallax_image_src );
		}
	}
	
	add_action( 'elementor/frontend/section/before_render', 'foton_core_render_section_parallax_option' );
}

//function that renders helper hidden input for parallax data attribute section
if ( ! function_exists( 'foton_core_generate_parallax_helper' ) ) {
	function foton_core_generate_parallax_helper( $template, $widget ) {
		if ( 'section' === $widget->get_name() ) {
			$template_preceding = "
            <# if( settings.mikado_enable_parallax == 'holder' ){
		        let parallaxSpeed = settings.mikado_parallax_speed !== '' ? settings.mikado_parallax_speed : '0';
	            let parallaxImage = settings.mikado_parallax_image.url !== '' ? settings.mikado_parallax_image.url : '0'
	        #>
		        <input type='hidden' class='mikado-parallax-helper-holder' data-parallax-bg-speed='{{ parallaxSpeed }}' data-parallax-bg-image='{{ parallaxImage }}'/>
		    <# } #>";
			$template           = $template_preceding . " " . $template;
		}
		
		return $template;
	}
	
	add_action( 'elementor/section/print_template', 'foton_core_generate_parallax_helper', 10, 2 );
}

//function that adds grid class to grid rows
if ( ! function_exists( 'foton_core_map_section_disable_background' ) ) {
	function foton_core_map_section_full_screen_sections( $section, $args ) {
		$section->start_controls_section(
			'mikado_section_grid_row',
			[
				'label' => esc_html__( 'Foton Grid', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);
		
		$section->add_control(
			'mikado_enable_grid_row',
			[
				'label'        => esc_html__( 'Make this row "In Grid"', 'foton-core' ),
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options'      => [
					'no'      => esc_html__( 'No', 'foton-core' ),
					'section' => esc_html__( 'Yes', 'foton-core' ),
				],
				'prefix_class' => 'mkdf-row-grid-'
			]
		);
		
		$section->end_controls_section();
	}
	
	add_action( 'elementor/element/section/_section_responsive/after_section_end', 'foton_core_map_section_full_screen_sections', 10, 2 );
}

//function that adds grid class to grid rows
if ( ! function_exists( 'foton_core_map_section_disable_background' ) ) {
	function foton_core_map_section_disable_background( $section, $args ) {
		$section->start_controls_section(
			'mikado_section_disable_background',
			[
				'label' => esc_html__( 'Foton Disable Background Image', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);
		
		$section->add_control(
			'mikado_disable_background',
			[
				'label'        => esc_html__( 'Disable row background', 'foton-core' ),
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options'      => [
					'no'   => esc_html__( 'Never', 'foton-core' ),
					'1280' => esc_html__( 'Below 1280px', 'foton-core' ),
					'1024' => esc_html__( 'Below 1024px', 'foton-core' ),
					'768'  => esc_html__( 'Below 768px', 'foton-core' ),
					'680'  => esc_html__( 'Below 680px', 'foton-core' ),
					'480'  => esc_html__( 'Below 480px', 'foton-core' )
				],
				'prefix_class' => 'mkdf-disabled-bg-image-bellow-'
			]
		);
		
		$section->end_controls_section();
	}
	
	add_action( 'elementor/element/section/_section_responsive/after_section_end', 'foton_core_map_section_disable_background', 10, 2 );
}