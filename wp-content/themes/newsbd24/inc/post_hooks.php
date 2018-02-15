<?php
/**
 * Functions hooked to post page.
 *
 * @package newsbd24
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 if ( ! function_exists( 'newsbd24_posts_formats_thumbnail' ) ) :

	/**
	 * Post formats thumbnail.
	 *
	 * @since 1.0.0
	 */
	function newsbd24_posts_formats_thumbnail() {
	?>
		<?php if ( has_post_thumbnail() ) :
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			$formats = get_post_format(get_the_ID());
		?>
           <div class="blog-media <?php echo esc_attr( $formats );?>">
           		<?php if ( is_singular() ) :?>
               		 <a href="<?php echo esc_url( $post_thumbnail_url );?>" class="image-popup">
                <?php else: ?>
                	<a href="<?php echo esc_url( get_permalink() );?>" class="image-link">
                <?php endif;?>
                <span class="style_1"><?php the_post_thumbnail('full');?></span>
                </a>
            </div>
         <?php else:?>
         
        <?php endif;?>  
	<?php
	}

endif;
add_action( 'newsbd24_posts_formats_thumbnail', 'newsbd24_posts_formats_thumbnail' );


if ( ! function_exists( 'newsbd24_posts_formats_video' ) ) :

	/**
	 * Post Formats Video.
	 *
	 * @since 1.0.0
	 */
	function newsbd24_posts_formats_video() {
	
		$content = apply_filters( 'the_content', get_the_content(get_the_ID()) );
		$video = false;
		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		}
		
		
			// If not a single post, highlight the video file.
			if ( ! empty( $video ) ) :
				foreach ( $video as $video_html ) {
					echo '<div class="blog-media"><div class="entry-video embed-responsive embed-responsive-16by9">';
						echo $video_html;
					echo '</div></div>';
				}
			else: 
				do_action('newsbd24_posts_formats_thumbnail');	
			endif;
		
		
	 }

endif;
add_action( 'newsbd24_posts_formats_video', 'newsbd24_posts_formats_video' ); 


if ( ! function_exists( 'newsbd24_posts_formats_audio' ) ) :

	/**
	 * Post Formats audio.
	 *
	 * @since 1.0.0
	 */
	function newsbd24_posts_formats_audio() {
		$content = apply_filters( 'the_content', get_the_content() );
		$audio = false;
	
		// Only get audio from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
		}
	
		
	
		// If not a single post, highlight the audio file.
		if ( ! empty( $audio ) ) :
			foreach ( $audio as $audio_html ) {
				echo '<div class="blog-media">';
					echo $audio_html;
				echo '</div>';
			}
		else: 
			do_action('newsbd24_posts_formats_video');	
		endif;
	
		
	 }

endif;
add_action( 'newsbd24_posts_formats_audio', 'newsbd24_posts_formats_audio' ); 

add_filter( 'use_default_gallery_style', '__return_false' );


if ( ! function_exists( 'newsbd24_posts_formats_gallery' ) ) :

	/**
	 * Post Formats gallery.
	 *
	 * @since 1.0.0
	 */
	function newsbd24_posts_formats_gallery() {
		
		if ( get_post_gallery() ) :
			echo '<div class="gallery-media">';
				echo get_post_gallery();
			echo '</div>';
		else: 
			do_action('newsbd24_posts_formats_thumbnail');	
		endif;	
	
	 }

endif;
add_action( 'newsbd24_posts_formats_gallery', 'newsbd24_posts_formats_gallery' ); 




if ( ! function_exists( 'newsbd24_posts_formats_header' ) ) :

	/**
	 * Post newsbd24_posts_blog_media
	 *
	 * @since 1.0.0
	 */
	function newsbd24_posts_blog_media() {
		$formats = get_post_format(get_the_ID());
		
		switch ( $formats ) {
			default:
				do_action('newsbd24_posts_formats_thumbnail');
			break;
			case 'gallery':
				do_action('newsbd24_posts_formats_gallery');
			break;
			case 'audio':
				do_action('newsbd24_posts_formats_audio');
			break;
			case 'video':
				do_action('newsbd24_posts_formats_video');
			break;
		} 
		
	 }

endif;
add_action( 'newsbd24_posts_blog_media', 'newsbd24_posts_blog_media' ); 

/*
remove_shortcode('gallery');
function newsreader_gallery($atts){
	extract( shortcode_atts( array(
		'size' => '',
		'ids' => '',
	), $atts ) );
	$html = '';
	if(!empty($ids)){
		$array = explode( ',' , $ids );
		$html .= '<div class="postGallery owl-carousel owl-theme">';
		foreach ($array as $id){
			
			$full = wp_get_attachment_image_src( $id, 'full' );
			$html .= '<div class="item">
				<a href="'.$full[0].'" class="image-popup"><img src="'.$full[0].'"></a>
			</div>';
		}
		
		$html .= '</div>';
		
		
	
	}
	return $html;
}
add_shortcode( 'gallery', 'newsreader_gallery' );*/


if ( ! function_exists( 'newsbd24_posts_loop_before' ) ) :

	/**
	 * Post newsbd24_posts_loop_before
	 *
	 * @since 1.0.0
	 */
	function newsbd24_posts_loop_before() {
	?>
        <div class="row masonry_grid"> 
        <div class="col-md-6 col-sm-6 col-xs-12 grid-sizer"></div>
	<?php
	 }

endif;
add_action( 'newsbd24_posts_loop_before', 'newsbd24_posts_loop_before' ); 

if ( ! function_exists( 'newsbd24_posts_loop_after' ) ) :

	/**
	 * Post newsbd24_posts_loop_before
	 *
	 * @since 1.0.0
	 */
	function newsbd24_posts_loop_after() {
	?>
        </div>
	<?php
	 }

endif;
add_action( 'newsbd24_posts_loop_after', 'newsbd24_posts_loop_after',10 ); 

if ( ! function_exists( 'newsbd24_posts_loop_navigation' ) ) :

	/**
	 * Post Posts Loop Navigation
	 *
	 * @since 1.0.0
	 */
	function newsbd24_posts_loop_navigation() {
		if( newsbd24_get_option( 'pagination_type' ) === 'default' ):
			$args = array (
			   'prev_text'          => '<i class="fa fa-long-arrow-left"></i>'. esc_html__('Previous Posts','newsbd24'),
			   'next_text'          =>  esc_html__('Next Posts','newsbd24').'<i class="fa fa-long-arrow-right"></i>',
			);
			echo '<div class="loop-prev-next">';
			the_posts_navigation( $args );
			echo '</div>';
		else:
			echo "<div class='clearfix'></div><div class='pagination justify-content-center'>";
			the_posts_pagination( array(
				'format' => '/page/%#%',
				'type' => 'list',
				'mid_size' => 2,
				'prev_text' => esc_html__( 'Previous', 'newsbd24' ),
				'next_text' => esc_html__( 'Next', 'newsbd24' ),
				'screen_reader_text' => esc_html__( '&nbsp;', 'newsbd24' ),
			) );
			echo "</div>";
		endif;
	}

endif;
add_action( 'newsbd24_posts_loop_after', 'newsbd24_posts_loop_navigation', 11 ); 


if ( ! function_exists( 'newsbd24_posts_loop_template_part' ) ) :

	/**
	 * Post Get themplate Part
	 *
	 * @since 1.0.0
	 */
	function newsbd24_posts_loop_template_part( $i = 1 ) {
		
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		if(  $i < 3 ){ 
		
		  get_template_part( 'template-parts/loop/content', get_post_format() );
		  
		}else{
			
		  get_template_part( 'template-parts/loop/content', 'grid' );
		  
		}
	}

endif;
add_action( 'newsbd24_posts_loop_template_part', 'newsbd24_posts_loop_template_part', 10 ); 


if ( ! function_exists( 'newsbd24_single_post_navigation' ) ) :

	/**
	 * Post Single Posts Navigation 
	 *
	 * @since 1.0.0
	 */
	function newsbd24_single_post_navigation( ) {
		echo '<div class="row single-prev-next">';
		$prevPost = get_previous_post(true);
		if( $prevPost ) :
			echo '<div class="col-md-6 col-sm-6 ">';
				$prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(40,40) );
				previous_post_link('%link',$prevthumbnail , TRUE); 
				echo '<div class="text"><h6>'.esc_html__('Previous Article','newsbd24').'</h6>';
					previous_post_link('%link',"<span>%title</span>", TRUE); 
				echo '</div>';
			echo '</div>';
			
		endif;
		
		$nextPost = get_next_post(true);
		if( $nextPost ) : 
			echo '<div class="col-md-6 col-sm-6 pull-right">';
				$nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(40,40) );
				next_post_link('%link',$nextthumbnail, TRUE);
				echo '<div class="text"><h6>'.esc_html__('Next Article','newsbd24').'</h6>';
					next_post_link('%link',"<span>%title</span>", TRUE);
				echo '</div>';
			echo '</div>';
			
		endif;
		echo '</div><hr class="dashedhr">';
	} 

endif;
add_action( 'newsbd24_single_post_navigation', 'newsbd24_single_post_navigation', 10 ); 


if( ! function_exists( 'newsbd24_blog_loop_content_type' ) && ! is_admin() ) :

    /**
     * Excerpt length
     *
     * @since  Blog Expert 1.0.0
     *
     * @param null
     * @return int
     */
    function newsbd24_blog_loop_content_type( $length ){
        $type = newsbd24_get_option( 'blog_loop_content_type' );

        if ( $type === 'excerpt-only' ) {
        	the_excerpt();
        }else{
			$content = preg_replace("/<embed[^>]+>/i", "", get_the_content() , 1);
			echo strip_shortcodes( $content );
		}

        return $length;

    }

endif; 
add_action( 'newsbd24_blog_loop_content_type', 'newsbd24_blog_loop_content_type', 10 ); 