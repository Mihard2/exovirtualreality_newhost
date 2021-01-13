<?php

class ElementorProductList extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_product_list';
	}
	
	public function get_title() {
		return esc_html__( 'Product List', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-product-list';
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
				'label'   => esc_html__( 'Type', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'standard' => esc_html__( 'Standard', 'foton-core' ),
					'masonry'  => esc_html__( 'Masonry', 'foton-core' )
				],
				'default' => 'standard'
			]
		);
		
		$this->add_control(
			'info_position',
			[
				'label'   => esc_html__( 'Product Info Position', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'info-on-image'    => esc_html__( 'Info On Image Hover', 'foton-core' ),
					'info-below-image' => esc_html__( 'Info Below Image', 'foton-core' )
				],
				'default' => 'info-on-image'
			]
		);
		
		$this->add_control(
			'number_of_posts',
			[
				'label'   => esc_html__( 'Number of Products', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '8'
			]
		);
		
		$this->add_control(
			'number_of_columns',
			[
				'label'   => esc_html__( 'Number of Columns', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_number_of_columns_array( true ),
				'default' => 'four'
			]
		);
		
		$this->add_control(
			'space_between_items',
			[
				'label'   => esc_html__( 'Number of Columns', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_space_between_items_array(),
				'default' => 'normal'
			]
		);
		
		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_query_order_by_array( false, array( 'on-sale' => esc_html__( 'On Sale', 'foton' ) ) ),
				'default' => 'date'
			]
		);
		
		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_query_order_array(),
				'order' => 'ASC'
			]
		);
		
		$this->add_control(
			'taxonomy_to_display',
			[
				'label'       => esc_html__( 'Choose Sorting Taxonomy', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => [
					'category' => esc_html__( 'Category', 'foton-core' ),
					'tag'      => esc_html__( 'Tag', 'foton-core' ),
					'id'       => esc_html__( 'Id', 'foton-core' ),
				],
				'default' => 'category',
				'description' => esc_html__( 'If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'foton' )
			]
		);
		
		$this->add_control(
			'taxonomy_values',
			[
				'label'       => esc_html__( 'Enter Taxonomy Values', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Separate values (category slugs, tags, or post IDs) with a comma', 'foton' )
			]
		);
		
		$this->add_control(
			'image_size',
			[
				'label'   => esc_html__( 'Image Proportions', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''                      => esc_html__( 'Default', 'foton-core' ),
					'full'                  => esc_html__( 'Original', 'foton-core' ),
					'square'                => esc_html__( 'Square', 'foton-core' ),
					'landscape'             => esc_html__( 'Landscape', 'foton-core' ),
					'portrait'              => esc_html__( 'Portrait', 'foton-core' ),
					'medium'                => esc_html__( 'Medium', 'foton-core' ),
					'large'                 => esc_html__( 'Large', 'foton-core' ),
					'woocommerce_single'    => esc_html__( 'Shop Single', 'foton-core' ),
					'woocommerce_thumbnail' => esc_html__( 'Shop Thumbnail', 'foton-core' ),
				],
				'default' => 'full'
			]
		);
		
		$this->add_control(
			'display_title',
			[
				'label'   => esc_html__( 'Display Title', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false, true ),
				'default' => 'yes'
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'product_info',
			[
				'label' => esc_html__( 'Product Info', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'product_info_skin',
			[
				'label'   => esc_html__( 'Product Info Skin', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'foton-core' ),
					'light'   => esc_html__( 'Light', 'foton-core' ),
					'dark'    => esc_html__( 'Dark', 'foton-core' ),
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
					'display_title' => array( 'yes' )
				],
				'default' => 'h5'
			]
		);
		
		$this->add_control(
			'title_transform',
			[
				'label'     => esc_html__( 'Title Text Transform', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_text_transform_array( true ),
				'condition' => [
					'display_title' => array( 'yes' )
				],
			]
		);
		
		$this->add_control(
			'display_category',
			[
				'label'   => esc_html__( 'Display Category', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false ),
				'default' => 'no'
			]
		);
		
		$this->add_control(
			'display_excerpt',
			[
				'label'   => esc_html__( 'Display Excerpt', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false ),
				'default' => 'no'
			]
		);
		
		$this->add_control(
			'excerpt_length',
			[
				'label'       => esc_html__( 'Excerpt Length', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Number of characters', 'foton' ),
				'condition'   => [
					'display_excerpt' => array( 'yes' )
				],
				'default' => '20'
			]
		);
		
		$this->add_control(
			'display_rating',
			[
				'label'   => esc_html__( 'Display Rating', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false, true ),
				'default' => 'yes'
			]
		);
		
		$this->add_control(
			'display_price',
			[
				'label'   => esc_html__( 'Display Price', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false, true ),
				'default' => 'yes'
			]
		);
		
		$this->add_control(
			'display_button',
			[
				'label'   => esc_html__( 'Display Button', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false, true ),
				'default' => 'yes'
			]
		);
		
		$this->add_control(
			'button_skin',
			[
				'label'     => esc_html__( 'Button Skin', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'default' => esc_html__( 'Default', 'foton-core' ),
					'light'   => esc_html__( 'Light', 'foton-core' ),
					'dark'    => esc_html__( 'Dark', 'foton-core' ),
				],
				'condition' => [
					'display_button' => array( 'yes' )
				],
				'default' => 'default'
			]
		);
		
		$this->add_control(
			'shader_background_color',
			[
				'label'   => esc_html__( 'Shader Background Color', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'options' => foton_mikado_get_yes_no_select_array( false, true ),
			]
		);
		
		$this->add_control(
			'info_bottom_text_align',
			[
				'label'     => esc_html__( 'Product Info Text Alignment', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'default' => esc_html__( 'Default', 'foton-core' ),
					'left'    => esc_html__( 'Left', 'foton-core' ),
					'center'  => esc_html__( 'Center', 'foton-core' ),
					'right'   => esc_html__( 'Right', 'foton-core' ),
				],
				'condition' => [
					'info_position' => array( 'info-below-image' )
				],
			]
		);
		
		$this->add_control(
			'info_bottom_margin',
			[
				'label'     => esc_html__( 'Product Info Bottom Margin (px)', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'info_position' => array( 'info-below-image' )
				],
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$default_atts = array(
			'type'                    => 'standard',
			'info_position'           => 'info-on-image',
			'number_of_posts'         => '8',
			'number_of_columns'       => 'four',
			'space_between_items'     => 'normal',
			'orderby'                 => 'date',
			'order'                   => 'ASC',
			'taxonomy_to_display'     => 'category',
			'taxonomy_values'         => '',
			'image_size'              => 'full',
			'display_title'           => 'yes',
			'product_info_skin'       => '',
			'title_tag'               => 'h5',
			'title_transform'         => '',
			'display_category'        => 'no',
			'display_excerpt'         => 'no',
			'excerpt_length'          => '20',
			'display_rating'          => 'yes',
			'display_price'           => 'yes',
			'display_button'          => 'yes',
			'button_skin'             => 'default',
			'shader_background_color' => '',
			'info_bottom_text_align'  => '',
			'info_bottom_margin'      => ''
		);
		
		$params['class_name']    = 'pli';
		$params['type']          = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];
		$params['info_position'] = ! empty( $params['info_position'] ) ? $params['info_position'] : $default_atts['info_position'];
		$params['title_tag']     = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		
		$additional_params                   = array();
		$additional_params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		
		$queryArray                        = $this->generateProductQueryArray( $params );
		$query_result                      = new \WP_Query( $queryArray );
		$additional_params['query_result'] = $query_result;
		
		$params['this_object'] = $this;
		
		echo foton_mikado_get_woo_shortcode_module_template_part( 'templates/product-list', 'product-list', $params['type'], $params, $additional_params );
	}
	
	private function getHolderClasses( $params, $default_atts ) {
		$holderClasses   = array();
		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-' . $params['type'] . '-layout' : 'mkdf-' . $default_atts['type'] . '-layout';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'mkdf-' . $params['number_of_columns'] . '-columns' : 'mkdf-' . $default_atts['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $default_atts['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['info_position'] ) ? 'mkdf-' . $params['info_position'] : 'mkdf-' . $default_atts['info_position'];
		$holderClasses[] = ! empty( $params['product_info_skin'] ) ? 'mkdf-product-info-' . $params['product_info_skin'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function generateProductQueryArray( $params ) {
		$queryArray = array(
			'post_status'         => 'publish',
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $params['number_of_posts'],
			'orderby'             => $params['orderby'],
			'order'               => $params['order']
		);
		
		if ( $params['orderby'] === 'on-sale' ) {
			$queryArray['no_found_rows'] = 1;
			$queryArray['post__in']      = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category' ) {
			$queryArray['product_cat'] = $params['taxonomy_values'];
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag' ) {
			$queryArray['product_tag'] = $params['taxonomy_values'];
		}
		
		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id' ) {
			$idArray                = $params['taxonomy_values'];
			$ids                    = explode( ',', $idArray );
			$queryArray['post__in'] = $ids;
		}
		
		return $queryArray;
	}
	
	public function getItemClasses( $params ) {
		$itemClasses = array();
		
		$image_size_meta = get_post_meta( get_the_ID(), 'mkdf_product_featured_image_size', true );
		
		if ( ! empty( $image_size_meta ) ) {
			$itemClasses[] = 'mkdf-fixed-masonry-item mkdf-masonry-size-' . $image_size_meta;
		}
		
		return implode( ' ', $itemClasses );
	}
	
	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getShaderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['shader_background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['shader_background_color'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getTextWrapperStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['info_bottom_text_align'] ) ) {
			$styles[] = 'text-align: ' . $params['info_bottom_text_align'];
		}
		
		if ( $params['info_bottom_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . foton_mikado_filter_px( $params['info_bottom_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorProductList() );