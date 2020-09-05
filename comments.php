<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shopstore
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comment-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
        
        <h4 class="custom-title">
			<?php
			$comment_count = get_comments_number();
			if ( 1 === $comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html_e( 'One thought on &ldquo;%1$s&rdquo;', 'shopstore' ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'shopstore' ) ),
					number_format_i18n( $comment_count ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			}
			?>
		</h4>
        
		<!-- .comments-title -->

		<ul class="comments-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'callback' => 'shopstore_walker_comment',
			) );
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'shopstore' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().
	?>
    <div class="clearfix"></div>
    
    
   <?php 
	
	$args = array(
	'fields' => apply_filters(
		'comment_form_default_fields', array(
			'author' =>'<div class="form-group col-lg-6">' . '<input id="author" placeholder="' . esc_attr__( 'Your Name', 'shopstore'  ) . '" name="author" class="form-control" type="text" value="' .
				esc_attr( $commenter['comment_author'] ) . '" size="30" />'.
				( $req ? '<span class="required">*</span>' : '' )  .
				'</div>'
				,
			'email'  => '<div class="form-group col-lg-6">' . '<input id="email" placeholder="' . esc_attr__( 'Your Email', 'shopstore'  ) . '" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30" class="form-control" />'  .
				( $req ? '<span class="required">*</span>' : '' ) 
				 .
				'</div>',
			'url'    => '<div class="form-group col-lg-12">' .
			 '<input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'shopstore' ) . '" type="text" value="' . esc_url( $commenter['comment_author_url'] ) . '" size="30" class="form-control" /> ' .
			
	           '</div>',
			   
		)
	),
	 'comment_field' =>  '<div class="form-group col-lg-12"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"  placeholder="' . esc_attr__( 'Comment', 'shopstore' ) . '" class="form-control">' .
    '</textarea></div>',
    'comment_notes_after' => '',
	'class_form'      => 'row contact-form',
	'class_submit'      => 'btn btn-primary',
	'title_reply_before'   => ' <h4 class="custom-title">',
     'title_reply_after'    => '</h4>',
);
	?>
    <div class="form-wrapper">
    <?php
	comment_form($args); ?>
    </div>

</div><!-- #comments -->
