<?php /* Template Name: AuthorPage */ 
get_header();
$query = isset($_GET['a']) ? stripslashes($_GET['a']) : '';
if (preg_match('/(.*)\/([0-9]+)/', $query, $matches)) {
	$author = $matches[1];
	$page = intval($matches[2]);
} else {
 	$author = isset($_GET['a']) ? $_GET['a'] : 'No Author Specified';
 	$page = 1;
}
$page = max(1, $page);
$results = posts_by_author($author, $page);
?>
	<div class="section-header">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="section-header-inner">
						<h4>Author Page (Page <?php echo $page; ?> of <?php the_field("count"); ?> | <a href="<?php the_permalink(); ?>?a=<?php echo urlencode($author.'/'.($page+1)); ?>">Next &raquo;</a>)</h4>
						<h2><?php echo htmlentities($author); ?></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
if ($results) {
	global $post;
	foreach ($results as $post) {
		setup_postdata($post);
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
<?php
	}
} else {
?>
	<div class="article-archive">
		<div class="container">
			<div class="row">
				<div class="span12">
					<h3 class="search-noresults-header">Oops! There are no more articles by this author.</h3>
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
<?php 
}
get_footer(); ?>
