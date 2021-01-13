<?php if ($enable_title === 'yes') {
	$title_tag = !empty($title_tag) ? $title_tag : 'h4';
	$title_styles = $this_object->getTitleStyles($params);
	?>
        <<?php echo esc_attr($title_tag); ?> itemprop="name" class="mkdf-pli-title entry-title" <?php foton_mikado_inline_style($title_styles); ?>>
            <a itemprop="url" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>">
            <?php echo esc_attr(get_the_title()); ?>
            </a>
        </<?php echo esc_attr($title_tag); ?>>

<?php } ?>