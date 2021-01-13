<?php

class ElementorPortfolioList extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_portfolio_list';
	}
	
	public function get_title() {
		return esc_html__( 'Portfolio List', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-portfolio-list';
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
				'label'   => esc_html__( 'Portfolio List Template', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'gallery' => esc_html__( 'Gallery', 'foton-core' ),
					'masonry' => esc_html__( 'Masonry', 'foton-core' ),
				],
				'default' => 'gallery'
			]
		);
		
		$this->add_control(
			'item_type',
			[
				'label'   => esc_html__( 'Click Behavior', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''        => esc_html__( 'Open portfolio single page on click', 'foton-core' ),
					'gallery' => esc_html__( 'Open gallery in Pretty Photo on click', 'foton-core' ),
				],
			]
		);
		
		$this->add_control(
			'number_of_columns',
			[
				'label'       => esc_html__( 'Number of Columns', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => foton_mikado_get_number_of_columns_array( true ),
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
				'default' => 'normal'
			]
		);
		
		$this->add_control(
			'number_of_items',
			[
				'label'       => esc_html__( 'Number of Portfolios Per Page', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Set number of items for your portfolio list. Enter -1 to show all.', 'foton-core' ),
				'default'     => '-1'
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
				'description' => esc_html__( 'Set image proportions for your portfolio list.', 'foton-core' ),
				'condition'   => [
					'type' => array( 'gallery' )
				],
				'default'     => 'full'
			]
		);
		
		$this->add_control(
			'enable_fixed_proportions',
			[
				'label'       => esc_html__( 'Enable Fixed Image Proportions', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => foton_mikado_get_yes_no_select_array( false ),
				'description' => esc_html__( 'Set predefined image proportions for your masonry portfolio list. This option will apply image proportions you set in Portfolio Single page - dimensions for masonry option.', 'foton-core' ),
				'condition'   => [
					'type' => array( 'masonry' )
				],
				'default'     => 'no'
			]
		);
		
		$this->add_control(
			'enable_image_shadow',
			[
				'label'   => esc_html__( 'Enable Image Shadow', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false ),
				'default' => 'no'
			]
		);
		
		$this->add_control(
			'rounded_image',
			[
				'label'   => esc_html__( 'Enable Rounded Images', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false ),
				'default' => 'no'
			]
		);
		
		$this->add_control(
			'category',
			[
				'label'       => esc_html__( 'One-Category Portfolio List', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'foton-core' )
			]
		);
		
		$this->add_control(
			'selected_projects',
			[
				'label'       => esc_html__( 'Show Only Projects with Listed IDs', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'foton-core' )
			]
		);
		
		$this->add_control(
			'tag',
			[
				'label'       => esc_html__( 'One-Tag Portfolio List', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'foton-core' )
			]
		);
		
		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_query_order_by_array(),
				'default' => 'date'
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
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'content_layout',
			[
				'label' => esc_html__( 'Content Layout', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'item_style',
			[
				'label'   => esc_html__( 'Item Style', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'standard-shader'                 => esc_html__( 'Standard - Shader', 'foton-core' ),
					'standard-switch-images'          => esc_html__( 'Standard - Switch Featured Images', 'foton-core' ),
					'gallery-overlay'                 => esc_html__( 'Gallery - Overlay', 'foton-core' ),
					'gallery-overlay-additional'      => esc_html__( 'Gallery - Overlay Additional', 'foton-core' ),
					'gallery-slide-from-image-bottom' => esc_html__( 'Gallery - Slide From Image Bottom', 'foton-core' ),
				],
				'default' => 'standard-shader'
			]
		);
		
		$this->add_control(
			'content_top_margin',
			[
				'label'     => esc_html__( 'Content Top Margin (px or %)', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'item_style' => array( 'standard-shader', 'standard-switch-images' )
				],
			]
		);
		
		$this->add_control(
			'content_bottom_margin',
			[
				'label'     => esc_html__( 'Content Bottom Margin (px or %)', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'item_style' => array( 'standard-shader', 'standard-switch-images' )
				],
			]
		);
		
		$this->add_control(
			'enable_title',
			[
				'label'   => esc_html__( 'Enable Title', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false, true ),
				'default' => 'yes'
			]
		);
		
		$this->add_control(
			'title_tag',
			[
				'label'     => esc_html__( 'Title Tag', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_title_tag( true ),
				'condition' => [
					'enable_title' => array( 'yes' )
				],
				'default'   => 'h4'
			]
		);
		
		$this->add_control(
			'title_text_transform',
			[
				'label'     => esc_html__( 'Title Text Transform', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_text_transform_array( true ),
				'condition' => [
					'enable_title' => array( 'yes' )
				],
			]
		);
		
		$this->add_control(
			'enable_category',
			[
				'label'   => esc_html__( 'Enable Category', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false, true ),
				'default' => 'yes'
			]
		);
		
		$this->add_control(
			'enable_count_images',
			[
				'label'     => esc_html__( 'Enable Number of Images', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_yes_no_select_array( false, true ),
				'condition' => [
					'type' => array( 'gallery' )
				],
				'default'   => 'yes'
			]
		);
		
		$this->add_control(
			'enable_excerpt',
			[
				'label'   => esc_html__( 'Enable Excerpt', 'foton-core' ),
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
				'description' => esc_html__( 'Number of characters', 'foton-core' ),
				'condition'   => [
					'enable_excerpt' => array( 'yes' )
				],
				'default'     => '20'
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'additional_features',
			[
				'label' => esc_html__( 'Additional Features', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'pagination_type',
			[
				'label'       => esc_html__( 'Pagination Type', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => [
					'no-pagination'   => esc_html__( 'None', 'foton-core' ),
					'standard'        => esc_html__( 'Standard', 'foton-core' ),
					'load-more'       => esc_html__( 'Load More', 'foton-core' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'foton-core' ),
				],
				'description' => esc_html__( 'Number of characters', 'foton-core' ),
				'default'     => 'no-pagination'
			]
		);
		
		$this->add_control(
			'load_more_top_margin',
			[
				'label'       => esc_html__( 'Load More Top Margin (px or %)', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Number of characters', 'foton-core' ),
				'condition'   => [
					'pagination_type' => array( 'load-more' )
				],
				'default'     => ''
			]
		);
		
		$this->add_control(
			'filter',
			[
				'label'   => esc_html__( 'Enable Category Filter', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false ),
				'default' => 'no'
			]
		);
		
		$this->add_control(
			'filter_order_by',
			[
				'label'     => esc_html__( 'Filter Order By', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'name'  => esc_html__( 'Name', 'foton-core' ),
					'count' => esc_html__( 'Count', 'foton-core' ),
					'id'    => esc_html__( 'Id', 'foton-core' ),
					'slug'  => esc_html__( 'Slug', 'foton-core' ),
				],
				'condition' => [
					'filter' => array( 'yes' )
				],
				'default'   => 'name'
			]
		);
		
		$this->add_control(
			'filter_text_transform',
			[
				'label'     => esc_html__( 'Filter Text Transform', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_text_transform_array( true ),
				'condition' => [
					'filter' => array( 'yes' )
				],
				'default'   => 'no'
			]
		);
		
		$this->add_control(
			'filter_bottom_margin',
			[
				'label'     => esc_html__( 'Filter Bottom Margin (px or %)', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'filter' => array( 'yes' )
				],
			]
		);
		
		$this->add_control(
			'enable_article_animation',
			[
				'label'       => esc_html__( 'Enable Article Animation', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => foton_mikado_get_yes_no_select_array( false ),
				'condition'   => [
					'filter' => array( 'yes' )
				],
				'description' => esc_html__( 'Enabling this option you will enable appears animation for your portfolio list items', 'foton-core' ),
				'default'     => 'no'
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$args = array(
			'type'                     => 'gallery',
			'item_type'                => '',
			'number_of_columns'        => 'three',
			'space_between_items'      => 'normal',
			'number_of_items'          => '-1',
			'image_proportions'        => 'full',
			'enable_fixed_proportions' => 'no',
			'enable_image_shadow'      => 'no',
			'rounded_image'            => 'no',
			'category'                 => '',
			'selected_projects'        => '',
			'tag'                      => '',
			'orderby'                  => 'date',
			'order'                    => 'ASC',
			'item_style'               => 'standard-shader',
			'content_top_margin'       => '',
			'content_bottom_margin'    => '',
			'enable_title'             => 'yes',
			'title_tag'                => 'h4',
			'title_text_transform'     => '',
			'enable_category'          => 'yes',
			'enable_count_images'      => 'yes',
			'enable_excerpt'           => 'no',
			'excerpt_length'           => '20',
			'pagination_type'          => 'no-pagination',
			'load_more_top_margin'     => '',
			'filter'                   => 'no',
			'filter_order_by'          => 'name',
			'filter_text_transform'    => '',
			'filter_bottom_margin'     => '',
			'enable_article_animation' => 'no',
			'portfolio_slider_on'      => 'no',
			'enable_loop'              => 'yes',
			'enable_autoplay'          => 'yes',
			'slider_speed'             => '5000',
			'slider_speed_animation'   => '600',
			'enable_navigation'        => 'yes',
			'navigation_skin'          => '',
			'enable_pagination'        => 'yes',
			'pagination_skin'          => '',
			'pagination_position'      => ''
		);
		
		$params = shortcode_atts( $args, $params = $this->get_settings_for_display() );
		
		/***
		 * @params query_results
		 * @params holder_data
		 * @params holder_classes
		 * @params holder_inner_classes
		 */
		$additional_params = array();
		
		$query_array                        = $this->getQueryArray( $params );
		$query_results                      = new \WP_Query( $query_array );
		$additional_params['query_results'] = $query_results;
		
		$additional_params['holder_data']          = foton_mikado_get_holder_data_for_cpt( $params, $additional_params );
		$additional_params['holder_classes']       = $this->getHolderClasses( $params, $args );
		$additional_params['holder_inner_classes'] = $this->getHolderInnerClasses( $params );
		
		$params['this_object'] = $this;
		
		echo foton_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'portfolio-holder', $params['type'], $params, $additional_params );
	}
	
	public function getQueryArray( $params ) {
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'portfolio-item',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['orderby'],
			'order'          => $params['order']
		);
		
		if ( ! empty( $params['category'] ) ) {
			$query_array['portfolio-category'] = $params['category'];
		}
		
		$project_ids = null;
		if ( ! empty( $params['selected_projects'] ) ) {
			$project_ids             = explode( ',', $params['selected_projects'] );
			$query_array['post__in'] = $project_ids;
		}
		
		if ( ! empty( $params['tag'] ) ) {
			$query_array['portfolio-tag'] = $params['tag'];
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$query_array['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
		return $query_array;
	}
	
	public function getHolderClasses( $params, $args ) {
		$classes = array();
		
		$classes[] = ! empty( $params['type'] ) ? 'mkdf-pl-' . $params['type'] : 'mkdf-pl-' . $args['type'];
		$classes[] = ! empty( $params['number_of_columns'] ) ? 'mkdf-' . $params['number_of_columns'] . '-columns' : 'mkdf-' . $args['number_of_columns'] . '-columns';
		$classes[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $args['space_between_items'] . '-space';
		$classes[] = ! empty( $params['item_style'] ) ? 'mkdf-pl-' . $params['item_style'] : '';
		$classes[] = $params['enable_fixed_proportions'] === 'yes' ? 'mkdf-fixed-masonry-items' : '';
		$classes[] = $params['enable_image_shadow'] === 'yes' ? 'mkdf-pl-has-shadow' : '';
		$classes[] = $params['rounded_image'] === 'yes' ? 'mkdf-pl-rounded-image' : '';
		$classes[] = $params['enable_title'] === 'no' && $params['enable_category'] === 'no' && $params['enable_excerpt'] === 'no' ? 'mkdf-pl-no-content' : '';
		$classes[] = ! empty( $params['pagination_type'] ) ? 'mkdf-pl-pag-' . $params['pagination_type'] : '';
		$classes[] = $params['filter'] === 'yes' ? 'mkdf-pl-has-filter' : '';
		$classes[] = $params['enable_article_animation'] === 'yes' ? 'mkdf-pl-has-animation' : '';
		$classes[] = ! empty( $params['navigation_skin'] ) ? 'mkdf-nav-' . $params['navigation_skin'] . '-skin' : '';
		$classes[] = ! empty( $params['pagination_skin'] ) ? 'mkdf-pag-' . $params['pagination_skin'] . '-skin' : '';
		$classes[] = ! empty( $params['pagination_position'] ) ? 'mkdf-pag-' . $params['pagination_position'] : '';
		
		return implode( ' ', $classes );
	}
	
	public function getHolderInnerClasses( $params ) {
		$classes = array();
		if ( isset( $params['portfolio_slider_on'] ) ) {
			$classes[] = $params['portfolio_slider_on'] === 'yes' ? 'mkdf-owl-slider mkdf-list-is-slider' : '';
		}
		
		return implode( ' ', $classes );
	}
	
	public function getArticleClasses( $params ) {
		$classes = array();
		
		$type       = $params['type'];
		$item_style = $params['item_style'];
		
		if ( get_post_meta( get_the_ID(), "mkdf_portfolio_featured_image_meta", true ) !== "" && $item_style === 'standard-switch-images' ) {
			$classes[] = 'mkdf-pl-has-switch-image';
		} elseif ( get_post_meta( get_the_ID(), "mkdf_portfolio_featured_image_meta", true ) === "" && $item_style === 'standard-switch-images' ) {
			$classes[] = 'mkdf-pl-no-switch-image';
		}
		
		$image_proportion = $params['enable_fixed_proportions'] === 'yes' ? 'fixed' : 'original';
		$masonry_size     = get_post_meta( get_the_ID(), 'mkdf_portfolio_masonry_' . $image_proportion . '_dimensions_meta', true );
		
		$classes[] = ! empty( $masonry_size ) && $type === 'masonry' ? 'mkdf-masonry-size-' . esc_attr( $masonry_size ) : '';
		
		$article_classes = get_post_class( $classes );
		
		return implode( ' ', $article_classes );
	}
	
	public function getImageSize( $params ) {
		$thumb_size = 'full';
		
		if ( ! empty( $params['image_proportions'] ) && $params['type'] == 'gallery' ) {
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
		
		if ( $params['type'] == 'masonry' && $params['enable_fixed_proportions'] === 'yes' ) {
			$fixed_image_size = get_post_meta( get_the_ID(), 'mkdf_portfolio_masonry_fixed_dimensions_meta', true );
			
			switch ( $fixed_image_size ) {
				case 'small' :
					$thumb_size = 'foton_mikado_image_square';
					break;
				case 'large-width':
					$thumb_size = 'foton_mikado_image_landscape';
					break;
				case 'large-height':
					$thumb_size = 'foton_mikado_image_portrait';
					break;
				case 'large-width-height':
					$thumb_size = 'foton_mikado_image_huge';
					break;
				default :
					$thumb_size = 'full';
					break;
			}
		}
		
		return $thumb_size;
	}
	
	public function getStandardContentStyles( $params ) {
		$styles = array();
		
		$margin_top    = isset( $params['content_top_margin'] ) ? $params['content_top_margin'] : '';
		$margin_bottom = isset( $params['content_bottom_margin'] ) ? $params['content_bottom_margin'] : '';
		
		if ( ! empty( $margin_top ) ) {
			if ( foton_mikado_string_ends_with( $margin_top, '%' ) || foton_mikado_string_ends_with( $margin_top, 'px' ) ) {
				$styles[] = 'margin-top: ' . $margin_top;
			} else {
				$styles[] = 'margin-top: ' . foton_mikado_filter_px( $margin_top ) . 'px';
			}
		}
		
		if ( ! empty( $margin_bottom ) ) {
			if ( foton_mikado_string_ends_with( $margin_bottom, '%' ) || foton_mikado_string_ends_with( $margin_bottom, 'px' ) ) {
				$styles[] = 'margin-bottom: ' . $margin_bottom;
			} else {
				$styles[] = 'margin-bottom: ' . foton_mikado_filter_px( $margin_bottom ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}
	
	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_text_transform'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getSwitchFeaturedImage() {
		$featured_image_meta = get_post_meta( get_the_ID(), 'mkdf_portfolio_featured_image_meta', true );
		
		$featured_image = ! empty( $featured_image_meta ) ? esc_url( $featured_image_meta ) : '';
		
		return $featured_image;
	}
	
	public function getLoadMoreStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['load_more_top_margin'] ) ) {
			$margin = $params['load_more_top_margin'];
			
			if ( foton_mikado_string_ends_with( $margin, '%' ) || foton_mikado_string_ends_with( $margin, 'px' ) ) {
				$styles[] = 'margin-top: ' . $margin;
			} else {
				$styles[] = 'margin-top: ' . foton_mikado_filter_px( $margin ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}
	
	public function getFilterCategories( $params ) {
		$cat_id = 0;
		
		if ( ! empty( $params['category'] ) ) {
			$top_category = get_term_by( 'slug', $params['category'], 'portfolio-category' );
			
			if ( isset( $top_category->term_id ) ) {
				$cat_id = $top_category->term_id;
			}
		}
		
		$order = $params['filter_order_by'] === 'count' ? 'DESC' : 'ASC';
		
		$args = array(
			'taxonomy' => 'portfolio-category',
			'child_of' => $cat_id,
			'orderby'  => $params['filter_order_by'],
			'order'    => $order
		);
		
		$filter_categories = get_terms( $args );
		
		return $filter_categories;
	}
	
	public function getFilterHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['filter_bottom_margin'] ) ) {
			$margin = $params['filter_bottom_margin'];
			
			if ( foton_mikado_string_ends_with( $margin, '%' ) || foton_mikado_string_ends_with( $margin, 'px' ) ) {
				$styles[] = 'margin-bottom: ' . $margin;
			} else {
				$styles[] = 'margin-bottom: ' . foton_mikado_filter_px( $margin ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}
	
	public function getFilterStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['filter_text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['filter_text_transform'];
		}
		
		return implode( ';', $styles );
	}
	
	public function getItemLink() {
		$portfolio_link_meta = get_post_meta( get_the_ID(), 'portfolio_external_link', true );
		$portfolio_link      = ! empty( $portfolio_link_meta ) ? $portfolio_link_meta : get_permalink( get_the_ID() );
		
		return apply_filters( 'foton_mikado_filter_portfolio_external_link', $portfolio_link );
	}
	
	public function getItemLinkTarget() {
		$portfolio_link_meta   = get_post_meta( get_the_ID(), 'portfolio_external_link', true );
		$portfolio_link_target = ! empty( $portfolio_link_meta ) ? '_blank' : '_self';
		
		return apply_filters( 'foton_mikado_filter_portfolio_external_link_target', $portfolio_link_target );
	}
	
	/**
	 * Filter portfolio categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_category_title'] ) > 0 ) ? esc_html__( 'Category', 'foton-core' ) . ': ' . $value['portfolio_category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_category = get_term_by( 'slug', $query, 'portfolio-category' );
			if ( is_object( $portfolio_category ) ) {
				
				$portfolio_category_slug  = $portfolio_category->slug;
				$portfolio_category_title = $portfolio_category->name;
				
				$portfolio_category_title_display = '';
				if ( ! empty( $portfolio_category_title ) ) {
					$portfolio_category_title_display = esc_html__( 'Category', 'foton-core' ) . ': ' . $portfolio_category_title;
				}
				
				$data          = array();
				$data['value'] = $portfolio_category_slug;
				$data['label'] = $portfolio_category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter portfolios by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$portfolio_id    = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts}
					WHERE post_type = 'portfolio-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'foton-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'foton-core' ) . ': ' . $value['title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio
			$portfolio = get_post( (int) $query );
			if ( ! is_wp_error( $portfolio ) ) {
				
				$portfolio_id    = $portfolio->ID;
				$portfolio_title = $portfolio->post_title;
				
				$portfolio_title_display = '';
				if ( ! empty( $portfolio_title ) ) {
					$portfolio_title_display = ' - ' . esc_html__( 'Title', 'foton-core' ) . ': ' . $portfolio_title;
				}
				
				$portfolio_id_display = esc_html__( 'Id', 'foton-core' ) . ': ' . $portfolio_id;
				
				$data          = array();
				$data['value'] = $portfolio_id;
				$data['label'] = $portfolio_id_display . $portfolio_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter portfolio tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'foton-core' ) . ': ' . $value['portfolio_tag_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio tag by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_tag = get_term_by( 'slug', $query, 'portfolio-tag' );
			if ( is_object( $portfolio_tag ) ) {
				
				$portfolio_tag_slug  = $portfolio_tag->slug;
				$portfolio_tag_title = $portfolio_tag->name;
				
				$portfolio_tag_title_display = '';
				if ( ! empty( $portfolio_tag_title ) ) {
					$portfolio_tag_title_display = esc_html__( 'Tag', 'foton-core' ) . ': ' . $portfolio_tag_title;
				}
				
				$data          = array();
				$data['value'] = $portfolio_tag_slug;
				$data['label'] = $portfolio_tag_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorPortfolioList() );