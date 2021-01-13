<?php
namespace FotonCore\CPT\Shortcodes\IconWithText;

use FotonCore\Lib;

class IconWithText implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_icon_with_text';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Icon With Text', 'foton-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-icon-with-text extended-custom-icon',
					'category'                  => esc_html__( 'by FOTON', 'foton-core' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
						array(
							array(
								'type'        => 'textfield',
								'param_name'  => 'custom_padding',
								'heading'     => esc_html__( 'Custom CSS Padding', 'foton-core' ),
								'description' => esc_html__( 'Add custom padding to IWT element', 'foton-core' )
							),
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
									esc_html__( 'Icon Left From Text', 'foton-core' )              => 'icon-left',
									esc_html__( 'Icon Left From Title', 'foton-core' )             => 'icon-left-from-title',
                                    esc_html__( 'Icon Left From Text with Arrow', 'foton-core' )   => 'icon-left-from-title-and-text',
									esc_html__( 'Icon Top', 'foton-core' )                         => 'icon-top'
								),
								'save_always' => true
							),
                            array(
                                'type'       => 'dropdown',
                                'param_name' => 'text_alignment',
                                'heading'    => esc_html__( 'Text Alignment Type', 'foton-core' ),
                                'value'      => array(
                                    esc_html__( 'Center', 'foton-core' ) => '',
                                    esc_html__( 'Left', 'foton-core' ) => 'left',
                                    esc_html__( 'Right', 'foton-core' ) => 'right'
                                ),
                                'dependency' => array(
                                    'element' => 'type',
                                    'value'   => array( 'icon-left-from-title-and-text' )
                                ),
                            ),
                            array(
                                'type'       => 'dropdown',
                                'param_name' => 'show_arrow',
                                'heading'    => esc_html__( 'Show Arrow', 'foton-core' ),
                                'value'      => array(
                                    esc_html__( 'Yes', 'foton-core' ) => '',
                                    esc_html__( 'No', 'foton-core' ) => 'no-arrow',
                                ),
                                'dependency' => array(
                                    'element' => 'type',
                                    'value'   => array( 'icon-left-from-title-and-text' )
                                ),
                            ),
						),
						foton_mikado_icon_collections()->getVCParamsArray(),
						array(
							array(
								'type'       => 'attach_image',
								'param_name' => 'custom_icon',
								'heading'    => esc_html__( 'Custom Icon', 'foton-core' )
							),
							array(
								'type'       => 'attach_image',
								'param_name' => 'custom_hover_icon',
								'heading'    => esc_html__( 'Custom Hover Icon', 'foton-core' ),
								'dependency' => array(
									'element' => 'custom_icon',
									'not_empty' => true ),
									),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_type',
								'heading'    => esc_html__( 'Icon Type', 'foton-core' ),
								'value'      => array(
									esc_html__( 'Normal', 'foton-core' ) => 'mkdf-normal',
									esc_html__( 'Circle', 'foton-core' ) => 'mkdf-circle',
									esc_html__( 'Square', 'foton-core' ) => 'mkdf-square'
								),
								'group'      => esc_html__( 'Icon Settings', 'foton-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_size',
								'heading'    => esc_html__( 'Icon Size', 'foton-core' ),
								'value'      => array(
									esc_html__( 'Medium', 'foton-core' )     => 'mkdf-icon-medium',
									esc_html__( 'Tiny', 'foton-core' )       => 'mkdf-icon-tiny',
									esc_html__( 'Small', 'foton-core' )      => 'mkdf-icon-small',
									esc_html__( 'Large', 'foton-core' )      => 'mkdf-icon-large',
									esc_html__( 'Very Large', 'foton-core' ) => 'mkdf-icon-huge'
								),
								'group'      => esc_html__( 'Icon Settings', 'foton-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'custom_icon_size',
								'heading'    => esc_html__( 'Custom Icon Size (px)', 'foton-core' ),
								'group'      => esc_html__( 'Icon Settings', 'foton-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'shape_size',
								'heading'    => esc_html__( 'Shape Size (px)', 'foton-core' ),
								'group'      => esc_html__( 'Icon Settings', 'foton-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_color',
								'heading'    => esc_html__( 'Icon Color', 'foton-core' ),
								'group'      => esc_html__( 'Icon Settings', 'foton-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_hover_color',
								'heading'    => esc_html__( 'Icon Hover Color', 'foton-core' ),
								'group'      => esc_html__( 'Icon Settings', 'foton-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_background_color',
								'heading'    => esc_html__( 'Icon Background Color', 'foton-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'foton-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_hover_background_color',
								'heading'    => esc_html__( 'Icon Hover Background Color', 'foton-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'foton-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_border_color',
								'heading'    => esc_html__( 'Icon Border Color', 'foton-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'foton-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_border_hover_color',
								'heading'    => esc_html__( 'Icon Border Hover Color', 'foton-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'foton-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_border_width',
								'heading'    => esc_html__( 'Border Width (px)', 'foton-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'foton-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_animation',
								'heading'    => esc_html__( 'Icon Animation', 'foton-core' ),
								'value'      => array_flip( foton_mikado_get_yes_no_select_array( false ) ),
								'group'      => esc_html__( 'Icon Settings', 'foton-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_animation_delay',
								'heading'    => esc_html__( 'Icon Animation Delay (ms)', 'foton-core' ),
								'dependency' => array( 'element' => 'icon_animation', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Icon Settings', 'foton-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'title',
								'heading'    => esc_html__( 'Title', 'foton-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'title_tag',
								'heading'     => esc_html__( 'Title Tag', 'foton-core' ),
								'value'       => array_flip( foton_mikado_get_title_tag( true ) ),
								'save_always' => true,
								'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
								'group'       => esc_html__( 'Text Settings', 'foton-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'title_color',
								'heading'    => esc_html__( 'Title Color', 'foton-core' ),
								'dependency' => array( 'element' => 'title', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'foton-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'title_top_margin',
								'heading'    => esc_html__( 'Title Top Margin (px)', 'foton-core' ),
								'dependency' => array( 'element' => 'title', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'foton-core' )
							),
							array(
								'type'       => 'textarea',
								'param_name' => 'text',
								'heading'    => esc_html__( 'Text', 'foton-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'text_color',
								'heading'    => esc_html__( 'Text Color', 'foton-core' ),
								'dependency' => array( 'element' => 'text', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'foton-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'text_top_margin',
								'heading'    => esc_html__( 'Text Top Margin (px)', 'foton-core' ),
								'dependency' => array( 'element' => 'text', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'foton-core' )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'link',
								'heading'     => esc_html__( 'Link', 'foton-core' ),
								'description' => esc_html__( 'Set link around icon and title', 'foton-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'target',
								'heading'    => esc_html__( 'Target', 'foton-core' ),
								'value'      => array_flip( foton_mikado_get_link_target_array() ),
								'dependency' => array( 'element' => 'link', 'not_empty' => true ),
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'text_padding',
								'heading'     => esc_html__( 'Text Top/Left Padding (px)', 'foton-core' ),
								'description' => esc_html__( 'Set left or top padding dependence of type for your text holder. Default value is 13 for left type and 25 for top icon with text type', 'foton-core' ),
								'dependency'  => array( 'element' => 'type', 'value'   => array( 'icon-left', 'icon-top' ) ),
								'group'       => esc_html__( 'Text Settings', 'foton-core' )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'text_bottom_padding',
								'heading'     => esc_html__( 'Text Bottom Padding (px)', 'foton-core' ),
								'description' => esc_html__( 'Set bottom padding. Default value is 0.', 'foton-core' ),
								'dependency'  => array( 'element' => 'type', 'value'   => array( 'icon-left', 'icon-top' ) ),
								'group'       => esc_html__( 'Text Settings', 'foton-core' )
							),
                            array(
                                'type'       => 'dropdown',
                                'param_name' => 'regular_shadow',
                                'heading'    => esc_html__( 'Shadow', 'foton-core' ),
                                'value'      => array(
                                    esc_html__( 'No', 'foton-core' ) => '',
                                    esc_html__( 'Yes', 'foton-core' ) => 'show-regular-shadow',
                                ),
                            ),
                            array(
                                'type'       => 'dropdown',
                                'param_name' => 'hover_shadow',
                                'heading'    => esc_html__( 'Hover Shadow', 'foton-core' ),
                                'value'      => array(
                                    esc_html__( 'Yes', 'foton-core' ) => '',
                                    esc_html__( 'No', 'foton-core' ) => 'no-hover-shadow',
                                ),
                            ),
                            array(
                                'type'       => 'dropdown',
                                'param_name' => 'hover_effect',
                                'heading'    => esc_html__( 'Additional Hover Effect', 'foton-core' ),
                                'value'      => array(
                                    esc_html__( 'Yes', 'foton-core' ) => '',
                                    esc_html__( 'No', 'foton-core' ) => 'no-hover-effect',
                                ),
                            ),
                            array(
                                'type'       => 'dropdown',
                                'param_name' => 'border',
                                'heading'    => esc_html__( 'Border', 'foton-core' ),
                                'value'      => array(
                                    esc_html__( 'No', 'foton-core' ) => '',
                                    esc_html__( 'Yes', 'foton-core' ) => 'show-border',
                                ),
                            )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'custom_padding'              => '',
			'custom_class'                => '',
			'type'                        => 'icon-left',
			'custom_icon'                 => '',
			'custom_hover_icon'           => '',
			'icon_type'                   => 'mkdf-normal',
			'icon_size'                   => 'mkdf-icon-medium',
			'custom_icon_size'            => '',
			'shape_size'                  => '',
			'icon_color'                  => '',
			'icon_hover_color'            => '',
			'icon_background_color'       => '',
			'icon_hover_background_color' => '',
			'icon_border_color'           => '',
			'icon_border_hover_color'     => '',
			'icon_border_width'           => '',
			'icon_animation'              => '',
			'icon_animation_delay'        => '',
			'title'                       => '',
			'title_tag'                   => 'h4',
			'title_color'                 => '',
			'title_top_margin'            => '',
			'text'                        => '',
			'text_color'                  => '',
			'text_top_margin'             => '',
            'text_alignment'              => '',
            'show_arrow'                  => '',
            'regular_shadow'              => '',
            'hover_shadow'                => '',
			'hover_effect'                => '',
			'border'                      => '',
			'link'                        => '',
			'target'                      => '_self',
			'text_padding'                => '',
			'text_bottom_padding'         => ''
		);
		$default_atts = array_merge( $default_atts, foton_mikado_icon_collections()->getShortcodeParams() );
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];
		
		$params['icon_parameters'] = $this->getIconParameters( $params );
		$params['inner_holder_classes']  = $this->getInnerHolderClasses( $params );
		$params['content_styles']  = $this->getContentStyles( $params );
		$params['title_styles']    = $this->getTitleStyles( $params );
		$params['padding_styles']  = $this->getPaddingStyles( $params );
		$params['title_tag']       = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['text_styles']     = $this->getTextStyles( $params );
		$params['target']          = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];
		
		return foton_core_get_shortcode_module_template_part( 'templates/iwt', 'icon-with-text', $params['type'], $params );
	}
	
	private function getIconParameters( $params ) {
		$params_array = array();
		
		if ( empty( $params['custom_icon'] ) ) {
			$iconPackName = foton_mikado_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
			
			$params_array['icon_pack']     = $params['icon_pack'];
			$params_array[ $iconPackName ] = $params[ $iconPackName ];
			
			if ( ! empty( $params['icon_size'] ) ) {
				$params_array['size'] = $params['icon_size'];
			}
			
			if ( ! empty( $params['custom_icon_size'] ) ) {
				$params_array['custom_size'] = foton_mikado_filter_px( $params['custom_icon_size'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_type'] ) ) {
				$params_array['type'] = $params['icon_type'];
			}
			
			if ( ! empty( $params['shape_size'] ) ) {
				$params_array['shape_size'] = foton_mikado_filter_px( $params['shape_size'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_border_color'] ) ) {
				$params_array['border_color'] = $params['icon_border_color'];
			}
			
			if ( ! empty( $params['icon_border_hover_color'] ) ) {
				$params_array['hover_border_color'] = $params['icon_border_hover_color'];
			}
			
			if ( $params['icon_border_width'] !== '' ) {
				$params_array['border_width'] = foton_mikado_filter_px( $params['icon_border_width'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_background_color'] ) ) {
				$params_array['background_color'] = $params['icon_background_color'];
			}
			
			if ( ! empty( $params['icon_hover_background_color'] ) ) {
				$params_array['hover_background_color'] = $params['icon_hover_background_color'];
			}
			
			$params_array['icon_color'] = $params['icon_color'];
			
			if ( ! empty( $params['icon_hover_color'] ) ) {
				$params_array['hover_icon_color'] = $params['icon_hover_color'];
			}
			
			$params_array['icon_animation']       = $params['icon_animation'];
			$params_array['icon_animation_delay'] = $params['icon_animation_delay'];
		}
		
		return $params_array;
	}
	
	private function getInnerHolderClasses( $params ) {
		$holderClasses = array( 'mkdf-iwt-inner', 'clearfix' );
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-iwt-' . $params['type'] : '';
		$holderClasses[] = ! empty( $params['icon_size'] ) ? 'mkdf-iwt-' . str_replace( 'mkdf-', '', $params['icon_size'] ) : '';
        $holderClasses[] = ! empty( $params['regular_shadow'] ) ? 'mkdf-iwt-' . $params['regular_shadow'] : '';
        $holderClasses[] = ! empty( $params['hover_shadow'] ) ? 'mkdf-iwt-' . $params['hover_shadow'] : '';
        $holderClasses[] = ! empty( $params['hover_effect'] ) ? 'mkdf-iwt-' . $params['hover_effect'] : '';
        $holderClasses[] = ! empty( $params['border'] ) ? 'mkdf-iwt-' . $params['border'] : '';
        $holderClasses[] = ($params['type'] == 'icon-left-from-title-and-text' && ! empty( $params['show_arrow'] )) ? 'mkdf-iwt-' . $params['show_arrow'] : '';
        $holderClasses[] = ($params['type'] == 'icon-left-from-title-and-text' && ! empty( $params['text_alignment'] )) ? 'mkdf-iwt-align-' . $params['text_alignment'] : '';
		
		return $holderClasses;
	}
	
	private function getContentStyles( $params ) {
		$styles = array();
		
		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-left' ) {
			$styles[] = 'padding-left: ' . foton_mikado_filter_px( $params['text_padding'] ) . 'px';
		}
		
		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-top' ) {
			$styles[] = 'padding-top: ' . foton_mikado_filter_px( $params['text_padding'] ) . 'px';
		}

		if ( $params['text_bottom_padding'] !== '') {
			$styles[] = 'padding-bottom: ' . foton_mikado_filter_px( $params['text_bottom_padding'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( $params['title_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . foton_mikado_filter_px( $params['title_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . foton_mikado_filter_px( $params['text_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}

	private function getPaddingStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['custom_padding'] ) ) {
			$styles[] = 'padding: ' . $params['custom_padding'];
		}

		return implode( ';', $styles );
	}
}