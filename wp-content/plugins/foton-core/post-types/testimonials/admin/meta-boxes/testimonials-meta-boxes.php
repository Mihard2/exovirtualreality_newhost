<?php

if ( ! function_exists( 'foton_core_map_testimonials_meta' ) ) {
	function foton_core_map_testimonials_meta() {
		$testimonial_meta_box = foton_mikado_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'foton-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'foton-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'foton-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'foton-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'foton-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'foton-core' ),
				'description' => esc_html__( 'Enter author name', 'foton-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'foton-core' ),
				'description' => esc_html__( 'Enter author job position', 'foton-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_core_map_testimonials_meta', 95 );
}