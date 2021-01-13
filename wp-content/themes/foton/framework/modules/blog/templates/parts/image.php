<?php
$image_size          = isset( $image_size ) ? $image_size : 'full';
$image_meta          = get_post_meta( get_the_ID(), 'mkdf_blog_list_featured_image_meta', true );
$has_featured        = ! empty( $image_meta ) || has_post_thumbnail();
$blog_list_image_id  = ! empty( $image_meta ) && foton_mikado_blog_item_has_link() ? foton_mikado_get_attachment_id_from_url( $image_meta ) : '';

$month = get_the_time('m');
$year = get_the_time('Y');
$title = get_the_title();
?>

<?php if ( $has_featured ) { ?>
    <?php if (!isset($post_info_date) || $post_info_date == 'yes') {?>
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
    <?php } ?>
	<div class="mkdf-post-image">
		<?php if ( foton_mikado_blog_item_has_link() ) { ?>
			<a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php } ?>
			<?php if ( ! empty( $blog_list_image_id ) ) {
				echo wp_get_attachment_image( $blog_list_image_id, $image_size );
			} else {
				the_post_thumbnail( $image_size );
			} ?>
		<?php if ( foton_mikado_blog_item_has_link() ) { ?>
			</a>
		<?php } ?>
		<?php do_action('foton_mikado_action_blog_inside_image_tag')?>
	</div>
<?php } ?>
