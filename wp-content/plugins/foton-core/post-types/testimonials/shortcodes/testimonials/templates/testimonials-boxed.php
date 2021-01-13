<div class="mkdf-testimonials-holder clearfix <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-testimonials mkdf-owl-slider" <?php echo foton_mikado_get_inline_attrs( $data_attr ) ?>>

        <?php if ( $query_results->have_posts() ):
            while ( $query_results->have_posts() ) : $query_results->the_post();
                $title    = get_post_meta( get_the_ID(), 'mkdf_testimonial_title', true );
                $text     = get_post_meta( get_the_ID(), 'mkdf_testimonial_text', true );
                $author   = get_post_meta( get_the_ID(), 'mkdf_testimonial_author', true );
                $position = get_post_meta( get_the_ID(), 'mkdf_testimonial_author_position', true );
                $current_id = get_the_ID();
        ?>

                <div class="mkdf-testimonial-content" id="mkdf-testimonials-<?php echo esc_attr( $current_id ) ?>" <?php foton_mikado_inline_style( $box_styles ); ?>>
                    <div class="mkdf-testimonial-text-holder">
                        <?php if ( ! empty( $text ) ) { ?>
                            <p class="mkdf-testimonial-text"><?php echo esc_html( $text ); ?></p>
                        <?php } ?>
                        <?php if ( has_post_thumbnail() || ! empty( $author ) ) { ?>
                            <div class="mkdf-testimonials-author-holder clearfix">
                                <?php if ( has_post_thumbnail() ) { ?>
                                    <div class="mkdf-testimonial-image">
                                        <?php echo get_the_post_thumbnail( get_the_ID(), array( 85, 85 ) ); ?>
                                    </div>
                                <?php } ?>
                                <?php if ( ! empty( $author ) ) { ?>
                                    <h4 class="mkdf-testimonial-author">
                                        <span class="mkdf-testimonials-author-name"><?php echo esc_html( $author ); ?></span>
                                        <?php if ( ! empty( $position ) ) { ?>
                                            <span class="mkdf-testimonials-author-job"><?php echo esc_html( $position ); ?></span>
                                        <?php } ?>
                                    </h4>
                                <?php } ?>
                            </div>
                        <?php } ?>
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