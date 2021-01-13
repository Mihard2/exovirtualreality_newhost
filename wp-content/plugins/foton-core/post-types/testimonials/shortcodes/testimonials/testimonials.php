<?php

namespace FotonCore\CPT\Shortcodes\Testimonials;

use FotonCore\Lib;

class Testimonials implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_testimonials';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
		
		//Testimonials category filter
		add_filter( 'vc_autocomplete_mkdf_testimonials_category_callback', array( &$this, 'testimonialsCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Testimonials category render
		add_filter( 'vc_autocomplete_mkdf_testimonials_category_render', array( &$this, 'testimonialsCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Testimonials', 'foton-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by FOTON', 'foton-core' ),
					'icon'                      => 'icon-wpb-testimonials extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'foton-core' ),
							'value'       => array(
								esc_html__( 'Standard', 'foton-core' )            => 'standard',
								esc_html__( 'Boxed', 'foton-core' )               => 'boxed',
								esc_html__( 'Boxed Text', 'foton-core' )          => 'boxed-text',
								esc_html__( 'Carousel', 'foton-core' )            => 'carousel'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'skin',
							'heading'     => esc_html__( 'Skin', 'foton-core' ),
							'value'       => array(
								esc_html__( 'Default', 'foton-core' ) => '',
								esc_html__( 'Light', 'foton-core' )   => 'light',
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'number',
							'heading'    => esc_html__( 'Number of Testimonials', 'foton-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category',
							'heading'     => esc_html__( 'Category', 'foton-core' ),
							'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'foton-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'box_color',
							'heading'    => esc_html__( 'Content Box Color', 'foton-core' ),
							'dependency' => Array( 'element' => 'type', 'value' => 'boxed' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_visible_items',
							'heading'     => esc_html__( 'Number Of Visible Items', 'foton-core' ),
							'value'       => array(
								esc_html__( 'One', 'foton-core' )   => '1',
								esc_html__( 'Two', 'foton-core' )   => '2',
								esc_html__( 'Three', 'foton-core' ) => '3',
								esc_html__( 'Four', 'foton-core' )  => '4',
								esc_html__( 'Five', 'foton-core' )  => '5',
								esc_html__( 'Six', 'foton-core' )   => '6'
							),
							'save_always' => true,
							'dependency'  => Array( 'element' => 'type', 'value' => array('boxed', 'boxed-text') ),
							'group'       => esc_html__( 'Slider Settings', 'foton-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_loop',
							'heading'     => esc_html__( 'Enable Slider Loop', 'foton-core' ),
							'value'       => array_flip( foton_mikado_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'foton-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_autoplay',
							'heading'     => esc_html__( 'Enable Slider Autoplay', 'foton-core' ),
							'value'       => array_flip( foton_mikado_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'foton-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed',
							'heading'     => esc_html__( 'Slide Duration', 'foton-core' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'foton-core' ),
							'group'       => esc_html__( 'Slider Settings', 'foton-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'foton-core' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'foton-core' ),
							'group'       => esc_html__( 'Slider Settings', 'foton-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_navigation',
							'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'foton-core' ),
							'value'       => array_flip( foton_mikado_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
                            'dependency'  => Array( 'element' => 'type', 'value' => array('boxed', 'boxed-text', 'standard', 'image-pagination') ),
							'group'       => esc_html__( 'Slider Settings', 'foton-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_pagination',
							'heading'     => esc_html__( 'Enable Slider Pagination', 'foton-core' ),
							'value'       => array_flip( foton_mikado_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
                            'dependency'  => Array( 'element' => 'type', 'value' => array('boxed', 'boxed-text', 'standard', 'image-pagination') ),
							'group'       => esc_html__( 'Slider Settings', 'foton-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'type'                    => '',
			'skin'                    => '',
			'number'                  => '-1',
			'category'                => '',
			'box_color'               => '',
			'number_of_visible_items' => '3',
			'slider_loop'             => 'yes',
			'slider_autoplay'         => 'yes',
			'slider_speed'            => '5000',
			'slider_speed_animation'  => '600',
			'slider_navigation'       => 'yes',
			'slider_pagination'       => 'yes'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : 'standard';
		
		$params['holder_classes'] = $this->getHolderClasses( $params );

		$params['query_args']    = $this->getQueryParams( $params );
		$params['query_results'] = new \WP_Query( $params['query_args'] );
		
		$params['box_styles'] = $this->getBoxStyles( $params );
		$params['data_attr'] = $this->getSliderData( $params );

        return foton_core_get_cpt_shortcode_module_template_part( 'testimonials', 'testimonials', 'testimonials-' . $params['type'], '', $params );

	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = 'mkdf-testimonials-' . $params['type'];
		$holderClasses[] = ! empty( $params['skin'] ) ? 'mkdf-testimonials-' . $params['skin'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getQueryParams( $params ) {
		$args = array(
			'post_status'    => 'publish',
			'post_type'      => 'testimonials',
			'orderby'        => 'date',
			'order'          => 'DESC',
			'posts_per_page' => $params['number']
		);
		
		if ( $params['category'] != '' ) {
			$args['testimonials-category'] = $params['category'];
		}
		
		return $args;
	}
	
	public function getBoxStyles( $params ) {
		$styles = array();
		
		if ( $params['type'] === 'boxed' && ! empty( $params['box_color'] ) ) {
			$styles[] = 'background-color: ' . $params['box_color'];
		}
		
		return $styles;
	}
	
	private function getSliderData( $params ) {
		$slider_data = array();
		
		$slider_data['data-number-of-items']        = ! empty( $params['number_of_visible_items'] ) && in_array($params['type'], array('boxed', 'boxed-text')) ? $params['number_of_visible_items'] : '1';
		$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';
		$slider_data['data-slider-margin']          = in_array($params['type'], array('boxed', 'boxed-text')) ? 10 : '';

		return $slider_data;
	}
	
	/**
	 * Filter testimonials categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function testimonialsCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS testimonials_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'testimonials-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['testimonials_category_title'] ) > 0 ) ? esc_html__( 'Category', 'foton-core' ) . ': ' . $value['testimonials_category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
		
	}
	
	/**
	 * Find testimonials category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function testimonialsCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$testimonials_category = get_term_by( 'slug', $query, 'testimonials-category' );
			if ( is_object( $testimonials_category ) ) {
				
				$testimonials_category_slug  = $testimonials_category->slug;
				$testimonials_category_title = $testimonials_category->name;
				
				$testimonials_category_title_display = '';
				if ( ! empty( $testimonials_category_title ) ) {
					$testimonials_category_title_display = esc_html__( 'Category', 'foton-core' ) . ': ' . $testimonials_category_title;
				}
				
				$data          = array();
				$data['value'] = $testimonials_category_slug;
				$data['label'] = $testimonials_category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}