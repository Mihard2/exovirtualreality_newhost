<?php if ( foton_mikado_options()->getOptionValue( 'enable_social_share' ) == 'yes' && foton_mikado_options()->getOptionValue( 'enable_social_share_on_portfolio-item' ) == 'yes' ) : ?>
	<div class="mkdf-ps-info-item mkdf-ps-social-share">
		<?php
		/**
		 * Available params type, icon_type and title
		 *
		 * Return social share html
		 */
		echo foton_mikado_get_social_share_html( array( 'type'  => 'list', 'title' => esc_attr__( 'Share', 'foton-core' ) ) ); ?>
	</div>
<?php endif; ?>