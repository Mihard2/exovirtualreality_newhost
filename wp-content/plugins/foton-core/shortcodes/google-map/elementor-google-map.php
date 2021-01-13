<?php

class ElementorGoogleMap extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_google_map';
	}
	
	public function get_title() {
		return esc_html__( 'Google Map', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-google-map';
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
			'address1',
			[
				'label'       => esc_html__( 'Address 1', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'address2',
			[
				'label'       => esc_html__( 'Address 2', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'address1!' => ''
				],
			]
		);
		
		$this->add_control(
			'address3',
			[
				'label'       => esc_html__( 'Address 3', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'address2!' => ''
				],
			]
		);
		
		$this->add_control(
			'address4',
			[
				'label'       => esc_html__( 'Address 4', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'address3!' => ''
				],
			]
		);
		
		$this->add_control(
			'address5',
			[
				'label'       => esc_html__( 'Address 5', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'address4!' => ''
				],
			]
		);
		
		$this->add_control(
			'snazzy_map_style',
			[
				'label'   => esc_html__( 'Snazzy Map Style', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false ),
				'description' => esc_html__( 'Enabling this option will set predefined snazzy map style', 'foton-core' ),
				'default' => 'no'
			]
		);
		
		$this->add_control(
			'snazzy_map_code',
			[
				'label'       => esc_html__( 'Snazzy Map Code', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'condition' => [
					'snazzy_map_style' => array( 'yes' )
				],
				'description' => sprintf( esc_html__( 'Fill code from snazzy map site %s to add predefined style for your google map', 'foton-core' ), '<a href="https://snazzymaps.com/" target="_blank">https://snazzymaps.com/</a>' ),
			]
		);
		
		$this->add_control(
			'custom_map_style',
			[
				'label'   => esc_html__( 'Custom Map Style', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false ),
				'condition' => [
					'snazzy_map_style' => array( 'no' )
				],
				'description' => esc_html__( 'Enabling this option will allow Map editing', 'foton-core' ),
				'default' => 'no'
			]
		);
		
		$this->add_control(
			'color_overlay',
			[
				'label'     => esc_html__( 'Color Overlay', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'snazzy_map_style' => array( 'no' )
				],
				'description' => esc_html__( 'Choose a Map color overlay', 'foton-core' ),
				'default' => ''
			]
		);
		
		$this->add_control(
			'saturation',
			[
				'label'       => esc_html__( 'Saturation', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'snazzy_map_style' => array( 'no' )
				],
				'description' => esc_html__( 'Enabling this option will allow Map editing', 'foton-core' ),
				'default' => '0'
			]
		);
		
		$this->add_control(
			'lightness',
			[
				'label'       => esc_html__( 'Lightness', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'snazzy_map_style' => array( 'no' )
				],
				'description' => esc_html__( 'Choose a level of lightness (-100 = darkest, 100 = lightest)', 'foton-core' ),
				'default' => '0'
			]
		);
		
		$this->add_control(
			'pin',
			[
				'label'       => esc_html__( 'Pin', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select a pin image to be used on Google Map', 'foton-core' )
			]
		);
		
		$this->add_control(
			'zoom',
			[
				'label'       => esc_html__( 'Map Zoom', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter a zoom factor for Google Map (0 = whole worlds, 19 = individual buildings)', 'foton-core' ),
				'default' => '12'
			]
		);
		
		$this->add_control(
			'scroll_wheel',
			[
				'label'   => esc_html__( 'Zoom Map on Mouse Wheel', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false ),
				'description' => esc_html__( 'Enabling this option will allow users to zoom in on Map using mouse wheel', 'foton-core' ),
				'default' => 'no'
			]
		);
		
		$this->add_control(
			'map_height',
			[
				'label'       => esc_html__( 'Map Height', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default' => '600'
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args   = array(
			'address1'         => '',
			'address2'         => '',
			'address3'         => '',
			'address4'         => '',
			'address5'         => '',
			'snazzy_map_style' => 'no',
			'snazzy_map_code'  => '',
			'custom_map_style' => 'no',
			'color_overlay'    => '#393939',
			'saturation'       => '-100',
			'lightness'        => '-60',
			'zoom'             => '12',
			'pin'              => '',
			'scroll_wheel'     => 'no',
			'map_height'       => '600'
		);
		
		$rand_id = mt_rand( 100000, 3000000 );
		
		$params['is_elementor'] = true;
		
		if ( ! empty( $params['pin'] ) ) {
			$params['pin'] = $params['pin']['id'];
		}
		
		$params['map_data'] = $this->getMapDate( $params, $rand_id );
		$params['map_id']   = 'mkdf-map-' . $rand_id;
		
		echo foton_core_get_shortcode_module_template_part( 'templates/google-map-template', 'google-map', '', $params );
	}
	
	private function getMapDate( $params, $id ) {
		$map_data = array();
		
		$addresses_array = array();
		if ( $params['address1'] != '' ) {
			array_push( $addresses_array, esc_attr( $params['address1'] ) );
		}
		if ( $params['address2'] != '' ) {
			array_push( $addresses_array, esc_attr( $params['address2'] ) );
		}
		if ( $params['address3'] != '' ) {
			array_push( $addresses_array, esc_attr( $params['address3'] ) );
		}
		if ( $params['address4'] != '' ) {
			array_push( $addresses_array, esc_attr( $params['address4'] ) );
		}
		if ( $params['address5'] != '' ) {
			array_push( $addresses_array, esc_attr( $params['address5'] ) );
		}
		
		if ( $params['pin'] != "" ) {
			$map_pin = wp_get_attachment_image_src( $params['pin'], 'full', true );
			$map_pin = $map_pin[0];
		} else {
			$map_pin = get_template_directory_uri() . "/assets/img/pin.png";
		}
		
		$map_data[] = "data-addresses='[\"" . implode( '","', $addresses_array ) . "\"]'";
		$map_data[] = 'data-custom-map-style=' . $params['custom_map_style'];
		$map_data[] = 'data-color-overlay=' . $params['color_overlay'];
		$map_data[] = 'data-saturation=' . $params['saturation'];
		$map_data[] = 'data-lightness=' . $params['lightness'];
		$map_data[] = 'data-zoom=' . $params['zoom'];
		$map_data[] = 'data-pin=' . $map_pin;
		$map_data[] = 'data-unique-id=' . $id;
		$map_data[] = 'data-scroll-wheel=' . $params['scroll_wheel'];
		$map_data[] = 'data-height=' . $params['map_height'];
		$map_data[] = $params['snazzy_map_style'] == 'yes' ? 'data-snazzy-map-style=yes' : '';
		
		return implode( ' ', $map_data );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorGoogleMap() );