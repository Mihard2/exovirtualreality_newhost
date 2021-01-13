<?php

if ( ! function_exists( 'foton_mikado_map_post_link_meta' ) ) {
	function foton_mikado_map_post_link_meta() {
		$link_post_format_meta_box = foton_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'foton' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'foton' ),
				'description' => esc_html__( 'Enter link', 'foton' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_mikado_map_post_link_meta', 24 );
}