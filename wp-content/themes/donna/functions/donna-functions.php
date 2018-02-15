<?php
/**
 * Donna functions and definitions
 *
 * @package Donna
 *
 *
 */
	
/**
 * Loads theme setup functions.
 */
 function donna_setup() {
	/**
 	* Sets up the content width.
 	*/
	global $content_width;
	if ( ! isset( $content_width ) ) { $content_width = 1200; }
	
	/** 
	 * Makes theme available for translation
	 * 
	 */
	load_theme_textdomain( 'donna');

	/** 
 	* This theme styles the visual editor with editor-style.css to match the theme style.
 	*/
	add_editor_style( array( 'css/editor-style.css' ));

	/** 
 	 * Default RSS feed links
	 */
	add_theme_support('automatic-feed-links');
	
	/**
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/**
 	* Register Navigation
 	*/
	register_nav_menu('main_navigation', __('Primary Menu', 'donna') );

	/** 
 	* Support a variety of post formats.
 	*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'gallery' ) );

	/** 
 	* Enable support for Post Thumbnails on posts and pages.
 	*/
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 ); 
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
	
	/**
 	* Sets up theme custom background.
 	*/
	$donna_color_args = array(
	'default-color' => 'f5f5f5',
	'default-image' => '',
	);
	add_theme_support( 'custom-background', $donna_color_args );
	
	/*
	* Enable support for custom logo.
	*/
	add_theme_support( 'custom-logo' );

	/**
	* Indicate widget sidebars can use selective refresh in the Customizer.
	*/	
	add_theme_support( 'customize-selective-refresh-widgets' );
 }
 
 add_action( 'after_setup_theme', 'donna_setup' );
 
 function donna_add_script_function() {
	/** 
	* Enqueue CSS
	*/	
	 wp_enqueue_style ('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
	 wp_enqueue_style('donna',  get_stylesheet_uri());
	 wp_enqueue_style ('font-awesome', get_template_directory_uri() . '/css/font-awesome.css');
	 wp_enqueue_style ('ionicons', get_template_directory_uri() . '/css/ionicons.css');
	 
	/** 
	 * Enqueue Javascripts
	 */
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ),'', false);
	wp_enqueue_script('jquery-smartmenus', get_template_directory_uri() . '/js/jquery.smartmenus.js', array( 'jquery' ),'', false);
	wp_enqueue_script('jquery-smartmenus-bootstrap', get_template_directory_uri() . '/js/jquery.smartmenus.bootstrap.js', array( 'jquery' ),'', false);	
	wp_enqueue_script('jquery-masonry');
	wp_enqueue_script('donna-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ),'', false);
	wp_enqueue_script('donna-html5', get_template_directory_uri() . '/js/html5.js', array(), '' );
	wp_enqueue_script('donna-scrollup', get_template_directory_uri() . '/js/scrollup.js', array( 'jquery' ),'', true); 
	wp_script_add_data( 'donna-html5', 'conditional', 'lt IE 9' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	$donna_theme_options = donna_get_options( 'donna_theme_options' );
	
	if( $donna_theme_options['google_font_body']) {
		wp_enqueue_style ('donna-body-font', '//fonts.googleapis.com/css?family='. urlencode($donna_theme_options['google_font_body']) .':400,400italic,700,700italic&subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese');
	}
	
	if( $donna_theme_options['google_font_logo']) {
		wp_enqueue_style ('donna-logo-font', '//fonts.googleapis.com/css?family='. urlencode($donna_theme_options['google_font_logo']) .':400,400italic,700,700italic&subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese');
	}
 }
 
 add_action('wp_enqueue_scripts','donna_add_script_function');
 
 /** 
 * Register widgetized locations
 */
function donna_widgets_init() {
	register_sidebar(array(
		'name' => __( 'Main Sidebar', 'donna' ),
		'id' => 'main-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-title clearfix"><h3><span>',
		'after_title' => '</span></h3></div>',
	));
	
	register_sidebar(array(
		'name' => __( 'Secondary Sidebar', 'donna' ),
		'id' => 'secondary-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-title clearfix"><h3><span>',
		'after_title' => '</span></h3></div>',
	));

	register_sidebar(array(
		'name' =>  __( 'Footer Widget 1', 'donna' ),
		'id' => 'footer-widget-1',
		'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => __( 'Footer Widget 2', 'donna' ),
		'id' => 'footer-widget-2',
		'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => __( 'Footer Widget 3', 'donna' ),
		'id' => 'footer-widget-3',
		'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
}

add_action( 'widgets_init', 'donna_widgets_init' );
 
 /** 
 * Function for displaying custom logo.
 * 
 */
if ( ! function_exists( 'donna_the_custom_logo' ) ) :
function donna_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

/** 
 * Function for custom search form.
*/
function donna_search_form( $form ) {
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url(home_url( '/' )) . '" >
    		<div class="input">
    			<input type="text" placeholder="'.esc_attr(__('Search...','donna')) .'" value="' . get_search_query() . '" name="s" />
				<div class="flip-box">
					<button class="searchSubmit">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</div>
    </form>';

    return $form;
}

add_filter( 'get_search_form', 'donna_search_form' );

/** 
* Function which displays post date in time ago format
*/
function donna_time_ago() {
	return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.esc_html__( 'ago','donna' );
}

/** 
 * Function to add footer menu.
 * 
 */
function donna_register_footer_menu() {
	register_nav_menu( 'footer', __( 'Footer', 'donna' ) );
}

add_action( 'init', 'donna_register_footer_menu' ); 

/** 
 * Function to add social menu.
 * 
 */
function donna_register_social_menu() {
	register_nav_menu( 'social', __( 'Social', 'donna' ) );
}

add_action( 'init', 'donna_register_social_menu' );

/** 
 * Function for displaying image attachments.
 * 
 */
function donna_the_attached_image() {
	$post = get_post();
	$attachment_size = apply_filters( 'donna_attachment_size', array( 1024, 1024 ) );
	$next_attachment_url = wp_get_attachment_url();
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}

/** 
 * Function to add author info box and display inside the post.
*/
function donna_author_info_box( $content ) {
	global $post; 
	$donna_theme_options = donna_get_options( 'donna_theme_options' );
	$author_info = $donna_theme_options['author_info'];
	
	if ($author_info == true ) {
		// Detect if it is a single post with a post author
		if ( is_single() && isset( $post->post_author ) ) {
			// Get author's display name
			$display_name = get_the_author_meta( 'display_name', $post->post_author );
			// If display name is not available then use nickname as display name
			if ( empty( $display_name ) )
			$display_name = get_the_author_meta( 'nickname', $post->post_author );
			// Get author's biographical information or description
			$user_description = get_the_author_meta( 'user_description', $post->post_author );
			// Get author's website URL
			$user_website = esc_url(get_the_author_meta('url', $post->post_author));
			// Get link to the author archive page
			$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
			if ( ! empty( $display_name ) )
			$author_details = '<p class="author_name">'. esc_html('About ','donna') . $display_name . '</p>';
			if ( ! empty( $user_description ) )
			// Author avatar and bio
			$author_details .= '<p class="author_details">' . get_avatar( get_the_author_meta('user_email') , 90 ) . nl2br( $user_description ). '</p>';
			$author_details .= '<p class="author_links"><a href="'. $user_posts .'">'. esc_html('View all posts by ', 'donna') . $display_name . '</a>'; 
			// Check if author has a website in their profile
			if ( ! empty( $user_website ) ) {
				// Display author website link
				$author_details .= ' | <a href="' . $user_website .'" target="_blank" rel="nofollow">'. esc_html('Website', 'donna') .'</a></p>';
			} else {
				// if there is no author website then just close the paragraph
				$author_details .= '</p>';
			}
			// Pass all this info to post content 
			$content = $content . '<div class="author_bio_section" >' . $author_details . '</div>';
		}
		
		return $content;
	
	} else {
		
		return $content;
		
	}

}
	 
// Add function to the post content filter
add_action( 'the_content', 'donna_author_info_box' );

/** 
 * Function for displaying image slider.
 * 
 */
function donna_image_slider() {
	global $post;
	$donna_theme_options = donna_get_options( 'donna_theme_options' );
	$slider_cat = $donna_theme_options['image_slider_cat'];
	$num_of_slides = $donna_theme_options['slider_num'];
	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array( 'jquery' ),'', false);
	$donna_slider_query = new WP_Query(
		array(
			'posts_per_page' => $num_of_slides,
			'cat' 	=> $slider_cat
			)
	); ?>
	<div class="donna-slider">
		<div id="owl-wrap" class="owl-carousel">
			<?php while ( $donna_slider_query->have_posts() ): $donna_slider_query->the_post(); ?>
				<article class="slider-item">
					<div class="slider-item-inner">
						<?php $donna_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
						<div class="slider-img" style="background-image: url( <?php echo esc_url($donna_image[0]); ?>)"></div>
						<div class="slider-content">
							<?php get_template_part( 'entry', 'cats' ); ?>
							<a class="post-title" href="<?php the_permalink(); ?>"><h2 <?php post_class('entry-title'); ?>><?php the_title(); ?></h2></a>
							<?php get_template_part( 'entry', 'meta' ); ?>
						</div>
					</div>
				</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div><!--owl-carousel-->
	</div><!--donna-slider-->
<?php
	wp_enqueue_script( 'donna-image-slider', get_template_directory_uri() .'/js/donna-image-slider.js' , array( 'jquery' ), '', true );
}

/** 
 * Function to display image slider in gallery post formats.
*/
function donna_gallery_post() { 
	global $post;
	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array( 'jquery' ),'', false);
	?>
	<div class="donna-slider">
		<div id="owl-wrap" class="owl-carousel">	
		<?php
			//Pull gallery images from custom meta
			$gallery_image = get_post_gallery_images( $post );
			if($gallery_image !=  ''){
				foreach ($gallery_image as $arr){ ?>
					<article class="slider-item">
						<div class="slider-item-inner">
							<div class="slider-img" style="background-image: url( <?php echo esc_url($arr); ?>)"></div>
						</div>
					</article>
				<?php
				}
			}
		?>		
		</div>
	</div>	
	<?php wp_enqueue_script('donna-gallery-slides', get_template_directory_uri() . '/js/gallery-slides.js', array( 'jquery' ),'', true);
}

/** 
 * Function to add ScrollUp to the footer.
*/
function donna_add_scrollup() { 
	
	echo '<a href="#" class="back-to-top"><i class="ion-ios-arrow-up"></i></a>'."\n";
	
}

add_action('wp_footer', 'donna_add_scrollup');