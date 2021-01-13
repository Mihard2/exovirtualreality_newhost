<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner">
				<div class="mkdf-post-text-main">
                    <div class="mkdf-post-mark">
                        <span class="mkdf-quote-mark"><i class="fas fa-quote-left"></i></span>
                    </div>
                    <?php foton_mikado_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
                </div>
                <div class="mkdf-post-text-icon-main">
                    <span class="mkdf-quote-mark"><i class="fas fa-quote-left"></i></span>
                </div>
            </div>
        </div>
        <div class="mkdf-post-additional-content">
            <?php the_content(); ?>
        </div>
        <div class="mkdf-post-info-bottom clearfix">
            <div class="mkdf-post-info-bottom-left">
                <?php foton_mikado_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
            </div>
            <div class="mkdf-post-info-bottom-right">
                <?php foton_mikado_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                <?php foton_mikado_get_module_template_part('templates/parts/post-info/like', 'blog', '', $part_params); ?>
            </div>
        </div>
    </div>
</article>