<?php

if ( class_exists( 'FotonCoreClassWidget' ) ) {
    class FotonMikadoClassAuthorInfoWidget extends FotonCoreClassWidget {
        public function __construct() {
            parent::__construct(
                'mkdf_author_info_widget',
                esc_html__( 'Foton Author Info Widget', 'foton' ),
                array( 'description' => esc_html__( 'Add author info element to widget areas', 'foton' ) )
            );

            $this->setParams();
        }

        protected function setParams() {
            $this->params = array(
                array(
                    'type'  => 'textfield',
                    'name'  => 'extra_class',
                    'title' => esc_html__( 'Custom CSS Class', 'foton' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'widget_bottom_margin',
                    'title' => esc_html__( 'Widget Bottom Margin (px)', 'foton' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'author_username',
                    'title' => esc_html__( 'Author Username', 'foton' )
                )
            );
        }

        public function widget( $args, $instance ) {
            extract( $args );

            $extra_class = '';
            if ( ! empty( $instance['extra_class'] ) ) {
                $extra_class = $instance['extra_class'];
            }

            $widget_styles = array();
            if ( isset( $instance['widget_bottom_margin'] ) && $instance['widget_bottom_margin'] !== '' ) {
                $widget_styles[] = 'margin-bottom: ' . foton_mikado_filter_px( $instance['widget_bottom_margin'] ) . 'px';
            }

            $authorID = 1;
            if ( ! empty( $instance['author_username'] ) ) {
                $author = get_user_by( 'login', $instance['author_username'] );

                if ( $author ) {
                    $authorID = $author->ID;
                }
            }

            $author_first_name = get_the_author_meta( 'first_name', $authorID);
            $author_last_name = get_the_author_meta( 'last_name', $authorID);

            $author_full_name = "{$author_first_name} {$author_last_name}";


            $author_info = get_the_author_meta( 'description', $authorID );
            ?>

            <div class="widget mkdf-author-info-widget <?php echo esc_attr( $extra_class ); ?>" <?php echo foton_mikado_get_inline_style( $widget_styles ); ?>>
                <div class="mkdf-aiw-inner">
                    <a itemprop="url" class="mkdf-aiw-image" href="<?php echo esc_url( get_author_posts_url( $authorID ) ); ?>">
                        <?php echo foton_mikado_kses_img( get_avatar( $authorID, 138 ) ); ?>
                    </a>
                    <?php if ( $author_info !== "" ) { ?>
                        <h4 class="mkdf-aiw-title"><?php echo wp_kses_post( $author_full_name ); ?></h4>
                        <p itemprop="description" class="mkdf-aiw-text"><?php echo wp_kses_post( $author_info ); ?></p>
                    <?php } ?>
                </div>
            </div>
            <?php
        }
    }
}