<div class="mkdf-vertical-showcase mkdf-vs-ready-animation <?php echo esc_attr( $holder_classes ); ?>">
	<div class="mkdf-vs-holder">
		<div class="mkdf-vs-frame-holder play-video_btn" id="play-video_btn">
			<img src="../wp-content/plugins/foton-core/assets/img/mobile-frame-shadow.png" alt="Mobile frame image">
			<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 			viewBox="0 0 142.448 142.448" style="enable-background:new 0 0 142.448 142.448;" xml:space="preserve">
				<g>
					<path d="M142.411,68.9C141.216,31.48,110.968,1.233,73.549,0.038c-20.361-0.646-39.41,7.104-53.488,21.639
						C6.527,35.65-0.584,54.071,0.038,73.549c1.194,37.419,31.442,67.667,68.861,68.861c0.779,0.025,1.551,0.037,2.325,0.037
						c19.454,0,37.624-7.698,51.163-21.676C135.921,106.799,143.033,88.377,142.411,68.9z M111.613,110.336
						c-10.688,11.035-25.032,17.112-40.389,17.112c-0.614,0-1.228-0.01-1.847-0.029c-29.532-0.943-53.404-24.815-54.348-54.348
						c-0.491-15.382,5.122-29.928,15.806-40.958c10.688-11.035,25.032-17.112,40.389-17.112c0.614,0,1.228,0.01,1.847,0.029
						c29.532,0.943,53.404,24.815,54.348,54.348C127.91,84.76,122.296,99.306,111.613,110.336z"/>
					<path d="M94.585,67.086L63.001,44.44c-3.369-2.416-8.059-0.008-8.059,4.138v45.293
						c0,4.146,4.69,6.554,8.059,4.138l31.583-22.647C97.418,73.331,97.418,69.118,94.585,67.086z"/>
				</g>
			</svg>
		</div>
		<div class="mkdf-vs-stripe">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 3000 3000" style="" xml:space="preserve">
			<style type="text/css">
				.st0{fill-rule:evenodd;clip-rule:evenodd;fill:url(#SVGID_1_);}
			</style>
			<linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="1543.491" y1="1474.8508" x2="2952.8528" y2="659.8721">
				<stop offset="0" style="stop-color:#131217"></stop>
				<stop offset="1" style="stop-color:#292A33"></stop>
			</linearGradient>
			<path class="st0" d="M0,3000h3000V0c0,0-540,0-570.14,0C2071,0,1861.65,130,1500.33,130C1138.55,130,929,0,569.66,0  C539.99,0,0,0,0,0V3000L0,3000z" style=""></path>
		</svg>
		</div>
		<div class="mkdf-vs-frame-holder">
			<div class="mkdf-vs-frame-mobile-holder">
				<img src="../wp-content/plugins/foton-core/assets/img/mobile-frame-shadow.png"
				     alt="<?php esc_attr_e( 'Mobile frame image', 'foton-core' ); ?>">
				<div class="mkdf-vs-inner-frame"></div>
			</div>
		</div>
		<div class="mkdf-vs-frame-info mkdf-vs-frame-animate-out">
			<div class="mkdf-vs-frame-info-top">
				<div class="mkdf-vs-frame-title-image"></div>
				<div class="mkdf-vs-frame-title"></div>
				<div class="mkdf-vs-frame-subtitle"></div>
			</div>
			<div class="mkdf-vs-frame-info-bottom">
				<div class="mkdf-vs-frame-slide-number">01</div>
				<div class="mkdf-vs-frame-slide-text"></div>
				<?php if ( $bg_text !== "" ) { ?>
					<div class="mkdf-vs-frame-bg-text">
						<div class="mkdf-vs-frame-bg-text-placeholder"><?php echo esc_html( $bg_text ); ?></div>
						<div class="mkdf-vs-frame-bg-text-content"><?php echo esc_html( $bg_text ); ?></div>
					</div>
				<?php } ?>
			</div>
			<div class="mkdf-vs-frame-info-other">
				<?php if ( $enable_app_store_link == "yes" ) { ?>
					<a itemprop="url" class="mkdf-vs-item-app-store-link"
					   href="<?php echo esc_url( $app_store_link ); ?>" target="_blank">
						<img src="../wp-content/plugins/foton-core/assets/img/android.png"
						     alt="<?php esc_attr_e( 'Apple store logo', 'foton-core' ); ?>">
					</a>
				<?php } ?>
				<?php if ( $enable_play_store_link == "yes" ) { ?>
					<a itemprop="url" class="mkdf-vs-item-play-store-link"
					   href="<?php echo esc_url( $play_store_link ); ?>" target="_blank">
						<img src="../wp-content/plugins/foton-core/assets/img/ios.png"
						     alt="<?php esc_attr_e( 'Play store logo', 'foton-core' ); ?>">
					</a>
				<?php } ?>
			</div>
		</div>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php if ( ! empty( $link_items ) ) { ?>
					<?php foreach ( $link_items as $link_item ): ?>
						<div class="swiper-slide">
							<div class="mkdf-vs-item">
								<?php
								if ( isset( $params['elementor'] ) ) {
									$link_item['image']      = $link_item['image']['id'];
									$link_item['icon_image'] = $link_item['icon_image']['id'];
								}
								?>
								<?php if ( isset( $link_item['image'] ) ) { ?>
									<?php echo wp_get_attachment_image( $link_item['image'], 'full' ); ?>
								<?php } ?>
								<div class="mkdf-vs-item-info">
									<?php if ( isset( $link_item['slide_text'] ) ) { ?>
										<span class="mkdf-vs-item-slide-text">
	                                        <?php echo esc_html( $link_item['slide_text'] ); ?>
                                        </span>
									<?php } ?>
									<?php if ( isset( $link_item['icon_image'] ) ) { ?>
										<span class="mkdf-vs-item-title-image"><?php echo wp_get_attachment_image( $link_item['icon_image'], 'full' ); ?></span>
									<?php } ?>
									<?php if ( isset( $link_item['title'] ) ) { ?>
										<span class="mkdf-vs-item-title"><?php echo esc_html( $link_item['title'] ); ?></span>
									<?php } ?>
									<?php if ( isset( $link_item['subtitle'] ) ) { ?>
										<span class="mkdf-vs-item-subtitle"><?php echo esc_html( $link_item['subtitle'] ); ?></span>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					<div class="swiper-slide">
						<div class="mkdf-vs-contact-form">
							<div class="mkdf-vs-contact-form-info">
								<?php if ( ! empty( $contact_form_title ) ) { ?>
									<div class="mkdf-vs-contact-form-title">
										<h3><?php echo esc_html( $contact_form_title ); ?></h3>
									</div>
								<?php } ?>
								<?php if ( ! empty( $contact_form_subtitle ) ) { ?>
									<div class="mkdf-vs-contact-form-subtitle">
										<h3><?php echo esc_html( $contact_form_subtitle ); ?></h3>
									</div>
								<?php } ?>
							</div>
							<?php if ( ! empty( $contact_form ) ) {
								echo do_shortcode( '[contact-form-7 id="' . esc_attr( $contact_form ) . '"]' );
							} ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="swiper-pagination"></div>
	</div>
</div>
