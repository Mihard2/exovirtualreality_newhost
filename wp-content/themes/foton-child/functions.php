<?php

/*** Child Theme Function  ***/

if ( !function_exists( 'foton_mikado_child_theme_enqueue_scripts' ) ) {
	function foton_mikado_child_theme_enqueue_scripts() {
		$parent_style = 'foton-mikado-default-style';
		
		wp_enqueue_style( 'foton-mikado-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'foton_mikado_child_theme_enqueue_scripts' );
}

// helper function to check product have been bought before
function has_bought_items() {
    $bought = false;

    // specific target product IDs
    $prod_arr = array( '13402' );

    // Get all customer orders
    $customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => get_current_user_id(),
        'post_type'   => 'shop_order', // WC orders post type
        'post_status' => 'wc-completed' // Only orders with status "completed"
	) );
	
    foreach ( $customer_orders as $customer_order ) {
        // Updated compatibility with WooCommerce 3+
        $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
        $order = wc_get_order( $customer_order );

        // Iterating through each current customer products bought in the order
        foreach ($order->get_items() as $item) {
            // WC 3+ compatibility
            if ( version_compare( WC_VERSION, '3.0', '<' ) ) 
                $product_id = $item['product_id'];
            else
                $product_id = $item->get_product_id();

            // Your condition related to your 2 specific products Ids
            if ( in_array( $product_id, $prod_arr ) ) 
                $bought = true;
        }
    }
    // return "true" if one of the specifics products have been bought before by customer
    return $bought;
}

// check user role
function is_user_role( $role, $user_id = null ) {
	$user = is_numeric( $user_id ) ? get_userdata( $user_id ) : wp_get_current_user();

	if( ! $user )
		return false;

	return in_array( $role, (array) $user->roles );
}

add_action( 'template_redirect', 'add_product_to_cart', 10, 1 );
// add the special product to the order
function add_product_to_cart() {
	$user_id = get_current_user_id();
	
    if ( is_user_role( 'customer', $user_id ) ) {
		if ( !has_bought_items() ) {
			$product_id = '13402'; // a product ID or a variation ID
			$quantity = 1; // The line item quantity
			
			$args = array(
				'customer_id'=> $user_id,
			);

			// Get an instance of the WC_Product object
			$product = wc_get_product( $product_id );

			// Create the order
			$order = wc_create_order( $args );

			// Add the product to the order
			$order->add_product( $product, $quantity );

			$order->calculate_totals(); // updating totals

			$order->save(); // Save the order data
			$order->update_status('completed', 'Order added programmatically!', true);
		}
	}
}