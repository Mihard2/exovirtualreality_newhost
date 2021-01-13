<?php

if ( class_exists( 'FotonCoreClassWidget' ) ) {
    class FotonMikadoClassSeparatorWidget extends FotonCoreClassWidget {
        public function __construct() {
            parent::__construct(
                'mkdf_separator_widget',
                esc_html__( 'Foton Separator Widget', 'foton' ),
                array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'foton' ) )
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
                        'normal'     => esc_html__( 'Normal', 'foton' ),
                        'full-width' => esc_html__( 'Full Width', 'foton' )
                    )
                ),
                array(
                    'type'    => 'dropdown',
                    'name'    => 'position',
                    'title'   => esc_html__( 'Position', 'foton' ),
                    'options' => array(
                        'center' => esc_html__( 'Center', 'foton' ),
                        'left'   => esc_html__( 'Left', 'foton' ),
                        'right'  => esc_html__( 'Right', 'foton' )
                    )
                ),
                array(
                    'type'    => 'dropdown',
                    'name'    => 'border_style',
                    'title'   => esc_html__( 'Style', 'foton' ),
                    'options' => array(
                        'solid'  => esc_html__( 'Solid', 'foton' ),
                        'dashed' => esc_html__( 'Dashed', 'foton' ),
                        'dotted' => esc_html__( 'Dotted', 'foton' )
                    )
                ),
                array(
                    'type'  => 'colorpicker',
                    'name'  => 'color',
                    'title' => esc_html__( 'Color', 'foton' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'width',
                    'title' => esc_html__( 'Width (px or %)', 'foton' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'thickness',
                    'title' => esc_html__( 'Thickness (px)', 'foton' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'top_margin',
                    'title' => esc_html__( 'Top Margin (px or %)', 'foton' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'bottom_margin',
                    'title' => esc_html__( 'Bottom Margin (px or %)', 'foton' )
                )
            );
        }

        public function widget( $args, $instance ) {
            if ( ! is_array( $instance ) ) {
                $instance = array();
            }

            //prepare variables
            $params = '';

            //is instance empty?
            if ( is_array( $instance ) && count( $instance ) ) {
                //generate shortcode params
                foreach ( $instance as $key => $value ) {
                    $params .= " $key='$value' ";
                }
            }

            echo '<div class="widget mkdf-separator-widget">';
            echo do_shortcode( "[mkdf_separator $params]" ); // XSS OK
            echo '</div>';
        }
    }
}