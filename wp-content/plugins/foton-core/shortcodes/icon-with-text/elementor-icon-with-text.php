<?php

class ElementorIconWithText extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_elementor_icon_with_text';
	}

	public function get_title() {
		return esc_html__( 'Icon With Text', 'foton-core' );
	}

	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-icon-with-text';
	}

	public function get_categories() {
		return [ 'mikado' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'custom_class',
			[
				'label'       => esc_html__( 'Custom CSS Class', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'foton-core' )
			]
		);

		$this->add_control(
			'custom_padding',
			[
				'label'       => esc_html__( 'Custom CSS Padding', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Add custom padding to IWT element', 'foton-core' )
			]
		);

		$this->add_control(
			'type',
			[
				'label'   => esc_html__( 'Type', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'icon-left'   => esc_html__( 'Icon Left From Text', 'foton-core' ),
					'icon-left-from-title' => esc_html__( 'Icon Left From Title', 'foton-core' ),
					'icon-left-from-title-and-text'  => esc_html__( 'Icon Left From Text with Arrow', 'foton-core' ),
					'icon-top'  => esc_html__( 'Icon Top', 'foton-core' ),
				],
				'default' => 'icon-left'
			]
		);

		$this->add_control(
			'text_alignment',
			[
				'label'   => esc_html__( 'Text Alignment Type', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''   => esc_html__( 'Center', 'foton-core' ),
					'left' => esc_html__( 'Left', 'foton-core' ),
					'right'  => esc_html__( 'Right', 'foton-core' )
				],
				'condition' => [
					'type' => array( 'icon-left-from-title-and-text' )
				],
			]
		);

		$this->add_control(
			'show_arrow',
			[
				'label'   => esc_html__( 'Show Arrow', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''   => esc_html__( 'Yes', 'foton-core' ),
					'no-arrow' => esc_html__( 'No', 'foton-core' )
				],
				'condition' => [
					'type' => array( 'icon-left-from-title-and-text' )
				],
			]
		);

		foton_mikado_icon_collections()->getElementorParamsArray( $this, '', '' );

		$this->add_control(
			'custom_icon',
			[
				'label'       => esc_html__( 'Custom Icon', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'custom_hover_icon',
			[
				'label'       => esc_html__( 'Custom Hover Icon', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'custom_icon!' => ''
				],
			]
		);
		
		$this->add_control(
			'regular_shadow',
			[
				'label'   => esc_html__( 'Shadow', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''   => esc_html__( 'No', 'foton-core' ),
					'show-regular-shadow' => esc_html__( 'Yes', 'foton-core' )
				]
			]
		);
		
		$this->add_control(
			'hover_shadow',
			[
				'label'   => esc_html__( 'Hover Shadow', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''   => esc_html__( 'Yes', 'foton-core' ),
					'no-hover-shadow' => esc_html__( 'No', 'foton-core' )
				]
			]
		);
		
		$this->add_control(
			'hover_effect',
			[
				'label'   => esc_html__( 'Additional Hover Effect', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''   => esc_html__( 'Yes', 'foton-core' ),
					'no-hover-effect' => esc_html__( 'No', 'foton-core' )
				]
			]
		);
		
		$this->add_control(
			'border',
			[
				'label'   => esc_html__( 'Border', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''   => esc_html__( 'No', 'foton-core' ),
					'show-border' => esc_html__( 'Yes', 'foton-core' )
				]
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'icon_settings',
			[
				'label' => esc_html__( 'Icon Settings', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Icon Type Arrow', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'mkdf-normal'   => esc_html__( 'Normal', 'foton-core' ),
					'mkdf-circle' => esc_html__( 'Circle', 'foton-core' ),
					'mkdf-square' => esc_html__( 'Square', 'foton-core' ),
				],
				'default' => 'mkdf-normal'
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label'   => esc_html__( 'Icon Type Arrow', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'mkdf-icon-medium'   => esc_html__( 'Medium', 'foton-core' ),
					'mkdf-icon-tiny' => esc_html__( 'Tiny', 'foton-core' ),
					'mkdf-icon-small' => esc_html__( 'Small', 'foton-core' ),
					'mkdf-icon-large' => esc_html__( 'Large', 'foton-core' ),
					'mkdf-icon-huge' => esc_html__( 'Very Large', 'foton-core' ),
				],
				'default' => 'mkdf-icon-medium'
			]
		);

		$this->add_control(
			'custom_icon_size',
			[
				'label'   => esc_html__( 'Custom Icon Size (px)', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
			]
		);

		$this->add_control(
			'shape_size',
			[
				'label'   => esc_html__( 'Shape Size (px)', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'   => esc_html__( 'Icon Color', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label'   => esc_html__( 'Icon Hover Color', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'icon_background_color',
			[
				'label'   => esc_html__( 'Icon Background Color', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type' => array( 'mkdf-square', 'mkdf-circle' )
				],
			]
		);

		$this->add_control(
			'icon_hover_background_color',
			[
				'label'   => esc_html__( 'Icon Hover Background Color', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type' => array( 'mkdf-square', 'mkdf-circle' )
				],
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'label'   => esc_html__( 'Icon Border Color', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type' => array( 'mkdf-square', 'mkdf-circle' )
				],
			]
		);

		$this->add_control(
			'icon_border_hover_color',
			[
				'label'   => esc_html__( 'Icon Border Hover Color', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type' => array( 'mkdf-square', 'mkdf-circle' )
				],
			]
		);

		$this->add_control(
			'icon_border_width',
			[
				'label'   => esc_html__( 'Border Width (px)', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'icon_type' => array( 'mkdf-square', 'mkdf-circle' )
				],
			]
		);

		$this->add_control(
			'icon_animation',
			[
				'label'   => esc_html__( 'Icon Animation', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false )
			]
		);

		$this->add_control(
			'icon_animation_delay',
			[
				'label'   => esc_html__( 'Icon Animation Delay (ms)', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'icon_animation' => array( 'yes' )
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'text_settings',
			[
				'label' => esc_html__( 'Text Settings', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => esc_html__( 'Title', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_title_tag( true ),
				'condition' => [
					'title!' => ''
				],
				'default' => 'h4'
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'   => esc_html__( 'Title Color', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'title_top_margin',
			[
				'label'   => esc_html__( 'Title Top Margin (px)', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'text',
			[
				'label'   => esc_html__( 'Text', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'   => esc_html__( 'Text Color', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'text!' => ''
				]
			]
		);

		$this->add_control(
			'text_top_margin',
			[
				'label'   => esc_html__( 'Text Top Margin (px)', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'text!' => ''
				]
			]
		);

		$this->add_control(
			'link',
			[
				'label'   => esc_html__( 'Link', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Set link around icon and title', 'foton-core' )
			]
		);

		$this->add_control(
			'target',
			[
				'label'   => esc_html__( 'Target', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'options' => foton_mikado_get_link_target_array(),
				'condition' => [
					'link!' => ''
				]
			]
		);

		$this->add_control(
			'text_padding',
			[
				'label'   => esc_html__( 'Text Top/Left Padding (px)', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'type' => array( 'icon-left', 'icon-top' )
				],
				'description' => esc_html__( 'Set left or top padding dependence of type for your text holder. Default value is 13 for left type and 25 for top icon with text type', 'foton-core' ),
			]
		);

		$this->add_control(
			'text_bottom_padding',
			[
				'label'   => esc_html__( 'Text Bottom Padding (px)', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'type' => array( 'icon-left', 'icon-top' )
				],
				'description' => esc_html__( 'Set bottom padding. Default value is 0.', 'foton-core' ),
			]
		);

		$this->end_controls_section();
	}

	public function render() {
		$params = $this->get_settings_for_display();
		
		$default_atts = array(
			'custom_padding'              => '',
			'custom_class'                => '',
			'type'                        => 'icon-left',
			'custom_icon'                 => '',
			'custom_hover_icon'           => '',
			'icon_type'                   => 'mkdf-normal',
			'icon_size'                   => 'mkdf-icon-medium',
			'custom_icon_size'            => '',
			'shape_size'                  => '',
			'icon_color'                  => '',
			'icon_hover_color'            => '',
			'icon_background_color'       => '',
			'icon_hover_background_color' => '',
			'icon_border_color'           => '',
			'icon_border_hover_color'     => '',
			'icon_border_width'           => '',
			'icon_animation'              => '',
			'icon_animation_delay'        => '',
			'title'                       => '',
			'title_tag'                   => 'h4',
			'title_color'                 => '',
			'title_top_margin'            => '',
			'text'                        => '',
			'text_color'                  => '',
			'text_top_margin'             => '',
            'text_alignment'              => '',
            'show_arrow'                  => '',
            'regular_shadow'              => '',
            'hover_shadow'                => '',
			'hover_effect'                => '',
			'border'                      => '',
			'link'                        => '',
			'target'                      => '_self',
			'text_padding'                => '',
			'text_bottom_padding'         => ''
		);
		
		if ( ! empty( $params['custom_icon'] ) ) {
			$params['custom_icon'] = $params['custom_icon']['id'];
		}
		
		if ( ! empty( $params['custom_hover_icon'] ) ) {
			$params['custom_hover_icon'] = $params['custom_hover_icon']['id'];
		}

		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];

		$params['icon_parameters'] = $this->getIconParameters( $params );
		$params['inner_holder_classes']  = $this->getInnerHolderClasses( $params );
		$params['content_styles']  = $this->getContentStyles( $params );
		$params['title_styles']    = $this->getTitleStyles( $params );
		$params['padding_styles']  = $this->getPaddingStyles( $params );
		$params['title_tag']       = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['text_styles']     = $this->getTextStyles( $params );
		$params['target']          = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];

		echo foton_core_get_shortcode_module_template_part( 'templates/iwt', 'icon-with-text', $params['type'], $params );
	}

	private function getIconParameters( $params ) {
		$params_array = array();

		if ( empty( $params['custom_icon'] ) ) {
			$iconPackName = foton_mikado_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );

			$params_array['icon_pack']     = $params['icon_pack'];
			$params_array[ $iconPackName ] = $params[ $iconPackName ];

			if ( ! empty( $params['icon_size'] ) ) {
				$params_array['size'] = $params['icon_size'];
			}

			if ( ! empty( $params['custom_icon_size'] ) ) {
				$params_array['custom_size'] = foton_mikado_filter_px( $params['custom_icon_size'] ) . 'px';
			}

			if ( ! empty( $params['icon_type'] ) ) {
				$params_array['type'] = $params['icon_type'];
			}

			if ( ! empty( $params['shape_size'] ) ) {
				$params_array['shape_size'] = foton_mikado_filter_px( $params['shape_size'] ) . 'px';
			}

			if ( ! empty( $params['icon_border_color'] ) ) {
				$params_array['border_color'] = $params['icon_border_color'];
			}

			if ( ! empty( $params['icon_border_hover_color'] ) ) {
				$params_array['hover_border_color'] = $params['icon_border_hover_color'];
			}

			if ( $params['icon_border_width'] !== '' ) {
				$params_array['border_width'] = foton_mikado_filter_px( $params['icon_border_width'] ) . 'px';
			}

			if ( ! empty( $params['icon_background_color'] ) ) {
				$params_array['background_color'] = $params['icon_background_color'];
			}

			if ( ! empty( $params['icon_hover_background_color'] ) ) {
				$params_array['hover_background_color'] = $params['icon_hover_background_color'];
			}

			$params_array['icon_color'] = $params['icon_color'];

			if ( ! empty( $params['icon_hover_color'] ) ) {
				$params_array['hover_icon_color'] = $params['icon_hover_color'];
			}

			$params_array['icon_animation']       = $params['icon_animation'];
			$params_array['icon_animation_delay'] = $params['icon_animation_delay'];
		}

		return $params_array;
	}

	private function getInnerHolderClasses( $params ) {
		$holderClasses = array( 'mkdf-iwt-inner', 'clearfix' );

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-iwt-' . $params['type'] : '';
		$holderClasses[] = ! empty( $params['icon_size'] ) ? 'mkdf-iwt-' . str_replace( 'mkdf-', '', $params['icon_size'] ) : '';
        $holderClasses[] = ! empty( $params['regular_shadow'] ) ? 'mkdf-iwt-' . $params['regular_shadow'] : '';
        $holderClasses[] = ! empty( $params['hover_shadow'] ) ? 'mkdf-iwt-' . $params['hover_shadow'] : '';
        $holderClasses[] = ! empty( $params['hover_effect'] ) ? 'mkdf-iwt-' . $params['hover_effect'] : '';
        $holderClasses[] = ! empty( $params['border'] ) ? 'mkdf-iwt-' . $params['border'] : '';
        $holderClasses[] = ($params['type'] == 'icon-left-from-title-and-text' && ! empty( $params['show_arrow'] )) ? 'mkdf-iwt-' . $params['show_arrow'] : '';
        $holderClasses[] = ($params['type'] == 'icon-left-from-title-and-text' && ! empty( $params['text_alignment'] )) ? 'mkdf-iwt-align-' . $params['text_alignment'] : '';

		return $holderClasses;
	}

	private function getContentStyles( $params ) {
		$styles = array();

		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-left' ) {
			$styles[] = 'padding-left: ' . foton_mikado_filter_px( $params['text_padding'] ) . 'px';
		}

		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-top' ) {
			$styles[] = 'padding-top: ' . foton_mikado_filter_px( $params['text_padding'] ) . 'px';
		}

		if ( $params['text_bottom_padding'] !== '') {
			$styles[] = 'padding-bottom: ' . foton_mikado_filter_px( $params['text_bottom_padding'] ) . 'px';
		}

		return implode( ';', $styles );
	}

	private function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

		if ( $params['title_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . foton_mikado_filter_px( $params['title_top_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}

	private function getTextStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}

		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . foton_mikado_filter_px( $params['text_top_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}

	private function getPaddingStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['custom_padding'] ) ) {
			$styles[] = 'padding: ' . $params['custom_padding'];
		}

		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorIconWithText() );