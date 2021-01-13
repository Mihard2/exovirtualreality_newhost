<?php

if (!function_exists('foton_mikado_map_footer_meta')) {
    function foton_mikado_map_footer_meta() {

        $footer_meta_box = foton_mikado_create_meta_box(
            array(
                'scope' => apply_filters('foton_mikado_filter_set_scope_for_meta_boxes', array('page', 'post'), 'footer_meta'),
                'title' => esc_html__('Footer', 'foton'),
                'name'  => 'footer_meta'
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'          => 'mkdf_disable_footer_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Disable Footer for this Page', 'foton'),
                'description'   => esc_html__('Enabling this option will hide footer on this page', 'foton'),
                'options'       => foton_mikado_get_yes_no_select_array(),
                'parent'        => $footer_meta_box
            )
        );

        $show_footer_meta_container = foton_mikado_add_admin_container(
            array(
                'name'       => 'mkdf_show_footer_meta_container',
                'parent'     => $footer_meta_box,
                'dependency' => array(
                    'hide' => array(
                        'mkdf_disable_footer_meta' => 'yes'
                    )
                )
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'          => 'mkdf_footer_in_grid_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Footer in Grid', 'foton'),
                'description'   => esc_html__('Enabling this option will place Footer content in grid', 'foton'),
                'options'       => foton_mikado_get_yes_no_select_array(),
                'parent'        => $show_footer_meta_container
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'          => 'mkdf_uncovering_footer_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Uncovering Footer', 'foton'),
                'description'   => esc_html__('Enabling this option will make Footer gradually appear on scroll', 'foton'),
                'options'       => foton_mikado_get_yes_no_select_array(),
                'parent'        => $show_footer_meta_container
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'mkdf_footer_skin_meta',
                'default_value' => '',
                'label'         => esc_html__('Footer Skin', 'foton'),
                'options'       => array(
                    ''      => esc_html__('Default', 'foton'),
                    'light' => esc_html__('Light', 'foton'),
                    'dark'  => esc_html__('Dark', 'foton'),
                ),
                'parent'        => $show_footer_meta_container,
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'          => 'mkdf_show_footer_top_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Show Footer Top', 'foton'),
                'description'   => esc_html__('Enabling this option will show Footer Top area', 'foton'),
                'options'       => foton_mikado_get_yes_no_select_array(),
                'parent'        => $show_footer_meta_container
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_footer_top_background_color_meta',
                'type'        => 'color',
                'label'       => esc_html__('Footer Top Background Color', 'foton'),
                'description' => esc_html__('Set background color for top footer area', 'foton'),
                'parent'      => $show_footer_meta_container,
                'dependency'  => array(
                    'show' => array(
                        'mkdf_show_footer_top_meta' => array('', 'yes')
                    )
                )
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'          => 'mkdf_show_footer_bottom_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Show Footer Bottom', 'foton'),
                'description'   => esc_html__('Enabling this option will show Footer Bottom area', 'foton'),
                'options'       => foton_mikado_get_yes_no_select_array(),
                'parent'        => $show_footer_meta_container
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_footer_bottom_background_color_meta',
                'type'        => 'color',
                'label'       => esc_html__('Footer Bottom Background Color', 'foton'),
                'description' => esc_html__('Set background color for bottom footer area', 'foton'),
                'parent'      => $show_footer_meta_container,
                'dependency'  => array(
                    'show' => array(
                        'mkdf_show_footer_bottom_meta' => array('', 'yes')
                    )
                )
            )
        );
    }

    add_action('foton_mikado_action_meta_boxes_map', 'foton_mikado_map_footer_meta', 70);
}