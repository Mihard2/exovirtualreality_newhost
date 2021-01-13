<?php

class ElementorButton extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_button';
	}
	
	public function get_title() {
		return esc_html__( 'Button', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-button';
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
			'type',
			[
				'label'   => esc_html__( 'Type', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'solid'   => esc_html__( 'Solid', 'foton-core' ),
					'outline' => esc_html__( 'Outline', 'foton-core' ),
					'simple'  => esc_html__( 'Simple', 'foton-core' )
				],
			]
		);
		
		$this->add_control(
			'size',
			[
				'label'     => esc_html__( 'Size', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					''       => esc_html__( 'Default', 'foton-core' ),
					'small'  => esc_html__( 'Small', 'foton-core' ),
					'medium' => esc_html__( 'Medium', 'foton-core' ),
					'large'  => esc_html__( 'Large', 'foton-core' ),
					'huge'   => esc_html__( 'Huge', 'foton-core' ),
				],
				'condition' => [
					'type' => array( 'solid', 'outline' )
				],
			]
		);
		
		$this->add_control(
			'text',
			[
				'label'       => esc_html__( 'Text', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'foton-core' )
			]
		);
		
		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'target',
			[
				'label'   => esc_html__( 'Link Target', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_link_target_array(),
			]
		);
		
		foton_mikado_icon_collections()->getElementorParamsArray( $this, '', '' );
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'design_options',
			[
				'label' => esc_html__( 'Design Options', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'color',
			[
				'label' => esc_html__( 'Color', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			]
		);
		
		$this->add_control(
			'hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'solid', 'outline' )
				],
			]
		);
		
		$this->add_control(
			'background_color',
			[
				'label'     => esc_html__( 'Background Color', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'solid' )
				],
			]
		);
		
		$this->add_control(
			'hover_background_color',
			[
				'label'     => esc_html__( 'Hover Background Color', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'outline' )
				],
			]
		);
		
		$this->add_control(
			'border_color',
			[
				'label'     => esc_html__( 'Border Color', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'solid', 'outline' )
				],
			]
		);
		
		$this->add_control(
			'hover_border_color',
			[
				'label'     => esc_html__( 'Hover Border Color', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'outline' )
				],
			]
		);
		
		$this->add_control(
			'margin',
			[
				'label'       => esc_html__( 'Margin', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'foton-core' ),
			]
		);
		
		$this->add_control(
			'padding',
			[
				'label'       => esc_html__( 'Button Padding', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'type' => array( 'solid', 'outline' )
				],
				'description' => esc_html__( 'Insert padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'foton-core' ),
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'font_size',
			[
				'label' => esc_html__( 'Font Size (px)', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'font_weight',
			[
				'label'   => esc_html__( 'Font Weight', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_font_weight_array( true ),
			]
		);
		
		$this->add_control(
			'text_transform',
			[
				'label'   => esc_html__( 'Text Transform', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_text_transform_array( true ),
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$default_atts = array(
			'size'                   => '',
			'type'                   => 'solid',
			'text'                   => '',
			'link'                   => '',
			'target'                 => '_self',
			'color'                  => '',
			'hover_color'            => '',
			'background_color'       => '',
			'hover_background_color' => '',
			'border_color'           => '',
			'hover_border_color'     => '',
			'font_size'              => '',
			'font_weight'            => '',
			'text_transform'         => '',
			'margin'                 => '',
			'padding'                => '',
			'custom_class'           => '',
			'html_type'              => 'anchor',
			'input_name'             => '',
			'custom_attrs'           => array()
		);
		
		if ( ! isset ( $params['html_type'] ) ) {
			$params['html_type'] = $default_atts['html_type'];
		}
		
		$params['icon'] = foton_mikado_icon_collections()->getShortcodeParams();
		
		if ( $params['html_type'] !== 'input' ) {
			$iconPackName   = foton_mikado_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
			$params['icon'] = $iconPackName ? $params[ $iconPackName ] : '';
		}
		
		$params['size'] = ! empty( $params['size'] ) ? $params['size'] : 'large';
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : 'solid';
		
		$params['link']   = ! empty( $params['link'] ) ? $params['link'] : '#';
		$params['target'] = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];
		
		$params['button_classes']      = $this->getButtonClasses( $params );
		$params['button_custom_attrs'] = ! empty( $params['custom_attrs'] ) ? $params['custom_attrs'] : array();
		$params['button_styles']       = $this->getButtonStyles( $params );
		$params['button_data']         = $this->getButtonDataAttr( $params );
		
		echo foton_core_get_shortcode_module_template_part( 'templates/' . $params['html_type'], 'button', '', $params );
	}
	
	private function getButtonStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		if ( ! empty( $params['background_color'] ) && $params['type'] !== 'outline' ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		if ( ! empty( $params['border_color'] ) ) {
			$styles[] = 'border-color: ' . $params['border_color'];
		}
		
		if ( ! empty( $params['font_size'] ) ) {
			$styles[] = 'font-size: ' . foton_mikado_filter_px( $params['font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['font_weight'] ) && $params['font_weight'] !== '' ) {
			$styles[] = 'font-weight: ' . $params['font_weight'];
		}
		
		if ( ! empty( $params['text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['text_transform'];
		}
		
		if ( $params['margin'] !== '' ) {
			$styles[] = 'margin: ' . $params['margin'];
		}
		
		if ( $params['padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['padding'];
		}
		
		return $styles;
	}
	
	private function getButtonDataAttr( $params ) {
		$data = array();
		
		if ( ! empty( $params['hover_color'] ) ) {
			$data['data-hover-color'] = $params['hover_color'];
		}
		
		if ( ! empty( $params['hover_background_color'] ) ) {
			$data['data-hover-bg-color'] = $params['hover_background_color'];
		}
		
		if ( ! empty( $params['hover_border_color'] ) ) {
			$data['data-hover-border-color'] = $params['hover_border_color'];
		}
		
		return $data;
	}
	
	private function getButtonClasses( $params ) {
		$buttonClasses = array(
			'mkdf-btn',
			'mkdf-btn-' . $params['size'],
			'mkdf-btn-' . $params['type']
		);
		
		if ( ! empty( $params['hover_background_color'] ) ) {
			$buttonClasses[] = 'mkdf-btn-custom-hover-bg';
		}
		
		if ( ! empty( $params['hover_border_color'] ) ) {
			$buttonClasses[] = 'mkdf-btn-custom-border-hover';
		}
		
		if ( ! empty( $params['hover_color'] ) ) {
			$buttonClasses[] = 'mkdf-btn-custom-hover-color';
		}
		
		if ( ! empty( $params['icon'] ) ) {
			$buttonClasses[] = 'mkdf-btn-icon';
		}
		
		if ( ! empty( $params['custom_class'] ) ) {
			$buttonClasses[] = esc_attr( $params['custom_class'] );
		}
		
		return $buttonClasses;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorButton() );