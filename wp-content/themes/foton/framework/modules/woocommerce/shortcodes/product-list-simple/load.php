<?php

include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/product-list-simple/functions.php';
include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/product-list-simple/product-list-simple.php';

if ( foton_mikado_is_elementor_installed() ) {
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/product-list-simple/elementor-product-list-simple.php';
}