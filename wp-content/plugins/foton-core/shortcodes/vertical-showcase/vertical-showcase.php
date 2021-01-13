<?php

namespace FotonCore\CPT\Shortcodes\VerticalShowcase;

use FotonCore\Lib;

class VerticalShowcase implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_vertical_showcase';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );

	}

	protected function setParams() {
		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
		
		$contact_forms = array();
		if ( $cf7 ) {
			foreach ( $cf7 as $cform ) {
				$contact_forms[ $cform->ID ] = $cform->post_title;
			}
		} else {
			$contact_forms[0] = esc_html__( 'No contact forms found', 'foton' );
		}

		$formatted_cf_array = array();
		
		if ( is_array( $contact_forms ) && count( $contact_forms ) ) {
			foreach ( $contact_forms as $key=>$value ) {
				$formatted_cf_array[ $value ] = $key;
			}
		}


		return $formatted_cf_array;


	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Vertical Showcase', 'foton-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by FOTON', 'foton-core' ),
					'icon'     => 'icon-wpb-vertical-showcase extended-custom-icon',
					'params'   => array(
						array(
							'type'       => 'param_group',
							'param_name' => 'link_items',
							'heading'    => esc_html__( 'Link Items', 'foton-core' ),
							'params'     => array(
								array(
									'type'        => 'attach_image',
									'param_name'  => 'icon_image',
									'heading'     => esc_html__( 'Icon Image', 'foton-core' ),
									'description' => esc_html__( 'Select image from media library', 'foton-core' )
								),
								array(
									'type'       => 'textfield',
									'param_name' => 'slide_text',
									'heading'    => esc_html__( 'Text beside number', 'foton-core' ),
								),
								array(
									'type'       => 'textfield',
									'param_name' => 'title',
									'heading'    => esc_html__( 'Slide Title', 'foton-core' ),
								),
								array(
									'type'       => 'textfield',
									'param_name' => 'subtitle',
									'heading'    => esc_html__( 'Slide Subtitle', 'foton-core' ),
								),
								array(
									'type'        => 'attach_image',
									'param_name'  => 'image',
									'heading'     => esc_html__( 'Image', 'foton-core' ),
									'description' => esc_html__( 'Select image from media library', 'foton-core' )
								)
							)
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'contact_form_title',
							'heading'    => esc_html__( 'Contact Form Title', 'foton-core' ),
							'group'     => esc_html__( 'Last Slide', 'foton-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'contact_form_subtitle',
							'heading'    => esc_html__( 'Contact Form Subtitle', 'foton-core' ),
							'group'     => esc_html__( 'Last Slide', 'foton-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'contact_form',
							'heading'     => esc_html__( 'Select Contact Form 7', 'foton' ),
							'value'       => $this->setParams(),
							'save_always' => true,
							'group'     => esc_html__( 'Last Slide', 'foton-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'bg_text',
							'heading'    => esc_html__( 'Background Text', 'foton-core' ),
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_phone_frame',
							'heading'     => esc_html__( 'Enable Phone Frame', 'foton-core' ),
							'value'       => array_flip( foton_mikado_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_app_store_link',
							'heading'     => esc_html__( 'Enable App Store Link', 'foton-core' ),
							'value'       => array_flip( foton_mikado_get_yes_no_select_array( false ) ),
							'save_always' => true,
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'app_store_link',
							'heading'     => esc_html__( 'Link Address', 'foton-core' ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'enable_app_store_link', 'value' => array( 'yes' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_play_store_link',
							'heading'     => esc_html__( 'Enable Google Play Store Link', 'foton-core' ),
							'value'       => array_flip( foton_mikado_get_yes_no_select_array( false ) ),
							'save_always' => true,
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'play_store_link',
							'heading'     => esc_html__( 'Link Address', 'foton-core' ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'enable_play_store_link', 'value' => array( 'yes' ) )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'link_items'       		 => '',
			'contact_form'		     => '',
			'contact_form_title'	 => '',
			'contact_form_subtitle'	 => '',
			'widget_area'			 => '',
			'bg_text'			 	 => '',
			'enable_phone_frame'	 => 'yes',
			'enable_app_store_link'  => 'no',
			'app_store_link' 		 => '#',
			'enable_play_store_link' => 'no',
			'play_store_link'		 => '#'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['link_items']          = json_decode( urldecode( $params['link_items'] ), true );
		
		$html = foton_core_get_shortcode_module_template_part( 'templates/vertical-showcase', 'vertical-showcase', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();

		$holderClasses[] = $params['enable_phone_frame'] == "no" ? 'mkdf-vs-no-frame' : '';
		
		return implode( ' ', $holderClasses );
	}

}