<?php

if ( ! function_exists( 'foton_mikado_logo_options_map' ) ) {
	function foton_mikado_logo_options_map() {
		
		foton_mikado_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'foton' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = foton_mikado_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'foton' )
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'foton' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'foton' )
			)
		);
		
		$hide_logo_container = foton_mikado_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'foton' ),
				'parent'        => $hide_logo_container
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'foton' ),
				'parent'        => $hide_logo_container
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'foton' ),
				'parent'        => $hide_logo_container
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'foton' ),
				'parent'        => $hide_logo_container
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'foton' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'foton_mikado_action_options_map', 'foton_mikado_logo_options_map', foton_mikado_set_options_map_position( 'logo' ) );
}