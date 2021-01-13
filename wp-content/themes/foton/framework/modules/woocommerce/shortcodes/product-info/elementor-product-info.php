<?php

class ElementorProductInfo extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_product_info';
	}
	
	public function get_title() {
		return esc_html__( 'Product Info', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-product-info';
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
			'product_id',
			[
				'label'       => esc_html__( 'Product ID', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'If you left this field empty then product ID will be of the current page', 'foton' )
			]
		);
		
		$this->add_control(
			'product_info_type',
			[
				'label'   => esc_html__( 'Product Info Type', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'title'          => esc_html__( 'Title', 'foton-core' ),
					'featured_image' => esc_html__( 'Featured Image', 'foton-core' ),
					'category'       => esc_html__( 'Category', 'foton-core' ),
					'excerpt'        => esc_html__( 'Excerpt', 'foton-core' ),
					'price'          => esc_html__( 'Price', 'foton-core' ),
					'rating'         => esc_html__( 'Rating', 'foton-core' ),
					'add_to_cart'    => esc_html__( 'Add To Cart', 'foton-core' ),
					'tag'            => esc_html__( 'Tag', 'foton-core' ),
					'author'         => esc_html__( 'Author', 'foton-core' ),
					'date'           => esc_html__( 'Date', 'foton-core' ),
				],
				'default' => 'title'
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'product_info_style',
			[
				'label' => esc_html__( 'Product Info Style', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'product_info_color',
			[
				'label'     => esc_html__( 'Product Info Color', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type' => array( 'title', 'category', 'excerpt', 'price', 'rating', 'tag', 'author', 'date' )
				],
			]
		);
		
		$this->add_control(
			'title_tag',
			[
				'label'       => esc_html__( 'Title Tag', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::COLOR,
				'options'     => foton_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
				'condition'   => [
					'product_info_type' => array( 'title' )
				],
				'description' => esc_html__( 'Set title tag for product title element', 'foton' ),
				'default'     => 'h2'
			]
		);
		
		$this->add_control(
			'featured_image_size',
			[
				'label'   => esc_html__( 'Featured Image Proportions', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''                             => esc_html__( 'Default', 'foton-core' ),
					'full'                         => esc_html__( 'Original', 'foton-core' ),
					'foton_mikado_image_square'    => esc_html__( 'Square', 'foton-core' ),
					'foton_mikado_image_landscape' => esc_html__( 'Landscape', 'foton-core' ),
					'foton_mikado_image_portrait'  => esc_html__( 'Portrait', 'foton-core' ),
					'medium'                       => esc_html__( 'Medium', 'foton-core' ),
					'large'                        => esc_html__( 'Large', 'foton-core' ),
					'woocommerce_single'           => esc_html__( 'Shop Single', 'foton-core' ),
					'woocommerce_thumbnail'        => esc_html__( 'Shop Thumbnail', 'foton-core' )
				],
				'default' => 'full'
			]
		);
		
		$this->add_control(
			'category_tag',
			[
				'label'       => esc_html__( 'Category Tag', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => foton_mikado_get_title_tag( true ),
				'condition'   => [
					'product_info_type' => array( 'category' )
				],
				'description' => esc_html__( 'Set category tag for product category element', 'foton' ),
			]
		);
		
		$this->add_control(
			'add_to_cart_skin',
			[
				'label'       => esc_html__( 'Add To Cart Skin', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => [
					''      => esc_html__( 'Default', 'foton-core' ),
					'white' => esc_html__( 'White', 'foton-core' ),
					'dark'  => esc_html__( 'Dark', 'foton-core' )
				],
				'condition'   => [
					'product_info_type' => array( 'add_to_cart' )
				],
				'description' => esc_html__( 'Set category tag for product category element', 'foton' ),
			]
		);
		
		$this->add_control(
			'add_to_cart_size',
			[
				'label'     => esc_html__( 'Add To Cart Size', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					''       => esc_html__( 'Default', 'foton-core' ),
					'small'  => esc_html__( 'Small', 'foton-core' ),
					'medium' => esc_html__( 'Medium', 'foton-core' ),
					'large'  => esc_html__( 'Large', 'foton-core' ),
				],
				'condition' => [
					'product_info_type' => array( 'add_to_cart' )
				],
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args = array(
			'product_id'          => '',
			'product_info_type'   => 'title',
			'product_info_color'  => '',
			'title_tag'           => 'h2',
			'featured_image_size' => 'full',
			'category_tag'        => '',
			'add_to_cart_skin'    => '',
			'add_to_cart_size'    => ''
		);
		
		extract( $params );
		
		$params['product_id']   = ! empty( $params['product_id'] ) ? $params['product_id'] : get_the_ID();
		$params['title_tag']    = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['category_tag'] = ! empty( $params['category_tag'] ) ? $params['category_tag'] : $args['category_tag'];
		
		$params['product_info_style'] = $this->getProductInfoStyle( $params );
		
		$html = '';
		$html .= '<div class="mkdf-product-info">';
		
		switch ( $product_info_type ) {
			case 'title':
				$html .= $this->getItemTitleHtml( $params );
				break;
			case 'featured_image':
				$html .= $this->getItemFeaturedImageHtml( $params );
				break;
			case 'category':
				$html .= $this->getItemCategoryHtml( $params );
				break;
			case 'excerpt':
				$html .= $this->getItemExcerptHtml( $params );
				break;
			case 'price':
				$html .= $this->getItemPriceHtml( $params );
				break;
			case 'rating':
				$html .= $this->getItemRatingHtml( $params );
				break;
			case 'add_to_cart':
				$html .= $this->getItemAddToCartHtml( $params );
				break;
			case 'tag':
				$html .= $this->getItemTagHtml( $params );
				break;
			case 'author':
				$html .= $this->getItemAuthorHtml( $params );
				break;
			case 'date':
				$html .= $this->getItemDateHtml( $params );
				break;
			default:
				$html .= $this->getItemTitleHtml( $params );
				break;
		}
		
		$html .= '</div>';
		
		echo foton_mikado_get_module_part( $html );
	}
	
	/**
	 * Return product info styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getProductInfoStyle( $params ) {
		$styles = array();
		
		if ( ! empty( $params['product_info_color'] ) ) {
			$styles[] = 'color: ' . $params['product_info_color'];
		}
		
		return $styles;
	}
	
	/**
	 * Generates product title html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemTitleHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$title              = get_the_title( $product_id );
		$title_tag          = $params['title_tag'];
		$product_info_style = $params['product_info_style'];
		
		if ( ! empty( $title ) ) {
			$html = '<' . esc_attr( $title_tag ) . ' itemprop="name" class="mkdf-pi-title entry-title" ' . foton_mikado_get_inline_style( $product_info_style ) . '>';
			$html .= '<a itemprop="url" href="' . esc_url( get_the_permalink( $product_id ) ) . '">' . esc_html( $title ) . '</a>';
			$html .= '</' . esc_attr( $title_tag ) . '>';
		}
		
		return $html;
	}
	
	/**
	 * Generates product featured image html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemFeaturedImageHtml( $params ) {
		$html                = '';
		$product_id          = $params['product_id'];
		$featured_image_size = ! empty( $params['featured_image_size'] ) ? $params['featured_image_size'] : 'full';
		$featured_image      = get_the_post_thumbnail( $product_id, $featured_image_size );
		
		if ( ! empty( $featured_image ) ) {
			$html = '<a itemprop="url" class="mkdf-pi-image" href="' . esc_url( get_the_permalink( $product_id ) ) . '">' . $featured_image . '</a>';
		}
		
		return $html;
	}
	
	/**
	 * Generates product categories html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemCategoryHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$categories         = wp_get_post_terms( $product_id, 'product_cat' );
		$product_info_style = $params['product_info_style'];
		
		if ( ! empty( $categories ) ) {
			$html .= '<div class="mkdf-pi-category">';
			foreach ( $categories as $cat ) {
				if ( ! empty( $params['category_tag'] ) ) {
					$html .= '<' . esc_attr( $params['category_tag'] ) . ' ' . foton_mikado_get_inline_style( $product_info_style ) . '>';
					$html .= '<a itemprop="url" class="mkdf-pi-category-item" href="' . esc_url( get_term_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
					$html .= '</' . esc_attr( $params['category_tag'] ) . '>';
				} else {
					$html .= '<a itemprop="url" class="mkdf-pi-category-item" href="' . esc_url( get_term_link( $cat->term_id ) ) . '" ' . foton_mikado_get_inline_style( $product_info_style ) . '>' . esc_html( $cat->name ) . '</a>';
				}
			}
			$html .= '</div>';
		}
		
		return $html;
	}
	
	/**
	 * Generates product excerpt html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemExcerptHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$excerpt            = get_the_excerpt( $product_id );
		$product_info_style = $params['product_info_style'];
		
		if ( ! empty( $excerpt ) ) {
			$html = '<div class="mkdf-pi-excerpt"><p itemprop="description" class="mkdf-pi-excerpt-item" ' . foton_mikado_get_inline_style( $product_info_style ) . '>' . esc_html( $excerpt ) . '</p></div>';
		}
		
		return $html;
	}
	
	/**
	 * Generates product price html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemPriceHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$product            = wc_get_product( $product_id );
		$product_info_style = $params['product_info_style'];
		
		if ( $price_html = $product->get_price_html() ) {
			$html = '<div class="mkdf-pi-price" ' . foton_mikado_get_inline_style( $product_info_style ) . '>' . $price_html . '</div>';
		}
		
		return $html;
	}
	
	/**
	 * Generates product rating html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemRatingHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$product            = wc_get_product( $product_id );
		$product_info_style = $params['product_info_style'];
		
		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
			$average = $product->get_average_rating();
			
			$html = '<div class="mkdf-pi-rating" title="' . sprintf( esc_attr__( "Rated %s out of 5", "foton" ), $average ) . '" ' . foton_mikado_get_inline_style( $product_info_style ) . '><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"></span></div>';
		}
		
		return $html;
	}
	
	/**
	 * Generates product add to cart html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemAddToCartHtml( $params ) {
		$product_id = $params['product_id'];
		$product    = wc_get_product( $product_id );
		
		if ( ! $product->is_in_stock() ) {
			$button_classes = 'button ajax_add_to_cart mkdf-btn mkdf-btn-solid';
		} else if ( $product->get_type() === 'variable' ) {
			$button_classes = 'button product_type_variable add_to_cart_button mkdf-btn mkdf-btn-solid';
		} else if ( $product->get_type() === 'external' ) {
			$button_classes = 'button product_type_external mkdf-btn mkdf-btn-solid';
		} else {
			$button_classes = 'button add_to_cart_button ajax_add_to_cart mkdf-btn mkdf-btn-solid';
		}
		
		if ( ! empty( $params['add_to_cart_skin'] ) ) {
			$button_classes .= ' mkdf-' . $params['add_to_cart_skin'] . '-skin mkdf-btn-custom-hover-color mkdf-btn-custom-hover-bg mkdf-btn-custom-border-hover';
		}
		
		if ( ! empty( $params['add_to_cart_size'] ) ) {
			$button_classes .= ' mkdf-btn-' . $params['add_to_cart_size'];
		}
		
		$html = '<div class="mkdf-pi-add-to-cart">';
		$html .= apply_filters( 'foton_mikado_filter_product_info_add_to_cart_link',
			sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product_id ),
				esc_attr( $product->get_sku() ),
				esc_attr( $button_classes ),
				esc_html( $product->add_to_cart_text() )
			),
			$product );
		$html .= '</div>';
		
		return $html;
	}
	
	/**
	 * Generates product tags html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemTagHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$tags               = wp_get_post_terms( $product_id, 'product_tag' );
		$product_info_style = $params['product_info_style'];
		
		if ( ! empty( $tags ) ) {
			$html = '<div class="mkdf-pi-tag">';
			foreach ( $tags as $tag ) {
				$html .= '<a itemprop="url" class="mkdf-pi-tag-item" href="' . esc_url( get_term_link( $tag->term_id ) ) . '" ' . foton_mikado_get_inline_style( $product_info_style ) . '>' . esc_html( $tag->name ) . '</a>';
			}
			$html .= '</div>';
		}
		
		return $html;
	}
	
	/**
	 * Generates product authors html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemAuthorHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$product_post       = get_post( $product_id );
		$autor_id           = $product_post->post_author;
		$author             = get_the_author_meta( 'display_name', $autor_id );
		$product_info_style = $params['product_info_style'];
		
		if ( ! empty( $author ) ) {
			$html = '<div class="mkdf-pi-author" ' . foton_mikado_get_inline_style( $product_info_style ) . '>' . esc_html( $author ) . '</div>';
		}
		
		return $html;
	}
	
	/**
	 * Generates product date html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemDateHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$date               = get_the_time( get_option( 'date_format' ), $product_id );
		$product_info_style = $params['product_info_style'];
		
		if ( ! empty( $date ) ) {
			$html = '<div class="mkdf-pi-date" ' . foton_mikado_get_inline_style( $product_info_style ) . '>' . esc_html( $date ) . '</div>';
		}
		
		return $html;
	}
	
	/**
	 * Filter product by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function productIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$product_id      = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts}
					WHERE post_type = 'product' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $product_id > 0 ? $product_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'foton' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'foton' ) . ': ' . $value['title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
		
	}
	
	/**
	 * Find product by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function productIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			
			$product = get_post( (int) $query );
			if ( ! is_wp_error( $product ) ) {
				
				$product_id    = $product->ID;
				$product_title = $product->post_title;
				
				$product_title_display = '';
				if ( ! empty( $product_title ) ) {
					$product_title_display = ' - ' . esc_html__( 'Title', 'foton' ) . ': ' . $product_title;
				}
				
				$product_id_display = esc_html__( 'Id', 'foton' ) . ': ' . $product_id;
				
				$data          = array();
				$data['value'] = $product_id;
				$data['label'] = $product_id_display . $product_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorProductInfo() );