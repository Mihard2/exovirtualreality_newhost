<?php
$has_featured        = ! empty( $image_meta ) || has_post_thumbnail();
?>

<li class="mkdf-bl-item mkdf-item-space clearfix">
	<div class="mkdf-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			foton_mikado_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
		<div class="mkdf-bli-content">
			<?php foton_mikado_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
            <?php if ($has_featured) : else : ?>
                <?php foton_mikado_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
            <?php endif; ?>
		</div>
	</div>
</li>