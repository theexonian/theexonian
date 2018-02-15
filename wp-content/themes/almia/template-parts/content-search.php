<?php
/**
 * The template part for displaying results in search pages
 *
 * 
 * @package Almia
 * @since Almia 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<?php almia_post_thumbnail(); ?>

	<?php almia_excerpt(); ?>

	<?php if ( 'post' === get_post_type() ) : ?>

		<aside class="entry-entry">
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
		</aside><!-- .entry-entry -->

	<?php else : ?>

		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'almia' ),
					get_the_title()
				),
				'<footer class="entry-entry"><span class="edit-link">',
				'</span></footer><!-- .entry-entry -->'
			);
		?>

	<?php endif; ?>
</article><!-- #post-## -->

