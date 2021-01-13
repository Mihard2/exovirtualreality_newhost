<?php
namespace FotonCore\CPT\Shortcodes\imageMarquee;

use FotonCore\Lib;

class imageMarquee implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_image_marquee';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Image Marquee', 'foton-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by FOTON', 'foton-core' ),
					'icon'                      => 'icon-wpb-image-marquee extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
							array(
							'type'        => 'attach_image',
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Image', 'foton-core' ),
							'description' => esc_html__( 'Select image from media library', 'foton-core' )
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'image' => '',
		);
		
		$params = shortcode_atts( $args, $atts );
		$html = foton_core_get_shortcode_module_template_part( 'templates/image-marquee-template', 'image-marquee', '', $params );
		
		return $html;
	}
}