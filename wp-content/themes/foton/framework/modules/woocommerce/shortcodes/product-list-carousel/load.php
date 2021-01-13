<?php

include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/product-list-carousel/functions.php';
include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/product-list-carousel/product-list-carousel.php';

if ( foton_mikado_is_elementor_installed() ) {
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/product-list-carousel/elementor-product-list-carousel.php';
}