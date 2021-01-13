<?php

if ( ! function_exists( 'foton_mikado_woocommerce_body_class' ) ) {
	function foton_mikado_woocommerce_body_class( $classes ) {
		if ( foton_mikado_is_woocommerce_page() ) {
			$classes[] = 'mkdf-woocommerce-page';
			
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				$classes[] = 'mkdf-woo-main-page';
			}
			
			if ( is_singular( 'product' ) ) {
				$classes[] = 'mkdf-woo-single-page';
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'foton_mikado_woocommerce_body_class' );
}

if ( ! function_exists( 'foton_mikado_woocommerce_columns_class' ) ) {
	function foton_mikado_woocommerce_columns_class( $classes ) {
		
		if ( is_singular( 'product' ) ) {
			$classes[] = foton_mikado_options()->getOptionValue( 'mkdf_woo_related_products_columns' );
		} else {
			$classes[] = foton_mikado_options()->getOptionValue( 'mkdf_woo_product_list_columns' );
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'foton_mikado_woocommerce_columns_class' );
}

if ( ! function_exists( 'foton_mikado_woocommerce_columns_space_class' ) ) {
	function foton_mikado_woocommerce_columns_space_class( $classes ) {
		$woo_space_between_items = foton_mikado_options()->getOptionValue( 'mkdf_woo_product_list_columns_space' );
		
		if ( ! empty( $woo_space_between_items ) ) {
			$classes[] = 'mkdf-woo-' . $woo_space_between_items . '-space';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'foton_mikado_woocommerce_columns_space_class' );
}

if ( ! function_exists( 'foton_mikado_woocommerce_pl_info_position_class' ) ) {
	function foton_mikado_woocommerce_pl_info_position_class( $classes ) {
		$info_position       = foton_mikado_options()->getOptionValue( 'mkdf_woo_product_list_info_position' );
		$info_position_class = '';
		
		if ( $info_position === 'info_below_image' ) {
			$info_position_class = 'mkdf-woo-pl-info-below-image';
		} else if ( $info_position === 'info_on_image_hover' ) {
			$info_position_class = 'mkdf-woo-pl-info-on-image-hover';
		}
		
		$classes[] = $info_position_class;
		
		return $classes;
	}
	
	add_filter( 'body_class', 'foton_mikado_woocommerce_pl_info_position_class' );
}

if ( ! function_exists( 'foton_mikado_add_woocommerce_shortcode_class' ) ) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return string
	 */
	function foton_mikado_add_woocommerce_shortcode_class( $classes ) {
		$woocommerce_shortcodes = array(
			'woocommerce_order_tracking'
		);
		
		foreach ( $woocommerce_shortcodes as $woocommerce_shortcode ) {
			$has_shortcode = foton_mikado_has_shortcode( $woocommerce_shortcode );
			
			if ( $has_shortcode ) {
				$classes[] = 'mkdf-woocommerce-page woocommerce-account mkdf-' . str_replace( '_', '-', $woocommerce_shortcode );
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'foton_mikado_add_woocommerce_shortcode_class' );
}

if ( ! function_exists( 'foton_mikado_woo_single_product_thumb_position_class' ) ) {
	function foton_mikado_woo_single_product_thumb_position_class( $classes ) {
		$product_thumbnail_position = foton_mikado_get_meta_field_intersect( 'woo_set_thumb_images_position' );
		
		if ( ! empty( $product_thumbnail_position ) ) {
			$classes[] = 'mkdf-woo-single-thumb-' . $product_thumbnail_position;
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'foton_mikado_woo_single_product_thumb_position_class' );
}

if ( ! function_exists( 'foton_mikado_woo_single_product_has_zoom_class' ) ) {
	function foton_mikado_woo_single_product_has_zoom_class( $classes ) {
		$zoom_maginifier = foton_mikado_get_meta_field_intersect( 'woo_enable_single_product_zoom_image' );
		
		if ( $zoom_maginifier === 'yes' ) {
			$classes[] = 'mkdf-woo-single-has-zoom';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'foton_mikado_woo_single_product_has_zoom_class' );
}

if ( ! function_exists( 'foton_mikado_woo_single_product_has_zoom_support' ) ) {
	function foton_mikado_woo_single_product_has_zoom_support() {
		$zoom_maginifier = foton_mikado_get_meta_field_intersect( 'woo_enable_single_product_zoom_image' );
		
		if ( $zoom_maginifier === 'yes' ) {
			add_theme_support( 'wc-product-gallery-zoom' );
		}
	}
	
	add_action( 'init', 'foton_mikado_woo_single_product_has_zoom_support' );
}

if ( ! function_exists( 'foton_mikado_woo_single_product_image_behavior_class' ) ) {
	function foton_mikado_woo_single_product_image_behavior_class( $classes ) {
		$image_behavior = foton_mikado_get_meta_field_intersect( 'woo_set_single_images_behavior' );
		
		if ( ! empty( $image_behavior ) ) {
			$classes[] = 'mkdf-woo-single-has-' . $image_behavior;
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'foton_mikado_woo_single_product_image_behavior_class' );
}

if ( ! function_exists( 'foton_mikado_woo_single_product_photo_swipe_support' ) ) {
	function foton_mikado_woo_single_product_photo_swipe_support() {
		$image_behavior = foton_mikado_get_meta_field_intersect( 'woo_set_single_images_behavior' );
		
		if ( $image_behavior === 'photo-swipe' ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
	}
	
	add_action( 'init', 'foton_mikado_woo_single_product_photo_swipe_support' );
}

if ( ! function_exists( 'foton_mikado_woocommerce_products_per_page' ) ) {
	/**
	 * Function that sets number of products per page. Default is 9
	 * @return int number of products to be shown per page
	 */
	function foton_mikado_woocommerce_products_per_page() {
		$products_per_page_meta = foton_mikado_options()->getOptionValue( 'mkdf_woo_products_per_page' );
		$products_per_page      = ! empty( $products_per_page_meta ) ? intval( $products_per_page_meta ) : 12;
		
		return $products_per_page;
	}
	
	add_filter('loop_shop_per_page', 'foton_mikado_woocommerce_products_per_page', 20);
}

if ( ! function_exists( 'foton_mikado_woocommerce_related_products_args' ) ) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 *
	 * @param $args array array of args for the query
	 *
	 * @return mixed array of changed args
	 */
	function foton_mikado_woocommerce_related_products_args( $args ) {
		$related = foton_mikado_options()->getOptionValue( 'mkdf_woo_related_products_columns' );
		
		if ( ! empty( $related ) ) {
			switch ( $related ) {
				case 'mkdf-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'mkdf-woocommerce-columns-3':
					$args['posts_per_page'] = 3;
					break;
				default:
					$args['posts_per_page'] = 3;
			}
		} else {
			$args['posts_per_page'] = 4;
		}
		
		return $args;
	}
	
	add_filter('woocommerce_output_related_products_args', 'foton_mikado_woocommerce_related_products_args');
}

if ( ! function_exists( 'foton_mikado_woocommerce_product_thumbnail_column_size' ) ) {
	/**
	 * Function that sets number of thumbnails on single product page per row. Default is 4
	 * @return int number of thumbnails to be shown on single product page per row
	 */
	function foton_mikado_woocommerce_product_thumbnail_column_size() {
		$thumbs_number_meta = foton_mikado_options()->getOptionValue( 'woo_number_of_thumb_images' );
		$thumbs_number      = ! empty ( $thumbs_number_meta ) ? intval( $thumbs_number_meta ) : 4;
		
		return apply_filters( 'foton_mikado_filter_number_of_thumbnails_per_row_single_product', $thumbs_number );
	}
	
	add_filter( 'woocommerce_product_thumbnails_columns', 'foton_mikado_woocommerce_product_thumbnail_column_size', 10 );
}

if ( ! function_exists( 'foton_mikado_single_product_show_product_thumbnails' ) ) {
	function foton_mikado_single_product_show_product_thumbnails() {
		global $product;
		
		$attachment_ids = $product->get_gallery_image_ids();
		
		if ( $attachment_ids && has_post_thumbnail() ) {
			foreach ( $attachment_ids as $attachment_id ) {
				$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
				$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'woocommerce_thumbnail' );
				$attributes      = array(
					'title'                   => get_post_field( 'post_title', $attachment_id ),
					'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
				);
				
				$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
				$html .= wp_get_attachment_image( $attachment_id, 'woocommerce_thumbnail', false, $attributes );
				$html .= '</a></div>';
				
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
			}
		}
	}
}

if ( ! function_exists( 'foton_mikado_woocommerce_template_loop_product_title' ) ) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function foton_mikado_woocommerce_template_loop_product_title() {
		$tag = foton_mikado_options()->getOptionValue( 'mkdf_products_list_title_tag' );
		if ( $tag === '' ) {
			$tag = 'h5';
		}
		
		the_title( '<' . $tag . ' class="mkdf-product-list-title"><a href="' . get_the_permalink() . '">', '</a></' . $tag . '>' );
	}
}

if ( ! function_exists( 'foton_mikado_woocommerce_template_single_title' ) ) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function foton_mikado_woocommerce_template_single_title() {
		$tag = foton_mikado_options()->getOptionValue( 'mkdf_single_product_title_tag' );
		if ( $tag === '' ) {
			$tag = 'h1';
		}
		
		the_title( '<' . $tag . '  itemprop="name" class="mkdf-single-product-title">', '</' . $tag . '>' );
	}
}

if ( ! function_exists( 'foton_mikado_woocommerce_sale_flash' ) ) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function foton_mikado_woocommerce_sale_flash() {
		global $product;
		
		if ( ! empty( $product ) ) {
			return '<span class="mkdf-onsale">' . foton_mikado_get_woocommerce_sale( $product ) . '</span>';
		}
	}
	
	add_filter( 'woocommerce_sale_flash', 'foton_mikado_woocommerce_sale_flash' );
}

if ( ! function_exists( 'foton_mikado_woocommerce_product_out_of_stock' ) ) {
	/**
	 * Function for adding Out Of Stock Template
	 *
	 * @return string
	 */
	function foton_mikado_woocommerce_product_out_of_stock() {
		global $product;
		
		if ( ! $product->is_in_stock() ) {
			print '<span class="mkdf-out-of-stock">' . esc_html__( 'Sold', 'foton' ) . '</span>';
		}
	}
	
	add_filter( 'woocommerce_product_thumbnails', 'foton_mikado_woocommerce_product_out_of_stock', 20 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'foton_mikado_woocommerce_product_out_of_stock', 10 );
}

if ( ! function_exists( 'foton_mikado_woocommerce_new_flash' ) ) {
	/**
	 * Function for adding new flash template
	 *
	 * @return string
	 */
	function foton_mikado_woocommerce_new_flash() {
		$new = get_post_meta( get_the_ID(), 'mkdf_show_new_sign_woo_meta', true );
		
		if ( $new === 'yes' ) {
			print '<span class="mkdf-new-product">' . esc_html__( 'New', 'foton' ) . '</span>';
		}
	}
	
	add_filter( 'woocommerce_product_thumbnails', 'foton_mikado_woocommerce_new_flash', 21 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'foton_mikado_woocommerce_new_flash', 11 );
}

if ( ! function_exists( 'foton_mikado_single_product_content_additional_tag_before' ) ) {
	function foton_mikado_single_product_content_additional_tag_before() {
		
		print '<div class="mkdf-single-product-content">';
	}
}

if ( ! function_exists( 'foton_mikado_single_product_content_additional_tag_after' ) ) {
	function foton_mikado_single_product_content_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'foton_mikado_single_product_summary_additional_tag_before' ) ) {
	function foton_mikado_single_product_summary_additional_tag_before() {
		
		print '<div class="mkdf-single-product-summary">';
	}
}

if ( ! function_exists( 'foton_mikado_single_product_summary_additional_tag_after' ) ) {
	function foton_mikado_single_product_summary_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'foton_mikado_pl_holder_additional_tag_before' ) ) {
	function foton_mikado_pl_holder_additional_tag_before() {
		
		print '<div class="mkdf-pl-main-holder">';
	}
}

if ( ! function_exists( 'foton_mikado_pl_holder_additional_tag_after' ) ) {
	function foton_mikado_pl_holder_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'foton_mikado_pl_inner_additional_tag_before' ) ) {
	function foton_mikado_pl_inner_additional_tag_before() {
		
		print '<div class="mkdf-pl-inner">';
	}
}

if ( ! function_exists( 'foton_mikado_pl_inner_additional_tag_after' ) ) {
	function foton_mikado_pl_inner_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'foton_mikado_pl_image_additional_tag_before' ) ) {
	function foton_mikado_pl_image_additional_tag_before() {
		
		print '<div class="mkdf-pl-image">';
	}
}

if ( ! function_exists( 'foton_mikado_pl_image_additional_tag_after' ) ) {
	function foton_mikado_pl_image_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'foton_mikado_pl_inner_text_additional_tag_before' ) ) {
	function foton_mikado_pl_inner_text_additional_tag_before() {
		
		print '<div class="mkdf-pl-text"><div class="mkdf-pl-text-outer"><div class="mkdf-pl-text-inner">';
	}
}

if ( ! function_exists( 'foton_mikado_pl_inner_text_additional_tag_after' ) ) {
	function foton_mikado_pl_inner_text_additional_tag_after() {
		
		print '</div></div></div>';
	}
}

if ( ! function_exists( 'foton_mikado_pl_text_wrapper_additional_tag_before' ) ) {
	function foton_mikado_pl_text_wrapper_additional_tag_before() {
		
		print '<div class="mkdf-pl-text-wrapper">';
	}
}

if ( ! function_exists( 'foton_mikado_pl_text_wrapper_additional_tag_after' ) ) {
	function foton_mikado_pl_text_wrapper_additional_tag_after() {
		
		print '</div>';
	}
}

if ( ! function_exists( 'foton_mikado_pl_rating_additional_tag_before' ) ) {
	function foton_mikado_pl_rating_additional_tag_before() {
		global $product;
		
		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
			$rating_html = wc_get_rating_html( $product->get_average_rating() );
			
			if ( $rating_html !== '' ) {
				print '<div class="mkdf-pl-rating-holder">';
			}
		}
	}
}

if ( ! function_exists( 'foton_mikado_pl_rating_additional_tag_after' ) ) {
	function foton_mikado_pl_rating_additional_tag_after() {
		global $product;
		
		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
			$rating_html = wc_get_rating_html( $product->get_average_rating() );
			
			if ( $rating_html !== '' ) {
				print '</div>';
			}
		}
	}
}

if ( ! function_exists( 'foton_mikado_woocommerce_share' ) ) {
	/**
	 * Function that social share for product page
	 *
	 * @see foton_mikado_get_social_share_html - available params type, icon_type and title
	 *
	 * Return social share html
	 */
	function foton_mikado_woocommerce_share() {
		if ( foton_mikado_core_plugin_installed() && foton_mikado_options()->getOptionValue( 'enable_social_share' ) == 'yes' && foton_mikado_options()->getOptionValue( 'enable_social_share_on_product' ) == 'yes' ) :
			echo '<div class="mkdf-woo-social-share-holder">';
			echo foton_mikado_get_social_share_html( array( 'type' => 'list', 'title' => esc_attr__('Share:', 'foton') ) );
			echo '</div>';
		endif;
	}
}

if ( ! function_exists( 'foton_mikado_woocommerce_single_product_title' ) ) {
	/**
	 * Function that checks option for single product title and overrides it with filter
	 */
	function foton_mikado_woocommerce_single_product_title( $show_title_area ) {
		if ( is_singular( 'product' ) ) {
			$woo_title_meta = get_post_meta( get_the_ID(), 'mkdf_show_title_area_woo_meta', true );
			
			if ( empty( $woo_title_meta ) ) {
				$woo_title_main = foton_mikado_options()->getOptionValue( 'show_title_area_woo' );
				
				if ( ! empty( $woo_title_main ) ) {
					$show_title_area = $woo_title_main == 'yes' ? true : false;
				}
			} else {
				$show_title_area = $woo_title_meta == 'yes' ? true : false;
			}
		}
		
		return $show_title_area;
	}
	
	add_filter( 'foton_mikado_filter_show_title_area', 'foton_mikado_woocommerce_single_product_title' );
}

if ( ! function_exists( 'foton_mikado_set_title_text_output_for_woocommerce' ) ) {
	function foton_mikado_set_title_text_output_for_woocommerce( $title ) {
		
		if ( is_product_category() || is_product_tag() ) {
			global $wp_query;
			
			$tax            = $wp_query->get_queried_object();
			$category_title = $tax->name;
			$title          = $category_title;
		} elseif ( foton_mikado_is_woocommerce_shop() || is_singular( 'product' ) ) {
			$shop_id = foton_mikado_get_woo_shop_page_id();
			$title   = $shop_id !== -1 ? get_the_title( $shop_id ) : esc_html__( 'Shop', 'foton' );
		}
		
		return $title;
	}
	
	add_filter( 'foton_mikado_filter_title_text', 'foton_mikado_set_title_text_output_for_woocommerce' );
}

if ( ! function_exists( 'foton_mikado_set_breadcrumbs_output_for_woocommerce' ) ) {
	function foton_mikado_set_breadcrumbs_output_for_woocommerce( $childContent, $delimiter, $before, $after ) {
		$shop_id = foton_mikado_get_woo_shop_page_id();
		
		if ( foton_mikado_is_product_category() || foton_mikado_is_product_tag() ) {
			$childContent = '';
			
			if ( ! empty( $shop_id ) && $shop_id !== -1 ) {
				$childContent .= '<a itemprop="url" href="' . get_permalink( $shop_id ) . '">' . get_the_title( $shop_id ) . '</a>' . $delimiter;
			}
			
			$mkdf_taxonomy_id        = get_queried_object_id();
			$mkdf_taxonomy_type      = is_tax( 'product_tag' ) ? 'product_tag' : 'product_cat';
			$mkdf_taxonomy           = ! empty( $mkdf_taxonomy_id ) ? get_term_by( 'id', $mkdf_taxonomy_id, $mkdf_taxonomy_type ) : '';
			$mkdf_taxonomy_parent_id = isset( $mkdf_taxonomy->parent ) && $mkdf_taxonomy->parent !== 0 ? $mkdf_taxonomy->parent : '';
			$mkdf_taxonomy_parent    = $mkdf_taxonomy_parent_id !== '' ? get_term_by( 'id', $mkdf_taxonomy_parent_id, $mkdf_taxonomy_type ) : '';
			
			if ( ! empty( $mkdf_taxonomy_parent ) ) {
				$childContent .= '<a itemprop="url" href="' . get_term_link( $mkdf_taxonomy_parent->term_id ) . '">' . $mkdf_taxonomy_parent->name . '</a>' . $delimiter;
			}
			
			if ( ! empty( $mkdf_taxonomy ) ) {
				$childContent .= $before . esc_attr( $mkdf_taxonomy->name ) . $after;
			}
			
		} elseif ( is_singular( 'product' ) ) {
			$childContent = '';
			$product      = wc_get_product( get_the_ID() );
			$categories   = ! empty( $product ) ? wc_get_product_category_list( $product->get_id(), ', ' ) : '';
			
			if ( ! empty( $shop_id ) && $shop_id !== -1 ) {
				$childContent .= '<a itemprop="url" href="' . get_permalink( $shop_id ) . '">' . get_the_title( $shop_id ) . '</a>' . $delimiter;
			}
			
			if ( ! empty( $categories ) ) {
				$childContent .= $categories . $delimiter;
			}
			
			$childContent .= $before . get_the_title() . $after;
			
		} elseif ( foton_mikado_is_woocommerce_shop() ) {
			$childContent = $before . get_the_title( $shop_id ) . $after;
		}
		
		return $childContent;
	}
	
	add_filter( 'foton_mikado_filter_breadcrumbs_title_child_output', 'foton_mikado_set_breadcrumbs_output_for_woocommerce', 10, 4 );
}

if ( ! function_exists( 'foton_mikado_set_sidebar_layout_for_woocommerce' ) ) {
	function foton_mikado_set_sidebar_layout_for_woocommerce( $sidebar_layout ) {
		
		if ( is_archive() && ( is_product_category() || is_product_tag() ) ) {
			$sidebar_layout = foton_mikado_get_meta_field_intersect( 'sidebar_layout', foton_mikado_get_woo_shop_page_id() );
		}
		
		return $sidebar_layout;
	}
	
	add_filter( 'foton_mikado_filter_sidebar_layout', 'foton_mikado_set_sidebar_layout_for_woocommerce' );
}

if ( ! function_exists( 'foton_mikado_set_sidebar_name_for_woocommerce' ) ) {
	function foton_mikado_set_sidebar_name_for_woocommerce( $sidebar_name ) {
		
		if ( is_archive() && ( is_product_category() || is_product_tag() ) ) {
			$sidebar_name = foton_mikado_get_meta_field_intersect( 'custom_sidebar_area', foton_mikado_get_woo_shop_page_id() );
		}
		
		return $sidebar_name;
	}
	
	add_filter( 'foton_mikado_filter_sidebar_name', 'foton_mikado_set_sidebar_name_for_woocommerce' );
}

if ( ! function_exists( 'foton_mikado_single_product_summary_meta_additional_title' ) ) {
	function foton_mikado_single_product_summary_meta_additional_title() {
		
		print '<div class="mkdf-single-product-meta-title"><span>' . esc_html__( 'Quick info', 'foton' ) . '</span></div>';
	}
}

if (!function_exists('foton_mikado_pl_category')) {
    function foton_mikado_pl_category() {
        $product            = foton_mikado_return_woocommerce_global_variable();
        $product_categories = wc_get_product_category_list( $product->get_id(), ' & ' );

        if (!empty($product_categories)) { ?>
            <span class="mkdf-pl-category"><?php echo wp_kses_post($product_categories); ?></span>
        <?php }
    }
}