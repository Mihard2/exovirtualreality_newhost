<?php if(comments_open()) { ?>
	<div class="mkdf-post-info-comments-holder">
		<a itemprop="url" class="mkdf-post-info-comments" href="<?php comments_link(); ?>">
            <i class="icon_comment_alt" aria-hidden="true"></i>
			<span><?php comments_number('0 '. esc_html__('Comments','foton'), '1 '.esc_html__('Comment','foton'), '% '.esc_html__('Comments','foton') ); ?></span>
		</a>
	</div>
<?php } ?>