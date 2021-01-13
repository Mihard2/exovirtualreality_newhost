<?php

foton_mikado_get_single_post_format_html( $blog_single_type );

do_action( 'foton_mikado_action_after_article_content' );

foton_mikado_get_module_template_part( 'templates/parts/single/author-info', 'blog' );

foton_mikado_get_module_template_part( 'templates/parts/single/single-navigation', 'blog' );

foton_mikado_get_module_template_part( 'templates/parts/single/related-posts', 'blog', '', $single_info_params );

foton_mikado_get_module_template_part( 'templates/parts/single/comments', 'blog' );