<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package Donna
 */ ?>
	 	<footer class="footer-area">
		 	<div class="container">
			 	<div class="footer clearfix">
				 	<?php  get_sidebar('footer'); ?>
				 	<div class="clearfix"></div>
				 	<?php get_template_part( 'menu', 'footer' ); ?>	
				 	<div class="clearfix"></div>
				 	<?php get_template_part( 'copyright' ); ?>	
				 	<div class="clearfix"></div>
				 	<?php get_template_part( 'menu', 'social' ); ?>	
			 	</div><!--footer-->
		 	</div><!--container-->
	 	</footer>
	 </div><!--grid-container-inner-->
 </div><!--grid-container-->
 <?php wp_footer(); ?>
</body>
</html>