<?php

if ( ! function_exists( 'foton_mikado_map_woocommerce_meta' ) ) {
	function foton_mikado_map_woocommerce_meta() {
		
		$woocommerce_meta_box = foton_mikado_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'foton' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'foton' ),
				'description' => esc_html__( 'Choose image layout when it appears in Mikado Product List - Masonry layout shortcode', 'foton' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'foton' ),
					'small'              => esc_html__( 'Small', 'foton' ),
					'large-width'        => esc_html__( 'Large Width', 'foton' ),
					'large-height'       => esc_html__( 'Large Height', 'foton' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'foton' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'foton' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'foton' ),
				'options'       => foton_mikado_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		foton_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'foton' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'foton' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'foton_mikado_action_meta_boxes_map', 'foton_mikado_map_woocommerce_meta', 99 );
}