<div class="mkdf-fullscreen-with-sidebar-search-holder">
	<a <?php foton_mikado_class_attribute( $search_close_icon_class ); ?> href="javascript:void(0)">
		<?php echo foton_mikado_get_icon_sources_html( 'search', true, array( 'search' => 'yes' ) ); ?>
	</a>
	<div class="mkdf-fullscreen-search-table">
		<div class="mkdf-fullscreen-search-cell">
			<div class="mkdf-fullscreen-search-inner  <?php echo esc_attr($search_in_grid); ?>">
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="mkdf-fullscreen-search-form" method="get">
					<div class="mkdf-form-holder">
						<div class="mkdf-form-holder-inner">
							<div class="mkdf-field-holder">
								<input type="text" placeholder="<?php esc_attr_e( 'Search', 'foton' ); ?>" name="s" class="mkdf-search-field" autocomplete="off"/>
							</div>
							<button type="submit" <?php foton_mikado_class_attribute( $search_submit_icon_class ); ?>>
								<?php echo foton_mikado_get_icon_sources_html( 'search', false, array( 'search' => 'yes' ) ); ?>
							</button>
						</div>
					</div>
				</form>
                <div class="mkdf-fullscreen-sidebar">
                    <?php foton_mikado_get_fullscreen_sidebar(); ?>
                </div>
			</div>
		</div>
	</div>
</div>