<?php

class ElementorFloatingImages extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_floating_images';
	}
	
	public function get_title() {
		return esc_html__( 'Floating Images', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-floating-images';
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
			'main_image',
			[
				'label' => esc_html__( 'Main Image', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::MEDIA
			]
		);
		
		$this->add_control(
			'main_image_shadow',
			[
				'label'       => esc_html__( 'Main Image Shadow', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::COLOR,
				'condition'   => [
					'main_image!' => ''
				],
				'description' => esc_html__( 'Main Image width in relation to shortcode holder width(%).', 'foton-core' )
			]
		);
		
		$this->add_control(
			'main_image_width',
			[
				'label'       => esc_html__( 'Main Image Width', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Main Image width in relation to shortcode holder width(%).', 'foton-core' ),
				'condition'   => [
					'main_image!' => ''
				]
			]
		);
		
		$this->add_control(
			'aux_image',
			[
				'label' => esc_html__( 'Aux Image', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::MEDIA
			]
		);
		
		$this->add_control(
			'aux_image_shadow',
			[
				'label'     => esc_html__( 'Aux Image Shadow', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'aux_image!' => ''
				]
			]
		);
		
		$this->add_control(
			'aux_image_width',
			[
				'label'       => esc_html__( 'Aux Image Width', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Aux Image width in relation to shortcode holder width(%).', 'foton-core' ),
				'condition'   => [
					'aux_image!' => ''
				]
			]
		);
		
		$this->add_control(
			'aux_image_x_offset',
			[
				'label'       => esc_html__( 'Aux Image X Offset', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Horizontal Offset based on Main Image width(%).', 'foton-core' ),
			]
		);
		
		$this->add_control(
			'aux_image_y_offset',
			[
				'label'       => esc_html__( 'Aux Image Y Offset', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Vertical Offset based on Main Image height(%).', 'foton-core' ),
				'condition'   => [
					'aux_image!' => ''
				]
			]
		);
		
		$this->add_control(
			'image_overlay',
			[
				'label' => esc_html__( 'Image Overlay', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::MEDIA
			]
		);
		
		$this->add_control(
			'alignment',
			[
				'label'   => esc_html__( 'Alignment', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'left-aligned'  => esc_html__( 'Left-Aligned', 'foton-core' ),
					'centered'      => esc_html__( 'Centered', 'foton-core' ),
					'right-aligned' => esc_html__( 'Right-Aligned', 'foton-core' )
				]
			]
		);
		
		$this->add_control(
			'enable_parallax_animation',
			[
				'label'   => esc_html__( 'Enable Parallax Animation', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false, true )
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args = array(
			'main_image'                => '',
			'main_image_width'          => '',
			'main_image_shadow'         => '',
			'aux_image'                 => '',
			'aux_image_shadow'          => '',
			'aux_image_width'           => '',
			'aux_image_x_offset'        => '',
			'aux_image_y_offset'        => '',
			'image_overlay'             => '',
			'alignment'                 => 'left-aligned',
			'enable_parallax_animation' => 'yes'
		);
		
		if ( ! empty( $params['main_image'] ) ) {
			$params['main_image'] = $params['main_image']['id'];
		}
		
		if ( ! empty( $params['aux_image'] ) ) {
			$params['aux_image'] = $params['aux_image']['id'];
		}
		
		$params['holder_classes']              = $this->getHolderClasses( $params );
		$params['main_image_styles']           = $this->getMainImageStyles( $params );
		$params['aux_image_styles']            = $this->getAuxImageStyles( $params );
		$params['main_image_position_data']    = $this->getMainImagePositionData( $params );
		$params['aux_image_position_data']     = $this->getAuxImagePositionData( $params );
		$params['main_image_parallax_data']    = $this->getMainParallaxData( $params );
		$params['aux_image_parallax_data']     = $this->getAuxParallaxData( $params );
		$params['overlay_image_parallax_data'] = $this->getOverlayParallaxData( $params );
		
		echo foton_core_get_shortcode_module_template_part( 'templates/floating-images-template', 'floating-images', '', $params );
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['alignment'] ) ? 'mkdf-fi-' . $params['alignment'] : '';
		$holderClasses[] = ( $params['enable_parallax_animation'] == 'yes' ) ? 'mkdf-fi-parallax' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getMainImageStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['main_image_shadow'] ) ) {
			if ( ! empty( $params['aux_image_x_offset'] ) ) {
				if ( foton_mikado_filter_percentage( $params['aux_image_x_offset'] ) > 0 ) {
					$styles[] = 'box-shadow: -10px 10px 35px 5px ' . $params['main_image_shadow'];
				} else {
					$styles[] = 'box-shadow: 10px 10px 35px 5px ' . $params['main_image_shadow'];
				}
			} else {
				$styles[] = 'box-shadow: 0 10px 35px 5px ' . $params['main_image_shadow'];
			}
		}
		
		return implode( ';', $styles );
	}
	
	private function getAuxImageStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['aux_image_shadow'] ) ) {
			$styles[] = 'box-shadow: 0 10px 35px 5px ' . $params['aux_image_shadow'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getMainImagePositionData( $params ) {
		$data = array();
		
		if ( ! empty( $params['main_image_width'] ) ) {
			$data['data-width'] = foton_mikado_filter_percentage( $params['main_image_width'] ) . '%';
		}
		
		return $data;
	}
	
	private function getAuxImagePositionData( $params ) {
		$data = array();
		
		if ( ! empty( $params['aux_image_x_offset'] ) ) {
			$data['data-x'] = foton_mikado_filter_percentage( $params['aux_image_x_offset'] ) . '%';
		}
		
		if ( ! empty( $params['aux_image_y_offset'] ) ) {
			$data['data-y'] = foton_mikado_filter_percentage( $params['aux_image_y_offset'] ) . '%';
		}
		
		if ( ! empty( $params['aux_image_width'] ) ) {
			$data['data-width'] = foton_mikado_filter_percentage( $params['aux_image_width'] ) . '%';
		}
		
		return $data;
	}
	
	private function getMainParallaxData( $params ) {
		$data = array();
		
		if ( $params['enable_parallax_animation'] === 'yes' ) {
			$y_absolute = rand( - 60, - 100 );
			$smoothness = 20; //1 is for linear, non-animated parallax
			
			$data['data-parallax'] = '{&quot;y&quot;: ' . $y_absolute . ', &quot;smoothness&quot;: ' . $smoothness . '}';
		}
		
		return $data;
	}
	
	private function getAuxParallaxData( $params ) {
		$data = array();
		
		if ( $params['enable_parallax_animation'] === 'yes' ) {
			$y_absolute = rand( - 20, - 60 );
			$smoothness = 20; //1 is for linear, non-animated parallax
			
			$data['data-parallax'] = '{&quot;y&quot;: ' . $y_absolute . ', &quot;smoothness&quot;: ' . $smoothness . '}';
		}
		
		return $data;
	}
	
	private function getOverlayParallaxData( $params ) {
		$data = array();
		
		if ( $params['enable_parallax_animation'] === 'yes' ) {
			$y_absolute = rand( - 30, - 40 );
			$smoothness = 20; //1 is for linear, non-animated parallax
			
			$data['data-parallax'] = '{&quot;y&quot;: ' . $y_absolute . ', &quot;smoothness&quot;: ' . $smoothness . '}';
		}
		
		return $data;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorFloatingImages() );