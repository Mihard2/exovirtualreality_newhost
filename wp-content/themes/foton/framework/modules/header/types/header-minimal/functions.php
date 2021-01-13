<?php

if ( ! function_exists( 'foton_mikado_register_header_minimal_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function foton_mikado_register_header_minimal_type( $header_types ) {
		$header_type = array(
			'header-minimal' => 'FotonMikadoNamespace\Modules\Header\Types\HeaderMinimal'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'foton_mikado_init_register_header_minimal_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function foton_mikado_init_register_header_minimal_type() {
		add_filter( 'foton_mikado_filter_register_header_type_class', 'foton_mikado_register_header_minimal_type' );
	}
	
	add_action( 'foton_mikado_action_before_header_function_init', 'foton_mikado_init_register_header_minimal_type' );
}

if ( ! function_exists( 'foton_mikado_include_header_minimal_full_screen_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function foton_mikado_include_header_minimal_full_screen_menu( $menus ) {
		$menus['popup-navigation'] = esc_html__( 'Full Screen Navigation', 'foton' );
		
		return $menus;
	}
	
	if ( foton_mikado_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_filter( 'foton_mikado_filter_register_headers_menu', 'foton_mikado_include_header_minimal_full_screen_menu' );
	}
}

if ( ! function_exists( 'foton_mikado_get_fullscreen_menu_icon_class' ) ) {
	/**
	 * Loads full screen menu icon class
	 */
	function foton_mikado_get_fullscreen_menu_icon_class() {
		$classes = array(
			'mkdf-fullscreen-menu-opener'
		);
		
		$classes[] = foton_mikado_get_icon_sources_class( 'fullscreen_menu', 'mkdf-fullscreen-menu-opener' );
		
		return $classes;
	}
}

if ( ! function_exists( 'foton_mikado_register_header_minimal_full_screen_menu_widgets' ) ) {
	/**
	 * Registers additional widget areas for this header type
	 */
	function foton_mikado_register_header_minimal_full_screen_menu_widgets() {
		register_sidebar(
			array(
				'id'            => 'fullscreen_menu_above',
				'name'          => esc_html__( 'Fullscreen Menu Top', 'foton' ),
				'description'   => esc_html__( 'This widget area is rendered above full screen menu', 'foton' ),
				'before_widget' => '<div class="%2$s mkdf-fullscreen-menu-above-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="mkdf-widget-title">',
				'after_title'   => '</h5>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'fullscreen_menu_below',
				'name'          => esc_html__( 'Fullscreen Menu Bottom', 'foton' ),
				'description'   => esc_html__( 'This widget area is rendered below full screen menu', 'foton' ),
				'before_widget' => '<div class="%2$s mkdf-fullscreen-menu-below-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="mkdf-widget-title">',
				'after_title'   => '</h5>'
			)
		);
	}
	
	if ( foton_mikado_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_action( 'widgets_init', 'foton_mikado_register_header_minimal_full_screen_menu_widgets' );
	}
}