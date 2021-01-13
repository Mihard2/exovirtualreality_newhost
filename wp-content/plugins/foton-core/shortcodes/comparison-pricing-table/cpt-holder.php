<?php

namespace FotonCore\CPT\Shortcodes\ComparisonPricingTable;

use FotonCore\Lib;

class ComparisonPricingTableHolder implements Lib\ShortcodeInterface
{
    private $base;

    /**
     * ComparisonPricingTablesHolder constructor.
     */
    public function __construct() {
        $this->base = 'mkdf_comparison_pricing_table_holder';

        add_action('vc_before_init', array($this, 'vcMap'));
    }


    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => esc_html__('Comparison Pricing Table', 'foton-core'),
            'base'                    => $this->base,
            'as_parent'               => array('only' => 'mkdf_comparison_pricing_item'),
            'content_element'         => true,
            'category'                => 'by FOTON',
            'icon'                    => 'icon-wpb-comparison-pricing-table extended-custom-icon',
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Columns', 'foton-core'),
                    'param_name'  => 'columns',
                    'value'       => array(
                        esc_html__('Two', 'foton-core')   => 'mkdf-two-columns',
                        esc_html__('Three', 'foton-core') => 'mkdf-three-columns',
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__('Title', 'foton-core'),
                    'param_name'  => 'title',
                    'value'       => '',
                    'save_always' => true
                ),
                array(
                    'type'        => 'exploded_textarea',
                    'heading'     => esc_html__('Features', 'foton-core'),
                    'param_name'  => 'features',
                    'value'       => '',
                    'save_always' => true,
                    'description' => esc_html__('Enter features. Separate each features with new line (enter).', 'foton-core')
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Show Footer', 'foton-core'),
                    'param_name'  => 'show_footer',
                    'value'       => array(
                        esc_html__('Yes', 'foton-core') => 'yes',
                        esc_html__('No', 'foton-core')  => 'no'
                    ),
                    'description' => '',
                    'save_always' => true,
                ),
                array(
                    'type'        => 'attach_image',
                    'param_name'  => 'footer_image',
                    'heading'     => esc_html__('Footer Image', 'foton-core'),
                    'description' => esc_html__('Select image from media library', 'foton-core'),
                    'dependency'  => array(
                        'element' => 'show_footer',
                        'value'   => 'yes'
                    )
                ),
                array(
                    'type'       => 'textfield',
                    'param_name' => 'footer_text',
                    'heading'    => esc_html__('Footer Text', 'foton-core'),
                    'dependency' => array(
                        'element' => 'show_footer',
                        'value'   => 'yes'
                    )
                ),
            ),
            'js_view'                 => 'VcColumnView'
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'columns'      => 'mkdf-three-columns',
            'features'     => '',
            'title'        => '',
            'show_footer'  => 'yes',
            'footer_image' => '',
            'footer_text'  => '',
        );

        $params = shortcode_atts($args, $atts);

        $params['features'] = $this->getFeaturesArray($params);
        $params['content'] = $content;
        $params['holder_classes'] = $this->getHolderClasses($params);

        return foton_core_get_shortcode_module_template_part('templates/cpt-holder-template', 'comparison-pricing-table', '', $params);
    }

    private function getFeaturesArray($params) {
        $features = array();

        if (!empty($params['features'])) {
            $features = explode(',', $params['features']);
        }

        return $features;
    }

    private function getHolderClasses($params) {
        $classes = array('mkdf-comparision-pricing-table-holder');

        if ($params['columns'] !== '') {
            $classes[] = $params['columns'];
        }

        return $classes;
    }
}