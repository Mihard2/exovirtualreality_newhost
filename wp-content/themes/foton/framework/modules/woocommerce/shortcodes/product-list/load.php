<?php

include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/product-list/functions.php';
include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/product-list/product-list.php';

if ( foton_mikado_is_elementor_installed() ) {
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/product-list/elementor-product-list.php';
}