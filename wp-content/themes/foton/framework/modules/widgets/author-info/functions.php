<?php

if ( ! function_exists( 'foton_mikado_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function foton_mikado_register_author_info_widget( $widgets ) {
		$widgets[] = 'FotonMikadoClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'foton_core_filter_register_widgets', 'foton_mikado_register_author_info_widget' );
}