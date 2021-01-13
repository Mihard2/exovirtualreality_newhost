<?php

if ( ! function_exists( 'foton_mikado_set_title_standard_with_breadcrumbs_type_for_options' ) ) {
	/**
	 * This function set standard with breadcrumbs title type value for title options map and meta boxes
	 */
	function foton_mikado_set_title_standard_with_breadcrumbs_type_for_options( $type ) {
		$type['standard-with-breadcrumbs'] = esc_html__( 'Standard With Breadcrumbs', 'foton' );
		
		return $type;
	}
	
	add_filter( 'foton_mikado_filter_title_type_global_option', 'foton_mikado_set_title_standard_with_breadcrumbs_type_for_options' );
	add_filter( 'foton_mikado_filter_title_type_meta_boxes', 'foton_mikado_set_title_standard_with_breadcrumbs_type_for_options' );
}