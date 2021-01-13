<?php

if (!function_exists('foton_mikado_register_footer_sidebar')) {
    function foton_mikado_register_footer_sidebar() {

        $show_footer_top = foton_mikado_options()->getOptionValue('show_footer_top') !== 'yes' ? false : true;
        $show_footer_bottom = foton_mikado_options()->getOptionValue('show_footer_bottom') !== 'yes' ? false : true;

        if ($show_footer_top) {

            register_sidebar(
                array(
                    'id'            => 'footer_top_column_1',
                    'name'          => esc_html__('Footer Top Column 1', 'foton'),
                    'description'   => esc_html__('Widgets added here will appear in the first column of top footer area', 'foton'),
                    'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-1 %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                    'after_title'   => '</h5></div>'
                )
            );

            register_sidebar(
                array(
                    'id'            => 'footer_top_column_2',
                    'name'          => esc_html__('Footer Top Column 2', 'foton'),
                    'description'   => esc_html__('Widgets added here will appear in the second column of top footer area', 'foton'),
                    'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-2 %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                    'after_title'   => '</h5></div>'
                )
            );

            register_sidebar(
                array(
                    'id'            => 'footer_top_column_3',
                    'name'          => esc_html__('Footer Top Column 3', 'foton'),
                    'description'   => esc_html__('Widgets added here will appear in the third column of top footer area', 'foton'),
                    'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-3 %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                    'after_title'   => '</h5></div>'
                )
            );

            register_sidebar(
                array(
                    'id'            => 'footer_top_column_4',
                    'name'          => esc_html__('Footer Top Column 4', 'foton'),
                    'description'   => esc_html__('Widgets added here will appear in the fourth column of top footer area', 'foton'),
                    'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-4 %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                    'after_title'   => '</h5></div>'
                )
            );
        }

        if ($show_footer_bottom) {

            register_sidebar(
                array(
                    'id'            => 'footer_bottom_column_1',
                    'name'          => esc_html__('Footer Bottom Column 1', 'foton'),
                    'description'   => esc_html__('Widgets added here will appear in the first column of bottom footer area', 'foton'),
                    'before_widget' => '<div id="%1$s" class="widget mkdf-footer-bottom-column-1 %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                    'after_title'   => '</h5></div>'
                )
            );

            register_sidebar(
                array(
                    'id'            => 'footer_bottom_column_2',
                    'name'          => esc_html__('Footer Bottom Column 2', 'foton'),
                    'description'   => esc_html__('Widgets added here will appear in the second column of bottom footer area', 'foton'),
                    'before_widget' => '<div id="%1$s" class="widget mkdf-footer-bottom-column-2 %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                    'after_title'   => '</h5></div>'
                )
            );

            register_sidebar(
                array(
                    'id'            => 'footer_bottom_column_3',
                    'name'          => esc_html__('Footer Bottom Column 3', 'foton'),
                    'description'   => esc_html__('Widgets added here will appear in the third column of bottom footer area', 'foton'),
                    'before_widget' => '<div id="%1$s" class="widget mkdf-footer-bottom-column-3 %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                    'after_title'   => '</h5></div>'
                )
            );
        }
    }

    add_action('widgets_init', 'foton_mikado_register_footer_sidebar');
}

if (!function_exists('foton_mikado_get_footer')) {
    /**
     * Loads footer HTML
     */
    function foton_mikado_get_footer() {
        $parameters = array();
        $holder_classes[] = 'mkdf-page-footer';
        $page_id = foton_mikado_get_page_id();
        $disable_footer_meta = get_post_meta($page_id, 'mkdf_disable_footer_meta', true);
        $uncovering_footer_meta = foton_mikado_get_meta_field_intersect('uncovering_footer', $page_id);
        $holder_classes[] = $uncovering_footer_meta === 'yes' ? 'mkdf-footer-uncover' : '';
        $footer_skin_meta = foton_mikado_get_meta_field_intersect('footer_skin', $page_id);
        if($footer_skin_meta !== '') {
            $holder_classes[] = 'mkdf-footer-skin-' . $footer_skin_meta;
        }

        $parameters['display_footer'] = $disable_footer_meta === 'yes' ? false : true;
        $parameters['display_footer_top'] = foton_mikado_show_footer_top();
        $parameters['display_footer_bottom'] = foton_mikado_show_footer_bottom();
        $parameters['holder_classes'] = $holder_classes;

        foton_mikado_get_module_template_part('templates/footer', 'footer', '', $parameters);
    }

    add_action('foton_mikado_get_footer_template', 'foton_mikado_get_footer');
}

if (!function_exists('foton_mikado_show_footer_top')) {
    /**
     * Check footer top showing
     * Function check value from options and checks if footer columns are empty.
     * return bool
     */
    function foton_mikado_show_footer_top() {
        $footer_top_flag = false;

        //check value from options and meta field on current page
        $option_flag = (foton_mikado_get_meta_field_intersect('show_footer_top') === 'yes') ? true : false;

        //check footer columns.If they are empty, disable footer top
        $columns_flag = false;
        for ($i = 1; $i <= 4; $i++) {
            $footer_columns_id = 'footer_top_column_' . $i;
            if (is_active_sidebar($footer_columns_id)) {
                $columns_flag = true;
                break;
            }
        }

        if ($option_flag && $columns_flag) {
            $footer_top_flag = true;
        }

        return $footer_top_flag;
    }
}

if (!function_exists('foton_mikado_show_footer_bottom')) {
    /**
     * Check footer bottom showing
     * Function check value from options and checks if footer columns are empty.
     * return bool
     */
    function foton_mikado_show_footer_bottom() {
        $footer_bottom_flag = false;

        //check value from options and meta field on current page
        $option_flag = (foton_mikado_get_meta_field_intersect('show_footer_bottom') === 'yes') ? true : false;

        //check footer columns.If they are empty, disable footer bottom
        $columns_flag = false;
        for ($i = 1; $i <= 3; $i++) {
            $footer_columns_id = 'footer_bottom_column_' . $i;
            if (is_active_sidebar($footer_columns_id)) {
                $columns_flag = true;
                break;
            }
        }

        if ($option_flag && $columns_flag) {
            $footer_bottom_flag = true;
        }

        return $footer_bottom_flag;
    }
}

if (!function_exists('foton_mikado_get_footer_top')) {
    /**
     * Return footer top HTML
     */
    function foton_mikado_get_footer_top() {
        $parameters = array();

        //get number of top footer columns
        $parameters['footer_top_columns'] = explode(' ', foton_mikado_options()->getOptionValue('footer_top_columns'));

        //get footer top grid/full width class
        $parameters['footer_top_grid_class'] = foton_mikado_get_meta_field_intersect('footer_in_grid') === 'yes' ? 'mkdf-grid' : 'mkdf-full-width';

        //get footer top other classes
        $footer_top_classes = array();

        //footer alignment
        $footer_top_alignment = foton_mikado_options()->getOptionValue('footer_top_columns_alignment');
        $footer_top_classes[] = !empty($footer_top_alignment) ? 'mkdf-footer-top-alignment-' . esc_attr($footer_top_alignment) : '';

        $footer_top_classes = apply_filters('foton_mikado_filter_footer_top_classes', $footer_top_classes);

        $parameters['footer_top_classes'] = implode(' ', $footer_top_classes);

        foton_mikado_get_module_template_part('templates/parts/footer-top', 'footer', '', $parameters);
    }
}

if (!function_exists('foton_mikado_get_footer_bottom')) {
    /**
     * Return footer bottom HTML
     */
    function foton_mikado_get_footer_bottom() {
        $parameters = array();

        //get number of bottom footer columns
        $parameters['footer_bottom_columns'] = explode(' ', foton_mikado_options()->getOptionValue('footer_bottom_columns'));

        //get footer top grid/full width class
        $parameters['footer_bottom_grid_class'] = foton_mikado_get_meta_field_intersect('footer_in_grid') === 'yes' ? 'mkdf-grid' : 'mkdf-full-width';

        //get footer top other classes
        $footer_bottom_classes = array();
        $footer_bottom_classes = apply_filters('foton_mikado_filter_footer_bottom_classes', $footer_bottom_classes);

        $parameters['footer_bottom_classes'] = implode(' ', $footer_bottom_classes);

        foton_mikado_get_module_template_part('templates/parts/footer-bottom', 'footer', '', $parameters);
    }
}

if (!function_exists('foton_mikado_footer_holder_style')) {
    /**
     * Function that return container style
     */
    function foton_mikado_footer_holder_style($style) {
        $current_style = '';
        $page_id = foton_mikado_get_page_id();
        $class_prefix = foton_mikado_get_unique_page_class($page_id, true);

        /***** footer top style - begin *****/

        $footer_top_selector = $class_prefix . ' .mkdf-footer-top-holder';
        $footer_top_background_color = get_post_meta($page_id, 'mkdf_footer_top_background_color_meta', true);

        if (!empty($footer_top_background_color)) {
            $current_style .= foton_mikado_dynamic_css($footer_top_selector, array('background-color' => $footer_top_background_color));
        }

        /***** footer top style - end *****/

        /***** footer bottom style - begin *****/

        $footer_bottom_selector = $class_prefix . ' .mkdf-footer-bottom-holder';
        $footer_bottom_background_color = get_post_meta($page_id, 'mkdf_footer_bottom_background_color_meta', true);

        if (!empty($footer_bottom_background_color)) {
            $current_style .= foton_mikado_dynamic_css($footer_bottom_selector, array('background-color' => $footer_bottom_background_color));
        }

        /***** footer bottom style - end *****/

        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter('foton_mikado_filter_add_page_custom_style', 'foton_mikado_footer_holder_style');
}