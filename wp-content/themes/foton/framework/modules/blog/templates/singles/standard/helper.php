<?php

if ( ! function_exists( 'foton_mikado_get_blog_holder_params' ) ) {
	/**
	 * Function that generates params for holders on blog templates
	 */
	function foton_mikado_get_blog_holder_params( $params ) {
		$params_list = array();
		
		$params_list['holder'] = 'mkdf-container';
		$params_list['inner']  = 'mkdf-container-inner clearfix';
		
		return $params_list;
	}
	
	add_filter( 'foton_mikado_filter_blog_holder_params', 'foton_mikado_get_blog_holder_params' );
}

if ( ! function_exists( 'foton_mikado_blog_part_params' ) ) {
	function foton_mikado_blog_part_params( $params ) {
		
		$part_params              = array();
		$part_params['title_tag'] = 'h3';
		$part_params['link_tag']  = 'h5';
		$part_params['quote_tag'] = 'h5';
		
		return array_merge( $params, $part_params );
	}
	
	add_filter( 'foton_mikado_filter_blog_part_params', 'foton_mikado_blog_part_params' );
}