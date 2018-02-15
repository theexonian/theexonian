<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Oncanvas
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="ilovewp-page-intro ilovewp-page-inner">
		<h1 class="title-page"><?php the_title(); ?></h1>
		<p class="post-meta"><?php _e('In','oncanvas'); ?> <span class="post-meta-category"><?php the_category(esc_html_x( ', ', 'Used on archive and post pages to separate multiple categories.', 'oncanvas' )); ?></span>
		<span class="posted-on"><span class="genericon genericon-time"></span> <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time></span>
		<?php if ( function_exists('the_views') ) { echo '<span class="post-views"><span class="genericon genericon-show"></span> '; the_views(); echo '</span>'; } ?>
		</p>
	</header><!-- .ilovewp-page-intro -->

	<div class="post-single clearfix">

		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'oncanvas' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="cleaner">&nbsp;</div><div class="page-links">' . esc_html__( 'Pages:', 'oncanvas' ),
				'after'  => '</div>',
			) );
		?>

		<?php
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'oncanvas' ) );
		if ( $tags_list ) {
			printf( '<div class="cleaner">&nbsp;</div><p class="tags-links">' . esc_html__( 'Tags: %1$s', 'oncanvas' ) . '</p>', $tags_list ); // WPCS: XSS OK.
		}
		?>

	</div><!-- .post-single -->

</article><!-- #post-<?php the_ID(); ?> -->