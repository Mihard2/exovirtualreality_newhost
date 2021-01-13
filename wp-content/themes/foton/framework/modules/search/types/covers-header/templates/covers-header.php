<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="mkdf-search-cover" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="mkdf-container">
		<div class="mkdf-container-inner clearfix">
	<?php } ?>
			<div class="mkdf-form-holder-outer">
				<div class="mkdf-form-holder">
					<div class="mkdf-form-holder-inner">
						<span aria-hidden="true" class="mkdf-icon-font-elegant icon_search" style="float:left; font-size: 20px;"></span>
						<input type="text" placeholder="<?php esc_attr_e( 'Type your search...', 'foton' ); ?>" name="s" class="mkdf_search_field" autocomplete="off" />
						<a <?php foton_mikado_class_attribute( $search_close_icon_class ); ?> href="#">
							<?php echo foton_mikado_get_icon_sources_html( 'search', true, array( 'search' => 'yes' ) ); ?>
						</a>
					</div>
				</div>
			</div>
	<?php if ( $search_in_grid ) { ?>
		</div>
	</div>
	<?php } ?>
</form>