<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Mkdf_Clients_Grid extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'foton_core_add_clients_holder_shortcodes' ) ) {
	function foton_core_add_clients_holder_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'FotonCore\CPT\Shortcodes\ClientsGrid\ClientsGrid'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'foton_core_filter_add_vc_shortcode', 'foton_core_add_clients_holder_shortcodes' );
}

if ( ! function_exists( 'foton_core_set_clients_holder_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for clients grid shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function foton_core_set_clients_holder_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-clients-grid';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'foton_core_filter_add_vc_shortcodes_custom_icon_class', 'foton_core_set_clients_holder_icon_class_name_for_vc_shortcodes' );
}