<?php

class ElementorPortfolioCategoryList extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_portfolio_category_list';
	}
	
	public function get_title() {
		return esc_html__( 'Portfolio Category List', 'foton-core' );
	}

	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-portfolio-category-list';
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
			'number_of_columns',
			[
				'label'       => esc_html__( 'Number of Columns', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => foton_mikado_get_number_of_columns_array( true, array( 'one' ) ),
				'description' => esc_html__( 'Default value is Three', 'foton-core' ),
				'default'     => 'three'
			]
		);
		
		$this->add_control(
			'space_between_items',
			[
				'label'   => esc_html__( 'Space Between Items', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_space_between_items_array(),
				'default'     => 'normal'
			]
		);
		
		$this->add_control(
			'number_of_items',
			[
				'label'       => esc_html__( 'Number of Items Per Page', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => foton_mikado_get_space_between_items_array(),
				'description' => esc_html__( 'Set number of items for your portfolio category list. Default value is 6', 'foton-core' ),
				'default'     => '6'
			]
		);
		
		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_query_order_by_array(),
				'default'     => 'date'
			]
		);
		
		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_query_order_array(),
				'default'     => 'ASC'
			]
		);
		
		$this->add_control(
			'image_proportions',
			[
				'label'       => esc_html__( 'Image Proportions', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => [
					'full'      => esc_html__( 'Original', 'foton-core' ),
					'square'    => esc_html__( 'Square', 'foton-core' ),
					'landscape' => esc_html__( 'Landscape', 'foton-core' ),
					'portrait'  => esc_html__( 'Portrait', 'foton-core' ),
					'medium'    => esc_html__( 'Medium', 'foton-core' ),
					'large'     => esc_html__( 'Large', 'foton-core' ),
				],
				'description' => esc_html__( 'Set image proportions for your portfolio category list', 'foton-core' ),
				'default'     => 'full'
			]
		);
		
		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_title_tag( true ),
				'default'     => 'h3'
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args   = array(
			'number_of_columns'   => 'three',
			'space_between_items' => 'normal',
			'number_of_items'     => '6',
			'orderby'             => 'date',
			'order'               => 'ASC',
			'image_proportions'   => 'full',
			'title_tag'           => 'h3'
		);
		
		$query_array              = $this->getQueryArray( $params );
		$params['query_results']  = get_terms( $query_array );
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['image_size']     = $this->getImageSize( $params );
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		
		echo foton_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'portfolio-category-holder', '', $params );
	}
	
	public function getQueryArray( $params ) {
		$query_array = array(
			'taxonomy'   => 'portfolio-category',
			'number'     => $params['number_of_items'],
			'orderby'    => $params['orderby'],
			'order'      => $params['order'],
			'hide_empty' => true
		);
		
		return $query_array;
	}
	
	public function getHolderClasses( $params, $args ) {
		$classes = array();
		
		$classes[] = ! empty( $params['number_of_columns'] ) ? 'mkdf-' . $params['number_of_columns'] . '-columns' : 'mkdf-' . $args['number_of_columns'] . '-columns';
		$classes[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $args['space_between_items'] . '-space';
		
		return implode( ' ', $classes );
	}
	
	public function getImageSize( $params ) {
		$thumb_size = 'full';
		
		if ( ! empty( $params['image_proportions'] ) ) {
			$image_size = $params['image_proportions'];
			
			switch ( $image_size ) {
				case 'landscape':
					$thumb_size = 'foton_mikado_image_landscape';
					break;
				case 'portrait':
					$thumb_size = 'foton_mikado_image_portrait';
					break;
				case 'square':
					$thumb_size = 'foton_mikado_image_square';
					break;
				case 'medium':
					$thumb_size = 'medium';
					break;
				case 'large':
					$thumb_size = 'large';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
			}
		}
		
		return $thumb_size;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorPortfolioCategoryList() );