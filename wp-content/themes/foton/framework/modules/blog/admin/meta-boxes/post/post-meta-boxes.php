<?php

/*** Post Settings ***/

if ( ! function_exists( 'foton_mikado_map_post_meta' ) ) {
	function foton_mikado_map_post_meta() {
		
		$post_meta_box = foton_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'foton' ),
				'name'  => 'post-meta'
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'foton' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'foton' ),
				'parent'        => $post_meta_box,
				'options'       => foton_mikado_get_yes_no_select_array()
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'foton' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'foton' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => foton_mikado_get_custom_sidebars_options( true )
			)
		);
		
		$foton_custom_sidebars = foton_mikado_get_custom_sidebars();
		if ( count( $foton_custom_sidebars ) > 0 ) {
			foton_mikado_create_meta_box_field( array(
				'name'        => 'mkdf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'foton' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'foton' ),
				'parent'      => $post_meta_box,
				'options'     => foton_mikado_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'foton' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'foton' ),
				'parent'      => $post_meta_box
			)
		);

		do_action('foton_mikado_action_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_mikado_map_post_meta', 20 );
}
