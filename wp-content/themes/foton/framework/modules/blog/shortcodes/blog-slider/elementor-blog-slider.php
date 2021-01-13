<?php

class ElementorBlogSlider extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_blog_slider';
	}
	
	public function get_title() {
		return esc_html__( 'Blog Slider', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-blog-slider';
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
			'slider_type',
			[
				'label'   => esc_html__( 'Type', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'slider' => esc_html__( 'Slider', 'foton-core' ),
					'carousel'   => esc_html__( 'Carousel', 'foton-core' ),
					'carousel-centered'  => esc_html__( 'Carousel Centered', 'foton-core' )
				],
				'default' => 'slider'
			]
		);
		
		$this->add_control(
			'number_of_posts',
			[
				'label'   => esc_html__( 'Number of Posts', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '-1'
			]
		);
		
		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_query_order_by_array(),
				'default' => 'title'
			]
		);
		
		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_query_order_array(),
				'default' => 'ASC'
			]
		);
		
		$this->add_control(
			'category',
			[
				'label'       => esc_html__( 'Category', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'foton' )
			]
		);
		
		$this->add_control(
			'image_size',
			[
				'label'     => esc_html__( 'Image Size', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'options'   => [
					'full'                         => esc_html__( 'Original', 'foton-core' ),
					'foton_mikado_image_square'    => esc_html__( 'Square', 'foton-core' ),
					'foton_mikado_image_landscape' => esc_html__( 'Landscape', 'foton-core' ),
					'foton_mikado_image_portrait'  => esc_html__( 'Portrait', 'foton-core' ),
					'thumbnail'                    => esc_html__( 'Thumbnail', 'foton-core' ),
					'medium'                       => esc_html__( 'Medium', 'foton-core' ),
					'large'                        => esc_html__( 'Large', 'foton-core' ),
				],
				'condition' => [
					'type' => array( 'standard', 'boxed', 'masonry' )
				],
				'default'   => 'full'
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'post_info',
			[
				'label' => esc_html__( 'Post Info', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_title_tag( true ),
				'default' => 'h2'
			]
		);
		
		$this->add_control(
			'title_transform',
			[
				'label'   => esc_html__( 'Title Text Transform', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_text_transform_array( true )
			]
		);
		
		$this->add_control(
			'post_info_author',
			[
				'label'     => esc_html__( 'Enable Post Info Author', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_yes_no_select_array( false, true ),
				'condition' => [
					'post_info_section' => array( 'yes' )
				],
				'default'   => 'yes'
			]
		);
		
		$this->add_control(
			'post_info_date',
			[
				'label'     => esc_html__( 'Enable Post Info Date', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_yes_no_select_array( false, true ),
				'condition' => [
					'post_info_section' => array( 'yes' )
				],
				'default'   => 'yes'
			]
		);
		
		$this->add_control(
			'post_info_category',
			[
				'label'     => esc_html__( 'Enable Post Info Category', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_yes_no_select_array( false, true ),
				'condition' => [
					'post_info_section' => array( 'yes' )
				],
				'default'   => 'yes'
			]
		);
		
		$this->add_control(
			'post_info_comments',
			[
				'label'     => esc_html__( 'Enable Post Info Comments', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_yes_no_select_array( false ),
				'condition' => [
					'post_info_section' => array( 'yes' )
				],
				'default'   => 'no'
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$default_atts = array(
			'slider_type'        => 'slider',
			'number_of_posts'    => '-1',
			'orderby'            => 'title',
			'order'              => 'ASC',
			'category'           => '',
			'image_size'         => 'full',
			'title_tag'          => 'h2',
			'title_transform'    => '',
			'post_info_author'   => '',
			'post_info_date'     => '',
			'post_info_category' => '',
			'post_info_comments' => ''
		);
		
		$queryArray             = $this->generateBlogQueryArray( $params );
		$query_result           = new \WP_Query( $queryArray );
		$params['query_result'] = $query_result;
		
		$params['slider_type']    = ! empty( $params['slider_type'] ) ? $params['slider_type'] : $default_atts['slider_type'];
		$params['slider_classes'] = $this->getSliderClasses( $params );
		$params['slider_data']    = $this->getSliderData( $params );
		
		ob_start();
		
		foton_mikado_get_module_template_part( 'shortcodes/blog-slider/holder', 'blog', '', $params );
		
		$html = ob_get_contents();
		
		ob_end_clean();
		
		echo foton_mikado_get_module_part( $html );
	}
	
	public function generateBlogQueryArray( $params ) {
		$queryArray = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'orderby'        => $params['orderby'],
			'order'          => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'post__not_in'   => get_option( 'sticky_posts' )
		);
		
		if ( ! empty( $params['category'] ) ) {
			$queryArray['category_name'] = $params['category'];
		}
		
		return $queryArray;
	}
	
	public function getSliderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = 'mkdf-bs-' . $params['slider_type'];
		
		return implode( ' ', $holderClasses );
	}
	
	private function getSliderData( $params ) {
		$type        = $params['slider_type'];
		$slider_data = array();
		
		if($type == 'carousel') {
			$slider_data['data-number-of-items']   = '4';
			$slider_data['data-slider-margin']     = '0';
			$slider_data['data-slider-padding']    = 'no';
			$slider_data['data-enable-navigation'] = 'no';
			$slider_data['data-enable-pagination'] = 'yes';
		} else if ($type == 'carousel-centered') {
			$slider_data['data-number-of-items']   = '2';
			$slider_data['data-slider-margin']     = '30';
			$slider_data['data-enable-center']     = 'yes';
			$slider_data['data-enable-navigation'] = 'yes';
			$slider_data['data-enable-pagination'] = 'yes';
		} else {
			$slider_data['data-number-of-items']   = '1';
			$slider_data['data-enable-pagination'] = 'yes';
		}
		
		return $slider_data;
	}

    /**
     * Filter categories
     *
     * @param $query
     *
     * @return array
     */
    public function blogListCategoryAutocompleteSuggester( $query ) {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['slug'];
                $data['label'] = ( ( strlen( $value['category_title'] ) > 0 ) ? esc_html__( 'Category', 'foton' ) . ': ' . $value['category_title'] : '' );
                $results[]     = $data;
            }
        }

        return $results;
    }

    /**
     * Find categories by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function blogListCategoryAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get category
            $category = get_term_by( 'slug', $query, 'category' );
            if ( is_object( $category ) ) {

                $category_slug = $category->slug;
                $category_title = $category->name;

                $category_title_display = '';
                if ( ! empty( $category_title ) ) {
                    $category_title_display = esc_html__( 'Category', 'foton' ) . ': ' . $category_title;
                }

                $data          = array();
                $data['value'] = $category_slug;
                $data['label'] = $category_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorBlogSlider() );