<?php

if ( ! function_exists( 'foton_mikado_sticky_header_global_js_var' ) ) {
	function foton_mikado_sticky_header_global_js_var( $global_variables ) {
		$global_variables['mkdfStickyHeaderHeight']             = foton_mikado_get_sticky_header_height();
		$global_variables['mkdfStickyHeaderTransparencyHeight'] = foton_mikado_get_sticky_header_height_of_complete_transparency();
		
		return $global_variables;
	}
	
	add_filter( 'foton_mikado_filter_js_global_variables', 'foton_mikado_sticky_header_global_js_var' );
}

if ( ! function_exists( 'foton_mikado_sticky_header_per_page_js_var' ) ) {
	function foton_mikado_sticky_header_per_page_js_var( $perPageVars ) {
		$perPageVars['mkdfStickyScrollAmount'] = foton_mikado_get_sticky_scroll_amount();
		
		return $perPageVars;
	}
	
	add_filter( 'foton_mikado_filter_per_page_js_vars', 'foton_mikado_sticky_header_per_page_js_var' );
}

if ( ! function_exists( 'foton_mikado_register_sticky_header_areas' ) ) {
	/**
	 * Registers widget area for sticky header
	 */
	function foton_mikado_register_sticky_header_areas() {
		register_sidebar(
			array(
				'id'            => 'mkdf-sticky-right',
				'name'          => esc_html__( 'Sticky Header Widget Area', 'foton' ),
				'description'   => esc_html__( 'Widgets added here will appear on the right hand side from the sticky menu', 'foton' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-sticky-right">',
				'after_widget'  => '</div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'foton_mikado_register_sticky_header_areas' );
}

if ( ! function_exists( 'foton_mikado_get_sticky_menu' ) ) {
	/**
	 * Loads sticky menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function foton_mikado_get_sticky_menu( $additional_class = 'mkdf-default-nav' ) {
		foton_mikado_get_module_template_part( 'templates/sticky-navigation', 'header/types/sticky-header', '', array( 'additional_class' => $additional_class ) );
	}
}

if ( ! function_exists( 'foton_mikado_get_sticky_header' ) ) {
	/**
	 * Loads sticky header behavior HTML
	 */
	function foton_mikado_get_sticky_header( $slug = '', $module = '' ) {
        $page_id             = foton_mikado_get_page_id();
		$sticky_in_grid      = foton_mikado_options()->getOptionValue( 'sticky_header_in_grid' ) == 'yes' ? true : false;
		$header_in_grid_meta = get_post_meta( $page_id, 'mkdf_menu_area_in_grid_meta', true);
		$menu_area_position  = foton_mikado_get_meta_field_intersect( 'set_menu_area_position', $page_id );
		
		if ( $header_in_grid_meta === 'yes' && ! $sticky_in_grid ) {
			$sticky_in_grid = true;
		} else if ( $header_in_grid_meta === 'no' && $sticky_in_grid ) {
			$sticky_in_grid = false;
		}
		
		$parameters = array(
			'hide_logo'                  => foton_mikado_options()->getOptionValue( 'hide_logo' ) == 'yes' ? true : false,
			'sticky_header_in_grid'      => $sticky_in_grid,
			'fullscreen_menu_icon_class' => foton_mikado_get_fullscreen_menu_icon_class(),
            'menu_area_position'    	 => $menu_area_position,
			'menu_area_class'       	 => ! empty( $menu_area_position ) ? 'mkdf-menu-' . $menu_area_position : ''
		);
		
		$module = ! empty( $module ) ? $module : 'header/types/sticky-header';
		
		foton_mikado_get_module_template_part( 'templates/sticky-header', $module, $slug, $parameters );
	}
}

if ( ! function_exists( 'foton_mikado_get_sticky_header_widget_menu_area' ) ) {
	/**
	 * Loads sticky header widgets area HTML
	 */
	function foton_mikado_get_sticky_header_widget_menu_area() {
		$page_id                 = foton_mikado_get_page_id();
		$custom_menu_widget_area = get_post_meta( $page_id, 'mkdf_custom_sticky_menu_area_sidebar_meta', true );
		
		if ( is_active_sidebar( 'mkdf-sticky-right' ) && empty( $custom_menu_widget_area ) ) {
			dynamic_sidebar( 'mkdf-sticky-right' );
		} else if ( ! empty( $custom_menu_widget_area ) && is_active_sidebar( $custom_menu_widget_area ) ) {
			dynamic_sidebar( $custom_menu_widget_area );
		}
	}
}

if ( ! function_exists( 'foton_mikado_get_sticky_header_height' ) ) {
	/**
	 * Returns top sticky header height
	 *
	 * @return bool|int|void
	 */
	function foton_mikado_get_sticky_header_height() {
		$allow_sticky_behavior = true;
		$allow_sticky_behavior = apply_filters( 'foton_mikado_filter_allow_sticky_header_behavior', $allow_sticky_behavior );
		$header_behaviour      = foton_mikado_get_meta_field_intersect( 'header_behaviour' );
		
		//sticky menu height, needed only for sticky header on scroll up
		if ( $allow_sticky_behavior && in_array( $header_behaviour, array( 'sticky-header-on-scroll-up' ) ) ) {
			$sticky_header_height = foton_mikado_filter_px( foton_mikado_options()->getOptionValue( 'sticky_header_height' ) );
			
			return $sticky_header_height !== '' ? intval( $sticky_header_height ) : 70;
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'foton_mikado_get_sticky_header_height_of_complete_transparency' ) ) {
	/**
	 * Returns top sticky header height it is fully transparent. used in anchor logic
	 *
	 * @return bool|int|void
	 */
	function foton_mikado_get_sticky_header_height_of_complete_transparency() {
		$allow_sticky_behavior = true;
		$allow_sticky_behavior = apply_filters( 'foton_mikado_filter_allow_sticky_header_behavior', $allow_sticky_behavior );
		
		if ( $allow_sticky_behavior ) {
			$stickyHeaderTransparent = foton_mikado_options()->getOptionValue( 'sticky_header_background_color' ) !== '' && foton_mikado_options()->getOptionValue( 'sticky_header_transparency' ) === '0';
			
			if ( $stickyHeaderTransparent ) {
				return 0;
			} else {
				$sticky_header_height = foton_mikado_filter_px( foton_mikado_options()->getOptionValue( 'sticky_header_height' ) );
				
				return $sticky_header_height !== '' ? intval( $sticky_header_height ) : 70;
			}
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'foton_mikado_get_sticky_scroll_amount' ) ) {
	/**
	 * Returns top sticky scroll amount
	 *
	 * @return bool|int|void
	 */
	function foton_mikado_get_sticky_scroll_amount() {
		$allow_sticky_behavior = true;
		$allow_sticky_behavior = apply_filters( 'foton_mikado_filter_allow_sticky_header_behavior', $allow_sticky_behavior );
		$header_behaviour      = foton_mikado_get_meta_field_intersect( 'header_behaviour' );
		
		//sticky menu scroll amount
		if ( $allow_sticky_behavior && in_array( $header_behaviour, array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' ) ) ) {
			$sticky_scroll_amount = foton_mikado_filter_px( foton_mikado_get_meta_field_intersect( 'scroll_amount_for_sticky' ) );
			
			return $sticky_scroll_amount !== '' ? intval( $sticky_scroll_amount ) : 0;
		} else {
			return 0;
		}
	}
}