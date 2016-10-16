<?php /*
PBJ YARPP template
Author: Project for Better Journalism
*/
?>
<div class="article-related">
	<h3>Related writing:</h3>
<?php if (have_posts()):?>
	<ul>
<?php while (have_posts()) : the_post(); ?>
		<li>
			<a href="<?php the_permalink() ?>" rel="bookmark">
				<?php the_title(); ?>
			</a><!-- (<?php the_score(); ?>)-->
		</li>
<?php endwhile; ?>
	</ul>
<?php else: ?>
	<p>No related writing.</p>
<?php endif; ?>
</div>