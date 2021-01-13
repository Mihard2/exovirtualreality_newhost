<?php
$has_featured        = ! empty( $image_meta ) || has_post_thumbnail();
?>

<li class="mkdf-bl-item mkdf-item-space">
	<div class="mkdf-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			foton_mikado_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
        <div class="mkdf-bli-content">
            <?php if ($post_info_section == 'yes') { ?>
            <div class="mkdf-post-info-top">
	                <?php if ( $post_info_date == 'yes' ) {
		                if ($has_featured) : else :
                            foton_mikado_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params);
                        endif;
		            }
		            if ( $post_info_category == 'yes' ) {
			            foton_mikado_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		            }
	            ?>
            </div>
            <?php } ?>

	        <?php foton_mikado_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>

	        <div class="mkdf-bli-excerpt">
                <?php foton_mikado_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
            </div>
            <div class="mkdf-post-info-bottom clearfix">
                <div class="mkdf-post-info-bottom-left">
                    <?php foton_mikado_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params ); ?>
                </div>
                <div class="mkdf-post-info-bottom-right">
                    <?php if ( $post_info_share == 'yes' ) { ?>
                        <?php foton_mikado_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params ); ?>
                    <?php } ?>
                </div>
	        </div>
            <?php if ($post_info_section == 'yes') { ?>
            <div class="mkdf-post-info-bottom clearfix">
                <div class="mkdf-post-info-bottom-left">
                    <?php if ( $post_info_author == 'yes' ) { ?>
                        <?php foton_mikado_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params ); ?>
                    <?php } ?>
                </div>
                <div class="mkdf-post-info-bottom-right">
                    <?php if ( $post_info_comments == 'yes' ) { ?>
                        <?php foton_mikado_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params ); ?>
                    <?php } ?>
                    <?php if ( $post_info_like == 'yes' ) { ?>
                        <?php foton_mikado_get_module_template_part( 'templates/parts/post-info/like', 'blog', '', $params ); ?>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
	</div>
</li>