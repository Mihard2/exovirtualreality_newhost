<div class="swiper-container mkdf-horizontal-layer-slider full-page" <?php foton_mikado_inline_style( $slider_styles ); ?> <?php echo foton_mikado_get_inline_attrs( $data_params ); ?>>
	<div class="swiper-wrapper">
		<?php foreach ( $params['horizontal_layer_slider_items'] as $hlsi ) :
			$slide_styles = array();
			
			if ( ! empty( $hlsi['background_image'] ) ) {
				$hlsi['background_image'] = $hlsi['background_image']['id'];
			}
			
			if ( ! empty( $hlsi['parallax_image'] ) ) {
				$hlsi['parallax_image'] = $hlsi['parallax_image']['id'];
			}
			
			$slide_styles[] = 'background-image: url(' . wp_get_attachment_url( $hlsi['background_image'] ) . ')';
			?>
			
			<div class="swiper-slide" <?php foton_mikado_inline_style( $slide_styles ); ?>>
				<?php if ( ! empty( $hlsi['parallax_image'] ) ) { ?>
					<div class="mkdf-slide-parallax-image-holder">
						<div class="mkdf-slide-parallax-image" data-swiper-parallax="-50%">
							<?php echo wp_get_attachment_image( $hlsi['parallax_image'], 'full' ); ?>
						</div>
					</div>
				<?php } ?>
				<?php if ( ! empty( $hlsi['link'] ) ) { ?>
					<a href="<?php echo esc_url( $hlsi['link'] ) ?>"
					   target="<?php echo esc_attr( $hlsi['target'] ) ?>">
					</a>
				<?php } ?>
			</div>
		
		<?php endforeach; ?>
	</div>
	
	<div class="swiper-navigation">
		<span class="mkdf-swiper-button-prev mkdf-swiper-button"><span class="arrow_carrot-left"></span></span>
		<span class="mkdf-swiper-button-next mkdf-swiper-button"><span class="arrow_carrot-right"></span></span>
	</div>

</div>