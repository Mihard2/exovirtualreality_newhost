<?php
namespace FotonCore\CPT\Shortcodes\Tabs;

use FotonCore\Lib;

class Tabs implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_tabs';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Tabs', 'foton-core' ),
					'base'            => $this->getBase(),
					'as_parent'       => array( 'only' => 'mkdf_tabs_item' ),
					'content_element' => true,
					'category'        => esc_html__( 'by FOTON', 'foton-core' ),
					'icon'            => 'icon-wpb-tabs extended-custom-icon',
					'js_view'         => 'VcColumnView',
					'params'          => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'foton-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'foton-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'foton-core' ),
							'value'       => array(
								esc_html__( 'Standard', 'foton-core' ) => 'standard',
								esc_html__( 'Boxed', 'foton-core' )    => 'boxed',
								esc_html__( 'Simple', 'foton-core' )   => 'simple',
								esc_html__( 'Vertical', 'foton-core' ) => 'vertical'
							),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class' => '',
			'type'         => 'standard'
		);
		$params = shortcode_atts( $args, $atts );
		
		// Extract tab titles
		preg_match_all( '/tab_title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$tab_titles = array();
		
		/**
		 * get tab titles array
		 */
		if ( isset( $matches[0] ) ) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach ( $tab_titles as $tab ) {
			preg_match( '/tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['tabs_titles']    = $tab_title_array;
		$params['content']        = $content;
		
		$output = foton_core_get_shortcode_module_template_part( 'templates/tab-template', 'tabs', '', $params );
		
		return $output;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-tabs-' . esc_attr( $params['type'] ) : 'mkdf-tabs-standard';
		
		return implode( ' ', $holderClasses );
	}
}