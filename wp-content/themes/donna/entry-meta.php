<?php 
/**
 * @package Donna
 */
?>
<div class="entry-meta">
	<span class="author-post"><?php esc_html_e('by ','donna');?><span class="author-link"><?php the_author_posts_link(); ?></span></span>
	<span class="separator"><i class="fa fa-circle"></i></span>
	<span><a class="p-date" title="<?php the_time(); ?>" href="<?php the_permalink(); ?>"><span class="post_date date updated"><?php the_time('F j, Y'); ?></span></a></span>
	<span class="separator"><i class="fa fa-circle"></i></span>
	<span><a href="<?php comments_link(); ?>"><?php comments_number( __('No Comments','donna'), __('1 Comment','donna'), __('% Comments','donna')); ?></a></span>
</div><!--entry-meta-->