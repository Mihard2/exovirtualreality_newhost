<?php

if ( ! function_exists( 'foton_mikado_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function foton_mikado_register_blog_list_widget( $widgets ) {
		$widgets[] = 'FotonMikadoClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'foton_core_filter_register_widgets', 'foton_mikado_register_blog_list_widget' );
}