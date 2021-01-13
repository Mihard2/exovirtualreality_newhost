<?php

if ( ! function_exists( 'foton_core_map_portfolio_meta' ) ) {
	function foton_core_map_portfolio_meta() {
		global $foton_mikado_global_Framework;
		
		$foton_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$foton_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$foton_portfolio_images = new FotonMikadoClassMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'foton-core' ), '', '', 'portfolio_images' );
		$foton_mikado_global_Framework->mkdMetaBoxes->addMetaBox( 'portfolio_images', $foton_portfolio_images );
		
		$foton_portfolio_image_gallery = new FotonMikadoClassMultipleImages( 'mkdf-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'foton-core' ), esc_html__( 'Choose your portfolio images', 'foton-core' ) );
		$foton_portfolio_images->addChild( 'mkdf-portfolio-image-gallery', $foton_portfolio_image_gallery );
		
		//Portfolio Single Upload Images/Videos 
		
		$foton_portfolio_images_videos = foton_mikado_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'foton-core' ),
				'name'  => 'mkdf_portfolio_images_videos'
			)
		);
		foton_mikado_add_repeater_field(
			array(
				'name'        => 'mkdf_portfolio_single_upload',
				'parent'      => $foton_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'foton-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'foton-core' ),
						'options' => array(
							'image' => esc_html__('Image','foton-core'),
							'video' => esc_html__('Video','foton-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'foton-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'foton-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'foton-core'),
							'vimeo' => esc_html__('Vimeo', 'foton-core'),
							'self' => esc_html__('Self Hosted', 'foton-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'foton-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'foton-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'foton-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);
		
		//Portfolio Additional Sidebar Items
		
		$foton_additional_sidebar_items = foton_mikado_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'foton-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		foton_mikado_add_repeater_field(
			array(
				'name'        => 'mkdf_portfolio_properties',
				'parent'      => $foton_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'foton-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'foton-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'foton-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'foton-core' )
					)
				)
			)
		);
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_core_map_portfolio_meta', 40 );
}