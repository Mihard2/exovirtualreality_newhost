<?php

if ( ! function_exists( 'foton_mikado_include_woocommerce_shortcodes' ) ) {
	function foton_mikado_include_woocommerce_shortcodes() {
		foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	if ( foton_mikado_core_plugin_installed() ) {
		add_action( 'foton_core_action_include_shortcodes_file', 'foton_mikado_include_woocommerce_shortcodes' );
	}
}
