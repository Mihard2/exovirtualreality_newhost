<?php

class ElementorHorizontalLayerSlider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_elementor_horizontal_layer_slider';
	}

	public function get_title() {
		return esc_html__( 'Horizontal Layer Slider', 'foton-core' );
	}

	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-horizontal-layer-slider';
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
			'mouse_wheel_control',
			[
				'label'   => esc_html__( 'Mouse Wheel Control', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'no'  => esc_html__( 'No', 'foton-core' ),
					'yes' => esc_html__( 'Yes', 'foton-core' )
				]
			]
		);

		$this->add_control(
			'height',
			[
				'label' => esc_html__( 'Slider Height (px)', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'background_image',
			[
				'label'       => esc_html__( 'Background Image', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select image from media library', 'foton-core' )
			]
		);

		$repeater->add_control(
			'parallax_image',
			[
				'label'       => esc_html__( 'Parallax Image', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select image from media library', 'foton-core' )
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'target',
			[
				'label'   => esc_html__( 'Custom Link Target', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_link_target_array(),
				'default' => '_self'
			]
		);

		$this->add_control(
			'horizontal_layer_slider_items',
			[
				'label'       => esc_html__( 'Horizontal Layer Slider Items', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => esc_html__( 'Horizontal Layer Slider Item' ),
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 *
	 * @return string
	 */
	public function render() {
		$params = $this->get_settings_for_display();

		$args = array(
			'mouse_wheel_control'           => '',
			'horizontal_layer_slider_items' => '',
			'height'                        => ''
		);
		
		$params['data_params'] = $this->getDataParams($params);
		$params['slider_styles'] = $this->getSliderStyles($params);

		//Get HTML from template
		echo foton_core_get_shortcode_module_template_part( 'templates/elementor-horizontal-layer-slider', 'horizontal-layer-slider', '', $params );
	}

	/**
	 * Return Horizontal Layer Slider data params
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getDataParams($params) {
		$data = array();
		
		$data['data-mouse-wheel-control'] = $params['mouse_wheel_control'];
		
		return $data;
	}
	
	private function getSliderStyles($params) {
		$styles = array();
		
		if ( ! empty( $params['height'] ) ) {
			$styles[] = 'max-height: ' . foton_mikado_filter_px($params['height']) . 'px';
		}
		
		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorHorizontalLayerSlider() );