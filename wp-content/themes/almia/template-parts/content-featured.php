<?php
/**
 * The template part for displaying content
 *
 * @package Almia
 * @since Almia 1.0
 */
?>

<article id="post-featured-<?php the_ID(); ?>" class="post-featured">

	<?php almia_post_thumbnail(); ?>

	<div>
		<header class="entry-header">
			<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
				<span class="sticky-post"><?php esc_html_e( 'Featured', 'almia' ); ?></span>
			<?php endif; ?>

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<footer class="entry-meta">
			<?php almia_entry_meta(); ?>
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'almia' ),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->

	</div>

</article><!-- #post-## -->
