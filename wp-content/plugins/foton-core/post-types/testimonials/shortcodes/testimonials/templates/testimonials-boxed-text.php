<div class="mkdf-testimonials-holder clearfix <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-testimonials mkdf-owl-slider mkdf-border-around" <?php echo foton_mikado_get_inline_attrs( $data_attr ) ?>>

        <?php if ( $query_results->have_posts() ):
            while ( $query_results->have_posts() ) : $query_results->the_post();
                $title    = get_post_meta( get_the_ID(), 'mkdf_testimonial_title', true );
                $text     = get_post_meta( get_the_ID(), 'mkdf_testimonial_text', true );
                $author   = get_post_meta( get_the_ID(), 'mkdf_testimonial_author', true );
                $position = get_post_meta( get_the_ID(), 'mkdf_testimonial_author_position', true );

                $current_id = get_the_ID();
                ?>

                <div class="mkdf-testimonial-content mkdf-testimonials<?php echo esc_attr($current_id) ?>">
                    <div class="mkdf-testimonial-content-inner">
                        <div class="mkdf-testimonial-text-holder">
                            <div class="mkdf-testimonial-text-inner">
                                <?php if ( ! empty( $title ) ) { ?>
                                    <h3 class="mkdf-testimonial-title">
                                        <?php echo esc_html( $title ); ?>
                                    </h3>
                                <?php }?>
                                <?php if ( ! empty( $text ) ) { ?>
                                    <p class="mkdf-testimonial-text"><?php echo esc_html( $text ); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="mkdf-testimonial-carousel-bottom">
                            <?php if ( has_post_thumbnail() ) { ?>
                                <div class="mkdf-testimonial-image">
                                    <?php echo get_the_post_thumbnail( get_the_ID(), array( 66, 66 ) ); ?>
                                </div>
                            <?php } ?>
                            <?php if ( ! empty( $author ) ) { ?>
                                <div class="mkdf-testimonial-author">
                                    <h5 class="mkdf-testimonials-author-name"><?php echo esc_html( $author ); ?></h5>
                                    <?php if ( ! empty( $position ) ) { ?>
                                        <h6 class="mkdf-testimonials-author-job"><?php echo esc_html( $position ); ?></h6>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php
            endwhile;
        else:
            echo esc_html__( 'Sorry, no posts matched your criteria.', 'foton-core' );
        endif;

        wp_reset_postdata();
        ?>

    </div>
</div>