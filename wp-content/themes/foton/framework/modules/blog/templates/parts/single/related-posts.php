<?php
$show_related = foton_mikado_options()->getOptionValue('blog_single_related_posts') == 'yes' ? true : false;
$related_post_number = foton_mikado_sidebar_layout() === 'no-sidebar' ? 4 : 3;

if ($related_post_number == 4) {
	$related_col_number = 3;
} else $related_col_number = 4;

$related_posts_options = array(
    'posts_per_page' => $related_post_number
);
$related_posts = foton_mikado_get_blog_related_post_type(get_the_ID(), $related_posts_options);
$related_posts_image_size = isset($related_posts_image_size) ? $related_posts_image_size : 'full';

$month = get_the_time('m');
$year = get_the_time('Y');
$title = get_the_title();
?>
<?php if($show_related) { ?>
    <div class="mkdf-related-posts-holder clearfix">
        <div class="mkdf-related-posts-holder-inner">
            <?php if ( $related_posts && $related_posts->have_posts() ) : ?>
                <div class="mkdf-related-posts-title">
                    <h4><?php esc_html_e('Related Posts', 'foton' ); ?></h4>
                </div>
                <div class="mkdf-related-posts-inner mkdf-grid-row clearfix">
                    <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                        <div class="mkdf-related-post mkdf-grid-col-<?php echo esc_attr($related_col_number); ?>">
                            <div class="mkdf-related-post-inner">
			                    <?php if (has_post_thumbnail()) { ?>
                                    <div itemprop="dateCreated" class="mkdf-post-info-date-on-image entry-date published updated">
                                        <?php if (empty($title) && foton_mikado_blog_item_has_link()) { ?>
                                        <a itemprop="url" href="<?php the_permalink() ?>">
                                            <?php } else { ?>
                                        <a itemprop="url" href="<?php echo get_month_link($year, $month); ?>">
                                            <?php } ?>
                                            <div class="mkdf-post-info-date-day"><?php the_time('j'); ?> </div>
                                            <div class="mkdf-post-info-date-month"><?php the_time('M'); ?> </div>
                                        </a>
                                            <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(foton_mikado_get_page_id()); ?>"/>
                                    </div>
                                <div class="mkdf-related-post-image">
                                    <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php the_post_thumbnail($related_posts_image_size); ?>
                                    </a>
                                </div>
			                    <?php }	?>
                                <div class="mkdf-post-info-top">
                                    <?php foton_mikado_get_module_template_part('templates/parts/post-info/category', 'blog', ''); ?>
                                </div>
                                <h4 itemprop="name" class="entry-title mkdf-post-title"><a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                                <div class="mkdf-post-info">
                                    <?php foton_mikado_get_module_template_part('templates/parts/post-info/read-more', 'blog', '' ); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
<?php } ?>