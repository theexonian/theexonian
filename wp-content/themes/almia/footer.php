<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * 
 * @package Almia
 * @since Almia 1.0
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php if ( shortcode_exists( 'optinform' ) && get_theme_mod( 'footer_optin_form', false ) ) echo do_shortcode('[optinform]'); ?>

			<?php
			$has_widget = ( is_active_sidebar('footer-widget-1')  || is_active_sidebar('footer-widget-2')  || is_active_sidebar('footer-widget-3') || is_active_sidebar('footer-widget-4') ); ?>
			
			<?php if ( $has_widget ) : ?>
			<div class="footer-widget-wrapper">
				<?php if ( is_active_sidebar('footer-widget-1') ) : ?>
				<div id="footer-widget-1" class="footer-widget">
					<?php dynamic_sidebar( 'footer-widget-1' ); ?>
				</div>
				<?php endif; ?>
				<?php if ( is_active_sidebar('footer-widget-2') ) : ?>
				<div id="footer-widget-2" class="footer-widget">
					<?php dynamic_sidebar( 'footer-widget-2' ); ?>
				</div>
				<?php endif; ?>
				<?php if ( is_active_sidebar('footer-widget-3') ) : ?>
				<div id="footer-widget-3" class="footer-widget">
					<?php dynamic_sidebar( 'footer-widget-3' ); ?>
				</div>
				<?php endif; ?>
				<?php if ( is_active_sidebar('footer-widget-4') ) : ?>
				<div id="footer-widget-4" class="footer-widget">
					<?php dynamic_sidebar( 'footer-widget-4' ); ?>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'almia' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'primary-menu',
						 ) );
					?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'almia' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>',
						) );
					?>
				</nav><!-- .social-navigation -->
			<?php endif; ?>

			<div class="site-info">
				<?php
				/**
				 * Fires before the almia footer text for footer customization.
				 *
				 * @since Almia 1.0
				 */
				do_action( 'almia_credits' );
			 	almia_footer_credit();

				 ?>
			</div><!-- .site-info -->
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
