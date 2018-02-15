<?php
/**
 * The Sidebar containing the primary widget area.
 *
 * @subpackage Simple_Classic
 * @since      Simple Classic
 */
?>

<div id="smplclssc_sidebar">
	<div class="smplclssc_widget">
		<ul>
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) {
				dynamic_sidebar( 'sidebar-1' );
			} else {
				$args     = array(
					'before_widget' => '<li class="widget %s">',
					'after_widget'  => '</li>',
					'before_title'  => '<h2 class="widgettitle">',
					'after_title'   => '</h2>',
				);
				$instance = array();
				the_widget( 'WP_Widget_Search', $instance, $args );
				the_widget( 'WP_Widget_Recent_Posts', $instance, $args );
				the_widget( 'WP_Widget_Recent_Comments', $instance, $args );
				the_widget( 'WP_Widget_Archives', $instance, $args );
				the_widget( 'WP_Widget_Categories', $instance, $args );
			} ?>
		</ul>
	</div><!-- .widget -->
</div><!-- #sidebar -->
