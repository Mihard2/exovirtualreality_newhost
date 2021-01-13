<?php

if ( ! function_exists( 'foton_mikado_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function foton_mikado_reset_options_map() {
		
		foton_mikado_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'foton' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = foton_mikado_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'foton' )
			)
		);
		
		foton_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'foton' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'foton' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'foton_mikado_action_options_map', 'foton_mikado_reset_options_map', foton_mikado_set_options_map_position( 'reset' ) );
}