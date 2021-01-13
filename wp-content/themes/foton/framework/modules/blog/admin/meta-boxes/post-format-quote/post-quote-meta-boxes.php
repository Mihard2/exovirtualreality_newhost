<?php

if ( ! function_exists( 'foton_mikado_map_post_quote_meta' ) ) {
	function foton_mikado_map_post_quote_meta() {
		$quote_post_format_meta_box = foton_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'foton' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'foton' ),
				'description' => esc_html__( 'Enter Quote text', 'foton' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'foton' ),
				'description' => esc_html__( 'Enter Quote author', 'foton' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_mikado_map_post_quote_meta', 25 );
}