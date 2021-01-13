<?php

class ElementorSectionTitle extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_section_title';
	}
	
	public function get_title() {
		return esc_html__( 'Section Title', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-section-title';
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
			'type',
			[
				'label'   => esc_html__( 'Type', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'standard'    => esc_html__( 'Standard', 'foton-core' ),
					'two-columns' => esc_html__( 'Two Columns', 'foton-core' ),
				],
			]
		);
		
		$this->add_control(
			'title_position',
			[
				'label'     => esc_html__( 'Title - Text Position', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'standard'    => esc_html__( 'Title Left - Text Right', 'foton-core' ),
					'two-columns' => esc_html__( 'Title Right - Text Left', 'foton-core' ),
				],
				'condition' => [
					'type' => array( 'two-columns' )
				],
			]
		);
		
		$this->add_control(
			'columns_space',
			[
				'label'     => esc_html__( 'Space Between Columns', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'normal' => esc_html__( 'Normal', 'foton-core' ),
					'small'  => esc_html__( 'Small', 'foton-core' ),
					'tiny'   => esc_html__( 'Tiny', 'foton-core' ),
				],
				'condition' => [
					'type' => array( 'two-columns' )
				],
			]
		);
		
		$this->add_control(
			'position',
			[
				'label'     => esc_html__( 'Horizontal Position', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					''       => esc_html__( 'Default', 'foton-core' ),
					'left'   => esc_html__( 'Left', 'foton-core' ),
					'center' => esc_html__( 'Center', 'foton-core' ),
					'right'  => esc_html__( 'Right', 'foton-core' ),
				],
				'condition' => [
					'type' => array( 'standard' )
				],
			]
		);
		
		$this->add_control(
			'holder_padding',
			[
				'label' => esc_html__( 'Holder Side Padding (px or %)', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
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
			'text',
			[
				'label' => esc_html__( 'Text', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'title_options',
			[
				'label' => esc_html__( 'Title Options', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'title!' => ''
				],
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
			'title_bold_words',
			[
				'label'       => esc_html__( 'Words with Bold Font Weight', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'title!' => ''
				],
				'description' => esc_html__( 'Enter the positions of the words you would like to display in a "bold" font weight. Separate the positions with commas (e.g. if you would like the first, second, and third word to have a light font weight, you would enter "1,2,3")', 'foton-core' ),
			]
		);
		
		$this->add_control(
			'title_light_words',
			[
				'label'       => esc_html__( 'Words with Light Font Weight', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'title!' => ''
				],
				'description' => esc_html__( 'Enter the positions of the words you would like to display in a "light" font weight. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a light font weight, you would enter "1,3,4")', 'foton-core' ),
			]
		);
		
		$this->add_control(
			'title_break_words',
			[
				'label'       => esc_html__( 'Position of Line Break', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'title!' => ''
				],
				'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'foton-core' ),
			]
		);
		
		$this->add_control(
			'disable_break_words',
			[
				'label'     => esc_html__( 'Disable Line Break for Smaller Screens', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_yes_no_select_array( false ),
				'condition' => [
					'title!' => ''
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'text_options',
			[
				'label' => esc_html__( 'Text Options', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'text!' => ''
				],
			]
		);
		
		$this->add_control(
			'text_tag',
			[
				'label'     => esc_html__( 'Text Tag', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
				'condition' => [
					'text!' => ''
				],
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
			'text_font_size',
			[
				'label'     => esc_html__( 'Text Font Size (px)', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'text!' => ''
				],
			]
		);
		
		$this->add_control(
			'text_line_height',
			[
				'label'     => esc_html__( 'Text Line Height (px)', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'text!' => ''
				],
			]
		);
		
		$this->add_control(
			'text_font_weight',
			[
				'label'     => esc_html__( 'Text Font Weight', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_font_weight_array( true ),
				'condition' => [
					'text!' => ''
				],
			]
		);
		
		$this->add_control(
			'text_margin',
			[
				'label'     => esc_html__( 'Text Top Margin (px)', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'text!' => ''
				],
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args   = array(
			'custom_class'        => '',
			'type'                => 'standard',
			'title_position'      => 'title-left',
			'columns_space'       => 'normal',
			'position'            => '',
			'holder_padding'      => '',
			'title'               => '',
			'title_tag'           => 'h2',
			'title_color'         => '',
			'title_bold_words'    => '',
			'title_light_words'   => '',
			'title_break_words'   => '',
			'disable_break_words' => '',
			'text'                => '',
			'text_tag'            => 'h5',
			'text_color'          => '',
			'text_font_size'      => '',
			'text_line_height'    => '',
			'text_font_weight'    => '',
			'text_margin'         => ''
		);
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['holder_styles']  = $this->getHolderStyles( $params );
		$params['title']          = $this->getModifiedTitle( $params );
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']   = $this->getTitleStyles( $params );
		$params['text_tag']       = ! empty( $params['text_tag'] ) ? $params['text_tag'] : $args['text_tag'];
		$params['text_styles']    = $this->getTextStyles( $params );
		
		echo foton_core_get_shortcode_module_template_part( 'templates/section-title', 'section-title', '', $params );
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-st-' . $params['type'] : 'mkdf-st-' . $args['type'];
		$holderClasses[] = ! empty( $params['title_position'] ) ? 'mkdf-st-' . $params['title_position'] : 'mkdf-st-' . $args['title_position'];
		$holderClasses[] = ! empty( $params['columns_space'] ) ? 'mkdf-st-' . $params['columns_space'] . '-space' : 'mkdf-st-' . $args['columns_space'] . '-space';
		$holderClasses[] = $params['disable_break_words'] === 'yes' ? 'mkdf-st-disable-title-break' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['holder_padding'] ) ) {
			$styles[] = 'padding: 0 ' . $params['holder_padding'];
		}
		
		if ( ! empty( $params['position'] ) ) {
			$styles[] = 'text-align: ' . $params['position'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getModifiedTitle( $params ) {
		$title             = $params['title'];
		$title_bold_words  = str_replace( ' ', '', $params['title_bold_words'] );
		$title_light_words = str_replace( ' ', '', $params['title_light_words'] );
		$title_break_words = str_replace( ' ', '', $params['title_break_words'] );
		
		if ( ! empty( $title ) ) {
			$bold_words  = explode( ',', $title_bold_words );
			$light_words = explode( ',', $title_light_words );
			$split_title = explode( ' ', $title );
			
			if ( ! empty( $title_bold_words ) ) {
				foreach ( $bold_words as $value ) {
					if ( ! empty( $split_title[ $value - 1 ] ) ) {
						$split_title[ $value - 1 ] = '<span class="mkdf-st-title-bold">' . $split_title[ $value - 1 ] . '</span>';
					}
				}
			}
			
			if ( ! empty( $title_light_words ) ) {
				foreach ( $light_words as $value ) {
					if ( ! empty( $split_title[ $value - 1 ] ) ) {
						$split_title[ $value - 1 ] = '<span class="mkdf-st-title-light">' . $split_title[ $value - 1 ] . '</span>';
					}
				}
			}
			
			if ( ! empty( $title_break_words ) ) {
				if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
					$split_title[ $title_break_words - 1 ] = $split_title[ $title_break_words - 1 ] . '<br />';
				}
			}
			
			$title = implode( ' ', $split_title );
		}
		
		return $title;
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( ! empty( $params['text_font_size'] ) ) {
			$styles[] = 'font-size: ' . foton_mikado_filter_px( $params['text_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['text_line_height'] ) ) {
			$styles[] = 'line-height: ' . foton_mikado_filter_px( $params['text_line_height'] ) . 'px';
		}
		
		if ( ! empty( $params['text_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['text_font_weight'];
		}
		
		if ( $params['text_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . foton_mikado_filter_px( $params['text_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorSectionTitle() );