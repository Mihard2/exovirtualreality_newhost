<?php

include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/product-info/functions.php';
include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/product-info/product-info.php';

if ( foton_mikado_is_elementor_installed() ) {
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/product-info/elementor-product-info.php';
}