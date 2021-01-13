<div class="mkdf-cc-item mkdf-item-space <?php echo esc_attr( $item_classes ); ?>">
	<?php if(!empty($link)) { ?>
	<a itemprop="url" class="mkdf-cc-link mkdf-block-drag-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
		<?php } ?>
		<div class="mkdf-cc-image-wrapper">
			<?php if(!empty($image)) { ?>
				<img itemprop="image" class="mkdf-cc-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
			<?php } ?>
			<?php if(!empty($hover_image)) { ?>
				<img itemprop="image" class="mkdf-cc-hover-image" src="<?php echo esc_url($hover_image['url']); ?>" alt="<?php echo esc_attr($hover_image['alt']); ?>" />
			<?php } ?>
		</div>
		<?php if(!empty($link)) { ?>
	</a>
<?php } ?>
</div>