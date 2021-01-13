<?php

class ElementorCountdown extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_countdown';
	}
	
	public function get_title() {
		return esc_html__( 'Countdown', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-countdown';
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
			'skin',
			[
				'label'   => esc_html__( 'Skin', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''                => esc_html__( 'Default', 'foton-core' ),
					'mkdf-light-skin' => esc_html__( 'Light', 'foton-core' )
				],
			]
		);
		
		$this->add_control(
			'year',
			[
				'label'   => esc_html__( 'Year', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'2019' => esc_html__( '2019', 'foton-core' ),
					'2020' => esc_html__( '2020', 'foton-core' ),
					'2021' => esc_html__( '2021', 'foton-core' ),
					'2022' => esc_html__( '2022', 'foton-core' ),
					'2023' => esc_html__( '2023', 'foton-core' ),
					'2024' => esc_html__( '2024', 'foton-core' ),
					'2025' => esc_html__( '2025', 'foton-core' ),
				],
			]
		);
		
		$this->add_control(
			'month',
			[
				'label'   => esc_html__( 'Month', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  => esc_html__( 'January', 'foton-core' ),
					'2'  => esc_html__( 'February', 'foton-core' ),
					'3'  => esc_html__( 'March', 'foton-core' ),
					'4'  => esc_html__( 'April', 'foton-core' ),
					'5'  => esc_html__( 'May', 'foton-core' ),
					'6'  => esc_html__( 'June', 'foton-core' ),
					'7'  => esc_html__( 'July', 'foton-core' ),
					'8'  => esc_html__( 'August', 'foton-core' ),
					'9'  => esc_html__( 'September', 'foton-core' ),
					'10' => esc_html__( 'October', 'foton-core' ),
					'11' => esc_html__( 'November', 'foton-core' ),
					'12' => esc_html__( 'December', 'foton-core' ),
				],
			]
		);
		
		$this->add_control(
			'day',
			[
				'label'   => esc_html__( 'Day', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  => esc_html__( '1', 'foton-core' ),
					'2'  => esc_html__( '2', 'foton-core' ),
					'3'  => esc_html__( '3', 'foton-core' ),
					'4'  => esc_html__( '4', 'foton-core' ),
					'5'  => esc_html__( '5', 'foton-core' ),
					'6'  => esc_html__( '6', 'foton-core' ),
					'7'  => esc_html__( '7', 'foton-core' ),
					'8'  => esc_html__( '8', 'foton-core' ),
					'9'  => esc_html__( '9', 'foton-core' ),
					'10' => esc_html__( '10', 'foton-core' ),
					'11' => esc_html__( '11', 'foton-core' ),
					'12' => esc_html__( '12', 'foton-core' ),
					'13' => esc_html__( '13', 'foton-core' ),
					'14' => esc_html__( '14', 'foton-core' ),
					'15' => esc_html__( '15', 'foton-core' ),
					'16' => esc_html__( '16', 'foton-core' ),
					'17' => esc_html__( '17', 'foton-core' ),
					'18' => esc_html__( '18', 'foton-core' ),
					'19' => esc_html__( '19', 'foton-core' ),
					'20' => esc_html__( '20', 'foton-core' ),
					'21' => esc_html__( '21', 'foton-core' ),
					'22' => esc_html__( '22', 'foton-core' ),
					'23' => esc_html__( '23', 'foton-core' ),
					'24' => esc_html__( '24', 'foton-core' ),
					'25' => esc_html__( '25', 'foton-core' ),
					'26' => esc_html__( '26', 'foton-core' ),
					'27' => esc_html__( '27', 'foton-core' ),
					'28' => esc_html__( '28', 'foton-core' ),
					'29' => esc_html__( '29', 'foton-core' ),
					'30' => esc_html__( '30', 'foton-core' ),
					'31' => esc_html__( '31', 'foton-core' ),
				],
			]
		);
		
		$this->add_control(
			'hour',
			[
				'label'   => esc_html__( 'Hour', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  => esc_html__( '1', 'foton-core' ),
					'2'  => esc_html__( '2', 'foton-core' ),
					'3'  => esc_html__( '3', 'foton-core' ),
					'4'  => esc_html__( '4', 'foton-core' ),
					'5'  => esc_html__( '5', 'foton-core' ),
					'6'  => esc_html__( '6', 'foton-core' ),
					'7'  => esc_html__( '7', 'foton-core' ),
					'8'  => esc_html__( '8', 'foton-core' ),
					'9'  => esc_html__( '9', 'foton-core' ),
					'10' => esc_html__( '10', 'foton-core' ),
					'11' => esc_html__( '11', 'foton-core' ),
					'12' => esc_html__( '12', 'foton-core' ),
					'13' => esc_html__( '13', 'foton-core' ),
					'14' => esc_html__( '14', 'foton-core' ),
					'15' => esc_html__( '15', 'foton-core' ),
					'16' => esc_html__( '16', 'foton-core' ),
					'17' => esc_html__( '17', 'foton-core' ),
					'18' => esc_html__( '18', 'foton-core' ),
					'19' => esc_html__( '19', 'foton-core' ),
					'20' => esc_html__( '20', 'foton-core' ),
					'21' => esc_html__( '21', 'foton-core' ),
					'22' => esc_html__( '22', 'foton-core' ),
					'23' => esc_html__( '23', 'foton-core' ),
					'24' => esc_html__( '24', 'foton-core' ),
					'25' => esc_html__( '25', 'foton-core' ),
					'26' => esc_html__( '26', 'foton-core' ),
					'27' => esc_html__( '27', 'foton-core' ),
					'28' => esc_html__( '28', 'foton-core' ),
					'29' => esc_html__( '29', 'foton-core' ),
					'30' => esc_html__( '30', 'foton-core' ),
					'31' => esc_html__( '31', 'foton-core' ),
				],
			]
		);
		
		$this->add_control(
			'minute',
			[
				'label'   => esc_html__( 'Minute', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  => esc_html__( '1', 'foton-core' ),
					'2'  => esc_html__( '2', 'foton-core' ),
					'3'  => esc_html__( '3', 'foton-core' ),
					'4'  => esc_html__( '4', 'foton-core' ),
					'5'  => esc_html__( '5', 'foton-core' ),
					'6'  => esc_html__( '6', 'foton-core' ),
					'7'  => esc_html__( '7', 'foton-core' ),
					'8'  => esc_html__( '8', 'foton-core' ),
					'9'  => esc_html__( '9', 'foton-core' ),
					'10' => esc_html__( '10', 'foton-core' ),
					'11' => esc_html__( '11', 'foton-core' ),
					'12' => esc_html__( '12', 'foton-core' ),
					'13' => esc_html__( '13', 'foton-core' ),
					'14' => esc_html__( '14', 'foton-core' ),
					'15' => esc_html__( '15', 'foton-core' ),
					'16' => esc_html__( '16', 'foton-core' ),
					'17' => esc_html__( '17', 'foton-core' ),
					'18' => esc_html__( '18', 'foton-core' ),
					'19' => esc_html__( '19', 'foton-core' ),
					'20' => esc_html__( '20', 'foton-core' ),
					'21' => esc_html__( '21', 'foton-core' ),
					'22' => esc_html__( '22', 'foton-core' ),
					'23' => esc_html__( '23', 'foton-core' ),
					'24' => esc_html__( '24', 'foton-core' ),
					'25' => esc_html__( '25', 'foton-core' ),
					'26' => esc_html__( '26', 'foton-core' ),
					'27' => esc_html__( '27', 'foton-core' ),
					'28' => esc_html__( '28', 'foton-core' ),
					'29' => esc_html__( '29', 'foton-core' ),
					'30' => esc_html__( '30', 'foton-core' ),
					'31' => esc_html__( '31', 'foton-core' ),
					'32' => esc_html__( '32', 'foton-core' ),
					'33' => esc_html__( '33', 'foton-core' ),
					'34' => esc_html__( '34', 'foton-core' ),
					'35' => esc_html__( '35', 'foton-core' ),
					'36' => esc_html__( '36', 'foton-core' ),
					'37' => esc_html__( '37', 'foton-core' ),
					'38' => esc_html__( '38', 'foton-core' ),
					'39' => esc_html__( '39', 'foton-core' ),
					'40' => esc_html__( '40', 'foton-core' ),
					'41' => esc_html__( '41', 'foton-core' ),
					'42' => esc_html__( '42', 'foton-core' ),
					'43' => esc_html__( '43', 'foton-core' ),
					'44' => esc_html__( '44', 'foton-core' ),
					'45' => esc_html__( '45', 'foton-core' ),
					'46' => esc_html__( '46', 'foton-core' ),
					'47' => esc_html__( '47', 'foton-core' ),
					'48' => esc_html__( '48', 'foton-core' ),
					'49' => esc_html__( '49', 'foton-core' ),
					'50' => esc_html__( '50', 'foton-core' ),
					'51' => esc_html__( '51', 'foton-core' ),
					'52' => esc_html__( '52', 'foton-core' ),
					'53' => esc_html__( '53', 'foton-core' ),
					'54' => esc_html__( '54', 'foton-core' ),
					'55' => esc_html__( '55', 'foton-core' ),
					'56' => esc_html__( '56', 'foton-core' ),
					'57' => esc_html__( '57', 'foton-core' ),
					'58' => esc_html__( '58', 'foton-core' ),
					'59' => esc_html__( '59', 'foton-core' ),
					'60' => esc_html__( '60', 'foton-core' ),
				]
			]
		);
		
		$this->add_control(
			'month_label',
			[
				'label' => esc_html__( 'Month Label', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Month', 'foton-core' )
			]
		);
		
		$this->add_control(
			'day_label',
			[
				'label' => esc_html__( 'Day Label', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Day', 'foton-core' )
			]
		);
		
		$this->add_control(
			'hour_label',
			[
				'label' => esc_html__( 'Hour Label', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Hour', 'foton-core' )
			]
		);
		
		$this->add_control(
			'minute_label',
			[
				'label' => esc_html__( 'Minute Label', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Minute', 'foton-core' )
			]
		);
		
		$this->add_control(
			'second_label',
			[
				'label' => esc_html__( 'Second Label', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Seconds', 'foton-core' )
			]
		);
		
		$this->add_control(
			'digit_font_size',
			[
				'label' => esc_html__( 'Digit Font Size (px)', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'label_font_size',
			[
				'label' => esc_html__( 'Label Font Size (px)', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args   = array(
			'custom_class'    => '',
			'skin'            => '',
			'year'            => '',
			'month'           => '',
			'day'             => '',
			'hour'            => '',
			'minute'          => '',
			'month_label'     => 'Months',
			'day_label'       => 'Days',
			'hour_label'      => 'Hours',
			'minute_label'    => 'Minutes',
			'second_label'    => 'Seconds',
			'digit_font_size' => '',
			'label_font_size' => ''
		);
		
		$params['id']             = mt_rand( 1000, 9999 );
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['holder_data']    = $this->getHolderData( $params );
		
		echo foton_core_get_shortcode_module_template_part( 'templates/countdown', 'countdown', '', $params );
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['skin'] ) ? $params['skin'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderData( $params ) {
		$holderData = array();
		
		$holderData['data-year']         = ! empty( $params['year'] ) ? $params['year'] : '';
		$holderData['data-month']        = ! empty( $params['month'] ) ? $params['month'] : '';
		$holderData['data-day']          = ! empty( $params['day'] ) ? $params['day'] : '';
		$holderData['data-hour']         = $params['hour'] !== '' ? $params['hour'] : '';
		$holderData['data-minute']       = $params['minute'] !== '' ? $params['minute'] : '';
		$holderData['data-month-label']  = ! empty( $params['month_label'] ) ? $params['month_label'] : esc_html__( 'Months', 'foton-core' );
		$holderData['data-day-label']    = ! empty( $params['day_label'] ) ? $params['day_label'] : esc_html__( 'Days', 'foton-core' );
		$holderData['data-hour-label']   = ! empty( $params['hour_label'] ) ? $params['hour_label'] : esc_html__( 'Hours', 'foton-core' );
		$holderData['data-minute-label'] = ! empty( $params['minute_label'] ) ? $params['minute_label'] : esc_html__( 'Minutes', 'foton-core' );
		$holderData['data-second-label'] = ! empty( $params['second_label'] ) ? $params['second_label'] : esc_html__( 'Seconds', 'foton-core' );
		$holderData['data-digit-size']   = ! empty( $params['digit_font_size'] ) ? $params['digit_font_size'] : '';
		$holderData['data-label-size']   = ! empty( $params['label_font_size'] ) ? $params['label_font_size'] : '';
		
		return $holderData;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorCountdown() );