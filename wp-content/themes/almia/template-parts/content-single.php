<?php
/**
 * The template part for displaying single posts
 *
 * 
 * @package Almia
 * @since Almia 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<aside class="entry-meta lined-title">
		<div>
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
		</div>
	</aside><!-- .entry-meta -->

	<?php almia_excerpt(); ?>

	<?php almia_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'almia' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'almia' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( 'post' === get_post_type() ) : ?>	
	<footer class="entry-footer clear">
		<div class="entry-meta">
			<?php almia_entry_taxonomies(); ?> 
		</div>

		<?php
		if ( '' !== get_the_author_meta( 'description' ) ) {
			get_template_part( 'template-parts/biography' );
		}
		?>	
	</footer>
	<?php endif; ?>

</article><!-- #post-## -->
