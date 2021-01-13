<?php

foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'foton_mikado_map_blog_meta' ) ) {
	function foton_mikado_map_blog_meta() {
		$mkdf_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$mkdf_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = foton_mikado_create_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'foton' ),
				'name'  => 'blog_meta'
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'foton' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'foton' ),
				'parent'      => $blog_meta_box,
				'options'     => $mkdf_blog_categories
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'foton' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'foton' ),
				'parent'      => $blog_meta_box,
				'options'     => $mkdf_blog_categories,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'foton' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'foton' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'foton' ),
					'in-grid'    => esc_html__( 'In Grid', 'foton' ),
					'full-width' => esc_html__( 'Full Width', 'foton' )
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'foton' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'foton' ),
				'parent'      => $blog_meta_box,
				'options'     => foton_mikado_get_number_of_columns_array( true, array( 'one', 'six' ) )
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'foton' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'foton' ),
				'options'     => foton_mikado_get_space_between_items_array( true ),
				'parent'      => $blog_meta_box
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'foton' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'foton' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'foton' ),
					'fixed'    => esc_html__( 'Fixed', 'foton' ),
					'original' => esc_html__( 'Original', 'foton' )
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'foton' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'foton' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'foton' ),
					'standard'        => esc_html__( 'Standard', 'foton' ),
					'load-more'       => esc_html__( 'Load More', 'foton' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'foton' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'foton' )
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'mkdf_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'foton' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'foton' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_mikado_map_blog_meta', 30 );
}