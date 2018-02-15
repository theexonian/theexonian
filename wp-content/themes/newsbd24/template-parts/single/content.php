<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newsbd24
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'single-page', 'clearfix' ) ); ?>>
	<?php
    /**
    * Hook - newsbd24_posts_blog_media.
    *
    * @hooked newsbd24_posts_blog_media - 10
    */
    do_action('newsbd24_posts_blog_media');
    ?>
    <div class="blog-desc text-center">
        <?php newsbd24_entry_category();?>
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
         <?php if ( 'post' === get_post_type() ) : ?>
         <div class="blog-meta entry-meta">
             <?php newsbd24_posted_on(); ?>
            <?php newsbd24_entry_footer();?>
         </div>
        <?php endif; ?>
        <!-- end meta -->
    </div>

	<div class="entry-content blog-desc">
		<?php
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'newsbd24' ),
				'after'  => '</div>',
			) );
		?>
        
    </div><!-- end desc -->
    
    <hr class="dashedhr">
    <div class="single-blog-bottom clearfix">
        <div class="tag-widget float-left">
           <?php echo get_the_tag_list();?>
        </div><!-- end tag-widget -->
        
    </div>
    <hr class="dashedhr">

	<footer class="entry-footer">
		<?php //newsbd24_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
