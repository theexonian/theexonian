<?php
/**
 * The template for displaying image attachments.
 *
 * @subpackage Simple_Classic
 * @since      Simple Classic
 */

get_header(); ?>
<div id="smplclssc_content">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="nav-single">
				<span class="nav-previous"><?php previous_image_link( '%link', '<span class="meta-nav">&larr;</span> ' . __( 'Previous', 'simple-classic' ) ); ?></span>
				<span class="nav-next"><?php next_image_link( '%link', __( 'Next', 'simple-classic' ) . '<span class="meta-nav">&rarr;</span>' ); ?></span>
			</div><!-- #nav-single -->
			<?php $metadata = wp_get_attachment_metadata(); ?>
			<p class="smplclssc_data-descr">
				<?php _e( 'Posted on', 'simple-classic' ); ?> <a href="<?php the_permalink(); ?>"><?php the_date(); ?></a>
				<?php _e( 'at', 'simple-classic' ); ?>
				<a href="<?php echo wp_get_attachment_url(); ?>" target="_blank"><?php echo $metadata['width'] . ' &times; ' . $metadata['height']; ?></a>
				<?php _e( 'in', 'simple-classic' ); ?>
				<a href="<?php echo get_permalink( $post->post_parent ); ?>"><?php echo get_the_title( $post->post_parent ); ?></a>
			</p><!-- .smplclssc_data-descr -->
			<h1 class="smplclssc_titleinmain"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<div class="smplclssc_image-attachment">
				<?php /* Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
						   * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file */
				$attachments = array_values( get_children( array(
					'post_parent'    => $post->post_parent,
					'post_status'    => 'inherit',
					'post_type'      => 'attachment',
					'post_mime_type' => 'image',
					'order'          => 'ASC',
					'orderby'        => 'menu_order ID',
				) ) );
				foreach ( $attachments as $k => $attachment ) {
					if ( $attachment->ID == $post->ID ) {
						break;
					}
				}
				$k ++;
				/* If there is more than 1 attachment in a gallery */
				if ( count( $attachments ) > 1 ) {
					/* Get the URL of the next image attachment */
					if ( isset( $attachments[ $k ] ) ) {
						$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
					} else /* Or get the URL of the first image attachment */ {
						$next_attachment_url = get_attachment_link( $attachments[0]->ID );
					}
				} else {
					/* Or, if there's only 1 image, get the URL of the image */
					$next_attachment_url = wp_get_attachment_url();
				} ?>
				<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
					<?php $attachment_size = apply_filters( 'simpleclassic_attachment_size', 1060 );
					echo wp_get_attachment_image( $post->ID, array(
						$attachment_size,
						1024,
					) ); /* Filterable image width with 1024px limit for image height. */ ?>
				</a>
				<?php if ( ! empty( $post->post_excerpt ) ) : ?>
					<div class="smplclssc_entry-caption">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
						<?php $attachment = get_posts( array(
							'post_type'   => 'attachment',
							'post_parent' => $post->ID,
						) );
						if ( $attachment ) {
							echo '<p class="smplclssc_img-descr">' . $attachment[0]->post_excerpt . '</p>';
						}
						the_excerpt(); ?>
					</div><!-- .smplclssc_entry-caption -->
				<?php endif; ?>
			</div><!-- .smplclssc_image-attachment -->
			<div class="smplclssc_entry-description">
				<?php the_content();
				if ( has_tag() ) : ?>
					<div class="smplclssc_tags">
						<p><?php the_tags(); ?></p>
					</div>
				<?php endif; ?>
				<div class="smplclssc_post-border">
					<?php wp_link_pages( array(
						'before' => '<div class="smplclssc_page-links"><span>' . __( 'Pages: ', 'simple-classic' ) . '</span>',
						'after'  => '</div>',
					) ); ?>
				</div><!-- .smplclssc_post-border -->
			</div><!-- .smplclssc_entry-description -->
			<?php comments_template();
		endwhile; ?>
	</div><!-- #post-## -->
</div><!-- #smplclssc_content -->
<?php get_sidebar();
get_footer();
