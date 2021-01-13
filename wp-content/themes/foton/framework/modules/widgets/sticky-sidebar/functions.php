<?php

if ( ! function_exists( 'foton_mikado_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function foton_mikado_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'FotonMikadoClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'foton_core_filter_register_widgets', 'foton_mikado_register_sticky_sidebar_widget' );
}