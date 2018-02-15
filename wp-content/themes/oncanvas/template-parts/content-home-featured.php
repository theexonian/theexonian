<?php
/**
 * The template used for displaying featured posts on the Front Page.
 *
 * @package Oncanvas
 */
?>

<?php
	
	$featured_tag = get_theme_mod( 'oncanvas_featured_term_1', 'featured' );
	$featured_layout = get_theme_mod( 'oncanvas_featured_posts_layout_1', 'default' );

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

<?php if ( $custom_loop->have_posts() ) : $i = 0; $m = 0; ?>

	<div class="ilovewp-featured-posts ilovewp-featured-posts-home<?php if ($featured_layout == 'large') { echo ' ilovewp-featured-posts-large'; } ?>">
		
		<p class="widget-title"><?php _e('Featured Posts','oncanvas'); ?></p>

		<ul class="ilovewp-posts clearfix">

		<?php while ( $custom_loop->have_posts() ) : $custom_loop->the_post(); $i++; ?>

		<?php if ($i === 1 && $featured_layout == 'large') {

			$classes = array('ilovewp-post','ilovewp-featured-post','featured-post-main','featured-post-'.esc_attr($i)); ?>

			<li <?php post_class($classes); ?>>
				<div class="ilovewp-post-wrapper">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-cover">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('oncanvas-featured-thumbnail-large'); ?></a>
					</div><!-- .post-cover -->
					<?php endif; ?>
					<div class="post-preview">
						<div class="post-preview-wrapper">
							<span class="posted-on"><time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time></span>
							<?php the_title( sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							<p class="post-excerpt"><?php echo wp_kses_post(force_balance_tags(get_the_excerpt())); ?></p>
						</div><!-- .post-preview-wrapper -->
					</div><!-- .post-preview -->
				</div><!-- .ilovewp-post-wrapper -->
			</li><!-- .ilovewp-post .ilovewp-featured-post .featured-post-main .featured-post-<?php echo esc_attr($i); ?> -->

		<?php } else { $m++;

			$classes = array('ilovewp-post','ilovewp-featured-post','featured-post-simple','featured-post-simple-'.esc_attr($m)); ?>
			
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
			</li><!-- .ilovewp-post .ilovewp-featured-post .featured-post-simple .featured-post-simple-<?php echo esc_attr($m); ?> -->
		
		<?php } ?>
		
		<?php endwhile; ?>
		
		<?php wp_reset_postdata(); ?>

		</ul><!-- .ilovewp-posts .clearfix -->
	</div><!-- .ilovewp-featured-posts .ilovewp-featured-posts-home -->

<?php else : ?>

	<?php if ( current_user_can( 'publish_posts' ) && is_customize_preview() ) : ?>

		<div id="ilovewp-featured-posts">

			<div class="ilovewp-page-intro">
				<h1 class="title-page"><?php _e( 'No Featured Posts Found', 'oncanvas' ); ?></h1>
				<div class="taxonomy-description">

					<p><?php printf( esc_html__( 'This section will display your featured posts. Configure (or disable) it via the Customizer.', 'oncanvas' ) ); ?><br>
					<?php printf( wp_kses( __( 'You can mark your posts with a "Featured" tag on the Edit Post page. <a href="%1$s">Get started here</a>.', 'oncanvas' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit.php' ) ) ); ?></p>
					<p><strong><?php printf( esc_html__( 'Important: This message is NOT visible to site visitors, only to admins and editors.', 'oncanvas' ) ); ?></strong></p>

				</div><!-- .taxonomy-description -->
			</div><!-- .ilovewp-page-intro -->

		</div><!-- #ilovewp-featured-posts -->

	<?php endif; ?>

<?php endif; ?>