<?php

if ( ! function_exists( 'foton_mikado_map_post_video_meta' ) ) {
	function foton_mikado_map_post_video_meta() {
		$video_post_format_meta_box = foton_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'foton' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'foton' ),
				'description'   => esc_html__( 'Choose video type', 'foton' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'foton' ),
					'self'            => esc_html__( 'Self Hosted', 'foton' )
				)
			)
		);
		
		$mkdf_video_embedded_container = foton_mikado_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'mkdf_video_embedded_container'
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'foton' ),
				'description' => esc_html__( 'Enter Video URL', 'foton' ),
				'parent'      => $mkdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'foton' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'foton' ),
				'parent'      => $mkdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_video_type_meta' => 'self'
					)
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'foton' ),
				'description' => esc_html__( 'Enter video image', 'foton' ),
				'parent'      => $mkdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_mikado_map_post_video_meta', 22 );
}