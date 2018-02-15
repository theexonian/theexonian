<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newsbd24
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col-md-12', 'blog-box', 'clearfix','grid-item' ) ); ?>>
	<?php
    /**
    * Hook - newsbd24_posts_blog_media.
    *
    * @hooked newsbd24_posts_blog_media - 10
    */
    do_action('newsbd24_posts_blog_media');
    ?>
   

	<div class="entry-content blog-desc text-center">
     <?php newsbd24_entry_category();?>
      
       <?php
	   if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
        
       
        
        <?php if ( 'post' === get_post_type() ) : ?>
         <div class="blog-meta entry-meta">
            <?php newsbd24_posted_on(); ?>
            <?php newsbd24_entry_footer();?>
         </div>
        <?php endif; ?>
        
		<?php
			/**
			* Hook - newsbd24_blog_loop_content_type.
			*
			* @hooked newsbd24_blog_loop_content_type - 10
			*/
			do_action('newsbd24_blog_loop_content_type');
			

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'newsbd24' ),
				'after'  => '</div>',
			) );
		?>
      
        
        <div class="blog-social clearfix"> <hr></div><!-- end blog-social -->
        
	</div><!-- end desc -->

	<footer class="entry-footer">
		<?php //newsbd24_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
