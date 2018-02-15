<?php
/**
 * Widget API: Almia_Widget_Recent_Posts class
 *
 * @package Almia
 * @since 1.0.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */
class Almia_Widget_Recent_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'widget-recent-posts', 'description' => __( "Your site&#8217;s most recent Posts.", 'almia') );
		parent::__construct('almia-recent-posts', __('Almia - Recent Posts', 'almia'), $widget_ops);
		$this->alt_option_name = 'widget_recent_posts';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'almia' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$sort = isset( $instance['sort'] ) ? $instance['sort'] : 'date';
		$category = isset( $instance['category'] ) ? $instance['category'] : '';

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'almia_widget_posts_args', array(
			'posts_per_page'      => $number,
			'cat'                 => $category,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'orderby'            => $sort,
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
		?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<ul>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li>
			<?php if ( has_post_thumbnail() ) : ?>
				<a class="post-thumbnail alignleft" href="<?php the_permalink(); ?>" aria-hidden="true">
					<?php the_post_thumbnail( 'thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
				</a>
			<?php endif; ?>
			<?php if ( $sort == 'date' ) : ?>
				<span class="entry-meta"><?php echo get_the_date(); ?></span>
			<?php endif; ?>
			<?php if ( $sort == 'comment_count' ) : ?>
				<span class="entry-meta"><?php comments_popup_link( __( 'No comment', 'almia' ) ); ?></span>
			<?php endif; ?>

				<span class="entry-title"><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></span>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = absint( $new_instance['number'] );
		$instance['sort'] = $new_instance['sort'];
		$instance['category'] = $new_instance['category'];
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$sort      = isset( $instance['sort'] ) ? $instance['sort'] : 'date';
		$category      = isset( $instance['category'] ) ? $instance['category'] : '';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'almia' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Category:', 'almia' ); ?></label>
			<?php wp_dropdown_categories( 
					array (
						'show_option_all' => __('All Categories', 'almia'),
						'name'            => $this->get_field_name( 'category' ),
						'id'              => $this->get_field_id( 'category' ),
						'selected'        => $category,
					) ); 
			?>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to show:', 'almia' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id( 'sort' ); ?>"><?php esc_html_e( 'Sort By:', 'almia' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'sort' ); ?>" name="<?php echo $this->get_field_name( 'sort' ); ?>" >
				<option value="date" <?php selected( $sort, 'date' ); ?> > <?php esc_html_e('Date', 'almia'); ?> </option>
				<option value="comment_count" <?php selected( $sort, 'comment_count' ); ?> > <?php esc_html_e('Comments Number', 'almia'); ?> </option>
			</select>
		</p>
<?php
	}
}

/* Register the widget */
function almia_register_widget_recent_posts() {
	return register_widget("Almia_Widget_Recent_Posts");	
}
add_action('widgets_init', 'almia_register_widget_recent_posts');