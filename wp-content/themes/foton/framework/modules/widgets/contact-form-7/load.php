<?php

if ( foton_mikado_contact_form_7_installed() ) {
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'foton_core_filter_register_widgets', 'foton_mikado_register_cf7_widget' );
}

if ( ! function_exists( 'foton_mikado_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function foton_mikado_register_cf7_widget( $widgets ) {
		$widgets[] = 'FotonMikadoClassContactForm7Widget';
		
		return $widgets;
	}
}