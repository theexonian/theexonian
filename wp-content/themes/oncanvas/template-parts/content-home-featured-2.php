<?php
/**
 * The template used for displaying featured posts on the Front Page.
 *
 * @package Oncanvas
 */
?>

<?php
	
	$featured_tag = get_theme_mod( 'oncanvas_featured_term_2', 'featured' );
	$featured_layout = get_theme_mod( 'oncanvas_featured_posts_layout_2', 'default' );

	if ($featured_layout == 'default') {
		$posts_num = 4;
	} elseif ($featured_layout == 'large') {
		$posts_num = 5;
	}
	
	$custom_loop = new WP_Query( array(
		'post_type'      => 'post',
		'posts_per_page' => absint($posts_num),
		'order'          => 'DESC',
		'orderby'        => 'date',
		'tag'	 	 	 => esc_html($featured_tag)
	) );
?>

<?php if ( $custom_loop->have_posts() ) : $i = 0; ?>

	<div class="ilovewp-featured-posts ilovewp-featured-posts-secondary ilovewp-featured-posts-secondary-<?php echo esc_attr($posts_num); ?>">
		
		<div class="wrapper">
			<ul class="ilovewp-posts clearfix">

			<?php while ( $custom_loop->have_posts() ) : $custom_loop->the_post(); $i++;

				$classes = array('ilovewp-post','ilovewp-featured-post','featured-post-simple','featured-post-simple-'.esc_attr($i)); ?>
				
				<li <?php post_class($classes); ?>>
					<div class="ilovewp-post-wrapper">
						<?php if ( has_post_thumbnail() ) : ?>
						<div class="post-cover">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('oncanvas-featured-thumbnail-small'); ?></a>
						</div><!-- .post-cover -->
						<?php endif; ?>
						<div class="post-preview">
							<div class="post-preview-wrapper">
								<span class="posted-on"><time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time></span>
								<?php the_title( sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							</div><!-- .post-preview-wrapper -->
						</div><!-- .post-preview -->
					</div><!-- .ilovewp-post-wrapper -->
				</li><!-- .ilovewp-post .ilovewp-featured-post .featured-post-simple .featured-post-simple-<?php echo esc_attr($i); ?> -->
			
			<?php endwhile; ?>
			
			<?php wp_reset_postdata(); ?>

			</ul><!-- .ilovewp-posts .clearfix -->
		</div><!-- .wrapper -->
	</div><!-- .ilovewp-featured-posts .ilovewp-featured-posts-secondary -->

<?php endif; ?>