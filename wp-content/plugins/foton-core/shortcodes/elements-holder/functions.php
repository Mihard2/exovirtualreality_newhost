<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Mkdf_Elements_Holder extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Mkdf_Elements_Holder_Item extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'foton_core_add_elements_holder_shortcodes' ) ) {
	function foton_core_add_elements_holder_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'FotonCore\CPT\Shortcodes\ElementsHolder\ElementsHolder',
			'FotonCore\CPT\Shortcodes\ElementsHolder\ElementsHolderItem'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'foton_core_filter_add_vc_shortcode', 'foton_core_add_elements_holder_shortcodes' );
}

if ( ! function_exists( 'foton_core_set_elements_holder_custom_style_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom css style for elements holder shortcode
	 */
	function foton_core_set_elements_holder_custom_style_for_vc_shortcodes( $style ) {
		$current_style = '.vc_shortcodes_container.wpb_mkdf_elements_holder_item { 
			background-color: #f4f4f4; 
		}';
		
		$style .= $current_style;
		
		return $style;
	}
	
	add_filter( 'foton_core_filter_add_vc_shortcodes_custom_style', 'foton_core_set_elements_holder_custom_style_for_vc_shortcodes' );
}

if ( ! function_exists( 'foton_core_set_elements_holder_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for elements holder shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function foton_core_set_elements_holder_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-elements-holder';
		$shortcodes_icon_class_array[] = '.icon-wpb-elements-holder-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'foton_core_filter_add_vc_shortcodes_custom_icon_class', 'foton_core_set_elements_holder_icon_class_name_for_vc_shortcodes' );
}