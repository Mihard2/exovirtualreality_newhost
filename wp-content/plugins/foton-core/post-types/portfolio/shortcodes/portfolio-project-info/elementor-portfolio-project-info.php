<?php

class ElementorPortfolioProjectInfo extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor-portfolio_project_info';
	}
	
	public function get_title() {
		return esc_html__( 'Portfolio Project Info', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-portfolio-project-info';
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
			'project_id',
			[
				'label'       => esc_html__( 'Selected Project', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'If you left this field empty then project ID will be of the current page', 'foton-core' )
			]
		);
		
		$this->add_control(
			'project_info_type',
			[
				'label'   => esc_html__( 'Project Info Type', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'title'    => esc_html__( 'Title', 'foton-core' ),
					'category' => esc_html__( 'Category', 'foton-core' ),
					'tag'      => esc_html__( 'Tag', 'foton-core' ),
					'author'   => esc_html__( 'Author', 'foton-core' ),
					'date'     => esc_html__( 'Date', 'foton-core' ),
					'image'    => esc_html__( 'Featured Image', 'foton-core' ),
				],
				'default' => 'title'
			]
		);
		
		$this->add_control(
			'project_info_title_type_tag',
			[
				'label'     => esc_html__( 'Project Title Tag', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
				'condition' => [
					'project_info_type' => array( 'title' )
				],
				'default' => 'h4'
			]
		);
		
		$this->add_control(
			'project_info_title',
			[
				'label'       => esc_html__( 'Project Info Label', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Add project info label before project info element/s', 'foton-core' )
			]
		);
		
		$this->add_control(
			'project_info_title_tag',
			[
				'label'     => esc_html__( 'Project Info Label Tag', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => foton_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
				'condition' => [
					'project_info_type!' => ''
				],
				'default' => 'h4'
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args = array(
			'project_id'                  => '',
			'project_info_type'           => 'title',
			'project_info_title_type_tag' => 'h4',
			'project_info_title'          => '',
			'project_info_title_tag'      => 'h4'
		);
		
		extract($params);
		
		$project_info_type                     = ! empty( $params['project_info_type'] ) ? $params['project_info_type'] : $args['project_info_type'];
		$params['project_id']                  = ! empty( $params['project_id'] ) ? $params['project_id'] : get_the_ID();
		$params['project_info_title_type_tag'] = ! empty( $params['project_info_title_type_tag'] ) ? $params['project_info_title_type_tag'] : $args['project_info_title_type_tag'];
		$project_info_title_tag                = ! empty( $params['project_info_title_tag'] ) ? $params['project_info_title_tag'] : $args['project_info_title_tag'];
		
		$html = '<div class="mkdf-portfolio-project-info">';
		
		if ( ! empty( $project_info_title ) ) {
			$html .= '<' . esc_attr( $project_info_title_tag ) . ' class="mkdf-ppi-label">' . esc_html( $project_info_title ) . '</' . esc_attr( $project_info_title_tag ) . '>';
		}
		
		switch ( $project_info_type ) {
			case 'title':
				$html .= $this->getItemTitleHtml( $params );
				break;
			case 'category':
				$html .= $this->getItemCategoryHtml( $params );
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
			case 'image':
				$html .= $this->getItemImageHtml( $params );
				break;
			default:
				$html .= $this->getItemTitleHtml( $params );
				break;
		}
		
		$html .= '</div>';
		
		echo foton_mikado_get_module_part( $html );
	}
	
	public function getItemTitleHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$title      = get_the_title( $project_id );
		$title_tag  = $params['project_info_title_type_tag'];
		
		if ( ! empty( $title ) ) {
			$html = '<' . esc_attr( $title_tag ) . ' itemprop="name" class="mkdf-ppi-title entry-title">';
			$html .= '<a itemprop="url" href="' . esc_url( get_the_permalink( $project_id ) ) . '">' . esc_html( $title ) . '</a>';
			$html .= '</' . esc_attr( $title_tag ) . '>';
		}
		
		return $html;
	}
	
	public function getItemCategoryHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$categories = wp_get_post_terms( $project_id, 'portfolio-category' );
		
		if ( ! empty( $categories ) ) {
			$html = '<div class="mkdf-ppi-category">';
			foreach ( $categories as $cat ) {
				$html .= '<a itemprop="url" class="mkdf-ppi-category-item" href="' . esc_url( get_term_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
			}
			$html .= '</div>';
		}
		
		return $html;
	}
	
	public function getItemTagHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$tags       = wp_get_post_terms( $project_id, 'portfolio-tag' );
		
		if ( ! empty( $tags ) ) {
			$html = '<div class="mkdf-ppi-tag">';
			foreach ( $tags as $tag ) {
				$html .= '<a itemprop="url" class="mkdf-ppi-tag-item" href="' . esc_url( get_term_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a>';
			}
			$html .= '</div>';
		}
		
		return $html;
	}
	
	public function getItemAuthorHtml( $params ) {
		$html         = '';
		$project_id   = $params['project_id'];
		$project_post = get_post( $project_id );
		$autor_id     = $project_post->post_author;
		$author       = get_the_author_meta( 'display_name', $autor_id );
		
		if ( ! empty( $author ) ) {
			$html = '<div class="mkdf-ppi-author">' . esc_html( $author ) . '</div>';
		}
		
		return $html;
	}
	
	public function getItemDateHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$date       = get_the_time( get_option( 'date_format' ), $project_id );
		
		if ( ! empty( $date ) ) {
			$html = '<div class="mkdf-ppi-date">' . esc_html( $date ) . '</div>';
		}
		
		return $html;
	}
	
	public function getItemImageHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$image      = get_the_post_thumbnail( $project_id, 'full' );
		
		if ( ! empty( $image ) ) {
			$html = '<a itemprop="url" class="mkdf-ppi-image" href="' . esc_url( get_the_permalink( $project_id ) ) . '">' . $image . '</a>';
		}
		
		return $html;
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
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorPortfolioProjectInfo() );