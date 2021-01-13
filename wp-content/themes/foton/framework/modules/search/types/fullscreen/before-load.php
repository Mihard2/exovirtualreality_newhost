<?php

if ( ! function_exists( 'foton_mikado_set_search_fullscreen_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function foton_mikado_set_search_fullscreen_global_option( $search_type_options ) {
        $search_type_options['fullscreen'] = esc_html__( 'Fullscreen', 'foton' );

        return $search_type_options;
    }

    add_filter( 'foton_mikado_filter_search_type_global_option', 'foton_mikado_set_search_fullscreen_global_option' );
}