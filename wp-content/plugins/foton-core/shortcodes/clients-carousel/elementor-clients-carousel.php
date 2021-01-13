<?php

class ElementorClientsCarousel extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_clients_carousel';
	}
	
	public function get_title() {
		return esc_html__( 'Clients Carousel', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-clients-carousel';
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
			'number_of_visible_items',
			[
				'label'   => esc_html__( 'Number Of Visible Items', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1' => esc_html__( 'One', 'foton-core' ),
					'2' => esc_html__( 'Two', 'foton-core' ),
					'3' => esc_html__( 'Three', 'foton-core' ),
					'4' => esc_html__( 'Four', 'foton-core' ),
					'5' => esc_html__( 'Five', 'foton-core' ),
					'6' => esc_html__( 'Six', 'foton-core' ),
					'7' => esc_html__( 'Seven', 'foton-core' ),
					'8' => esc_html__( 'Eight', 'foton-core' ),
				]
			]
		);
		
		$this->add_control(
			'slider_loop',
			[
				'label'   => esc_html__( 'Enable Slider Loop', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false, true ),
			]
		);
		
		$this->add_control(
			'slider_autoplay',
			[
				'label'   => esc_html__( 'Enable Slider Autoplay', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false, true ),
			]
		);
		
		$this->add_control(
			'slider_speed',
			[
				'label'       => esc_html__( 'Slide Duration', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Default value is 5000 (ms)', 'foton-core' )
			]
		);
		
		$this->add_control(
			'slider_speed_animation',
			[
				'label'       => esc_html__( 'Slide Animation Duration', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'foton-core' )
			]
		);
		
		$this->add_control(
			'slider_navigation',
			[
				'label'   => esc_html__( 'Enable Slider Navigation Arrows', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false ),
			]
		);
		
		$this->add_control(
			'slider_pagination',
			[
				'label'   => esc_html__( 'Enable Slider Pagination', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false )
			]
		);
		
		$this->add_control(
			'items_hover_animation',
			[
				'label'   => esc_html__( 'Items Hover Animation', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'switch-images' => esc_html__( 'Switch Images', 'foton-core' ),
					'roll-over'     => esc_html__( 'Roll Over', 'foton-core' )
				]
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'image',
			[
				'label'       => esc_html__( 'Image', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select image from media library', 'foton-core' )
			]
		);
		
		$repeater->add_control(
			'hover_image',
			[
				'label'       => esc_html__( 'Image Size', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'foton-core' )
			]
		);
		
		$repeater->add_control(
			'image_size',
			[
				'label'       => esc_html__( 'Slide Animation Duration', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'foton-core' ),
				'default'     => 'full'
			]
		);
		
		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Custom Link', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT
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
			'clients_item',
			[
				'label'       => esc_html__( 'Client Items', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => esc_html__( 'Client Item' ),
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args = array(
			'number_of_visible_items' => '4',
			'slider_loop'             => 'yes',
			'slider_autoplay'         => 'yes',
			'slider_speed'            => '5000',
			'slider_speed_animation'  => '600',
			'slider_navigation'       => 'no',
			'slider_pagination'       => 'no',
			'items_hover_animation'   => 'switch-images'
		);
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['carousel_data']  = $this->getSliderData( $params );
		?>
		
		<div class="mkdf-clients-carousel-holder <?php echo esc_attr( $params['holder_classes'] ); ?>">
			<div class="mkdf-cc-inner mkdf-owl-slider" <?php echo foton_mikado_get_inline_attrs( $params['carousel_data'] ); ?>>
				<?php foreach ( $params['clients_item'] as $client ) {
					
					$client['item_classes'] = $this->getItemClasses( $client, $args );
					$client['image']        = $this->getCarouselImage( $client );
					$client['hover_image']  = $this->getCarouselHoverImage( $client );
					
					echo foton_core_get_shortcode_module_template_part( 'templates/elementor-clients-carousel-item', 'clients-carousel', '', $client );
				} ?>
			</div>
		</div>
		
		<?php
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['items_hover_animation'] ) ? 'mkdf-cc-hover-' . $params['items_hover_animation'] : 'mkdf-cc-hover-switch-images';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getSliderData( $params ) {
		$slider_data = array();
		
		$slider_data['data-number-of-items']        = ! empty( $params['number_of_visible_items'] ) ? $params['number_of_visible_items'] : '4';
		$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';
		
		return $slider_data;
	}
	
	private function getItemClasses( $client, $args ) {
		$itemClasses = array();
		
		$itemClasses[] = ! empty( $client['link'] ) ? 'mkdf-cci-has-link' : 'mkdf-cci-no-link';
		
		return implode( ' ', $itemClasses );
	}
	
	private function getCarouselImage( $client ) {
		$image_meta = array();
		
		$client['image'] = $client['image']['id'];
		
		if ( ! empty( $client['image'] ) ) {
			$image_size     = $this->getCarouselImageSize( $client['image_size'] );
			$image_id       = $client['image'];
			$image_original = wp_get_attachment_image_src( $image_id, $image_size );
			$image['url']   = $image_original[0];
			$image['alt']   = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			
			$image_meta = $image;
		}
		
		return $image_meta;
	}
	
	private function getCarouselHoverImage( $client ) {
		$image_meta = array();
		
		$client['hover_image'] = $client['hover_image']['id'];
		
		if ( ! empty( $client['hover_image'] ) ) {
			$image_size     = $this->getCarouselImageSize( $client['image_size'] );
			$image_id       = $client['hover_image'];
			$image_original = wp_get_attachment_image_src( $image_id, $image_size );
			$image['url']   = $image_original[0];
			$image['alt']   = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			
			$image_meta = $image;
		}
		
		return $image_meta;
	}
	
	private function getCarouselImageSize( $image_size ) {
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
			return 'full';
		}
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorClientsCarousel() );