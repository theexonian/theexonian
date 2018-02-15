<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newsbd24
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col-md-6', 'col-sm-6', 'col-xs-12' ,'grid-item' ) ); ?>>
<div class="small-blog-box blog-box clearfix">
	
	<?php
    /**
    * Hook - newsbd24_posts_blog_media.
    *
    * @hooked newsbd24_posts_blog_media - 10
    */
    do_action('newsbd24_posts_blog_media');
    ?>
	

	<div class="entry-content blog-desc">
       <div class="cat-title"><?php newsbd24_entry_category();?></div>
       <?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );?>
        
        <?php if ( 'post' === get_post_type() ) : ?>
         <div class="blog-meta entry-meta">
            <?php newsbd24_posted_on(); ?>
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
       
      
        
	</div><!-- end desc -->

</div>
</article><!-- #post-<?php the_ID(); ?> -->
