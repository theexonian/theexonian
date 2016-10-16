<?php
$thisCategory = get_category($cat);

$childCategories = get_categories("child_of=" . $cat);
$isParent = ($childCategories) ? true : false;

$parentCategory = $thisCategory->parent;
$isChild = ($parentCategory) ? true : false;
?>

<?php get_header(); ?>

<div class="archives-container">
	<div class="container">
		<div class="row"><div class="span12">
			<div class="archives-container-inner">
				<div class="archives-sidebar">
					<div class="archives-header">
						<div class="archives-header-label">Column archives</div>
						<h2><?php single_cat_title(); ?></h2>
<?php if ($isChild) : ?>
						<div class="archives-header-breadcrumb"><?php echo substr(get_category_parents($cat, TRUE, ' &raquo; '),0,-9); ?></div>
<?php endif; ?>
						<div class="archives-header-description"><?php echo category_description($cat); ?></div>
					</div>
<?php if ($isParent) : ?>
					<div class="archives-children">
						<div class="archives-header-label"><?php single_cat_title(); ?> Subcolumns</div>
						<ul class="archives-children-list">
<?php foreach ($childCategories as $child) : ?>
							<li><a href="<?php echo get_category_link($child->cat_ID); ?>"><?php echo $child->name; ?></a> <span>(<?php echo $child->count; ?>)</span></li>
<?php endforeach; ?>
						</ul>
					</div>
<?php endif; ?>
				</div>
				<div class="archives-mainarea">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="article-archive-inner <?php echo (has_post_thumbnail()) ? "article-archive-inner-hasphoto" : ""; ?>">
						<a href="<?php the_permalink(); ?>">
							<?php if (has_post_thumbnail()) { ?><div class="article-archive-image" style="background:url(<?php echo bw_FeaturedImage($post->ID,150,150); ?>)"></div><?php } ?>
							<div class="article-archive-content">
								<h3><?php the_title(); ?></h3>
								<span><?php the_time('F j, Y g:ia'); ?> | <?php the_field('authors'); ?></span>
								<p class="article-archive-content-snippet"><?php echo substr(strip_tags(get_the_content()),0,500) . "&hellip;"; ?></p>
							</div>
							<div class="article-archive-content-gradient"></div>
							<div style="clear:both"></div>
						</a>
					</div>
<?php endwhile; else : ?>
					<div class="fullwidth-errormessage">
						<h3>No articles yet.</h3>
						<p>There haven't been any articles published in this column.<br />Please check back later.</p>
					</div>
<?php endif; ?>
				</div>
				<div style="clear:both"></div>
			</div>
		</div></div>
	</div>
</div>

<?php if (have_posts() && $wp_query->max_num_pages > 1) : ?>
	<div class="article-archive-pagination">
		<div class="container"><div class="row"><div class="span12"><div style="padding: 0 20px">
			<div class="article-archive-pagination-inner">
				<div class="nav-previous">
					<?php echo get_next_posts_link('View older &rarr;'); ?>
				</div>
				<div class="nav-next">
					<?php echo get_previous_posts_link('&larr; More recent'); ?>
				</div>
				<div style="clear:both"></div>
			</div>
		</div></div></div></div>
	</div>
<?php endif; ?>
<?php get_footer(); ?>