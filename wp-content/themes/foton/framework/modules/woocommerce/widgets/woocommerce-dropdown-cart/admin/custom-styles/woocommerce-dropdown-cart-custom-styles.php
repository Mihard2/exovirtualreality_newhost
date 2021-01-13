<?php

if ( ! function_exists( 'foton_mikado_dropdown_cart_icon_styles' ) ) {
	/**
	 * Generates styles for dropdown cart icon
	 */
	function foton_mikado_dropdown_cart_icon_styles() {
		$icon_color       = foton_mikado_options()->getOptionValue( 'dropdown_cart_icon_color' );
		$icon_hover_color = foton_mikado_options()->getOptionValue( 'dropdown_cart_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo foton_mikado_dynamic_css( '.mkdf-shopping-cart-holder .mkdf-header-cart a', array( 'color' => $icon_color ) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo foton_mikado_dynamic_css( '.mkdf-shopping-cart-holder .mkdf-header-cart a:hover', array( 'color' => $icon_hover_color ) );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic', 'foton_mikado_dropdown_cart_icon_styles' );
}