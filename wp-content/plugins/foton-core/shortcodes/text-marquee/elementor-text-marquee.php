<?php

class ElementorTextMarquee extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_text_marquee';
	}
	
	public function get_title() {
		return esc_html__( 'Text Marquee', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-text-marquee';
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
			'text',
			[
				'label'       => esc_html__( 'Text', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'color',
			[
				'label'       => esc_html__( 'Text Color', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::COLOR,
			]
		);
		
		$this->add_control(
			'font_size',
			[
				'label'       => esc_html__( 'Font Size (px or em)', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'line_height',
			[
				'label'       => esc_html__( 'Line Height (px or em)', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'font_weight',
			[
				'label'       => esc_html__( 'Font Weight', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_font_weight_array( true )
			]
		);
		
		$this->add_control(
			'font_style',
			[
				'label'       => esc_html__( 'Font Style', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_font_style_array( true )
			]
		);
		
		$this->add_control(
			'letter_spacing',
			[
				'label'       => esc_html__( 'Letter Spacing (px or em)', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'text_transform',
			[
				'label'       => esc_html__( 'Text Transform', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_text_transform_array( true )
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'laptops',
			[
				'label' => esc_html__( 'Laptops', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'font_size_1366',
			[
				'label'       => esc_html__( 'Font Size (px or em)', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'foton-core' )
			]
		);
		
		$this->add_control(
			'line_height_1366',
			[
				'label'       => esc_html__( 'Line Height (px or em)', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'tablets_landscape',
			[
				'label' => esc_html__( 'Tablets Landscape', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'font_size_1024',
			[
				'label'       => esc_html__( 'Font Size (px or em)', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'line_height_1024',
			[
				'label'       => esc_html__( 'Line Height (px or em)', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'tablets_portrait',
			[
				'label' => esc_html__( 'Tablets Landscape', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'font_size_768',
			[
				'label'       => esc_html__( 'Font Size (px or em)', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'line_height_768',
			[
				'label'       => esc_html__( 'Line Height (px or em)', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'mobiles',
			[
				'label' => esc_html__( 'Mobiles', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'font_size_680',
			[
				'label'       => esc_html__( 'Font Size (px or em)', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'line_height_680',
			[
				'label'       => esc_html__( 'Line Height (px or em)', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args = array(
			'text'             => '',
			'color'            => '',
			'font_size'        => '',
			'line_height'      => '',
			'font_weight'      => '',
			'font_style'       => '',
			'letter_spacing'   => '',
			'text_transform'   => '',
			'font_size_1366'   => '',
			'line_height_1366' => '',
			'font_size_1024'   => '',
			'line_height_1024' => '',
			'font_size_768'    => '',
			'line_height_768'  => '',
			'font_size_680'    => '',
			'line_height_680'  => ''
		);
		
		$params['holder_rand_class'] = 'mkdf-tm-' . mt_rand( 1000, 10000 );
		$params['holder_classes']    = $this->getHolderClasses( $params );
		$params['text_styles'] = $this->getTextStyles( $params );
		$params['text_data']       = $this->getTextData( $params );
		
		echo foton_core_get_shortcode_module_template_part( 'templates/text-marquee', 'text-marquee', '', $params );
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['holder_rand_class'] ) ? esc_attr( $params['holder_rand_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		if ( ! empty( $params['font_size'] ) ) {
			if ( foton_mikado_string_ends_with( $params['font_size'], 'px' ) || foton_mikado_string_ends_with( $params['font_size'], 'em' ) ) {
				$styles[] = 'font-size: ' . $params['font_size'];
			} else {
				$styles[] = 'font-size: ' . $params['font_size'] . 'px';
			}
		}
		
		if ( ! empty( $params['line_height'] ) ) {
			if ( foton_mikado_string_ends_with( $params['line_height'], 'px' ) || foton_mikado_string_ends_with( $params['line_height'], 'em' ) ) {
				$styles[] = 'line-height: ' . $params['line_height'];
			} else {
				$styles[] = 'line-height: ' . $params['line_height'] . 'px';
			}
		}
		
		if ( ! empty( $params['font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['font_weight'];
		}
		
		if ( ! empty( $params['font_style'] ) ) {
			$styles[] = 'font-style: ' . $params['font_style'];
		}
		
		if ( ! empty( $params['letter_spacing'] ) ) {
			if ( foton_mikado_string_ends_with( $params['letter_spacing'], 'px' ) || foton_mikado_string_ends_with( $params['letter_spacing'], 'em' ) ) {
				$styles[] = 'letter-spacing: ' . $params['letter_spacing'];
			} else {
				$styles[] = 'letter-spacing: ' . $params['letter_spacing'] . 'px';
			}
		}
		
		if ( ! empty( $params['text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['text_transform'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextData( $params ) {
		$data                    = array();
		$data['data-item-class'] = $params['holder_rand_class'];
		
		if ( $params['font_size_1366'] !== '' ) {
			if ( foton_mikado_string_ends_with( $params['font_size_1366'], 'px' ) || foton_mikado_string_ends_with( $params['font_size_1366'], 'em' ) ) {
				$data['data-font-size-1366'] = $params['font_size_1366'];
			} else {
				$data['data-font-size-1366'] = $params['font_size_1366'] . 'px';
			}
		}
		
		if ( $params['font_size_1024'] !== '' ) {
			if ( foton_mikado_string_ends_with( $params['font_size_1024'], 'px' ) || foton_mikado_string_ends_with( $params['font_size_1024'], 'em' ) ) {
				$data['data-font-size-1024'] = $params['font_size_1024'];
			} else {
				$data['data-font-size-1024'] = $params['font_size_1024'] . 'px';
			}
		}
		
		if ( $params['font_size_768'] !== '' ) {
			if ( foton_mikado_string_ends_with( $params['font_size_768'], 'px' ) || foton_mikado_string_ends_with( $params['font_size_768'], 'em' ) ) {
				$data['data-font-size-768'] = $params['font_size_768'];
			} else {
				$data['data-font-size-768'] = $params['font_size_768'] . 'px';
			}
		}
		
		if ( $params['font_size_680'] !== '' ) {
			if ( foton_mikado_string_ends_with( $params['font_size_680'], 'px' ) || foton_mikado_string_ends_with( $params['font_size_680'], 'em' ) ) {
				$data['data-font-size-680'] = $params['font_size_680'];
			} else {
				$data['data-font-size-680'] = $params['font_size_680'] . 'px';
			}
		}
		
		if ( $params['line_height_1366'] !== '' ) {
			if ( foton_mikado_string_ends_with( $params['line_height_1366'], 'px' ) || foton_mikado_string_ends_with( $params['line_height_1366'], 'em' ) ) {
				$data['data-line-height-1366'] = $params['line_height_1366'];
			} else {
				$data['data-line-height-1366'] = $params['line_height_1366'] . 'px';
			}
		}
		
		if ( $params['line_height_1024'] !== '' ) {
			if ( foton_mikado_string_ends_with( $params['line_height_1024'], 'px' ) || foton_mikado_string_ends_with( $params['line_height_1024'], 'em' ) ) {
				$data['data-line-height-1024'] = $params['line_height_1024'];
			} else {
				$data['data-line-height-1024'] = $params['line_height_1024'] . 'px';
			}
		}
		
		if ( $params['line_height_768'] !== '' ) {
			if ( foton_mikado_string_ends_with( $params['line_height_768'], 'px' ) || foton_mikado_string_ends_with( $params['line_height_768'], 'em' ) ) {
				$data['data-line-height-768'] = $params['line_height_768'];
			} else {
				$data['data-line-height-768'] = $params['line_height_768'] . 'px';
			}
		}
		
		if ( $params['line_height_680'] !== '' ) {
			if ( foton_mikado_string_ends_with( $params['line_height_680'], 'px' ) || foton_mikado_string_ends_with( $params['line_height_680'], 'em' ) ) {
				$data['data-line-height-680'] = $params['line_height_680'];
			} else {
				$data['data-line-height-680'] = $params['line_height_680'] . 'px';
			}
		}
		
		return $data;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorTextMarquee() );