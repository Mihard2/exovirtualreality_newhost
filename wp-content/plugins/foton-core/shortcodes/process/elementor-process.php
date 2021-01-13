<?php

class ElementorProcess extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_process';
	}
	
	public function get_title() {
		return esc_html__( 'Process', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-process';
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
			'number_of_columns',
			[
				'label'   => esc_html__( 'Number Of Columns', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) ),
				'default' => 'three'
			]
		);
		
		$this->add_control(
			'switch_to_one_column',
			[
				'label'   => esc_html__( 'Switch to One Column', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''     => esc_html__( 'None', 'foton-core' ),
					'1366' => esc_html__( 'Below 1366px', 'foton-core' ),
					'1024' => esc_html__( 'Below 1024px', 'foton-core' ),
					'768'  => esc_html__( 'Below 768px', 'foton-core' ),
					'680'  => esc_html__( 'Below 680px', 'foton-core' ),
					'480'  => esc_html__( 'Below 480px', 'foton-core' ),
				],
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'custom_class',
			[
				'label'       => esc_html__( 'Custom CSS Class', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'foton-core' )
			]
		);
		
		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'foton-core' )
			]
		);
		
		$repeater->add_control(
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
		
		$repeater->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'title!' => ''
				],
			]
		);
		
		$repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			]
		);
		
		$repeater->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'text!' => ''
				],
			]
		);
		
		$repeater->add_control(
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
			'process_item',
			[
				'label'       => esc_html__( 'Process Items', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => esc_html__( 'Process Item' ),
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args = array(
			'custom_class'         => '',
			'number_of_columns'    => 'three',
			'switch_to_one_column' => ''
		);
		
		$params['holder_classes']  = $this->getHolderClasses( $params, $args );
		$params['number_of_items'] = $this->getNumberOfItems( $params['number_of_columns'] );
		?>
		
		<div class="mkdf-process-holder <?php echo esc_attr( $params['holder_classes'] ); ?>">
			<div class="mkdf-mark-horizontal-holder">
				<?php for ( $i = 1; $i <= $params['number_of_items']; $i ++ ) { ?>
					<div class="mkdf-process-mark">
						<div class="mkdf-process-line"></div>
						<div class="mkdf-process-circle"><?php echo esc_attr( $i ); ?></div>
					</div>
				<?php } ?>
			</div>
			<div class="mkdf-mark-vertical-holder">
				<?php for ( $i = 1; $i <= $params['number_of_items']; $i ++ ) { ?>
					<div class="mkdf-process-mark">
						<div class="mkdf-process-line"></div>
						<div class="mkdf-process-circle"><?php echo esc_attr( $i ); ?></div>
					</div>
				<?php } ?>
			</div>
			<div class="mkdf-process-inner">
				
				<?php foreach ( $params['process_item'] as $pi ) {
					
					$pi['holder_classes'] = $this->getItemHolderClasses( $pi );
					$pi['title_tag']      = ! empty( $pi['title_tag'] ) ? $pi['title_tag'] : $args['title_tag'];
					$pi['title_styles']   = $this->getTitleStyles( $pi );
					$pi['text_styles']    = $this->getTextStyles( $pi );
					
					echo foton_core_get_shortcode_module_template_part( 'templates/process-item-template', 'process', '', $pi );
				} ?>
			
			</div>
		</div>
		
		<?php
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'mkdf-' . $params['number_of_columns'] . '-columns' : 'mkdf-' . $args['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['switch_to_one_column'] ) ? 'mkdf-responsive-' . $params['switch_to_one_column'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getNumberOfItems( $params ) {
		$number = 3;
		
		switch ( $params ) {
			case 'two':
				$number = 2;
				break;
			case 'three':
				$number = 3;
				break;
			case 'four':
				$number = 4;
				break;
		}
		
		return $number;
	}
	
	private function getItemHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
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
		
		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . foton_mikado_filter_px( $params['text_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorProcess() );