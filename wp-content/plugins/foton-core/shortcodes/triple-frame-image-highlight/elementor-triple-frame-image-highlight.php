<?php

class ElementorTripleFrameImageHighlight extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_triple_frame_image_highlight';
	}
	
	public function get_title() {
		return esc_html__( 'Triple Frame Image Highlight', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-triple-frame-image-highlight';
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
			'centered_image',
			[
				'label'       => esc_html__( 'Centered Image', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
			]
		);
		
		$this->add_control(
			'centered_image_link',
			[
				'label'       => esc_html__( 'Centered Image Link', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'left_image',
			[
				'label'       => esc_html__( 'Left Image', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
			]
		);
		
		$this->add_control(
			'left_image_link',
			[
				'label'       => esc_html__( 'Left Image Link', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'right_image',
			[
				'label'       => esc_html__( 'Right Image', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
			]
		);
		
		$this->add_control(
			'right_image_link',
			[
				'label'       => esc_html__( 'Right Image Link', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'enable_navigation',
			[
				'label'       => esc_html__( 'Enable Navigation', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false )
			]
		);
		
		$this->add_control(
			'link_target',
			[
				'label'       => esc_html__( 'Link Target', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_link_target_array()
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args   = array(
			'centered_image'      => '',
			'centered_image_link' => '',
			'left_image'          => '',
			'left_image_link'     => '',
			'right_image'         => '',
			'right_image_link'    => '',
			'link_target'         => '',
			'enable_navigation'   => 'no',
		);
		
		if ( ! empty( $params['centered_image'] ) ) {
			$params['centered_image'] = $params['centered_image']['id'];
		}
		
		if ( ! empty( $params['left_image'] ) ) {
			$params['left_image'] = $params['left_image']['id'];
		}
		
		if ( ! empty( $params['right_image'] ) ) {
			$params['right_image'] = $params['right_image']['id'];
		}
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		
		echo foton_core_get_shortcode_module_template_part( 'templates/triple-frame-image-highlight-template', 'triple-frame-image-highlight', '', $params );
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['layout'] ) ? 'mkdf-tfih-' . $params['layout'] : '';
		$holderClasses[] = ( $params['enable_navigation'] == 'yes' ) ? 'mkdf-tfih-with-nav' : '';
		
		return implode( ' ', $holderClasses );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorTripleFrameImageHighlight() );