<?php

if ( ! function_exists( 'foton_mikado_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function foton_mikado_register_separator_widget( $widgets ) {
		$widgets[] = 'FotonMikadoClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'foton_core_filter_register_widgets', 'foton_mikado_register_separator_widget' );
}