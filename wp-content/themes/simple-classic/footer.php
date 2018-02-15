<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @subpackage Simple_Classic
 * @since      Simple Classic
 */
?>
</div><!-- #smplclssc_main -->
<div id="smplclssc_footer">
	<div id="smplclssc_footer-content">
		<p class="smplclssc_copirate">&#169;
			<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a> <?php echo date_i18n( 'Y' ); ?>
		</p>
		<p class="smplclssc_footerlinks"><?php _e( 'Powered by', 'simple-classic' ); ?>
			<a href="<?php echo esc_url( wp_get_theme()->get( 'AuthorURI' ) ); ?>" target="_blank">BestWebLayout</a> <?php _e( 'and', 'simple-classic' ); ?>
			<a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" target="_blank">WordPress</a>
		</p>
	</div><!-- #smplclssc_footer-content -->
</div><!-- #smplclssc_footer -->
</div><!-- #smplclssc_main-container -->
<?php wp_footer(); ?>
</body>
</html>
