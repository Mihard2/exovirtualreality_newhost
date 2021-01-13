<?php

class ElementorSingleImage extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_single_image';
	}
	
	public function get_title() {
		return esc_html__( 'Single Image', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-single-image';
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
			'image',
			[
				'label'       => esc_html__( 'Image', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select image from media library', 'foton-core' )
			]
		);
		
		$this->add_control(
			'image_size',
			[
				'label'       => esc_html__( 'Image Size', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'foton-core' ),
				'default'     => 'full'
			]
		);
		
		$this->add_control(
			'enable_image_shadow',
			[
				'label'   => esc_html__( 'Enable Image Shadow on Hover', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false ),
				'default' => 'no'
			]
		);
		
		$this->add_control(
			'enable_rounded_image',
			[
				'label'   => esc_html__( 'Enable Rounded Image', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array(false),
				'default' => 'no'
			]
		);
		
		$this->add_control(
			'image_behavior',
			[
				'label'   => esc_html__( 'Image Behavior', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''            => esc_html__( 'None', 'foton-core' ),
					'lightbox'    => esc_html__( 'Open Lightbox', 'foton-core' ),
					'custom-link' => esc_html__( 'Open Custom Link', 'foton-core' ),
					'zoom'        => esc_html__( 'Zoom', 'foton-core' ),
					'grayscale'   => esc_html__( 'Grayscale', 'foton-core' ),
					'moving'      => esc_html__( 'Moving on Hover', 'foton-core' ),
				],
			]
		);
		
		$this->add_control(
			'custom_link',
			[
				'label'     => esc_html__( 'Custom Link', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'image_behavior' => array( 'custom-link' )
				],
			]
		);
		
		$this->add_control(
			'custom_link_target',
			[
				'label'     => esc_html__( 'Custom Link Target', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_link_target_array(),
				'condition' => [
					'image_behavior' => array( 'custom-link' )
				],
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args   = array(
			'image'                => '',
			'image_size'           => 'full',
			'enable_image_shadow'  => 'no',
			'enable_rounded_image' => 'no',
			'image_behavior'       => '',
			'custom_link'          => '',
			'custom_link_target'   => '_self'
		);
		
		if ( ! empty( $params['image'] ) ) {
			$params['image'] = $params['image']['id'];
		}
		
		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['holder_styles']      = $this->getHolderStyles( $params );
		$params['image']              = $this->getImage( $params );
		$params['image_size']         = $this->getImageSize( $params['image_size'] );
		$params['image_behavior']     = ! empty( $params['image_behavior'] ) ? $params['image_behavior'] : $args['image_behavior'];
		$params['custom_link_target'] = ! empty( $params['custom_link_target'] ) ? $params['custom_link_target'] : $args['custom_link_target'];
		
		echo foton_core_get_shortcode_module_template_part( 'templates/single-image', 'single-image', '', $params );
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'mkdf-has-shadow' : '';
		$holderClasses[] = $params['enable_rounded_image'] === 'yes' ? 'mkdf-rounded-image' : '';
		$holderClasses[] = ! empty( $params['image_behavior'] ) ? 'mkdf-image-behavior-' . $params['image_behavior'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['image'] ) && $params['image_behavior'] === 'moving' ) {
			$image_original = wp_get_attachment_image_src( $params['image'], 'full' );
			
			$styles[] = 'background-image: url(' . $image_original[0] . ')';
		}
		
		return implode( ';', $styles );
	}
	
	private function getImage( $params ) {
		$image = array();
		
		if ( ! empty( $params['image'] ) ) {
			$id = $params['image'];
			
			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
		}
		
		return $image;
	}
	
	private function getImageSize( $image_size ) {
		$image_size = trim( $image_size );
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
			return $image_size;
		} elseif ( ! empty( $matches[0] ) ) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} else {
			return 'thumbnail';
		}
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorSingleImage() );