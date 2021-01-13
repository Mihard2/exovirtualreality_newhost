<?php

namespace FotonCore\CPT\Shortcodes\FloatingImages;

use FotonCore\Lib;

class FloatingImages implements Lib\ShortcodeInterface
{
    private $base;

    function __construct()
    {
        $this->base = 'mkdf_floating_images';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase()
    {
        return $this->base;
    }

    public function vcMap()
    {
        if (function_exists('vc_map')) {
            vc_map(array(
                'name' => esc_html__('Floating Images', 'foton-core'),
                'base' => $this->base,
                'category' => esc_html__('by FOTON', 'foton-core'),
                'icon' => 'icon-wpb-floating-images extended-custom-icon',
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'main_image',
                        'heading' => esc_html__('Main Image', 'foton-core')
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'main_image_shadow',
                        'dependency' => array('item' => 'main_image', 'not_empty' => true),
                        'heading' => esc_html__('Main Image Shadow', 'foton-core')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'main_image_width',
                        'heading' => esc_html__('Main Image Width', 'foton-core'),
                        'dependency' => array('item' => 'main_image', 'not_empty' => true),
                        'description' => esc_html__('Main Image width in relation to shortcode holder width(%).', 'foton-core')
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'aux_image',
                        'heading' => esc_html__('Aux Image', 'foton-core')
                    ),
                    array(
                        'type' => 'colorpicker',
                        'param_name' => 'aux_image_shadow',
                        'dependency' => array('item' => 'aux_image', 'not_empty' => true),
                        'heading' => esc_html__('Aux Image Shadow', 'foton-core')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'aux_image_width',
                        'heading' => esc_html__('Aux Image Width', 'foton-core'),
                        'dependency' => array('item' => 'aux_image', 'not_empty' => true),
                        'description' => esc_html__('Aux Image width in relation to shortcode holder width(%).', 'foton-core')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'aux_image_x_offset',
                        'heading' => esc_html__('Aux Image X Offset', 'foton-core'),
                        'dependency' => array('item' => 'aux_image', 'not_empty' => true),
                        'description' => esc_html__('Horizontal Offset based on Main Image width(%).', 'foton-core')
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'aux_image_y_offset',
                        'heading' => esc_html__('Aux Image Y Offset', 'foton-core'),
                        'dependency' => array('item' => 'aux_image', 'not_empty' => true),
                        'description' => esc_html__('Vertical Offset based on Main Image height(%).', 'foton-core')
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'image_overlay',
                        'heading' => esc_html__('Image Overlay', 'foton-core')
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'alignment',
                        'heading' => esc_html__('Alignment', 'foton-core'),
                        'value' => array(
                            esc_html__('Left-Aligned', 'foton-core') => 'left-aligned',
                            esc_html__('Centered', 'foton-core') => 'centered',
                            esc_html__('Right-Aligned', 'foton-core') => 'right-aligned',
                        ),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'enable_parallax_animation',
                        'heading' => esc_html__('Enable Parallax Animation', 'foton-core'),
                        'value' => array_flip(foton_mikado_get_yes_no_select_array(false, true)),
                        'admin_label' => true
                    ),
                )
            ));
        }
    }

    public function render($atts, $content = null)
    {
        $args = array(
            'main_image' => '',
            'main_image_width' => '',
            'main_image_shadow' => '',
            'aux_image' => '',
            'aux_image_shadow' => '',
            'aux_image_width' => '',
            'aux_image_x_offset' => '',
            'aux_image_y_offset' => '',
            'image_overlay' => '',
            'alignment' => 'left-aligned',
            'enable_parallax_animation' => 'yes'
        );
        $params = shortcode_atts($args, $atts);

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['main_image_styles'] = $this->getMainImageStyles($params);
        $params['aux_image_styles'] = $this->getAuxImageStyles($params);
        $params['main_image_position_data'] = $this->getMainImagePositionData($params);
        $params['aux_image_position_data'] = $this->getAuxImagePositionData($params);
        $params['main_image_parallax_data'] = $this->getMainParallaxData($params);
        $params['aux_image_parallax_data'] = $this->getAuxParallaxData($params);
        $params['overlay_image_parallax_data'] = $this->getOverlayParallaxData($params);

        $html = foton_core_get_shortcode_module_template_part('templates/floating-images-template', 'floating-images', '', $params);

        return $html;
    }

    private function getHolderClasses($params)
    {
        $holderClasses = array();

        $holderClasses[] = !empty($params['alignment']) ? 'mkdf-fi-' . $params['alignment'] : '';
        $holderClasses[] = ($params['enable_parallax_animation'] == 'yes') ? 'mkdf-fi-parallax' : '';

        return implode(' ', $holderClasses);
    }

    private function getMainImageStyles($params)
    {
        $styles = array();

        if (!empty($params['main_image_shadow'])) {
            if (!empty($params['aux_image_x_offset'])) {
                if (foton_mikado_filter_percentage($params['aux_image_x_offset']) > 0) {
                    $styles[] = 'box-shadow: -10px 10px 35px 5px ' . $params['main_image_shadow'];
                } else {
                    $styles[] = 'box-shadow: 10px 10px 35px 5px ' . $params['main_image_shadow'];
                }
            } else {
                $styles[] = 'box-shadow: 0 10px 35px 5px ' . $params['main_image_shadow'];
            }
        }

        return implode(';', $styles);
    }

    private function getAuxImageStyles($params)
    {
        $styles = array();

        if (!empty($params['aux_image_shadow'])) {
            $styles[] = 'box-shadow: 0 10px 35px 5px ' . $params['aux_image_shadow'];
        }

        return implode(';', $styles);
    }

    private function getMainImagePositionData($params)
    {
        $data = array();

        if (!empty($params['main_image_width'])) {
            $data['data-width'] = foton_mikado_filter_percentage($params['main_image_width']) . '%';
        }

        return $data;
    }

    private function getAuxImagePositionData($params)
    {
        $data = array();

        if (!empty($params['aux_image_x_offset'])) {
            $data['data-x'] = foton_mikado_filter_percentage($params['aux_image_x_offset']) . '%';
        }

        if (!empty($params['aux_image_y_offset'])) {
            $data['data-y'] = foton_mikado_filter_percentage($params['aux_image_y_offset']) . '%';
        }

        if (!empty($params['aux_image_width'])) {
            $data['data-width'] = foton_mikado_filter_percentage($params['aux_image_width']) . '%';
        }

        return $data;
    }

    private function getMainParallaxData($params)
    {
        $data = array();

        if ($params['enable_parallax_animation'] === 'yes') {
            $y_absolute = rand(-60, -100);
            $smoothness = 20; //1 is for linear, non-animated parallax

            $data['data-parallax'] = '{&quot;y&quot;: ' . $y_absolute . ', &quot;smoothness&quot;: ' . $smoothness . '}';
        }

        return $data;
    }

    private function getAuxParallaxData($params)
    {
        $data = array();

        if ($params['enable_parallax_animation'] === 'yes') {
            $y_absolute = rand(-20, -60);
            $smoothness = 20; //1 is for linear, non-animated parallax

            $data['data-parallax'] = '{&quot;y&quot;: ' . $y_absolute . ', &quot;smoothness&quot;: ' . $smoothness . '}';
        }

        return $data;
    }

    private function getOverlayParallaxData($params)
    {
        $data = array();

        if ($params['enable_parallax_animation'] === 'yes') {
            $y_absolute = rand(-30, -40);
            $smoothness = 20; //1 is for linear, non-animated parallax

            $data['data-parallax'] = '{&quot;y&quot;: ' . $y_absolute . ', &quot;smoothness&quot;: ' . $smoothness . '}';
        }

        return $data;
    }

}