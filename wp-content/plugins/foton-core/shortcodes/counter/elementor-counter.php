<?php

class ElementorCounter extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_counter';
	}
	
	public function get_title() {
		return esc_html__( 'Counter', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-counter';
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
					'mkdf-zero-counter'   => esc_html__( 'Zero Counter', 'foton-core' ),
					'mkdf-random-counter' => esc_html__( 'Random Counter', 'foton-core' )
				]
			]
		);
		
		$this->add_control(
			'digit',
			[
				'label'       => esc_html__( 'Digit', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'digit_font_size',
			[
				'label'       => esc_html__( 'Digit Font Size (px)', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'digit!' => ''
				],
			]
		);
		
		$this->add_control(
			'digit_color',
			[
				'label'     => esc_html__( 'Digit Color', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'digit!' => ''
				],
			]
		);
		
		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
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
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'title!' => ''
				],
			]
		);
		
		$this->add_control(
			'title_font_weight',
			[
				'label'   => esc_html__( 'Title Font Weight', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_font_weight_array( true ),
				'condition' => [
					'title!' => ''
				],
			]
		);
		
		$this->add_control(
			'text',
			[
				'label'       => esc_html__( 'Text', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
			]
		);
		
		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'text!' => ''
				],
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args   = array(
			'custom_class'      => '',
			'type'              => 'mkdf-zero-counter',
			'digit'             => '123',
			'digit_font_size'   => '',
			'digit_color'       => '',
			'title'             => '',
			'title_tag'         => 'h4',
			'title_color'       => '',
			'title_font_weight' => '',
			'text'              => '',
			'text_color'        => ''
		);
		
		$params['holder_classes']       = $this->getHolderClasses( $params );
		$params['counter_styles']       = $this->getCounterStyles( $params );
		$params['counter_title_styles'] = $this->getCounterTitleStyles( $params );
		$params['counter_text_styles']  = $this->getCounterTextStyles( $params );
		
		$params['title_tag'] = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		
		echo foton_core_get_shortcode_module_template_part( 'templates/counter', 'counter', '', $params );
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getCounterStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['digit_font_size'] ) ) {
			$styles[] = 'font-size: ' . foton_mikado_filter_px( $params['digit_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['digit_color'] ) ) {
			$styles[] = 'color: ' . $params['digit_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getCounterTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( ! empty( $params['title_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['title_font_weight'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getCounterTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorCounter() );