<?php

if ( ! function_exists( 'foton_mikado_map_post_gallery_meta' ) ) {
	
	function foton_mikado_map_post_gallery_meta() {
		$gallery_post_format_meta_box = foton_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'foton' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		foton_mikado_add_multiple_images_field(
			array(
				'name'        => 'mkdf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'foton' ),
				'description' => esc_html__( 'Choose your gallery images', 'foton' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_mikado_map_post_gallery_meta', 21 );
}
