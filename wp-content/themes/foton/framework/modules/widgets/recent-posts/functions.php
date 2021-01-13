<?php

if ( ! function_exists( 'foton_mikado_register_recent_posts_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function foton_mikado_register_recent_posts_widget( $widgets ) {
		$widgets[] = 'FotonMikadoClassRecentPosts';
		
		return $widgets;
	}
	
	add_filter( 'foton_core_filter_register_widgets', 'foton_mikado_register_recent_posts_widget' );
}