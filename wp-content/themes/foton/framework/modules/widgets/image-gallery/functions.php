<?php

if ( ! function_exists( 'foton_mikado_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function foton_mikado_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'FotonMikadoClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'foton_core_filter_register_widgets', 'foton_mikado_register_image_gallery_widget' );
}