<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @subpackage Simple_Classic
 * @since      Simple Classic
 */
?>

<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'simple-classic' ); ?></p>
		<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template. */

		return;
	endif;
	/* You can start editing here -- including this comment! */
	if ( have_comments() ) : ?>
		<h3 id="comments-title">
			<?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'simple-classic' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?>
		</h3>
		<ul class="commentlist"><?php wp_list_comments( array( 'callback' => 'simpleclassic_comment' ) ); ?></ul>
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link() ?></div>
			<div class="alignright"><?php next_comments_link() ?></div>
		</div><!-- .navigation -->
	<?php endif;
	comment_form(); ?>
</div><!-- #comments -->
