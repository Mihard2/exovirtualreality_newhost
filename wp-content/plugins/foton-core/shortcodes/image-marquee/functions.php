<?php

if ( ! function_exists( 'foton_core_add_image_marquee_shortcodes' ) ) {
	function foton_core_add_image_marquee_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'FotonCore\CPT\Shortcodes\ImageMarquee\ImageMarquee'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'foton_core_filter_add_vc_shortcode', 'foton_core_add_image_marquee_shortcodes' );
}

if ( ! function_exists( 'foton_core_set_image_marquee_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for image marquee shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function foton_core_set_image_marquee_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-image-marquee';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'foton_core_filter_add_vc_shortcodes_custom_icon_class', 'foton_core_set_image_marquee_icon_class_name_for_vc_shortcodes' );
}