<?php

if ( ! function_exists( 'foton_mikado_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function foton_mikado_register_custom_font_widget( $widgets ) {
		$widgets[] = 'FotonMikadoClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'foton_core_filter_register_widgets', 'foton_mikado_register_custom_font_widget' );
}