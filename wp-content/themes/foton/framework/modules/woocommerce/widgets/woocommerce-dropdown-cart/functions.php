<?php

if ( ! function_exists( 'foton_mikado_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function foton_mikado_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'FotonMikadoClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'foton_core_filter_register_widgets', 'foton_mikado_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'foton_mikado_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function foton_mikado_get_dropdown_cart_icon_class() {
		$classes = array(
			'mkdf-header-cart'
		);
		
		$classes[] = foton_mikado_get_icon_sources_class( 'dropdown_cart', 'mkdf-header-cart' );
		
		return $classes;
	}
}