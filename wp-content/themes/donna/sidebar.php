<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Doona
 */

if ( ! dynamic_sidebar( 'main-sidebar' ) ) : ?>
	<aside id="archives" class="widget widget_archive">
		<div class="widget-title clearfix">
			<h3><?php esc_html_e( 'Archives', 'donna' ); ?></h3>
		</div>
		<ul>
			<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
		</ul>
	</aside>
	<aside id="meta" class="widget widget_meta">
		<div class="widget-title clearfix">
			<h3><?php esc_html_e( 'Meta', 'donna' ); ?></h3>
		</div>	
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>
	</aside>
<?php endif; ?>
