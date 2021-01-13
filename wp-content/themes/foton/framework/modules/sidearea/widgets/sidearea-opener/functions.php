<?php

if ( ! function_exists( 'foton_mikado_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function foton_mikado_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'FotonMikadoClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'foton_core_filter_register_widgets', 'foton_mikado_register_sidearea_opener_widget' );
}