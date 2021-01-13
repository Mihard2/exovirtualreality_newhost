<?php

function foton_mikado_filter_move_comment_below( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'foton_mikado_filter_move_comment_below' );

if ( post_password_required() ) {
	return;
}

if ( comments_open() || get_comments_number() ) { ?>
	<div class="mkdf-comment-holder clearfix" id="comments">
		<?php if ( have_comments() ) { ?>
			<div class="mkdf-comment-holder-inner">
				<div class="mkdf-comments-title">
					<h4><?php esc_html_e( 'Comments', 'foton' ); ?></h4>
				</div>
				<div class="mkdf-comments">
					<ul class="mkdf-comment-list">
						<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'foton_mikado_comment' ), apply_filters( 'foton_mikado_filter_comments_callback', array() ) ) ) ); ?>
					</ul>
				</div>
			</div>
		<?php } ?>
		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
			<p><?php esc_html_e( 'Sorry, the comment form is closed at this time.', 'foton' ); ?></p>
		<?php } ?>
	</div>
	<?php
		$mkdf_commenter = wp_get_current_commenter();
		$mkdf_req       = get_option( 'require_name_email' );
		$mkdf_aria_req  = ( $mkdf_req ? " aria-required='true'" : '' );
        $mkdf_consent  = empty( $mkdf_commenter['comment_author_email'] ) ? '' : ' checked="checked"';

		$mkdf_args = array(
			'id_form'              => 'commentform',
			'id_submit'            => 'submit_comment',
			'title_reply'          => esc_html__( 'Post a Comment', 'foton' ),
			'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after'    => '</h4>',
			'title_reply_to'       => esc_html__( 'Post a Reply to %s', 'foton' ),
			'cancel_reply_link'    => esc_html__( 'cancel reply', 'foton' ),
			'label_submit'         => esc_html__( 'Submit', 'foton' ),
			'comment_field'        => apply_filters( 'foton_mikado_filter_comment_form_textarea_field', '<textarea id="comment" placeholder="' . esc_attr__( 'Your comment', 'foton' ) . '" name="comment" cols="45" rows="6" aria-required="true"></textarea>' ),
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'fields'               => apply_filters( 'foton_mikado_filter_comment_form_default_fields', array(
				'author' => '<div class="mkdf-grid-row"><div class="mkdf-grid-col-6"><input id="author" name="author" placeholder="' . esc_attr__( 'Your Name', 'foton' ) . '" type="text" value="' . esc_attr( $mkdf_commenter['comment_author'] ) . '"' . $mkdf_aria_req . ' /></div>',
				'email'  => '<div class="mkdf-grid-col-6"><input id="email" name="email" placeholder="' . esc_attr__( 'Your Email', 'foton' ) . '" type="text" value="' . esc_attr( $mkdf_commenter['comment_author_email'] ) . '"' . $mkdf_aria_req . ' /></div></div>',
                'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" ' . $mkdf_consent . ' />' .
                    '<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'foton' ) . '</label></p>',
			) )
		);

	$mkdf_args = apply_filters( 'foton_mikado_filter_comment_form_final_fields', $mkdf_args );

	if ( get_comment_pages_count() > 1 ) { ?>
		<div class="mkdf-comment-pager">
			<p><?php paginate_comments_links(); ?></p>
		</div>
	<?php } ?>

    <?php
    $mkdf_show_comment_form = apply_filters('foton_mikado_filter_show_comment_form_filter', true);
    if($mkdf_show_comment_form) {
    ?>
        <div class="mkdf-comment-form">
            <div class="mkdf-comment-form-inner">
                <?php comment_form( $mkdf_args ); ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>


