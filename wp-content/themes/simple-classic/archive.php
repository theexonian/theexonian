<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 * @subpackage Simple_Classic
 * @since      Simple Classic
 */

get_header(); ?>
<div id="smplclssc_content">
	<?php $count = 0; /* Post counter */
	if ( have_posts() ) : ?>
		<h1 class="smplclssc_page-title">
			<?php the_archive_title(); ?>
		</h1>
		<?php /* Start the Loop */
		while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="smplclssc_titleinmain"><a href="<?php the_permalink(); ?>"><?php the_title(); /* Post title */ ?></a>
				</h1>
				<p class="smplclssc_data-descr">
					<?php _e( 'Posted on', 'simple-classic' ); ?> <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
					<?php if ( has_category() ) {
						_e( 'in ', 'simple-classic' );
						the_category( ' ' );
					} ?>
				</p><!-- .smplclssc_data-descr -->
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				<p>
					<?php if ( has_excerpt() ) {
						the_excerpt();
					} else {
						the_content();
					} ?>
				</p>
				<?php if ( has_tag() ) : ?>
					<div class="smplclssc_tags">
						<p><?php the_tags(); ?></p>
					</div>
				<?php endif; ?>
				<div class="smplclssc_post-border">
					<?php wp_link_pages( array(
						'before' => '<div class="smplclssc_page-links"><span>' . __( 'Pages:', 'simple-classic' ) . ' </span>',
						'after'  => '</div>',
					) );
					if ( $count > 1 ) : ?>
						<a class="smplclssc_links" href="#"><?php _e( 'Top', 'simple-classic' ); ?></a>
					<?php endif; ?>
				</div><!-- .smplclssc_post-border -->
				<?php $count ++; /* Post counter */ ?>
			</div><!-- #post-## -->
		<?php endwhile;
	else : ?>
		<h3 class="smplclssc_page-title"><?php _e( 'Nothing Found', 'simple-classic' ); ?></h3>
		<div class="smplclssc_entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'simple-classic' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .smplclssc_entry-content -->
	<?php endif;
	simpleclassic_content_nav( 'nav-below' ); ?>
</div><!-- #smplclssc_content -->
<?php get_sidebar();
get_footer();
