<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newsbd24
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('single-page', 'clearfix' )); ?>>
	<?php
    /**
    * Hook - newsbd24_posts_formats_thumbnail.
    *
    * @hooked newsbd24_posts_formats_thumbnail - 10
    */
    do_action('newsbd24_posts_formats_thumbnail');
    ?>
	
	<div class="entry-content blog-desc">
    	
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'newsbd24' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'newsbd24' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
