<div class="mkdf-slide-from-header-bottom-holder">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<div class="mkdf-form-holder">
			<input type="text" placeholder="<?php esc_attr_e( 'Search', 'foton' ); ?>" name="s" class="mkdf-search-field" autocomplete="off" />
			<button type="submit" <?php foton_mikado_class_attribute( $search_submit_icon_class ); ?>>
				<?php echo foton_mikado_get_icon_sources_html( 'search', false, array( 'search' => 'yes' ) ); ?>
			</button>
		</div>
	</form>
</div>