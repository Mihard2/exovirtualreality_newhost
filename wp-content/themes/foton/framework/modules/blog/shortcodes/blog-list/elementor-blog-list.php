<?php

class ElementorBlogList extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mkdf_elementor_blog_list';
	}

	public function get_title() {
		return esc_html__( 'Blog List', 'foton-core' );
	}

	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-blog-list';
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
					'simple'   => esc_html__( 'Simple', 'foton-core' ),
					'minimal'  => esc_html__( 'Minimal', 'foton-core' )
				],
				'default' => 'standard'
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
			'number_of_columns',
			[
				'label'     => esc_html__( 'Number of Columns', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_number_of_columns_array( true ),
				'condition' => [
					'type' => array( 'standard', 'boxed', 'masonry' )
				],
				'default'   => 'four'
			]
		);

		$this->add_control(
			'space_between_items',
			[
				'label'     => esc_html__( 'Space Between Items', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_space_between_items_array(),
				'condition' => [
					'type' => array( 'standard', 'boxed', 'masonry' )
				],
				'default'   => 'normal'
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
				'default' => 'h4'
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
			'excerpt_length',
			[
				'label'       => esc_html__( 'Text Length', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Number of words', 'foton' ),
				'condition'   => [
					'type' => array( 'standard', 'boxed', 'masonry' )
				],
				'default'     => '40'
			]
		);

		$this->add_control(
			'post_info_image',
			[
				'label'     => esc_html__( 'Enable Post Info Image', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_yes_no_select_array( false, true ),
				'condition' => [
					'type' => array( 'standard', 'boxed', 'masonry' )
				],
			]
		);

		$this->add_control(
			'post_info_section',
			[
				'label'     => esc_html__( 'Enable Post Info Section', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_yes_no_select_array( false, true ),
				'condition' => [
					'type' => array( 'standard', 'boxed', 'masonry' )
				],
				'default'   => 'yes'
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

		$this->add_control(
			'post_info_like',
			[
				'label'     => esc_html__( 'Enable Post Info Like', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_yes_no_select_array( false ),
				'condition' => [
					'post_info_section' => array( 'yes' )
				],
				'default'   => 'no'
			]
		);

		$this->add_control(
			'post_info_share',
			[
				'label'     => esc_html__( 'Enable Post Info Share', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_yes_no_select_array( false ),
				'condition' => [
					'post_info_section' => array( 'yes' )
				],
				'default'   => 'no'
			]
		);

		$this->add_control(
			'pagination_type',
			[
				'label'   => esc_html__( 'Pagination Type', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'no-pagination'       => esc_html__( 'None', 'foton-core' ),
					'standard-shortcodes' => esc_html__( 'Standard', 'foton-core' ),
					'load-more'           => esc_html__( 'Load More', 'foton-core' ),
					'infinite-scroll'     => esc_html__( 'Infinite Scroll', 'foton-core' ),
				],
				'default' => 'no-pagination'
			]
		);

		$this->end_controls_section();
	}

	public function render() {
		$params = $this->get_settings_for_display();

		$default_atts = array(
			'type'                => 'standard',
			'number_of_posts'     => '-1',
			'number_of_columns'   => 'four',
			'space_between_items' => 'normal',
			'category'            => '',
			'orderby'             => 'title',
			'order'               => 'ASC',
			'image_size'          => 'full',
			'title_tag'           => 'h4',
			'title_transform'     => '',
			'excerpt_length'      => '40',
			'post_info_section'   => 'yes',
			'post_info_image'     => 'yes',
			'post_info_author'    => 'yes',
			'post_info_date'      => 'yes',
			'post_info_category'  => 'yes',
			'post_info_comments'  => 'no',
			'post_info_like'      => 'no',
			'post_info_share'     => 'no',
			'pagination_type'     => 'no-pagination'
		);

		$queryArray             = $this->generateQueryArray( $params );
		$query_result           = new \WP_Query( $queryArray );
		$params['query_result'] = $query_result;

		$params['holder_data']    = $this->getHolderData( $params );
		$params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		$params['module']         = 'list';

		$params['max_num_pages'] = $query_result->max_num_pages;
		$params['paged']         = isset( $query_result->query['paged'] ) ? $query_result->query['paged'] : 1;

		$params['this_object'] = $this;

		ob_start();

		foton_mikado_get_module_template_part( 'shortcodes/blog-list/holder', 'blog', $params['type'], $params );

		$html = ob_get_contents();

		ob_end_clean();

		echo foton_mikado_get_module_part( $html );
	}

	public function getHolderClasses( $params, $default_atts ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-bl-' . $params['type'] : 'mkdf-bl-' . $default_atts['type'];
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'mkdf-' . $params['number_of_columns'] . '-columns' : 'mkdf-' . $default_atts['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $default_atts['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['pagination_type'] ) ? 'mkdf-bl-pag-' . $params['pagination_type'] : 'mkdf-bl-pag-' . $default_atts['pagination_type'];

		return implode( ' ', $holderClasses );
	}

	public function getHolderData( $params ) {
		$dataString = '';

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		$query_result = $params['query_result'];

		$params['max_num_pages'] = $query_result->max_num_pages;

		if ( ! empty( $paged ) ) {
			$params['next-page'] = $paged + 1;
		}

		foreach ( $params as $key => $value ) {
			if ( $key !== 'query_result' && is_string($value) && $value !== '' ) {
				$new_key = str_replace( '_', '-', $key );

				$dataString .= ' data-' . $new_key . '=' . esc_attr( str_replace( ' ', '', $value ) );
			}
		}

		return $dataString;
	}

	public function generateQueryArray( $params ) {
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

		if ( ! empty( $params['next_page'] ) ) {
			$queryArray['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}

		return $queryArray;
	}

	public function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}

		return implode( ';', $styles );
	}

	/**
	 * Filter blog categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function blogCategoryAutocompleteSuggester( $query ) {
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
	 * Find blog category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function blogCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$category = get_term_by( 'slug', $query, 'category' );
			if ( is_object( $category ) ) {

				$category_slug  = $category->slug;
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

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorBlogList() );