<?php
/**
 * The Template for displaying all single posts.
 *
 * @subpackage Simple_Classic
 * @since      Simple Classic
 */

get_header(); ?>
<div id="smplclssc_content">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
				<div id="nav-single">
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> ' . __( 'Previous', 'simple-classic' ) ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', __( 'Next', 'simple-classic' ) . ' <span class="meta-nav">&rarr;</span>' ); ?></span>
				</div><!-- #nav-single -->
				<h1 class="smplclssc_titleinmain"><?php the_title(); ?></h1>
				<p class="smplclssc_data-descr">
					<?php _e( 'Posted on', 'simple-classic' ); ?> <a href="<?php echo esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ); ?>"><?php echo get_the_date(); ?></a>
					<?php if ( has_category() ) {
						_e( 'in ', 'simple-classic' );
						the_category( ' ' );
					} ?>
				</p><!-- .smplclssc_data-descr -->
				<p><?php the_content(); ?></p>
				<?php if ( has_tag() ) : ?>
					<div class="smplclssc_tags">
						<p><?php the_tags(); ?></p>
					</div>
				<?php endif; ?>
				<div class="smplclssc_post-border">
					<?php wp_link_pages( array(
						'before' => '<div class="smplclssc_page-links"><span>' . __( 'Pages: ', 'simple-classic' ) . '</span>',
						'after'  => '</div>',
					) ); ?>
				</div>
				<?php if ( comments_open( get_the_ID() ) ) :
					comments_template( '', true );
				endif;
			endwhile;
		endif; ?>
	</div><!-- #post-## -->
</div><!-- #smplclssc_content -->
<?php get_sidebar();
get_footer();
