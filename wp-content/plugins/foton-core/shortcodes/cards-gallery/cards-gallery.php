<?php
namespace FotonCore\CPT\Shortcodes\CardsGallery;

use FotonCore\Lib;

class CardsGallery implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_cards_gallery';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Cards Gallery', 'foton-core' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by FOTON', 'foton-core' ),
					'icon'     => 'icon-wpb-cards-gallery extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'layout',
							'heading'     => esc_html__( 'Layout', 'foton-core' ),
							'value'       => array(
								esc_html__( 'Shuffled right', 'foton-core' ) => 'shuffled-right',
								esc_html__( 'Shuffled left', 'foton-core' )  => 'shuffled-left',
							),
							'save_always' => true
						),
						array(
							'type'        => 'attach_images',
							'param_name'  => 'images',
							'heading'     => esc_html__( 'Images', 'foton-core' ),
							'description' => esc_html__( 'Select images from media library', 'foton-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'bundle_animation',
							'heading'     => esc_html__( 'Bundle Animation', 'foton-core' ),
							'value'       => array_flip( foton_mikado_get_yes_no_select_array( false ) )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'layout'           => 'shuffled-right',
			'images'           => '',
			'bundle_animation' => 'no'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['images']         = $this->getGalleryImages( $params );
		
		return foton_core_get_shortcode_module_template_part( 'templates/cards-gallery', 'cards-gallery', '', $params );
	}
	
	private function getHolderClasses( $params ) {
		$classes = array( 'mkdf-cards-gallery' );
		
		$classes[] = 'mkdf-cg-' . $params['layout'];
		
		if ( $params['bundle_animation'] === 'yes' ) {
			$classes[] = 'mkdf-no-events mkdf-bundle-animation';
		}
		
		return $classes;
	}
	
	private function getGalleryImages( $params ) {
		$image_ids = array();
		$images    = array();
		$i         = 0;
		
		if ( $params['images'] !== '' ) {
			$image_ids = explode( ',', $params['images'] );
		}
		
		foreach ( $image_ids as $id ) {
			$image['image_id']     = $id;
			$image_original        = wp_get_attachment_image_src( $id, 'full' );
			$image['url']          = $image_original[0];
			$image['alt']          = get_post_meta( $id, '_wp_attachment_image_alt', true );
			$image['image_link']   = get_post_meta( $id, 'attachment_image_link', true );
			$image['image_target'] = get_post_meta( $id, 'attachment_image_target', true );
			
			$image_dimensions = foton_mikado_get_image_dimensions( $image['url'] );
			
			if ( is_array( $image_dimensions ) && array_key_exists( 'height', $image_dimensions ) ) {
				if ( ! empty( $image_dimensions['height'] ) && $image_dimensions['width'] ) {
					$image['height'] = $image_dimensions['height'];
					$image['width']  = $image_dimensions['width'];
				}
			}
			
			$images[ $i ] = $image;
			$i ++;
		}
		
		return $images;
	}
}