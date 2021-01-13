<div class="mkdf-triple-frame-image-highlight-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-triple-frame-image-highlight">
        <div class="mkdf-tfih-inner">
            <?php 
                $images = array('centered', 'left', 'right');
            ?>
            <?php foreach ($images as $image) { ?>
                <div class="mkdf-tfih-image-holder mkdf-tfih-<?php echo "{$image}" ?>-image-holder">
                    <div class=mkdf-tfih-frame>
                        <div class="mkdf-tfih-top-bar">
                            <div class="mkdf-tfih-top-bar-left">
                                <span class="mkdf-tfih-dot"></span>
                                <span class="mkdf-tfih-dot"></span>
                                <span class="mkdf-tfih-dot"></span>
                            </div>
                            <div class="mkdf-tfih-top-bar-right">
                                <span class="mkdf-tfih-dot"></span>
                                <span class="mkdf-tfih-dot"></span>
                                <span class="mkdf-tfih-dot"></span>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty(${$image.'_image_link'})) { ?>
                        <a class="mkdf-tfih-link" 
                            href="<?php echo esc_url(${$image.'_image_link'}) ?>" 
                            target="<?php echo esc_attr($link_target) ?>">
                        </a>
                    <?php } ?>
                    <img class="mkdf-tfih-<?php echo "{$image}" ?>-image" 
                        src="<?php echo wp_get_attachment_url(${$image.'_image'}); ?>" 
                        alt="<?php echo get_the_title(${$image.'_image'}) ?>" />
                </div>
            <?php } ?>
        </div>
        <div class="mkdf-tfih-left-trigger"></div>
        <div class="mkdf-tfih-right-trigger"></div>
    </div>
    <?php if ($enable_navigation == 'yes') { ?>
        <span class="mkdf-tfih-nav mkdf-tfih-left">
            <svg viewBox="0 0 22 40" style="enable-background:new 0 0 22 40;" xml:space="preserve">
                <path d="M0.6,18.5L18.5,0.6c0.8-0.8,2-0.8,2.8,0c0.8,0.8,0.8,2,0,2.8L4.8,20l16.5,16.5c0.8,0.8,0.8,2,0,2.8  c-0.8,0.8-2,0.8-2.8,0L0.6,21.5C0.2,21.1,0,20.5,0,20C0,19.5,0.2,18.9,0.6,18.5z"/>
            </svg>
        </span>
        <span class="mkdf-tfih-nav mkdf-tfih-right">
            <svg viewBox="0 0 22 40" style="enable-background:new 0 0 22 40;" xml:space="preserve">
                <path d="M21.4,18.5L3.5,0.6c-0.8-0.8-2-0.8-2.8,0c-0.8,0.8-0.8,2,0,2.8L17.2,20L0.6,36.5c-0.8,0.8-0.8,2,0,2.8  c0.8,0.8,2,0.8,2.8,0l17.9-17.9c0.4-0.4,0.6-0.9,0.6-1.5C22,19.5,21.8,18.9,21.4,18.5z"/>
            </svg>
        </span>
    <?php } ?>
</div>
