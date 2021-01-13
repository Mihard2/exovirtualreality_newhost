<?php

if ( class_exists( 'FotonCoreClassWidget' ) ) {
    class FotonMikadoClassButtonWidget extends FotonCoreClassWidget {
        public function __construct() {
            parent::__construct(
                'mkdf_button_widget',
                esc_html__( 'Foton Button Widget', 'foton' ),
                array( 'description' => esc_html__( 'Add button element to widget areas', 'foton' ) )
            );

            $this->setParams();
        }

        protected function setParams() {
            $this->params = array(
                array(
                    'type'    => 'dropdown',
                    'name'    => 'type',
                    'title'   => esc_html__( 'Type', 'foton' ),
                    'options' => array(
                        'solid'   => esc_html__( 'Solid', 'foton' ),
                        'outline' => esc_html__( 'Outline', 'foton' ),
                        'simple'  => esc_html__( 'Simple', 'foton' )
                    )
                ),
                array(
                    'type'        => 'dropdown',
                    'name'        => 'size',
                    'title'       => esc_html__( 'Size', 'foton' ),
                    'options'     => array(
                        'small'  => esc_html__( 'Small', 'foton' ),
                        'medium' => esc_html__( 'Medium', 'foton' ),
                        'large'  => esc_html__( 'Large', 'foton' ),
                        'huge'   => esc_html__( 'Huge', 'foton' )
                    ),
                    'description' => esc_html__( 'This option is only available for solid and outline button type', 'foton' )
                ),
                array(
                    'type'    => 'textfield',
                    'name'    => 'text',
                    'title'   => esc_html__( 'Text', 'foton' ),
                    'default' => esc_html__( 'Button Text', 'foton' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'link',
                    'title' => esc_html__( 'Link', 'foton' )
                ),
                array(
                    'type'    => 'dropdown',
                    'name'    => 'target',
                    'title'   => esc_html__( 'Link Target', 'foton' ),
                    'options' => foton_mikado_get_link_target_array()
                ),
                array(
                    'type'  => 'colorpicker',
                    'name'  => 'color',
                    'title' => esc_html__( 'Color', 'foton' )
                ),
                array(
                    'type'  => 'colorpicker',
                    'name'  => 'hover_color',
                    'title' => esc_html__( 'Hover Color', 'foton' )
                ),
                array(
                    'type'        => 'colorpicker',
                    'name'        => 'background_color',
                    'title'       => esc_html__( 'Background Color', 'foton' ),
                    'description' => esc_html__( 'This option is only available for solid button type', 'foton' )
                ),
                array(
                    'type'        => 'colorpicker',
                    'name'        => 'hover_background_color',
                    'title'       => esc_html__( 'Hover Background Color', 'foton' ),
                    'description' => esc_html__( 'This option is only available for solid button type', 'foton' )
                ),
                array(
                    'type'        => 'colorpicker',
                    'name'        => 'border_color',
                    'title'       => esc_html__( 'Border Color', 'foton' ),
                    'description' => esc_html__( 'This option is only available for solid and outline button type', 'foton' )
                ),
                array(
                    'type'        => 'colorpicker',
                    'name'        => 'hover_border_color',
                    'title'       => esc_html__( 'Hover Border Color', 'foton' ),
                    'description' => esc_html__( 'This option is only available for solid and outline button type', 'foton' )
                ),
                array(
                    'type'        => 'textfield',
                    'name'        => 'margin',
                    'title'       => esc_html__( 'Margin', 'foton' ),
                    'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'foton' )
                )
            );
        }

        public function widget( $args, $instance ) {
            $params = '';

            if ( ! is_array( $instance ) ) {
                $instance = array();
            }

            // Filter out all empty params
            $instance = array_filter( $instance, function ( $array_value ) {
                return trim( $array_value ) != '';
            } );

            // Default values
            if ( ! isset( $instance['text'] ) ) {
                $instance['text'] = 'Button Text';
            }

            // Generate shortcode params
            foreach ( $instance as $key => $value ) {
                $params .= " $key='$value' ";
            }

            echo '<div class="widget mkdf-button-widget">';
            echo do_shortcode( "[mkdf_button $params]" ); // XSS OK
            echo '</div>';
        }
    }
}