<?php
get_header();
foton_mikado_get_title();
do_action( 'foton_mikado_action_before_main_content' ); ?>
<div class="mkdf-container mkdf-default-page-template">
	<?php do_action( 'foton_mikado_action_after_container_open' ); ?>
	<div class="mkdf-container-inner clearfix">
		<?php
			$foton_taxonomy_id   = get_queried_object_id();
			$foton_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$foton_taxonomy      = ! empty( $foton_taxonomy_id ) ? get_term_by( 'id', $foton_taxonomy_id, $foton_taxonomy_type ) : '';
			$foton_taxonomy_slug = ! empty( $foton_taxonomy ) ? $foton_taxonomy->slug : '';
			$foton_taxonomy_name = ! empty( $foton_taxonomy ) ? $foton_taxonomy->taxonomy : '';
			
			foton_core_get_archive_portfolio_list( $foton_taxonomy_slug, $foton_taxonomy_name );
		?>
	</div>
	<?php do_action( 'foton_mikado_action_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
