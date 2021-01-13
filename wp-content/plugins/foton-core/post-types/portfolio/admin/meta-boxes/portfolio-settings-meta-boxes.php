<?php

if ( ! function_exists( 'foton_core_map_portfolio_settings_meta' ) ) {
	function foton_core_map_portfolio_settings_meta() {
		$meta_box = foton_mikado_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'foton-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		foton_mikado_create_meta_box_field( array(
			'name'        => 'mkdf_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'foton-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'foton-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'foton-core' ),
				'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'foton-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'foton-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'foton-core' ),
				'slider'            => esc_html__( 'Portfolio Slider', 'foton-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'foton-core' ),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'foton-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'foton-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'foton-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'foton-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'foton-core' ),
				'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'foton-core' )
			)
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = foton_mikado_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'mkdf_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'mkdf_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'foton-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'foton-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => foton_mikado_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'foton-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'foton-core' ),
				'default_value' => '',
				'options'       => foton_mikado_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = foton_mikado_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'mkdf_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'mkdf_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'foton-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'foton-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => foton_mikado_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'foton-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'foton-core' ),
				'default_value' => '',
				'options'       => foton_mikado_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'foton-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'foton-core' ),
				'parent'        => $meta_box,
				'options'       => foton_mikado_get_yes_no_select_array()
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'foton-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'foton-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'foton-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'foton-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'foton-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'foton-core' ),
				'parent'      => $meta_box
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'foton-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'foton-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'foton-core' ),
					'small'              => esc_html__( 'Small', 'foton-core' ),
					'large-width'        => esc_html__( 'Large Width', 'foton-core' ),
					'large-height'       => esc_html__( 'Large Height', 'foton-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'foton-core' )
				)
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'foton-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'foton-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''            => esc_html__( 'Default', 'foton-core' ),
					'large-width' => esc_html__( 'Large Width', 'foton-core' )
				)
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'foton-core' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'foton-core' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_core_map_portfolio_settings_meta', 41 );
}