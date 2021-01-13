<?php
$i    = 0;
$rand = rand( 0, 1000 );
?>
<div class="mkdf-image-gallery mkdf-grid-list mkdf-grid-masonry-list mkdf-disable-bottom-space <?php echo esc_attr( $holder_classes ); ?>">
	<div class="mkdf-ig-inner mkdf-outer-space mkdf-masonry-list-wrapper">
		<div class="mkdf-masonry-grid-sizer"></div>
		<div class="mkdf-masonry-grid-gutter"></div>
		<?php foreach ( $images as $image ) { ?>
			<?php
			$image_classes    = '';
			$image_size_class = get_post_meta( $image['image_id'], 'image_gallery_masonry_image_size', true );
			$new_image_size   = $image_size;
			
			if ( ! empty( $image_size_class ) ) {
				$image_classes = 'mkdf-fixed-masonry-item mkdf-masonry-size-' . esc_attr( $image_size_class );
				
				if ( $image_size_class === 'large-width-height' ) {
					$new_image_size = 'full';
				} else if ( $image_size_class === 'small' ) {
					$new_image_size = 'foton_mikado_image_square';
				} else if ( $image_size_class === 'large-width' ) {
					$new_image_size = 'foton_mikado_image_landscape';
				} else if ( $image_size_class === 'large-height' ) {
					$new_image_size = 'foton_mikado_image_portrait';
				} else {
					$new_image_size = 'full';
				}
			}
			?>
			<div class="mkdf-ig-image mkdf-item-space <?php echo esc_attr( $image_classes ); ?>">
				<div class="mkdf-ig-image-inner">
					<?php if ( $image_behavior === 'lightbox' ) { ?>
						<a itemprop="image" class="mkdf-ig-lightbox" href="<?php echo esc_url( $image['url'] ); ?>" data-rel="prettyPhoto[image_gallery_pretty_photo-<?php echo esc_attr( $rand ); ?>]" title="<?php echo esc_attr( $image['title'] ); ?>">
					<?php } else if ( $image_behavior === 'custom-link' && ! empty( $custom_links ) ) { ?>
						<a itemprop="url" class="mkdf-ig-custom-link" href="<?php echo esc_url( $custom_links[ $i ++ ] ); ?>" target="<?php echo esc_attr( $custom_link_target ); ?>" title="<?php echo esc_attr( $image['title'] ); ?>">
					<?php } ?>
						<?php if ( is_array( $image_size ) && count( $image_size ) ) :
							echo foton_mikado_generate_thumbnail( $image['image_id'], null, $image_size[0], $image_size[1] );
						else:
							echo wp_get_attachment_image( $image['image_id'], $new_image_size );
						endif; ?>
					<?php if ( $image_behavior === 'lightbox' || $image_behavior === 'custom-link' ) { ?>
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>