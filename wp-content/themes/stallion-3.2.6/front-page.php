<?php 
/*
Template Name: PBJ -- Homepage template
*/

get_header(); 

$featured_id = (ot_get_option('hp_featured_cat','')) ? ot_get_option('hp_featured_cat','') : "1";
$categoryID_exclusive = (ot_get_option('hp_exclusive_cat','')) ? ot_get_option('hp_exclusive_cat','') : "";

// The metric ton of queries.
$queryExposition = new WP_Query("showposts=1&cat=" . $featured_id);
$queryLowerexpo = new WP_Query("showposts=1&offset=1&cat=" . $featured_id);
$querySmallexpo = new WP_Query("showposts=4&offset=2&cat=" . $featured_id);

$queryNewsticker = new WP_Query("showposts=15&category__not_in=6&category__not_in=" . $featured_id);

$newsTickerPosition = (ot_get_option('hp_newsticker_swap','')) ? ot_get_option('hp_newsticker_swap','') : "right";
$featureDisplay = (ot_get_option('hp_feature','')) ? ot_get_option('hp_feature','') : "horizontal";

?>
<?php if ($featureDisplay == "breaking" || $featureDisplay == "breakingnotext") : ?>
	<div class="breaking-expo">
		<div class="container">
			<div class="row">
				<div class="span12">
<?php while ($queryExposition->have_posts()) : $queryExposition->the_post(); ?>
					<div class="breaking-mainelement">
						<div class="breaking-photo" style="background:url(<?php echo bw_FeaturedImage($post->ID,940,303,bw_CheckPhotoAlign(get_field('photo_alignment'),'c')); ?>)">
							<a href="<?php the_permalink(); ?>" class="breaking-photo-link">
<?php if ($featureDisplay == "breaking") : ?>
								<h2 class="balance-text"><?php the_title(); ?></h2>
								<p><span><?php echo substr(strip_tags(get_the_content()),0,80) . "&hellip;" ?></span></p>
<?php endif; ?>
							</a>
						</div>
					</div>
<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
	<div class="exposition">
		<div class="container">
			<div class="row">
				<div class="span8" <?php if($newsTickerPosition == "left"): ?>style="margin-left:340px"<?php endif; ?>>
<?php 
while ($queryExposition->have_posts()) : $queryExposition->the_post();

if ($featureDisplay == "horizontal" && has_post_thumbnail()) : ?>
					<div class="exposition-mainelement exposition-horizontal-mainelement">
						<div class="exposition-photo" style="background-image:url(<?php echo bw_FeaturedImage($post->ID,620,222,bw_CheckPhotoAlign(get_field('photo_alignment'),'c')); ?>)">
							<a href="<?php the_permalink(); ?>" class="exposition-photo-link">
								<div class="exposition-content">
									<h2><?php the_title(); ?></h2>
									<p><?php echo substr(strip_tags(get_the_content()),0,80) . "&hellip;" ?></p>
								</div>
							</a>
						</div>
					</div>
<?php elseif ($featureDisplay == "vertical" && has_post_thumbnail()) : ?>
					<div class="exposition-mainelement exposition-vertical-mainelement">
						<div class="exposition-photo" style="background:url(<?php echo bw_FeaturedImage($post->ID,240,300,bw_CheckPhotoAlign(get_field('photo_alignment'))); ?>)">
							<a href="<?php the_permalink(); ?>" class="exposition-photo-link">
							</a>
							<?php if (get_field('photo_caption')) { ?>
							<div class="exposition-photo-caption"><a href="<?php the_permalink(); ?>"><?php echo get_field('photo_caption'); ?></a></div>
							<?php } ?>
						</div>
						<h2><a href="<?php the_permalink(); ?>" class="balance-text"><?php the_title(); ?></a></h2>
						<div class="exposition-explainer">
							<p class="exposition-explainer-text"><?php echo substr(strip_tags(get_the_content()),0,400) ?></p>
							<p>
								<a href="<?php the_permalink(); ?>">Read more &rarr;</a>
								<span class="meta-fields">
									<?php the_time('F j, Y g:ia'); ?><br />
									<?php the_field('authors'); ?>
								</span>
							</p>
						</div>
					</div>
<?php elseif ($featureDisplay == "breaking" || $featureDisplay == "breakingnotext") : ?>
<?php else : ?>
					<div class="exposition-mainelement-nophoto">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<span class="featured-blip">FEATURED</span>
						<div class="exposition-explainer">
							<p><?php echo substr(strip_tags(get_the_content()),0,250) . "&hellip;" ?></p>
							<p>
								<a href="<?php the_permalink(); ?>">Read more &rarr;</a>
								<span class="meta-fields">
									<?php the_time('F j, Y g:ia'); ?><br />
									<?php the_field('authors'); ?>
								</span>
							</p>
						</div>
					</div>
<?php endif; ?>
<?php endwhile; wp_reset_postdata(); ?>
					<div class="row" <?php if ($featureDisplay != "breaking" && $featureDisplay != "breakingnotext") : ?>style="margin-top:20px"<?php endif; ?>>
						<div class="span5">
							<div class="matrixexpo-wrapper">
<?php 
$matrixexpoPosition = "left";
while ($querySmallexpo->have_posts()) : $querySmallexpo->the_post();
?>
								<div class="matrixexpo matrixexpo-<?php echo $matrixexpoPosition; ?> <?php echo (has_post_thumbnail()) ? "matrixexpo-hasphoto" : "matrixexpo-bg" . rand(1,5); ?>" <?php if(has_post_thumbnail()) : ?>style="background:url(<?php echo bw_FeaturedImage($post->ID,190,100,bw_CheckPhotoAlign(get_field('photo_alignment'))); ?>)"<?php endif; ?>>
									<a class="matrixexpo-overlay" href="<?php the_permalink(); ?>">
										<h3 class="matrixexpo-heading balance-text"><?php the_field('title-short'); ?></h3>
<?php if (in_category($categoryID_exclusive)) : ?>
										<span class="label hp-labeloverlay"><i class="icon-globe icon-white"></i> Web exclusive</span>
<?php endif; ?>
										<p class="matrixexpo-content balance-text"><?php echo substr(strip_tags(get_the_content()),0,120) . "&hellip;" ?></p>
									</a>
								</div>
<?php 
$matrixexpoPosition = ($matrixexpoPosition == "left") ? "right" : "left";
endwhile; wp_reset_postdata(); ?>
							</div>
						</div>
						<div class="span3">
<?php while ($queryLowerexpo->have_posts()) : $queryLowerexpo->the_post(); ?>
							<div class="lowerexpo <?php echo (has_post_thumbnail()) ? "lowerexpo-hasphoto" : "lowerexpo-nophoto"; ?>">
								<div class="lowerexpo-photo" <?php if(has_post_thumbnail()) : ?>style="background:url(<?php echo bw_FeaturedImage($post->ID,220,115,bw_CheckPhotoAlign(get_field('photo_alignment'),'c')); ?>)"<?php endif; ?>>
									<a class="lowerexpo-link" href="<?php the_permalink(); ?>">
<?php if (in_category($categoryID_exclusive)) : ?>
										<span class="label hp-labeloverlay"><i class="icon-globe icon-white"></i> Web exclusive</span>
<?php endif; ?>
										<h2><?php the_field('title-short'); ?></h2>
									</a>
								</div>
								<p><?php echo substr(strip_tags(get_the_content()),0,120) . "&hellip;" ?> <a href="<?php the_permalink(); ?>">Read more &rarr;</a></p>
							</div>
<?php endwhile; wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
				<div class="span4" <?php if($newsTickerPosition == "left"): ?>style="margin-left:-940px"<?php endif; ?>>
					<div class="news-tickers" <?php if($featureDisplay == "breaking" || $featureDisplay == "breakingnotext") : ?>style="height:208px"<?php endif; ?>>
						<h3>Fresh from our newsroom</h3>
						<ul>
<?php while ($queryNewsticker->have_posts()) : $queryNewsticker->the_post(); ?>
<?php if (has_post_thumbnail()) { ?>
							<li class="news-ticker-containsimage">
								<a href="<?php the_permalink(); ?>"><img class="news-ticker-image pull-right" src="<?php echo bw_FeaturedImage($post->ID,0,70,bw_CheckPhotoAlign(get_field('photo_alignment'))); ?>"></a>

								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<small><?php echo substr(strip_tags(get_the_content()),0,140) ?></small>
								<div style="clear:both"></div>
							</li>
<?php } else { ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php } ?>
<?php endwhile; wp_reset_postdata(); ?>
						</ul>
					</div>
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
<?php include(TEMPLATEPATH . '/homepage-bottom-expanded.php'); ?>
<?php get_footer(); ?>
