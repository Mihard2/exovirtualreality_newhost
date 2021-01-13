<?php

namespace FotonCore\CPT\Shortcodes\TripleFrameImageHighlight;

use FotonCore\Lib;

class TripleFrameImageHighlight implements Lib\ShortcodeInterface
{
    private $base;

    function __construct() {
        $this->base = 'mkdf_triple_frame_image_highlight';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(array(
                'name'     => esc_html__('Triple Frame Image Highlight', 'foton-core'),
                'base'     => $this->base,
                'category' => esc_html__('by FOTON', 'foton-core'),
                'icon'     => 'icon-wpb-triple-frame-image-highlight extended-custom-icon',
                'params'   => array(
                    array(
                        'type'       => 'attach_image',
                        'param_name' => 'centered_image',
                        'heading'    => esc_html__('Centered Image', 'foton-core')
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'centered_image_link',
                        'heading'    => esc_html__('Centered Image Link', 'foton-core')
                    ),
                    array(
                        'type'       => 'attach_image',
                        'param_name' => 'left_image',
                        'heading'    => esc_html__('Left Image', 'foton-core')
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'left_image_link',
                        'heading'    => esc_html__('Left Image Link', 'foton-core')
                    ),
                    array(
                        'type'       => 'attach_image',
                        'param_name' => 'right_image',
                        'heading'    => esc_html__('Right Image', 'foton-core')
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'right_image_link',
                        'heading'    => esc_html__('Right Image Link', 'foton-core')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'enable_navigation',
                        'heading'     => esc_html__( 'Enable Navigation', 'foton-core' ),
                        'value'       => array_flip( foton_mikado_get_yes_no_select_array( false ) ),
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'link_target',
                        'heading'     => esc_html__( 'Link Target', 'foton-core' ),
                        'value'       => array_flip( foton_mikado_get_link_target_array() ),
                        'save_always' => true
                    )
                )
            ));
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'centered_image'    => '',
            'centered_image_link'     => '',
            'left_image'    => '',
            'left_image_link'   => '',
            'right_image'   => '',
            'right_image_link'  => '',
            'link_target'    => '',
            'enable_navigation' => 'no',
        );
        $params = shortcode_atts($args, $atts);

        $params['holder_classes'] = $this->getHolderClasses( $params );

        $html = foton_core_get_shortcode_module_template_part('templates/triple-frame-image-highlight-template', 'triple-frame-image-highlight', '', $params);

        return $html;
    }

    private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = !empty($params['layout']) ? 'mkdf-tfih-'.$params['layout'] : '';
		$holderClasses[] = ($params['enable_navigation'] == 'yes') ? 'mkdf-tfih-with-nav' : '';
		
		return implode( ' ', $holderClasses );
    }

	
}