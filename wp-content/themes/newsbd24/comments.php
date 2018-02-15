<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage newsbd24
 * @since 1.0
 * @version 1.0
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
<div id="comments" class="comments-wrapper">

	

	<?php if ( have_comments() ) : ?>
		<h4 class="custom-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( esc_html_x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'newsbd24' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'newsbd24'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h4>

	

		<ul class="comments-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'callback' => 'newsbd24_walker_comment',
					
				) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'newsbd24' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'newsbd24' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'newsbd24' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'newsbd24' ); ?></p>
	<?php endif; ?>
    
    
  

</div><!-- #comments -->

<hr class="dashedhr">

<div class="comments-wrapper">
	<?php 
	
	$args = array(
	'fields' => apply_filters(
		'comment_form_default_fields', array(
			'author' =>'<div class="form-group col-lg-6">' . '<input id="author" placeholder="' . esc_attr__( 'Your Name', 'newsbd24'  ) . '" name="author" class="form-control" type="text" value="' .
				esc_attr( $commenter['comment_author'] ) . '" size="30" />'.
				( $req ? '<span class="required">*</span>' : '' )  .
				'</div>'
				,
			'email'  => '<div class="form-group col-lg-6">' . '<input id="email" placeholder="' . esc_attr__( 'Your Email', 'newsbd24'  ) . '" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30" class="form-control" />'  .
				( $req ? '<span class="required">*</span>' : '' ) 
				 .
				'</div>',
			'url'    => '<div class="form-group col-lg-12">' .
			 '<input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'newsbd24' ) . '" type="text" value="' . esc_url( $commenter['comment_author_url'] ) . '" size="30" class="form-control" /> ' .
			
	           '</div><div class="clearfix"',
			   
		)
	),
	 'comment_field' =>  '<div class="form-group col-lg-12"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"  placeholder="' . esc_attr__( 'Comment', 'newsbd24' ) . '" class="form-control">' .
    '</textarea></div>',
    'comment_notes_after' => '',
	'class_form'      => 'row contact-form',
	'class_submit'      => 'btn btn-primary',
);
	?>
    <div class="form-wrapper">
    <?php
	comment_form($args); ?>
    </div>
  
</div>