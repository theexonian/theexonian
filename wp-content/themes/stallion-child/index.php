<?php
cflems_hit();
get_header();
the_ads('HEADER', 1);
if (have_posts()) : while (have_posts()) : the_post();

$authors = explode(", ", get_field("authors"));
foreach ($authors as $i => $author) {	
	$authors[$i] = '<a href="'.get_site_url(null, '/authorpage/?a='.urlencode(html_entity_decode($authors[$i], ENT_QUOTES | ENT_XHTML).'/1')).'">'.$authors[$i].'</a>';
}
$authors = implode(", ", $authors);

switch (get_field("photo_type")) {
	case "horizontal":
		$thumb_size = "medium-flexheight";
		$width = 525;
		break;
	case "vertical":
		$thumb_size = "medium-flexheight";
		$width = 400;
		break;
	case "wide":
		$thumb_size = "header-wide";
		$width = 920;
		break;
}
?>

	<div class="article">
		<div class="container">
			<div class="row"><div class="span12">
				<div class="article-heading-block"><div class="row">
					<div class="span12">
						<div class="article-heading-categories"><?php the_category(', '); ?></div>
						<h1 class="balance-text"><?php the_title(); ?></h1>
						<div class="article-sidebar-meta <?php echo (get_field("photo_type") == "wide") ? "article-sidebar-meta-noline" : ""; ?>">
<?php if (get_field("authors")) : ?>
							<div class="article-sidebar-meta-i">
								<small>The Author<?php echo (strpos(get_field('authors'),",")) ? "s" : ""; ?></small>
								<span class="article-sidebar-meta-authors"><?php echo $authors; ?></span>
							</div>
<?php endif; ?>
<div class="pull-right">
							<div class="article-sidebar-meta-i">
								<small>Published online</small>
								<span class="article-sidebar-meta-publishdate"><?php the_time('F j, Y g:ia'); ?></span>
							</div>
<?php if (get_the_time() != get_the_modified_time()) : ?>
							<div class="article-sidebar-meta-i">
								<small>Last updated</small>
								<span class="article-sidebar-meta-publishdate"><?php the_modified_time('F j, Y g:ia'); ?></span>
							</div>
<?php endif; ?>
<?php if (get_field("web-editors")) : ?>
							<div class="article-sidebar-meta-i">
								<small>Web Editor<?php echo (strpos(get_field('web-editors'),",")) ? "s" : ""; ?></small>
								<span class="article-sidebar-meta-publishdate"><?php the_field("web-editors"); ?></span>
							</div>
<?php endif; ?>
</div>
							<div style="clear:both"></div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div></div>
			</div></div>
			<div class="row"><div class="span12">
				<div class="article-content-block">
					<div class="row">
						<div class="span8 offset4">
<?php if (has_post_thumbnail() && (!get_field("photo_type") || get_field("photo_type") != "nophoto")) : ?>
							<div class="article-sidebar article-sidebar-photo">
								<img src="<?php echo bw_FeaturedImage($post->ID,$thumb_size,bw_CheckPhotoAlign(get_field('photo_alignment'),'c')); ?>" alt="<?php the_field("photo_caption"); ?>" style="width:<?= $width ?>px" />
							</div>
<?php endif; ?>
<?php if (has_post_thumbnail() && get_field("photo_type") != "nophoto"
			&& get_field("photo_not_related") != "Photo not related" && get_field("photo_caption")) : ?>
							<div class="article-sidebar">
								<div class="article-sidebar-caption">
									<span style="color:#AAA;font-size:11px">&#x25B2;</span>
									<br /><?php the_field("photo_caption"); ?>
<?php if (get_field("photo_credit")) : ?>
									<br /><span class="article-sidebar-caption-credit"><?php the_field("photo_credit"); ?></span>
<?php endif; ?>
								</div>
							</div>
<?php endif; ?>
<?php if (get_field("highlights")) : ?>
							<div class="article-sidebar">
								<div class="article-sidebar-highlights">
									<h3>Article highlights:</h3>
<?php if(substr(get_field('highlights'),0,4) == "<ul>") : the_field('highlights'); else : ?>
									<ul>
										<li><?php the_field('highlights'); ?></li>
									</ul>
<?php endif ?>
								</div>
							</div>
<?php endif; ?>
							<div class="article-text">
							<?php ads_content(); ?>
							<p style="font-size:15px">
								<div>
									<a href="#" class="article-text-social article-text-social-facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href),'facebook-share-dialog','width=626,height=436');return false;">Facebook</a>
									<a href="#" class="article-text-social article-text-social-twitter" onclick="window.open('https://twitter.com/share?url='+encodeURIComponent(location.href),'twitter-share-dialog','width=626,height=436');return false;">Twitter</a>
									<a href="#" class="article-text-social article-text-social-google" onclick="window.open('https://plus.google.com/share?url='+encodeURIComponent(location.href),'gplus-share-dialog','width=626,height=436');return false;">Google+</a>
									<div style="clear:both"></div>
								</div>
							</p>
							</div>
						</div>
						<div class="clear:both"></div>
					</div>
				</div>
			</div></div>
		</div>
	</div>

<?php endwhile; endif; ?>
<?php the_ads('FOOTER', 1); ?>
<?php get_footer(); ?>
