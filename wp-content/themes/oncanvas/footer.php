<?php
/**
 * The template for displaying the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Oncanvas
 */

$ilovewp_logo = get_template_directory_uri() . '/images/ilovewp-logo.png';

?>

	<footer class="site-footer" role="contentinfo">
	
		<?php get_sidebar( 'footer' ); ?>
		
		<div class="wrapper wrapper-copy">
			<p class="copy"><?php esc_attr_e('Copyright &copy;','oncanvas');?> <?php echo date_i18n(__("Y","oncanvas")); ?> <?php bloginfo('name'); ?>. <?php esc_attr_e('All Rights Reserved', 'oncanvas');?>.</p>
			<p class="copy-ilovewp"><span class="theme-credit"><?php _e( 'Theme by', 'oncanvas' ); ?><a href="http://www.ilovewp.com/" rel="designer" class="footer-logo-ilovewp"><img src="<?php echo esc_url($ilovewp_logo); ?>" width="51" height="11" alt="<?php esc_attr_e('Portfolio WordPress Themes', 'oncanvas');?>" /></a></span></p>
		</div><!-- .wrapper .wrapper-copy -->
	
	</footer><!-- .site-footer -->

</div><!-- end #container -->

<?php wp_footer(); ?>

</body>
</html>