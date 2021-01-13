<?php

if ( ! function_exists( 'foton_mikado_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function foton_mikado_register_icon_widget( $widgets ) {
		$widgets[] = 'FotonMikadoClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'foton_core_filter_register_widgets', 'foton_mikado_register_icon_widget' );
}