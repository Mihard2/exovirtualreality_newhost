<?php
$mkdf_sidebar_layout  = foton_mikado_sidebar_layout();
$mkdf_grid_space_meta = foton_mikado_get_meta_field_intersect( 'page_grid_space' );
$mkdf_holder_classes  = ! empty( $mkdf_grid_space_meta ) ? 'mkdf-grid-' . $mkdf_grid_space_meta . '-gutter' : '';

get_header();
foton_mikado_get_title();
get_template_part( 'slider' );
do_action('foton_mikado_action_before_main_content');
?>

<div class="mkdf-container mkdf-default-page-template">
	<?php do_action( 'foton_mikado_action_after_container_open' ); ?>
	
	<div class="mkdf-container-inner clearfix">
        <?php do_action( 'foton_mikado_action_after_container_inner_open' ); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="mkdf-grid-row <?php echo esc_attr( $mkdf_holder_classes ); ?>">
				<div <?php echo foton_mikado_get_content_sidebar_class(); ?>>
					<?php
						the_content();
						do_action( 'foton_mikado_action_page_after_content' );
					?>
				</div>
				<?php if ( $mkdf_sidebar_layout !== 'no-sidebar' ) { ?>
					<div <?php echo foton_mikado_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
        <?php do_action( 'foton_mikado_action_before_container_inner_close' ); ?>
	</div>
	
	<?php do_action( 'foton_mikado_action_before_container_close' ); ?>
</div>

<?php get_footer(); ?>