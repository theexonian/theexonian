<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no front-page.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage Simple_Classic
 * @since      Simple Classic
 */

get_header(); ?>
<div id="smplclssc_page_main">
	<?php $count = 0; /* Post counter */
	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="smplclssc_titleinmain"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<p class="smplclssc_data-descr"><?php _e( 'Posted on', 'simple-classic' ); ?>
					<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
					<?php if ( has_category() ) {
						_e( 'in ', 'simple-classic' );
						the_category( ' ' );
					} ?>
				</p>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				<?php $attachment = get_posts( array(
					'post_type'   => 'attachment',
					'post_parent' => $post->ID,
				) );
				if ( $attachment ) {
					echo '<p class="smplclssc_img-descr">' . $attachment[0]->post_excerpt . '</p>'; /* Caption for thumbnail */
				}
				the_content();
				if ( has_tag() ) : ?>
					<div class="smplclssc_tags">
						<p><?php the_tags(); ?></p>
					</div><!-- .smplclssc_tags -->
				<?php endif; ?>
				<div class="smplclssc_post-border">
					<?php wp_link_pages( array(
						'before' => '<div class="smplclssc_page-links"><span>' . __( 'Pages: ', 'simple-classic' ) . '</span>',
						'after'  => '</div>',
					) ); /* Page pagination */
					if ( 0 != $count ) : ?>
						<a class="smplclssc_links" href="#">[<?php _e( 'Top', 'simple-classic' ); ?>]</a>
					<?php endif; ?>
				</div><!-- .smplclssc_post-border -->
				<?php $count ++; /* Post counter */ ?>
			</div><!-- #post-## -->
		<?php endwhile;
	endif;
	echo apply_filters( 'simpleclassic_content_nav', 'simpleclassic_content_nav' ); ?>
</div><!-- #page-main -->
<?php get_sidebar();
get_footer();
