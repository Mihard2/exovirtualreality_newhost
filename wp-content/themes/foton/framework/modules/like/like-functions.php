<?php

if ( ! function_exists( 'foton_mikado_like' ) ) {
	/**
	 * Returns FotonMikadoClassLike instance
	 *
	 * @return FotonMikadoClassLike
	 */
	function foton_mikado_like() {
		return FotonMikadoClassLike::get_instance();
	}
}

function foton_mikado_get_like() {
	
	echo wp_kses( foton_mikado_like()->add_like(), array(
		'span' => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'    => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'    => array(
			'href'  => true,
			'class' => true,
			'id'    => true,
			'title' => true,
			'style' => true
		)
	) );
}