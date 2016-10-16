<?php if (is_single() && have_posts()) : 
	the_post();
	$articleDescription  = strip_tags(get_the_category_list(", ")) . " &mdash; ";
	$articleDescription .= substr(strip_tags(get_the_content()),0,150) . "&hellip;";
	$photoLink = bw_FeaturedImage($post->ID,400,300,bw_CheckPhotoAlign(get_field('photo_alignment'),'c'));
?>

<!---- Google / generic -->
<?php if (get_field("authors")) : ?>
<meta name="author" content="<?php the_field("authors"); ?>" />
<meta property="author" content="<?php the_field("authors"); ?>" />
<?php endif; ?>
<meta name="description" content="<?php echo $articleDescription; ?>" />

<!---- OpenGraph -->
<meta property="og:title" content="<?php echo wp_title(""); ?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php echo get_permalink(); ?>" />
<?php if (has_post_thumbnail()) : ?>
<meta property="og:image" content="<?php echo $photoLink; ?>" />
<meta property="og:image:width" content="400" />
<meta property="og:image:height" content="300" />
<?php endif; ?>
<meta property="og:description" content="<?php echo $articleDescription; ?>" />
<meta property="og:site_name" content="<?php echo bloginfo("name"); ?>" />
<meta property="article:published_time" content="<?php the_time("c"); ?>" />
<?php if (get_the_time() != get_the_modified_time()) : ?>
<meta property="article:modified_time" content="<?php the_modified_time("c"); ?>" />
<?php endif; ?>
<meta property="article:section" content="<?php echo strip_tags(get_the_category_list(", ")); ?>" />

<!---- Twitter Cards -->
<meta property="twitter:card" content="summary" />
<meta property="twitter:title" content="<?php echo wp_title(""); ?>" />
<meta property="twitter:description" content="<?php echo $articleDescription; ?>" />
<meta property="twitter:image" content="<?php echo $photoLink; ?>" />
<meta property="twitter:url" content="<?php echo get_permalink(); ?>" />
<?php 
	wp_reset_postdata();
	rewind_posts();
endif; 
?>