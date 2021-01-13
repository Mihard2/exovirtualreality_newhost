<li class="mkdf-blog-slider-item">
    <div class="mkdf-blog-slider-item-inner">
        <div class="mkdf-item-image">
            <a itemprop="url" href="<?php echo get_permalink(); ?>">
                <?php echo get_the_post_thumbnail(get_the_ID(), $image_size); ?>
            </a>
        </div>
        <div class="mkdf-item-text-wrapper">
            <div class="mkdf-item-text-holder">
                <div class="mkdf-item-text-holder-inner">
                    <?php if($post_info_date == 'yes' || $post_info_category == 'yes' || $post_info_author == 'yes' || $post_info_comments == 'yes'){ ?>
                        <div class="mkdf-item-info-section">
                            <?php
                            if ($post_info_date == 'yes') {
                                foton_mikado_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params);
                            }
                            if ($post_info_category == 'yes') {
                                foton_mikado_get_module_template_part('templates/parts/post-info/category', 'blog', '', $params);
                            }
                            ?>
                        </div>
                    <?php } ?>

                    <?php foton_mikado_get_module_template_part('templates/parts/title', 'blog', '', $params); ?>

                    <?php foton_mikado_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $params); ?>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>