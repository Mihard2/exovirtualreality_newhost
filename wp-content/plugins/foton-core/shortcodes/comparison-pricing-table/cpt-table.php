<?php

namespace FotonCore\CPT\Shortcodes\ComparisonPricingTable;

use FotonCore\Lib;

class ComparisonPricingItem implements Lib\ShortcodeInterface
{
    private $base;

    /**
     * ComparisonPricingTable constructor.
     */
    public function __construct() {
        $this->base = 'mkdf_comparison_pricing_item';

        add_action('vc_before_init', array($this, 'vcMap'));
    }


    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Comparison Pricing Item', 'foton-core'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-cmp-pricing-item extended-custom-icon',
            'category'                  => 'by FOTON',
            'allowed_container_element' => 'vc_row',
            'as_child'                  => array('only' => 'mkd_comparison_pricing_table_holder'),
            'params'                    => array_merge(
                foton_mikado_icon_collections()->getVCParamsArray(),
                array(
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'icon_size',
                        'heading'    => esc_html__('Icon Size (px)', 'foton-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'icon_color',
                        'heading'    => esc_html__('Icon Color', 'foton-core')
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => esc_html__('Title', 'foton-core'),
                        'param_name'  => 'title',
                        'value'       => esc_html__('Basic Plan', 'foton-core'),
                        'description' => ''
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Show Button', 'foton-core'),
                        'param_name'  => 'show_button',
                        'value'       => array(
                            esc_html__('Yes', 'foton-core') => 'yes',
                            esc_html__('No', 'foton-core')  => 'no'
                        ),
                        'description' => '',
                        'save_always' => true,
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => esc_html__('Button Text', 'foton-core'),
                        'param_name'  => 'button_text',
                        'dependency'  => array(
                            'element' => 'show_button',
                            'value'   => 'yes'
                        )
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Button Link', 'foton-core'),
                        'param_name'  => 'button_link',
                        'dependency'  => array(
                            'element' => 'show_button',
                            'value'   => 'yes'
                        )
                    ),
                    array(
                        'type'        => 'textarea_html',
                        'heading'     => esc_html__('Content', 'foton-core'),
                        'param_name'  => 'content',
                        'value'       => '<li>' . esc_html__('content content content', 'foton-core') . '</li><li>' . esc_html__('content content content', 'foton-core') . '</li><li>' . esc_html__('content content content', 'foton-core') . '</li>',
                        'description' => '',
                        'admin_label' => false
                    ),
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'icon_size'        => '',
            'icon_color'       => '',
            'title'            => esc_html__('Basic', 'foton-core'),
            'show_button'      => 'yes',
            'button_link'      => '',
            'button_text'      => 'button',
        );

        $args   = array_merge( $args, foton_mikado_icon_collections()->getShortcodeParams() );
        $params = shortcode_atts($args, $atts);

        $iconPackName = foton_mikado_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );

        $params['content'] = $content;
        $params['icon']                     = $params[ $iconPackName ];
        $params['icon_attributes']['style'] = $this->getIconStyles( $params );
        $params['table_classes'] = $this->getTableClasses($params);
        $params['button_parameters'] = $this->getButtonParameters($params);

        return foton_core_get_shortcode_module_template_part('templates/cpt-item-template', 'comparison-pricing-table', '', $params);
    }

    private function getTableClasses($params) {
        $classes = array('mkdf-comparision-item-holder', 'mkdf-cpt-table');

        return $classes;
    }

    private function getIconStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['icon_color'] ) ) {
            $styles[] = 'color: ' . $params['icon_color'];
        }

        if ( ! empty( $params['icon_size'] ) ) {
            $styles[] = 'font-size: ' . foton_mikado_filter_px( $params['icon_size'] ) . 'px';
        }

        return implode( ';', $styles );
    }

    private function getButtonParameters($params) {
        $button_params_array = array();

        if (!empty($params['button_text'])) {
            $button_params_array['text'] = $params['button_text'];
        }

        if (!empty($params['button_link'])) {
            $button_params_array['link'] = $params['button_link'];
        }

        $button_params_array['size'] = 'medium';

        $button_params_array['type'] = 'simple';

        return $button_params_array;
    }
}