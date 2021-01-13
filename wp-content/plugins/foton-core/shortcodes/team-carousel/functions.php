<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Mkdf_Team_Carousel extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'foton_core_add_team_carousel_shortcode' ) ) {
	function foton_core_add_team_carousel_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'FotonCore\CPT\Shortcodes\Team\TeamCarousel'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'foton_core_filter_add_vc_shortcode', 'foton_core_add_team_carousel_shortcode' );
}

if ( ! function_exists( 'foton_core_set_team_carousel_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for team carousel shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function foton_core_set_team_carousel_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-team-carousel';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'foton_core_filter_add_vc_shortcodes_custom_icon_class', 'foton_core_set_team_carousel_icon_class_name_for_vc_shortcodes' );
}