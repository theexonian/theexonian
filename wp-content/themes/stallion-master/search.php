<?php get_header(); ?>

	<div class="section-header">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="section-header-inner">
						<h4>Search results</h4>
						<h2><?php the_search_query(); ?></h2>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php if (have_posts()) : while (have_posts()) : the_post();

?>
	<div class="article-archive">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="article-archive-inner">
						<a href="<?php the_permalink(); ?>">
							<div class="article-archive-image" <?php if (has_post_thumbnail()) { ?>style="background:url(<?php echo bw_FeaturedImage($post->ID,"small-square"); ?>)"<?php } ?>></div>
							<div class="article-archive-content">
								<h3><?php the_title(); ?></h3>
								<span><?php the_time('F j, Y g:ia'); ?> | <?php the_field('authors'); ?></span>
								<p><?php the_excerpt(); ?></p>
							</div>
							<div style="clear:both"></div>
						</a>
					</div>
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
<?php endwhile; ?>

		<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div class="article-archive-pagination">
		<div class="container"><div class="row"><div class="span12">
			<div class="article-archive-pagination-inner">
				<div class="nav-previous">
					<?php echo get_next_posts_link('View older &rarr;'); ?>
				</div>
				<div class="nav-next">
					<?php echo get_previous_posts_link('&larr; More recent'); ?>
				</div>
				<div style="clear:both"></div>
			</div>
		</div></div></div>
	</div>
<?php endif; ?>
<?php else: ?>
	<div class="article-archive">
		<div class="container">
			<div class="row">
				<div class="span12">
					<h3 class="search-noresults-header">Your search returned no results.</h3>
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php get_footer(); ?>
