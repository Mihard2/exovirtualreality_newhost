<?php

if ( ! function_exists( 'foton_mikado_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function foton_mikado_register_button_widget( $widgets ) {
		$widgets[] = 'FotonMikadoClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'foton_core_filter_register_widgets', 'foton_mikado_register_button_widget' );
}