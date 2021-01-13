<?php
$image_meta          = get_post_meta( get_the_ID(), 'mkdf_blog_list_featured_image_meta', true );
$blog_list_image_id  = ! empty( $image_meta ) && foton_mikado_blog_item_has_link() ? foton_mikado_get_attachment_id_from_url( $image_meta ) : '';
?>

<li class="mkdf-blog-slider-item">
	<div class="mkdf-blog-slider-item-inner">
		<div class="mkdf-item-image">
			<a itemprop="url" href="<?php echo get_permalink(); ?>">
				<?php if ( ! empty( $blog_list_image_id ) ) {
					echo wp_get_attachment_image( $blog_list_image_id, $image_size );
				} else {
					the_post_thumbnail( $image_size );
				} ?>
			</a>
		</div>
		<div class="mkdf-bli-content">
			<?php foton_mikado_get_module_template_part('templates/parts/title', 'blog', '', $params); ?>
			
			<div class="mkdf-bli-excerpt">
				<?php foton_mikado_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
			</div>
		</div>
        <div class="mkdf-post-info-bottom clearfix">
            <?php foton_mikado_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params ); ?>
        </div>
	</div>
</li>