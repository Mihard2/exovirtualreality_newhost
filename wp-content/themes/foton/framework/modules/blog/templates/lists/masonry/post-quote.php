<?php
$post_classes[] = 'mkdf-item-space';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
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
    </div>
</article>