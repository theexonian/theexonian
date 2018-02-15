<?php
/**
 * The template for displaying the featured posts
 *
 * @package Almia
 * @since Almia 1.0
 */

?>
<?php 

$featured = new WP_Query(
	array(
		'tag_slug__in' => get_theme_mod('featured_posts_tags', 'featured'),
		'posts_per_page' => get_theme_mod('featured_posts_number', 5),
	)
);

if ( $featured->have_posts() ) :
	?>
	<section id="featured-posts" class="site-featured-posts <?php echo esc_attr( get_theme_mod( 'featured_posts_type', 'carousel' ) ); ?>" >
		<div class="slides active-slide-1 clear" data-active-slide="1" data-slide-items="<?php echo esc_attr( $featured->post_count ) ?>" >
			<?php
			while ( $featured->have_posts() ) :
				$featured->the_post();
				get_template_part( 'template-parts/content-featured', get_post_format() );
			endwhile;
			?>
		</div>
	</section>
	<?php
	wp_reset_postdata();
endif; // ( $featured->have_posts() )
?>