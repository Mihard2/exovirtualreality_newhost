<?php
namespace FotonCore\CPT\Shortcodes\ItemShowcase;

use FotonCore\Lib;

class ItemShowcase implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_item_showcase';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'      => esc_html__( 'Item Showcase', 'foton-core' ),
					'base'      => $this->base,
					'category'  => esc_html__( 'by FOTON', 'foton-core' ),
					'icon'      => 'icon-wpb-item-showcase extended-custom-icon',
					'as_parent' => array( 'only' => 'mkdf_item_showcase_item' ),
					'js_view'   => 'VcColumnView',
					'params'    => array(
						array(
							'type'       => 'attach_image',
							'param_name' => 'item_image',
							'heading'    => esc_html__( 'Image', 'foton-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_top_offset',
							'heading'     => esc_html__( 'Image Top Offset', 'foton-core' ),
							'value'       => '-100px',
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'item_image'       => '',
			'image_top_offset' => '',
		);
		$params = shortcode_atts( $args, $atts );
		extract( $params );
		
		$item_image_style = '';
		if ( ! empty( $image_top_offset ) ) {
			$item_image_style = 'margin-top: ' . foton_mikado_filter_px( $image_top_offset ) . 'px';
		}
		
		$html = '<div class="mkdf-item-showcase-holder clearfix">';
			$html .= do_shortcode( $content );
			if ( ! empty( $item_image ) ) {
				$html .= '<div class="mkdf-is-image" ' . foton_mikado_get_inline_style( $item_image_style ) . '>';
					$html .= wp_get_attachment_image( $item_image, 'full' );
				$html .= '</div>';
			}
		$html .= '</div>';
		
		return $html;
	}
}