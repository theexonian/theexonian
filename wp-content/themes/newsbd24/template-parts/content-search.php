<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newsbd24
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'blog-box', 'clearfix' ) ); ?>>
	
	

	<div class="entry-content">
    
       <?php  the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );?>
        
        <?php if ( 'post' === get_post_type() ) : ?>
         <div class="blog-meta entry-meta">
            <?php newsbd24_posted_on(); ?>
         </div>
         <?php else:?>
          <div class="blog-meta entry-meta"></div>
        <?php endif; ?>
        
		<?php
			the_excerpt();
			

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'newsbd24' ),
				'after'  => '</div>',
			) );
		?>
        <div class="blog-bottom text-right">
            <a href="<?php echo esc_url( get_permalink()); ?>" class="btn btn-primary"><?php esc_html_e('Continue Reading', 'newsbd24'); ?> <i class="fa fa-fw fa-angle-double-right"></i></a>
        </div><!-- end bottom -->
        
	</div><!-- end desc -->

	<hr class="dashedhr">
</article><!-- #post-<?php the_ID(); ?> -->

