<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Oncanvas
 */

get_header(); ?>

	<div id="site-main" class="content-home">

		<div class="wrapper wrapper-main clearfix">
		
			<?php if ( is_home() && !is_paged() ) { ?>

				<?php if ( is_active_sidebar( 'homepage-welcome-1' ) || is_active_sidebar( 'homepage-welcome-2' ) ) : ?>
					<div class="site-home-welcome-columns clearfix">
						<div class="site-home-welcome clearfix">
						<?php dynamic_sidebar( 'homepage-welcome-1' ); ?>
						</div><!-- .site-home-welcome --><!-- ws fix
						--><div class="site-home-welcome-aside clearfix">
						<?php dynamic_sidebar( 'homepage-welcome-2' ); ?>
						</div><!-- .site-home-welcome-aside -->
					</div><!-- .site-home-welcome-columns .clearfix -->
				<?php endif; ?>

				<?php
				if ( 1 == get_theme_mod( 'oncanvas_front_featured_posts', 1 ) ) {
					// get_template_part( 'template-parts/content', 'home-featured' );
				}
				?>
			<?php } ?>
			
			<main id="site-content" class="site-main site-main-full" role="main">
			
				<div class="site-content-wrapper clearfix">

					<?php if ( have_posts() ) : $i = 0; ?>
					<?php if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
					<?php endif; ?>
					<?php if ( is_home() && !is_paged() ) { ?>
					
						<?php
						if ( 1 == get_theme_mod( 'oncanvas_front_featured_categories', 0 ) ) {
							get_template_part( 'template-parts/content', 'home-categories' );
						}
						?>

					<?php } ?>
					<?php if ( is_home() && !is_paged() ) { ?><p class="widget-title archive-title"><?php _e('Recent Posts','oncanvas'); ?></p><?php } ?>
					
					<ul id="recent-posts" class="ilovewp-posts ilovewp-posts-archive clearfix">
						
						<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part( 'template-parts/content'); ?>
						<?php endwhile; ?>
						
					</ul><!-- .ilovewp-posts .ilovewp-posts-archive -->

					<?php 
					$args['prev_text'] = '<span class="nav-link-label"><span class="genericon genericon-previous"></span></span>' . __('Older Posts', 'oncanvas');
					$args['next_text'] = __('Newer Posts', 'oncanvas') . '<span class="nav-link-label"><span class="genericon genericon-next"></span></span>';
					the_posts_navigation($args); ?>
			
					<?php else : ?>
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
					<?php endif; ?>

				</div><!-- .site-content-wrapper .clearfix -->
			
			</main><!-- #site-content .site-main .site-main-full -->
		
		</div><!-- .wrapper .wrapper-main -->

	</div><!-- #site-main -->

<?php get_footer(); ?>