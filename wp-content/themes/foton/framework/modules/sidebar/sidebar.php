<?php

if ( ! function_exists( 'foton_mikado_register_sidebars' ) ) {
	/**
	 * Function that registers theme's sidebars
	 */
	function foton_mikado_register_sidebars() {
		
		register_sidebar(
			array(
				'id'            => 'sidebar',
				'name'          => esc_html__( 'Sidebar', 'foton' ),
				'description'   => esc_html__( 'Default Sidebar area. In order to display this area you need to enable it through global theme options or on page meta box options.', 'foton' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="mkdf-widget-title-holder"><h4 class="mkdf-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'foton_mikado_register_sidebars', 1 );
}

if ( ! function_exists( 'foton_mikado_add_support_custom_sidebar' ) ) {
	/**
	 * Function that adds theme support for custom sidebars. It also creates FotonMikadoClassSidebar object
	 */
	function foton_mikado_add_support_custom_sidebar() {
		add_theme_support( 'FotonMikadoClassSidebar' );
		
		if ( get_theme_support( 'FotonMikadoClassSidebar' ) ) {
			new FotonMikadoClassSidebar();
		}
	}
	
	add_action( 'after_setup_theme', 'foton_mikado_add_support_custom_sidebar' );
}