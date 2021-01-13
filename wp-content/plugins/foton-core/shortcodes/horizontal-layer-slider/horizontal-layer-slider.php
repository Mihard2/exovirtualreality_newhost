<?php
namespace FotonCore\CPT\Shortcodes\HorizontalLayerSlider;

use FotonCore\Lib;

class HorizontalLayerSlider implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_horizontal_layer_slider';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/*
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		if (function_exists('vc_map')) {
			vc_map(
				array(
					'name'                      => esc_html__('Horizontal Layer Slider', 'foton-core'),
					'base'                      => $this->base,
					'category'                  => esc_html__('by FOTON', 'foton-core'),
					'icon'                      => 'icon-wpb-horizontal-layer-slider extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'mouse_wheel_control',
							'value'       => array(
								esc_html__('No', 'foton-core')  => 'no',
								esc_html__('Yes', 'foton-core') => 'yes',
							),
							'save_always' => true,
							'heading'     => esc_html__('Mouse Wheel Control', 'foton-core'),
							'description' => esc_html__('', 'foton-core')
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'height',
                            'heading'     => esc_html__('Slider Height (px)', 'foton-core'),
                        ),
						array(
							'type'       => 'param_group',
							'heading'    => esc_html__('Horizontal Layer Slider Items', 'foton-core'),
							'param_name' => 'horizontal_layer_slider_items',
							'value'      => '',
							'params'     => array(
								array(
									'type'        => 'attach_image',
									'param_name'  => 'background_image',
									'heading'     => esc_html__('Background Image', 'foton-core'),
									'description' => esc_html__('Select image from media library', 'foton-core')
								),
								array(
									'type'        => 'attach_image',
									'param_name'  => 'parallax_image',
									'heading'     => esc_html__('Parallax Image', 'foton-core'),
									'description' => esc_html__('Select image from media library', 'foton-core')
								),
								array(
									'type'        => 'textfield',
									'param_name'  => 'link',
									'heading'     => esc_html__('Link', 'foton-core'),
								),
							    array(
								    'type'        => 'dropdown',
								    'param_name'  => 'target',
								    'heading'     => esc_html__( 'Link Target', 'foton-core' ),
								    'value'       => array_flip( foton_mikado_get_link_target_array() ),
								    'save_always' => true,
							    	'dependency' => array( 'element' => 'link', 'not_empty' => true)
							    )
							)
						)
					)
				)
			);
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'mouse_wheel_control'      => '',
			'horizontal_layer_slider_items' => '',
            'height' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['content'] = $content;

		$params['horizontal_layers'] = vc_param_group_parse_atts($atts['horizontal_layer_slider_items']);
		$params['data_params'] = $this->getDataParams($params);
		$params['slider_styles'] = $this->getSliderStyles($params);

		//Get HTML from template
		$html = foton_core_get_shortcode_module_template_part('templates/horizontal-layer-slider', 'horizontal-layer-slider', '', $params);

		return $html;
	}

	/**
	 * Return Horizontal Layer Slider data params
	 *
	 * @param $params
	 * @return array
	 */
	private function getDataParams($params) {
		$data = array();

		$data['data-mouse-wheel-control'] = $params['mouse_wheel_control'];

		return $data;
	}

    private function getSliderStyles($params) {
        $styles = array();

        if ( ! empty( $params['height'] ) ) {
            $styles[] = 'max-height: ' . foton_mikado_filter_px($params['height']) . 'px';
        }

        return implode( ';', $styles );
    }
}