<?php

include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/blog-slider/functions.php';
include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/blog-slider/blog-slider.php';

if ( foton_mikado_is_elementor_installed() ) {
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/blog-slider/elementor-blog-slider.php';
}