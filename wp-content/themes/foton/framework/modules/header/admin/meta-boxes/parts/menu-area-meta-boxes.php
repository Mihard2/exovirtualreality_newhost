<?php

if (!function_exists('foton_mikado_get_hide_dep_for_header_menu_area_meta_boxes')) {
    function foton_mikado_get_hide_dep_for_header_menu_area_meta_boxes() {
        $hide_dep_options = apply_filters('foton_mikado_filter_header_menu_area_hide_meta_boxes', $hide_dep_options = array());

        return $hide_dep_options;
    }
}

if (!function_exists('foton_mikado_get_hide_dep_for_header_menu_area_widgets_meta_boxes')) {
    function foton_mikado_get_hide_dep_for_header_menu_area_widgets_meta_boxes() {
        $hide_dep_options = apply_filters('foton_mikado_filter_header_menu_area_widgets_hide_meta_boxes', $hide_dep_options = array());

        return $hide_dep_options;
    }
}

if (!function_exists('foton_mikado_header_menu_area_meta_options_map')) {
    function foton_mikado_header_menu_area_meta_options_map($header_meta_box) {
        $hide_dep_options = foton_mikado_get_hide_dep_for_header_menu_area_meta_boxes();
        $hide_dep_widgets = foton_mikado_get_hide_dep_for_header_menu_area_widgets_meta_boxes();

        $menu_area_container = foton_mikado_add_admin_container_no_style(
            array(
                'type'       => 'container',
                'name'       => 'menu_area_container',
                'parent'     => $header_meta_box,
                'dependency' => array(
                    'hide' => array(
                        'mkdf_header_type_meta' => $hide_dep_options
                    )
                ),
                'args'       => array(
                    'enable_panels_for_default_value' => true
                )
            )
        );

        foton_mikado_add_admin_section_title(
            array(
                'parent' => $menu_area_container,
                'name'   => 'menu_area_style',
                'title'  => esc_html__('Menu Area Style', 'foton')
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'          => 'mkdf_disable_header_widget_menu_area_meta',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Disable Header Menu Area Widget', 'foton'),
                'description'   => esc_html__('Enabling this option will hide widget area from the menu area', 'foton'),
                'parent'        => $menu_area_container,
                'dependency'    => array(
                    'hide' => array(
                        'mkdf_header_type_meta' => $hide_dep_widgets
                    )
                )
            )
        );

        $foton_custom_sidebars = foton_mikado_get_custom_sidebars();
        if (count($foton_custom_sidebars) > 0) {
            foton_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_custom_menu_area_sidebar_meta',
                    'type'        => 'selectblank',
                    'label'       => esc_html__('Choose Custom Widget Area In Menu Area', 'foton'),
                    'description' => esc_html__('Choose custom widget area to display in header menu area', 'foton'),
                    'parent'      => $menu_area_container,
                    'options'     => $foton_custom_sidebars,
                    'dependency'  => array(
                        'hide' => array(
                            'mkdf_header_type_meta' => $hide_dep_widgets
                        )
                    )
                )
            );
        }

        foton_mikado_create_meta_box_field(
            array(
                'name'          => 'mkdf_menu_area_in_grid_meta',
                'type'          => 'select',
                'label'         => esc_html__('Menu Area In Grid', 'foton'),
                'description'   => esc_html__('Set menu area content to be in grid', 'foton'),
                'parent'        => $menu_area_container,
                'default_value' => '',
                'options'       => foton_mikado_get_yes_no_select_array()
            )
        );

        $menu_area_in_grid_container = foton_mikado_add_admin_container(
            array(
                'type'       => 'container',
                'name'       => 'menu_area_in_grid_container',
                'parent'     => $menu_area_container,
                'dependency' => array(
                    'show' => array(
                        'mkdf_menu_area_in_grid_meta' => 'yes'
                    )
                )
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_menu_area_grid_background_color_meta',
                'type'        => 'color',
                'label'       => esc_html__('Grid Background Color', 'foton'),
                'description' => esc_html__('Set grid background color for menu area', 'foton'),
                'parent'      => $menu_area_in_grid_container
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_menu_area_grid_background_transparency_meta',
                'type'        => 'text',
                'label'       => esc_html__('Grid Background Transparency', 'foton'),
                'description' => esc_html__('Set grid background transparency for menu area (0 = fully transparent, 1 = opaque)', 'foton'),
                'parent'      => $menu_area_in_grid_container,
                'args'        => array(
                    'col_width' => 2
                )
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'          => 'mkdf_menu_area_in_grid_shadow_meta',
                'type'          => 'select',
                'label'         => esc_html__('Grid Area Shadow', 'foton'),
                'description'   => esc_html__('Set shadow on grid menu area', 'foton'),
                'parent'        => $menu_area_in_grid_container,
                'default_value' => '',
                'options'       => foton_mikado_get_yes_no_select_array()
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'          => 'mkdf_menu_area_in_grid_border_meta',
                'type'          => 'select',
                'label'         => esc_html__('Grid Area Border', 'foton'),
                'description'   => esc_html__('Set border on grid menu area', 'foton'),
                'parent'        => $menu_area_in_grid_container,
                'default_value' => '',
                'options'       => foton_mikado_get_yes_no_select_array()
            )
        );

        $menu_area_in_grid_border_container = foton_mikado_add_admin_container(
            array(
                'type'       => 'container',
                'name'       => 'menu_area_in_grid_border_container',
                'parent'     => $menu_area_in_grid_container,
                'dependency' => array(
                    'show' => array(
                        'mkdf_menu_area_in_grid_border_meta' => 'yes'
                    )
                )
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_menu_area_in_grid_border_color_meta',
                'type'        => 'color',
                'label'       => esc_html__('Border Color', 'foton'),
                'description' => esc_html__('Set border color for grid area', 'foton'),
                'parent'      => $menu_area_in_grid_border_container
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_menu_area_background_color_meta',
                'type'        => 'color',
                'label'       => esc_html__('Background Color', 'foton'),
                'description' => esc_html__('Choose a background color for menu area', 'foton'),
                'parent'      => $menu_area_container
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_menu_area_background_transparency_meta',
                'type'        => 'text',
                'label'       => esc_html__('Transparency', 'foton'),
                'description' => esc_html__('Choose a transparency for the menu area background color (0 = fully transparent, 1 = opaque)', 'foton'),
                'parent'      => $menu_area_container,
                'args'        => array(
                    'col_width' => 2
                )
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'          => 'mkdf_menu_area_shadow_meta',
                'type'          => 'select',
                'label'         => esc_html__('Menu Area Shadow', 'foton'),
                'description'   => esc_html__('Set shadow on menu area', 'foton'),
                'parent'        => $menu_area_container,
                'default_value' => '',
                'options'       => foton_mikado_get_yes_no_select_array()
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'mkdf_menu_item_dot_color_meta',
                'default_value' => '',
                'label'         => esc_html__('Set Menu Item Dot Color', 'foton'),
                'description'   => esc_html__('Select predefined menu item dot color', 'foton'),
                'options'       => array(
                    ''                  => esc_html__('Default', 'foton'),
                    'first-predefined-color'  => esc_html__('First Predefined Color', 'foton'),
                    'second-predefined-color' => esc_html__('Second Predefined Color', 'foton'),
                    'third-predefined-color'  => esc_html__('Third Predefined Color', 'foton')
                ),
                'parent'        => $menu_area_container,
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'mkdf_side_area_opener_background_color_meta',
                'default_value' => '',
                'label'         => esc_html__('Side Area Opener Background Color', 'foton'),
                'options'       => array(
                    ''                  => esc_html__('Default', 'foton'),
                    'first-predefined-color'  => esc_html__('First Predefined Color', 'foton'),
                    'second-predefined-color' => esc_html__('Second Predefined Color', 'foton'),
                    'third-predefined-color'  => esc_html__('Third Predefined Color', 'foton')
                ),
                'parent'        => $menu_area_container,
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'mkdf_fullscreen_menu_opener_background_color_meta',
                'default_value' => '',
                'label'         => esc_html__('Fullscreen Opener Background Color', 'foton'),
                'options'       => array(
                    ''                  => esc_html__('Default', 'foton'),
                    'first-predefined-color'  => esc_html__('First Predefined Color', 'foton'),
                    'second-predefined-color' => esc_html__('Second Predefined Color', 'foton'),
                    'third-predefined-color'  => esc_html__('Third Predefined Color', 'foton')
                ),
                'parent'        => $menu_area_container,
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'          => 'mkdf_menu_area_border_meta',
                'type'          => 'select',
                'label'         => esc_html__('Menu Area Border', 'foton'),
                'description'   => esc_html__('Set border on menu area', 'foton'),
                'parent'        => $menu_area_container,
                'default_value' => '',
                'options'       => foton_mikado_get_yes_no_select_array()
            )
        );

        $menu_area_border_bottom_color_container = foton_mikado_add_admin_container(
            array(
                'type'       => 'container',
                'name'       => 'menu_area_border_bottom_color_container',
                'parent'     => $menu_area_container,
                'dependency' => array(
                    'show' => array(
                        'mkdf_menu_area_border_meta' => 'yes'
                    )
                )
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_menu_area_border_color_meta',
                'type'        => 'color',
                'label'       => esc_html__('Border Color', 'foton'),
                'description' => esc_html__('Choose color of header bottom border', 'foton'),
                'parent'      => $menu_area_border_bottom_color_container
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'type'        => 'text',
                'name'        => 'mkdf_menu_area_height_meta',
                'label'       => esc_html__('Height', 'foton'),
                'description' => esc_html__('Enter header height', 'foton'),
                'parent'      => $menu_area_container,
                'args'        => array(
                    'col_width' => 3,
                    'suffix'    => esc_html__('px', 'foton')
                )
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'type'        => 'text',
                'name'        => 'mkdf_menu_area_side_padding_meta',
                'label'       => esc_html__('Menu Area Side Padding', 'foton'),
                'description' => esc_html__('Enter value in px or percentage to define menu area side padding', 'foton'),
                'parent'      => $menu_area_container,
                'args'        => array(
                    'col_width' => 3,
                    'suffix'    => esc_html__('px or %', 'foton')
                )
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'parent'      => $menu_area_container,
                'type'        => 'text',
                'name'        => 'mkdf_dropdown_top_position_meta',
                'label'       => esc_html__('Dropdown Position', 'foton'),
                'description' => esc_html__('Enter value in percentage of entire header height', 'foton'),
                'args'        => array(
                    'col_width' => 3,
                    'suffix'    => '%'
                )
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'          => 'mkdf_wide_dropdown_menu_in_grid_meta',
                'type'          => 'select',
                'label'         => esc_html__('Wide Dropdown Menu In Grid', 'foton'),
                'description'   => esc_html__('Set wide dropdown menu to be in grid', 'foton'),
                'parent'        => $menu_area_container,
                'default_value' => '',
                'options'       => foton_mikado_get_yes_no_select_array()
            )
        );

        $wide_dropdown_menu_in_grid_container = foton_mikado_add_admin_container(
            array(
                'type'       => 'container',
                'name'       => 'wide_dropdown_menu_in_grid_container',
                'parent'     => $menu_area_container,
                'dependency' => array(
                    'show' => array(
                        'mkdf_wide_dropdown_menu_in_grid_meta' => 'no'
                    )
                )
            )
        );

        foton_mikado_create_meta_box_field(
            array(
                'name'          => 'mkdf_wide_dropdown_menu_content_in_grid_meta',
                'type'          => 'select',
                'label'         => esc_html__('Wide Dropdown Menu Content In Grid', 'foton'),
                'description'   => esc_html__('Set wide dropdown menu content to be in grid', 'foton'),
                'parent'        => $wide_dropdown_menu_in_grid_container,
                'default_value' => '',
                'options'       => foton_mikado_get_yes_no_select_array()
            )
        );

        do_action('foton_mikado_header_menu_area_additional_meta_boxes_map', $menu_area_container);
    }

    add_action('foton_mikado_action_header_menu_area_meta_boxes_map', 'foton_mikado_header_menu_area_meta_options_map', 10, 1);
}