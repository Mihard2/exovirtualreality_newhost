<?php

class ElementorImageWithText extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_image_with_text';
	}
	
	public function get_title() {
		return esc_html__( 'Image With Text', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-image-with-text';
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
				'label'   => esc_html__( 'Enable Image Shadow', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false ),
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
		
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'title_tag',
			[
				'label'     => esc_html__( 'Title Tag', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_title_tag( true ),
				'condition' => [
					'title!' => ''
				],
				'default'   => 'h4'
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
			'title_top_margin',
			[
				'label'     => esc_html__( 'Title Top Margin (px)', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'title!' => ''
				],
			]
		);
		
		$this->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
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
		
		$this->add_control(
			'text_top_margin',
			[
				'label'     => esc_html__( 'Text Top Margin (px)', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'text!' => ''
				],
			]
		);
		
		$this->add_control(
			'enable_new',
			[
				'label'   => esc_html__( 'Enable "New" Sticker', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''    => esc_html__( 'No', 'foton-core' ),
					'yes' => esc_html__( 'Yes', 'foton-core' ),
				],
			]
		);
		
		$this->add_control(
			'enable_bottom_buttons',
			[
				'label'     => esc_html__( 'Enable Bottom Buttons', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_yes_no_select_array( false ),
				'condition' => [
					'image_behavior' => array( 'custom-link' )
				],
			]
		);
		
		$this->add_control(
			'bakery_button_link',
			[
				'label'     => esc_html__( 'WP Bakery Button Link', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'enable_bottom_buttons' => array( 'yes' )
				],
			]
		);
		
		$this->add_control(
			'elementor_button_link',
			[
				'label'     => esc_html__( 'Elementor Button Link', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'enable_bottom_buttons' => array( 'yes' )
				],
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args = array(
			'custom_class'          => '',
			'image'                 => '',
			'image_size'            => 'full',
			'enable_image_shadow'   => 'no',
			'image_behavior'        => '',
			'custom_link'           => '',
			'custom_link_target'    => '_self',
			'title'                 => '',
			'title_tag'             => 'h4',
			'title_color'           => '',
			'title_top_margin'      => '',
			'text'                  => '',
			'text_color'            => '',
			'text_top_margin'       => '',
			'enable_bottom_buttons' => '',
			'bakery_button_link'    => '',
			'elementor_button_link' => ''
		);
		
		if ( ! empty( $params['image'] ) ) {
			$params['image'] = $params['image']['id'];
		}
		
		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['image']              = $this->getImage( $params );
		$params['image_size']         = $this->getImageSize( $params['image_size'] );
		$params['image_behavior']     = ! empty( $params['image_behavior'] ) ? $params['image_behavior'] : $args['image_behavior'];
		$params['custom_link_target'] = ! empty( $params['custom_link_target'] ) ? $params['custom_link_target'] : $args['custom_link_target'];
		$params['title_tag']          = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']       = $this->getTitleStyles( $params );
		$params['text_styles']        = $this->getTextStyles( $params );
		
		echo foton_core_get_shortcode_module_template_part( 'templates/image-with-text', 'image-with-text', '', $params );
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'mkdf-has-shadow' : '';
		$holderClasses[] = ! empty( $params['image_behavior'] ) ? 'mkdf-image-behavior-' . $params['image_behavior'] : '';
		$holderClasses[] = $params['enable_bottom_buttons'] === 'yes' ? 'mkdf-image-bottom-buttons' : '';
		
		return implode( ' ', $holderClasses );
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
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorImageWithText() );