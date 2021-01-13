<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = MIKADO_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'foton_mikado_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function foton_mikado_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'foton_mikado_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'foton_mikado_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function foton_mikado_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Mikado Row Content Width', 'foton' ),
				'value'      => array(
					esc_html__( 'Full Width', 'foton' ) => 'full-width',
					esc_html__( 'In Grid', 'foton' )    => 'grid'
				),
				'group'      => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Mikado Anchor ID', 'foton' ),
				'description' => esc_html__( 'For example "home"', 'foton' ),
				'group'       => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Mikado Background Color', 'foton' ),
				'group'      => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Mikado Background Image', 'foton' ),
				'group'      => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Mikado Background Position', 'foton' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'foton' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Mikado Disable Background Image', 'foton' ),
				'value'       => array(
					esc_html__( 'Never', 'foton' )        => '',
					esc_html__( 'Below 1280px', 'foton' ) => '1280',
					esc_html__( 'Below 1024px', 'foton' ) => '1024',
					esc_html__( 'Below 768px', 'foton' )  => '768',
					esc_html__( 'Below 680px', 'foton' )  => '680',
					esc_html__( 'Below 480px', 'foton' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'foton' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Mikado Parallax Background Image', 'foton' ),
				'group'      => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Mikado Parallax Speed', 'foton' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'foton' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Mikado Parallax Section Height (px)', 'foton' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Mikado Settings', 'foton' )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'dynamic_background_color_value',
				'heading'    => esc_html__( 'Dynamic Background Color Value', 'foton' ),
				'description' => esc_html__( 'This color value will be used if Dynamic Background Color metabox is set to Yes on this page.', 'foton' ),
				'group'      => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Mikado Content Aligment', 'foton' ),
				'value'      => array(
					esc_html__( 'Default', 'foton' ) => '',
					esc_html__( 'Left', 'foton' )    => 'left',
					esc_html__( 'Center', 'foton' )  => 'center',
					esc_html__( 'Right', 'foton' )   => 'right'
				),
				'group'      => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Mikado Row Content Width', 'foton' ),
				'value'      => array(
					esc_html__( 'Full Width', 'foton' ) => 'full-width',
					esc_html__( 'In Grid', 'foton' )    => 'grid'
				),
				'group'      => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Mikado Background Color', 'foton' ),
				'group'      => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Mikado Background Image', 'foton' ),
				'group'      => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Mikado Background Position', 'foton' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'foton' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Mikado Disable Background Image', 'foton' ),
				'value'       => array(
					esc_html__( 'Never', 'foton' )        => '',
					esc_html__( 'Below 1280px', 'foton' ) => '1280',
					esc_html__( 'Below 1024px', 'foton' ) => '1024',
					esc_html__( 'Below 768px', 'foton' )  => '768',
					esc_html__( 'Below 680px', 'foton' )  => '680',
					esc_html__( 'Below 480px', 'foton' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'foton' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Mikado Content Aligment', 'foton' ),
				'value'      => array(
					esc_html__( 'Default', 'foton' ) => '',
					esc_html__( 'Left', 'foton' )    => 'left',
					esc_html__( 'Center', 'foton' )  => 'center',
					esc_html__( 'Right', 'foton' )   => 'right'
				),
				'group'      => esc_html__( 'Mikado Settings', 'foton' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( foton_mikado_revolution_slider_installed() ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Mikado Enable Passepartout', 'foton' ),
					'value'       => array_flip( foton_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Mikado Settings', 'foton' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Mikado Passepartout Size', 'foton' ),
					'value'       => array(
						esc_html__( 'Tiny', 'foton' )   => 'tiny',
						esc_html__( 'Small', 'foton' )  => 'small',
						esc_html__( 'Normal', 'foton' ) => 'normal',
						esc_html__( 'Large', 'foton' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'foton' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Mikado Disable Side Passepartout', 'foton' ),
					'value'       => array_flip( foton_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'foton' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Mikado Disable Top Passepartout', 'foton' ),
					'value'       => array_flip( foton_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'foton' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'foton_mikado_vc_row_map' );
}