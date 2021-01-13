<?php

if ( ! function_exists( 'foton_mikado_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function foton_mikado_register_social_icon_widget( $widgets ) {
		$widgets[] = 'FotonMikadoClassSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'foton_core_filter_register_widgets', 'foton_mikado_register_social_icon_widget' );
}