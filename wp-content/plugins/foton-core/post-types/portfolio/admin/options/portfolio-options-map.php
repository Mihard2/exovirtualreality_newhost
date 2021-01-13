<?php

if ( ! function_exists( 'foton_mikado_portfolio_options_map' ) ) {
	function foton_mikado_portfolio_options_map() {
		
		foton_mikado_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'foton-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = foton_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'foton-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'foton-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'foton-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'foton-core' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is Four columns', 'foton-core' ),
				'parent'        => $panel_archive,
				'options'       => foton_mikado_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'foton-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'foton-core' ),
				'default_value' => 'normal',
				'options'       => foton_mikado_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'foton-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'foton-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'foton-core' ),
					'landscape' => esc_html__( 'Landscape', 'foton-core' ),
					'portrait'  => esc_html__( 'Portrait', 'foton-core' ),
					'square'    => esc_html__( 'Square', 'foton-core' )
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'foton-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'foton-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'foton-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'foton-core' )
				)
			)
		);
		
		$panel = foton_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'foton-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'foton-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'foton-core' ),
				'parent'        => $panel,
				'options'       => array(
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
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = foton_mikado_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'foton-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'foton-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => foton_mikado_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'foton-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'foton-core' ),
				'default_value' => 'normal',
				'options'       => foton_mikado_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = foton_mikado_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'foton-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'foton-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => foton_mikado_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'foton-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'foton-core' ),
				'default_value' => 'normal',
				'options'       => foton_mikado_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		foton_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'foton-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'foton-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'foton-core' ),
					'yes' => esc_html__( 'Yes', 'foton-core' ),
					'no'  => esc_html__( 'No', 'foton-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'foton-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'foton-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'foton-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'foton-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'foton-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'foton-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'foton-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'foton-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'foton-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'foton-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'foton-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'foton-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'foton-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'foton-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = foton_mikado_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'foton-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'foton-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'foton-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'foton-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'foton_mikado_action_options_map', 'foton_mikado_portfolio_options_map', foton_mikado_set_options_map_position( 'portfolio' ) );
}