<?php

class ElementorCardsGallery extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_cards_gallery';
	}
	
	public function get_title() {
		return esc_html__( 'Cards Gallery', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-cards-gallery';
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
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'shuffled-right'   => esc_html__( 'Shuffled right', 'foton-core' ),
					'shuffled-left' => esc_html__( 'Shuffled left', 'foton-core' ),
				],
			]
		);
		
		$this->add_control(
			'images',
			[
				'label'       => esc_html__( 'Images', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::GALLERY,
				'description' => esc_html__( 'Select images from media library', 'foton-core' )
			]
		);
		
		$this->add_control(
			'bundle_animation',
			[
				'label'   => esc_html__( 'Bundle Animation', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false ),
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args   = array(
			'layout'           => 'shuffled-right',
			'images'           => '',
			'bundle_animation' => 'no'
		);
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['images']         = $this->getGalleryImages( $params );
		
		echo foton_core_get_shortcode_module_template_part( 'templates/cards-gallery', 'cards-gallery', '', $params );
	}
	
	private function getHolderClasses( $params ) {
		$classes = array( 'mkdf-cards-gallery' );
		
		$classes[] = 'mkdf-cg-' . $params['layout'];
		
		if ( $params['bundle_animation'] === 'yes' ) {
			$classes[] = 'mkdf-no-events mkdf-bundle-animation';
		}
		
		return $classes;
	}
	
	private function getGalleryImages( $params ) {
		$image_ids = array();
		$images    = array();
		$i         = 0;
		
		if ( $params['images'] !== '' ) {
			foreach ( $params['images'] as $image ) {
				$image_ids[] = $image['id'];
			}
		}
		
		foreach ( $image_ids as $id ) {
			$image['image_id']     = $id;
			$image_original        = wp_get_attachment_image_src( $id, 'full' );
			$image['url']          = $image_original[0];
			$image['alt']          = get_post_meta( $id, '_wp_attachment_image_alt', true );
			$image['image_link']   = get_post_meta( $id, 'attachment_image_link', true );
			$image['image_target'] = get_post_meta( $id, 'attachment_image_target', true );

			$image_dimensions = foton_mikado_get_image_dimensions( $image['url'] );

			if ( is_array( $image_dimensions ) && array_key_exists( 'height', $image_dimensions ) ) {
				if ( ! empty( $image_dimensions['height'] ) && $image_dimensions['width'] ) {
					$image['height'] = $image_dimensions['height'];
					$image['width']  = $image_dimensions['width'];
				}
			}

			$images[ $i ] = $image;
			$i ++;
		}
		
		return $images;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorCardsGallery() );