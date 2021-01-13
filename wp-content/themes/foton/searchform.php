<form role="search" method="get" class="searchform" id="searchform-<?php echo esc_attr(rand(0, 1000)); ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text"><?php esc_html_e( 'Search for:', 'foton' ); ?></label>
	<div class="input-holder clearfix">
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search', 'foton' ); ?>" value="" name="s" title="<?php esc_attr_e( 'Search for:', 'foton' ); ?>"/>
		<button type="submit" class="mkdf-search-submit"><?php echo foton_mikado_icon_collections()->renderIcon( 'icon_search', 'font_elegant' ); ?></button>
	</div>
</form>