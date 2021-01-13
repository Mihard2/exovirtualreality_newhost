<?php

if ( ! function_exists( 'foton_mikado_map_post_audio_meta' ) ) {
	function foton_mikado_map_post_audio_meta() {
		$audio_post_format_meta_box = foton_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'foton' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'foton' ),
				'description'   => esc_html__( 'Choose audio type', 'foton' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'foton' ),
					'self'            => esc_html__( 'Self Hosted', 'foton' )
				)
			)
		);
		
		$mkdf_audio_embedded_container = foton_mikado_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'mkdf_audio_embedded_container'
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'foton' ),
				'description' => esc_html__( 'Enter audio URL', 'foton' ),
				'parent'      => $mkdf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'foton' ),
				'description' => esc_html__( 'Enter audio link', 'foton' ),
				'parent'      => $mkdf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_mikado_map_post_audio_meta', 23 );
}