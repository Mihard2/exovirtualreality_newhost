<?php

if ( ! function_exists( 'foton_mikado_content_responsive_styles' ) ) {
	/**
	 * Generates content responsive custom styles
	 */
	function foton_mikado_content_responsive_styles() {
		$content_style = array();
		
		$padding_mobile = foton_mikado_options()->getOptionValue( 'content_padding_mobile' );
		if ( $padding_mobile !== '' ) {
			$content_style['padding'] = $padding_mobile;
		}
		
		$content_selector = array(
			'.mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner',
			'.mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner',
		);
		
		echo foton_mikado_dynamic_css( $content_selector, $content_style );
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_1024', 'foton_mikado_content_responsive_styles' );
}

if ( ! function_exists( 'foton_mikado_h1_responsive_styles3' ) ) {
	function foton_mikado_h1_responsive_styles3() {
		$selector = array(
			'h1'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h1_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_768_1024', 'foton_mikado_h1_responsive_styles3' );
}

if ( ! function_exists( 'foton_mikado_h2_responsive_styles3' ) ) {
	function foton_mikado_h2_responsive_styles3() {
		$selector = array(
			'h2'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h2_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_768_1024', 'foton_mikado_h2_responsive_styles3' );
}

if ( ! function_exists( 'foton_mikado_h3_responsive_styles3' ) ) {
	function foton_mikado_h3_responsive_styles3() {
		$selector = array(
			'h3'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h3_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_768_1024', 'foton_mikado_h3_responsive_styles3' );
}

if ( ! function_exists( 'foton_mikado_h4_responsive_styles3' ) ) {
	function foton_mikado_h4_responsive_styles3() {
		$selector = array(
			'h4'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h4_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_768_1024', 'foton_mikado_h4_responsive_styles3' );
}

if ( ! function_exists( 'foton_mikado_h5_responsive_styles3' ) ) {
	function foton_mikado_h5_responsive_styles3() {
		$selector = array(
			'h5'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h5_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_768_1024', 'foton_mikado_h5_responsive_styles3' );
}

if ( ! function_exists( 'foton_mikado_h6_responsive_styles3' ) ) {
	function foton_mikado_h6_responsive_styles3() {
		$selector = array(
			'h6'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h6_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_768_1024', 'foton_mikado_h6_responsive_styles3' );
}

if ( ! function_exists( 'foton_mikado_h1_responsive_styles' ) ) {
	function foton_mikado_h1_responsive_styles() {
		$selector = array(
			'h1'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h1_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_680_768', 'foton_mikado_h1_responsive_styles' );
}

if ( ! function_exists( 'foton_mikado_h2_responsive_styles' ) ) {
	function foton_mikado_h2_responsive_styles() {
		$selector = array(
			'h2'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h2_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_680_768', 'foton_mikado_h2_responsive_styles' );
}

if ( ! function_exists( 'foton_mikado_h3_responsive_styles' ) ) {
	function foton_mikado_h3_responsive_styles() {
		$selector = array(
			'h3'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h3_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_680_768', 'foton_mikado_h3_responsive_styles' );
}

if ( ! function_exists( 'foton_mikado_h4_responsive_styles' ) ) {
	function foton_mikado_h4_responsive_styles() {
		$selector = array(
			'h4'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h4_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_680_768', 'foton_mikado_h4_responsive_styles' );
}

if ( ! function_exists( 'foton_mikado_h5_responsive_styles' ) ) {
	function foton_mikado_h5_responsive_styles() {
		$selector = array(
			'h5'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h5_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_680_768', 'foton_mikado_h5_responsive_styles' );
}

if ( ! function_exists( 'foton_mikado_h6_responsive_styles' ) ) {
	function foton_mikado_h6_responsive_styles() {
		$selector = array(
			'h6'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h6_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_680_768', 'foton_mikado_h6_responsive_styles' );
}

if ( ! function_exists( 'foton_mikado_text_responsive_styles' ) ) {
	function foton_mikado_text_responsive_styles() {
		$selector = array(
			'body',
			'p'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'text', '_res1' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_680_768', 'foton_mikado_text_responsive_styles' );
}

if ( ! function_exists( 'foton_mikado_h1_responsive_styles2' ) ) {
	function foton_mikado_h1_responsive_styles2() {
		$selector = array(
			'h1'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h1_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_680', 'foton_mikado_h1_responsive_styles2' );
}

if ( ! function_exists( 'foton_mikado_h2_responsive_styles2' ) ) {
	function foton_mikado_h2_responsive_styles2() {
		$selector = array(
			'h2'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h2_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_680', 'foton_mikado_h2_responsive_styles2' );
}

if ( ! function_exists( 'foton_mikado_h3_responsive_styles2' ) ) {
	function foton_mikado_h3_responsive_styles2() {
		$selector = array(
			'h3'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h3_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_680', 'foton_mikado_h3_responsive_styles2' );
}

if ( ! function_exists( 'foton_mikado_h4_responsive_styles2' ) ) {
	function foton_mikado_h4_responsive_styles2() {
		$selector = array(
			'h4'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h4_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_680', 'foton_mikado_h4_responsive_styles2' );
}

if ( ! function_exists( 'foton_mikado_h5_responsive_styles2' ) ) {
	function foton_mikado_h5_responsive_styles2() {
		$selector = array(
			'h5'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h5_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_680', 'foton_mikado_h5_responsive_styles2' );
}

if ( ! function_exists( 'foton_mikado_h6_responsive_styles2' ) ) {
	function foton_mikado_h6_responsive_styles2() {
		$selector = array(
			'h6'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'h6_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_680', 'foton_mikado_h6_responsive_styles2' );
}

if ( ! function_exists( 'foton_mikado_text_responsive_styles2' ) ) {
	function foton_mikado_text_responsive_styles2() {
		$selector = array(
			'body',
			'p'
		);
		
		$styles = foton_mikado_get_responsive_typography_styles( 'text', '_res2' );
		
		if ( ! empty( $styles ) ) {
			echo foton_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'foton_mikado_action_style_dynamic_responsive_680', 'foton_mikado_text_responsive_styles2' );
}