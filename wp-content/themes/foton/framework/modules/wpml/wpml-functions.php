<?php

if ( ! function_exists( 'foton_mikado_disable_wpml_css' ) ) {
	function foton_mikado_disable_wpml_css() {
		define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
	}
	
	add_action( 'after_setup_theme', 'foton_mikado_disable_wpml_css' );
}