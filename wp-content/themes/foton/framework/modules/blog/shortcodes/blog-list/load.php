<?php

include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/blog-list/functions.php';
include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/blog-list/blog-list.php';

if ( foton_mikado_is_elementor_installed() ) {
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/blog-list/elementor-blog-list.php';
}