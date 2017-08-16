<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
  while ( have_posts() ) : the_post(); ?>

  	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  		<div class="entry-content">

  			<?php the_content(); ?>

  		</div><!-- .entry-content -->

  	</article>

  <?php
  endwhile;
  ?>
	<?php wp_footer(); ?>

</body>
</html>
