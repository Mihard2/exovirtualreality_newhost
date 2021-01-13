<?php

class ElementorProductListSimple extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_product_list_simple';
	}
	
	public function get_title() {
		return esc_html__( 'Product List - Simple', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-product-list-simple';
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
			'type',
			[
				'label'       => esc_html__( 'Type', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'sale'   => esc_html__( 'Sale', 'foton-core' ),
					'best-sellers' => esc_html__( 'Best Sellers', 'foton-core' ),
					'featured'  => esc_html__( 'Featured', 'foton-core' )
				],
				'default' => 'sale'
			]
		);
		
		$this->add_control(
			'number',
			[
				'label'       => esc_html__( 'Number of Products', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Number of products to show (default value is 4)', 'foton' ),
				'default' => '4'
			]
		);
		
		$this->add_control(
			'orderby',
			[
				'label'       => esc_html__( 'Order By', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_query_order_by_array(),
				'condition' => [
					'type' => array( 'sale', 'featured')
				],
				'default' => 'title'
			]
		);
		
		$this->add_control(
			'sort_order',
			[
				'label'       => esc_html__( 'Order', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_query_order_array(),
				'condition' => [
					'type' => array( 'sale', 'featured')
				],
				'default' => 'ASC'
			]
		);
		
		$this->add_control(
			'display_title',
			[
				'label'       => esc_html__( 'Display Title', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false, true ),
				'default' => 'yes'
			]
		);
		
		$this->add_control(
			'title_tag',
			[
				'label'       => esc_html__( 'Title Tag', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_title_tag( true ),
				'condition' => [
					'display_title' => array( 'yes')
				],
				'default' => 'h5'
			]
		);
		
		$this->add_control(
			'title_transform',
			[
				'label'       => esc_html__( 'Title Text Transform', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_text_transform_array( true ),
				'condition' => [
					'display_title' => array( 'yes')
				],
				'default' => 'yes'
			]
		);
		
		$this->add_control(
			'display_rating',
			[
				'label'       => esc_html__( 'Display Rating', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false, true ),
				'default' => 'yes'
			]
		);
		
		$this->add_control(
			'display_price',
			[
				'label'       => esc_html__( 'Display Price', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false, true ),
				'default' => 'yes'
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$default_atts = array(
			'type'            => 'sale',
			'number'          => '4',
			'orderby'         => 'title',
			'sort_order'      => 'ASC',
			'display_title'   => 'yes',
			'title_tag'       => 'h5',
			'title_transform' => 'uppercase',
			'display_price'   => 'yes',
			'display_rating'  => 'yes'
		);
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['class_name']     = 'pls';
		
		$params['title_tag']    = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles'] = $this->getTitleStyles( $params );
		
		$queryArray             = $this->generateProductQueryArray( $params );
		$query_result           = new \WP_Query( $queryArray );
		$params['query_result'] = $query_result;
		
		echo foton_mikado_get_woo_shortcode_module_template_part( 'templates/product-list-template', 'product-list-simple', '', $params );
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses   = '';
		$productListType = $params['type'];
		
		switch ( $productListType ) {
			case 'sale':
				$holderClasses = 'mkdf-pls-sale';
				break;
			case 'best-sellers':
				$holderClasses = 'mkdf-pls-best-sellers';
				break;
			case 'featured':
				$holderClasses = 'mkdf-pls-featured';
				break;
			default:
				$holderClasses = 'mkdf-pls-sale';
				break;
		}
		
		return $holderClasses;
	}
	
	private function generateProductQueryArray( $params ) {
		switch ( $params['type'] ) {
			case 'sale':
				$args = array(
					'post_status'    => 'publish',
					'post_type'      => 'product',
					'posts_per_page' => $params['number'],
					'orderby'        => $params['orderby'],
					'order'          => $params['sort_order'],
					'no_found_rows'  => 1,
					'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
				);
				break;
			case 'best-sellers':
				$args = array(
					'post_status'         => 'publish',
					'post_type'           => 'product',
					'ignore_sticky_posts' => 1,
					'posts_per_page'      => $params['number'],
					'meta_key'            => 'total_sales',
					'orderby'             => 'meta_value_num'
				);
				break;
			case 'featured':
				$args = array(
					'post_status'    => 'publish',
					'post_type'      => 'product',
					'posts_per_page' => $params['number'],
					'orderby'        => $params['orderby'],
					'order'          => $params['sort_order'],
					'tax_query' => array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'featured',
                        ),
                    ),
				);
				break;
		}
		
		return $args;
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}
		
		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorProductListSimple() );