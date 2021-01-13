<?php

namespace FotonCore\Lib;

/**
 * interface PostTypeInterface
 * @package FotonCore\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}