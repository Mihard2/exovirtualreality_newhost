<?php

class ElementorVerticalSplitSlider extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_vertical_split_slider';
	}
	
	public function get_title() {
		return esc_html__( 'Vertical Split Slider', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-vertical-split-slider';
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
			'enable_scrolling_animation',
			[
				'label'       => esc_html__( 'Enable Scrolling Animation', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => foton_mikado_get_yes_no_select_array( false )
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'left_sliding_panel',
			[
				'label' => esc_html__( 'Left Sliding Panel', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$repeater1 = new \Elementor\Repeater();
		
		$repeater1->add_control(
			'background_color',
			[
				'label'       => esc_html__( 'Background Color', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::COLOR,
			]
		);
		
		$repeater1->add_control(
			'background_image',
			[
				'label'       => esc_html__( 'Background Image', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
			]
		);
		
		$repeater1->add_control(
			'item_padding',
			[
				'label'       => esc_html__( 'Padding', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'foton-core' )
			]
		);
		
		$repeater1->add_control(
			'alignment',
			[
				'label'       => esc_html__( 'Content Alignment', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''   => esc_html__( 'Default', 'foton-core' ),
					'left' => esc_html__( 'Left', 'foton-core' ),
					'right'  => esc_html__( 'Right', 'foton-core' ),
					'center'  => esc_html__( 'Center', 'foton-core' ),
				],
			]
		);
		
		$repeater1->add_control(
			'header_style',
			[
				'label'       => esc_html__( 'Header/Bullets Style', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''   => esc_html__( 'Default', 'foton-core' ),
					'light' => esc_html__( 'Light', 'foton-core' ),
					'dark'  => esc_html__( 'Dark', 'foton-core' )
				],
			]
		);
		
		foton_core_generate_elementor_templates_control( $repeater1 );
		
		$this->add_control(
			'left_slide_content_item',
			[
				'label'       => esc_html__( 'Left Slide Content Items', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater1->get_controls(),
				'title_field' => esc_html__( 'Left Slide Content Item' ),
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'right_sliding_panel',
			[
				'label' => esc_html__( 'Right Sliding Panel', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$repeater2 = new \Elementor\Repeater();
		
		$repeater2->add_control(
			'background_color',
			[
				'label'       => esc_html__( 'Background Color', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::COLOR,
			]
		);
		
		$repeater2->add_control(
			'background_image',
			[
				'label'       => esc_html__( 'Background Image', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
			]
		);
		
		$repeater2->add_control(
			'item_padding',
			[
				'label'       => esc_html__( 'Padding', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'foton-core' )
			]
		);
		
		$repeater2->add_control(
			'alignment',
			[
				'label'       => esc_html__( 'Content Alignment', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''   => esc_html__( 'Default', 'foton-core' ),
					'left' => esc_html__( 'Left', 'foton-core' ),
					'right'  => esc_html__( 'Right', 'foton-core' ),
					'center'  => esc_html__( 'Center', 'foton-core' ),
				],
			]
		);
		
		$repeater2->add_control(
			'header_style',
			[
				'label'       => esc_html__( 'Header/Bullets Style', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''   => esc_html__( 'Default', 'foton-core' ),
					'light' => esc_html__( 'Light', 'foton-core' ),
					'dark'  => esc_html__( 'Dark', 'foton-core' )
				],
			]
		);
		
		foton_core_generate_elementor_templates_control( $repeater2 );
		
		$this->add_control(
			'right_slide_content_item',
			[
				'label'       => esc_html__( 'Right Slide Content Items', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater1->get_controls(),
				'title_field' => esc_html__( 'Right Slide Content Item' ),
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args   = array(
			'enable_scrolling_animation' => 'no'
		);
		
		$holder_classes = $this->getHolderClasses( $params );
		?>
		
		<div class="mkdf-vertical-split-slider '<?php echo esc_attr( $holder_classes ) ?>">
			<div class="mkdf-vss-ms-left">
				<?php foreach ( $params['left_slide_content_item'] as $left ) {
					$left['content_data']  = $this->getContentData( $left );
					$left['content_style'] = $this->getContentStyles( $left );
					
					$left['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display($left['template_id']);
					
					echo foton_core_get_shortcode_module_template_part( 'templates/elementor-vertical-split-slider-content-item-template', 'vertical-split-slider', '', $left );
				} ?>
			</div>
			
			<div class="mkdf-vss-ms-right">
				<?php foreach ( $params['right_slide_content_item'] as $right ) {
					$right['content_data']  = $this->getContentData( $right );
					$right['content_style'] = $this->getContentStyles( $right );
					
					$right['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display($right['template_id']);
					
					echo foton_core_get_shortcode_module_template_part( 'templates/elementor-vertical-split-slider-content-item-template', 'vertical-split-slider', '', $right );
				} ?>
			</div>
		
		<div class="mkdf-vss-horizontal-mask"></div>
		<div class="mkdf-vss-vertical-mask"></div>
		</div>
	<?php
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = $params['enable_scrolling_animation'] === 'yes' ? 'mkdf-vss-scrolling-animation' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getContentData( $params ) {
		$data = array();
		
		if ( ! empty( $params['header_style'] ) ) {
			$data['data-header-style'] = $params['header_style'];
		}
		
		return $data;
	}
	
	private function getContentStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		if ( ! empty( $params['background_image'] ) ) {
			$url      = wp_get_attachment_url( $params['background_image']['id'] );
			$styles[] = 'background-image: url(' . $url . ')';
		}
		
		if ( ! empty( $params['item_padding'] ) ) {
			$styles[] = 'padding: ' . $params['item_padding'];
		}
		
		if ( ! empty( $params['alignment'] ) ) {
			$styles[] = 'text-align: ' . $params['alignment'];
		}
		
		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorVerticalSplitSlider() );