<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Oncanvas
 */

?>

<?php global $oncanvas_i; $oncanvas_i++; ?>

<?php $classes = array('ilovewp-post','ilovewp-post-archive','ilovewp-post-'.$oncanvas_i, 'clearfix'); ?>

<li <?php post_class($classes); ?>>

	<article id="post-<?php the_ID(); ?>">
	
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-cover">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('oncanvas-large-thumbnail'); ?></a>
		</div><!-- .post-cover -->
		<?php endif; ?>
		<div class="post-preview">
			<?php the_title( sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<span class="post-meta-category"><?php the_category(esc_html_x( ', ', 'Used on archive and post pages to separate multiple categories.', 'oncanvas' )); ?></span>
		</div><!-- .post-preview -->
	
	</article><!-- #post-<?php the_ID(); ?> -->

</li><!-- .ilovewp-post .ilovewp-post-archive .clearfix -->

<?php if ( $oncanvas_i == 3) { $oncanvas_i = 0; } ?>