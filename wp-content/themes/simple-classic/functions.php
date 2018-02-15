<?php
/**
 * Simple Classic functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, simpleclassic_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @subpackage Simple_Classic
 * @since      Simple Classic
 */

if ( ! isset( $content_width ) ) {
	$content_width = 625;
}
add_theme_support( 'content-width', $content_width );

/*Function Simple Classic Setup*/
function simpleclassic_setup() {
	/* This theme styles the visual editor with editor-style.css to match the theme style. */
	add_editor_style();
	add_theme_support( 'title-tag' );
	/* This theme uses post thumbnails */
	add_theme_support( 'post-thumbnails' );
	/* Set size of thumbnails */
	set_post_thumbnail_size( 540, 283, true );
	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );
	load_theme_textdomain( 'simple-classic', get_template_directory() . '/languages' );
	/* Register Simple Classic menu */
	register_nav_menu( 'primary', __( 'Header Menu', 'simple-classic' ) );
	/* Add support for custom headers. */
	$custom_header_support = array(
		/* The default header text color. */
		'default-text-color' => '000',
		/* The height and width of our custom header. */
		'width'              => 960,
		'height'             => 283,
		'flex-width'         => true,
		'flex-height'        => true,
		/* Random image rotation by default. */
		'random-default'     => true,
	);
	add_theme_support( 'custom-header', $custom_header_support );
	add_theme_support( 'custom-background' );
	/* Add Simple Classic's custom image sizes.
	 * Used for large feature (header) images. */
	add_image_size( 'large-feature', $custom_header_support['width'], $custom_header_support['height'], true );
	/* Used for featured posts if a large-feature doesn't exist. */
	add_image_size( 'small-feature', 500, 300 );
} /* Simpleclassic_setup */

/* Sidebar register */
function simpleclassic_register_sidebar() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'simple-classic' ),
		'id' => 'sidebar-1',
	) );
}

/* Function that connects scripts for theme */
function simpleclassic_script() {
	wp_enqueue_script( 'simpleclassic-main-script', get_stylesheet_directory_uri() . '/js/script.js', array( 'jquery' ) );
	$string_js = array(
		'chooseFile'      => __( 'Choose file...', 'simple-classic' ),
		'fileNotSel' => __( 'File is not selected.', 'simple-classic' ),
	);
	wp_localize_script( 'simpleclassic-main-script', 'stringJs', $string_js );
	wp_enqueue_style( 'simpleclassic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'simpleclassic-style-ie', get_stylesheet_directory_uri() . '/css/ie.css' );
	wp_style_add_data( 'simpleclassic-style-ie', 'conditional', 'IE' );
	wp_enqueue_script( 'simpleclassic-script-ie', 'http://ie7-js.googlecode.com/svn/trunk/lib/IE9.js' );
	wp_script_add_data( 'simpleclassic-script-ie', 'conditional', 'lt IE 9' );
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/* Display navigation to next/previous pages when applicable */
function simpleclassic_content_nav( $html_id ) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo esc_attr( $html_id ); ?>">
			<div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span> ' . __( 'Older posts', 'simple-classic' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'simple-classic' ) . ' <span class="meta-nav">&rarr;</span>' ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}

/* Styles of comments list */
function simpleclassic_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback'  :
		case 'trackback' : ?>
			<li class="post pingback">
				<p>
					<?php _e( 'Pingback:', 'simple-classic' );
					comment_author_link();
					edit_comment_link( __( 'Edit', 'simple-classic' ), ' ' ); ?>
				</p>
			</li>
			<?php break;
		default : ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<div id="comment-<?php comment_ID(); ?>">
					<div class="comment-author vcard">
						<?php echo get_avatar( $comment, 64 );
						printf( '%s <span class="says">' . __( 'says:', 'simple-classic' ) . '</span>', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author .vcard -->
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'simple-classic' ); ?></em>
						<br />
					<?php endif; ?>
					<div class="comment-meta commentmetadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php /* translators: 1: date, 2: time */
							printf( '%1$s ' . __( 'at', 'simple-classic' ) . ' %2$s', get_comment_date(), get_comment_time() ); ?>
						</a>
					</div><!-- .comment-meta .commentmetadata -->
					<div class="comment-body"><?php comment_text(); ?></div>
					<div class="reply">
						<p>
							<?php comment_reply_link( array_merge( $args, array(
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
							) ) );
							edit_comment_link( __( 'Edit', 'simple-classic' ), ' ' ); ?>
						</p>
					</div><!-- .reply -->
				</div>
			</li><!-- #comment-##  -->
			<?php break;
	endswitch;
}

/* Making navigation */
function simpleclassic_navigation() {
	global $post;
	/* Options */
	$text['home']     = __( 'Home', 'simple-classic' ); /* Link text "Home" */
	$text['category'] = __( 'Category:', 'simple-classic' ) . ' %s'; /* Text for a category page */
	$text['search']   = __( 'Results for:', 'simple-classic' ) . ' %s'; /* Text for the search results page */
	$text['tag']      = __( 'Tags:', 'simple-classic' ) . ' %s'; /* Text for the tag page */
	$text['author']   = __( 'Autors posts:', 'simple-classic' ) . ' %s'; /* Text for the autor page */
	$text['404']      = __( 'Error 404', 'simple-classic' ); /* Text for the page 404 */
	$showcurrent      = 1; /* 1 - show the name of the current article / page, 0 - no */
	$showonhome       = 0; /* 1 - show the "simpleclassic_navigation" on the main page, 0 - no */
	$delimiter        = ' - '; /* Divide between the "simpleclassic_navigation" */
	$before           = '<span>'; /* Tag before the current "crumb" */
	$after            = '</span>'; /* Tag after the current "crumb" */
	/* End options */
	$homelink   = home_url() . '/';
	$linkbefore = '<span>';
	$linkafter  = '</span>';
	$linkattr   = ' rel=""';
	$link       = $linkbefore . '<a' . $linkattr . ' href="%1$s">%2$s</a>' . $linkafter;

	if ( is_home() || is_front_page() ) {
		if ( 1 == $showonhome ) {
			echo '<h2 id="smplclssc_crumbs"><a href="' . $homelink . '">' . $text['home'] . '</a></h2>';
		}
	} elseif ( is_page() ) {

		echo '<h1>';
		echo '<a href="';
		the_permalink();
		echo '">';
		echo get_the_title();
		echo '</a>';
		echo '</h1>';

	} else {
		echo '<h2 id="smplclssc_crumbs">' . sprintf( $link, $homelink, $text['home'] ) . $delimiter;
		if ( is_category() ) {
			$thiscat = get_category( get_query_var( 'cat' ), false );
			if ( 0 != $thiscat->parent ) {
				$cats = get_category_parents( $thiscat->parent, true, $delimiter );
				$cats = str_replace( '<a', $linkbefore . '<a' . $linkattr, $cats );
				$cats = str_replace( '</a>', '</a>' . $linkafter, $cats );
				echo $cats;
			}
			echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
		} elseif ( is_search() ) {
			echo $before . sprintf( $text['search'], get_search_query() ) . $after;
		} elseif ( is_day() ) {
			echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
			echo sprintf( $link, get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ), get_the_time( 'F' ) ) . $delimiter;
			echo $before . get_the_time( 'd' ) . $after;
		} elseif ( is_month() ) {
			echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
			echo $before . get_the_time( 'F' ) . $after;
		} elseif ( is_year() ) {
			echo $before . get_the_time( 'Y' ) . $after;
		} elseif ( is_single() && ! is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object( get_post_type() );
				$slug      = $post_type->rewrite;
				printf( $link, $homelink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name );
				if ( 1 == $showcurrent ) {
					echo $delimiter . $before . get_the_title() . $after;
				}
			} else {
				$cat  = get_the_category();
				$cat  = $cat[0];
				$cats = get_category_parents( $cat, true, $delimiter );
				if ( 0 == $showcurrent ) {
					$cats = preg_replace( "#^(.+)$delimiter$#", '$1', $cats );
				}
				$cats = str_replace( '<a', $linkbefore . '<a' . $linkattr, $cats );
				$cats = str_replace( '</a>', '</a>' . $linkafter, $cats );
				echo $cats;
				if ( 1 == $showcurrent ) {
					echo $before . get_the_title() . $after;
				}
			}
		} elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() ) {
			$post_type = get_post_type_object( get_post_type() );
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) {
			$parent = get_post( $post->post_parent );
			$cat    = get_the_category( $parent->ID );
			$cat    = $cat[0];
			$cats   = get_category_parents( $cat, true, $delimiter );
			$cats   = str_replace( '<a', $linkbefore . '<a' . $linkattr, $cats );
			$cats   = str_replace( '</a>', '</a>' . $linkafter, $cats );
			echo $cats;
			printf( $link, get_permalink( $parent ), $parent->post_title );
			if ( 1 == $showcurrent ) {
				echo $delimiter . $before . get_the_title() . $after;
			}
		} elseif ( is_page() && ! $post->post_parent ) {
			if ( 1 == $showcurrent ) {
				echo $before . get_the_title() . $after;
			}
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id   = $post->post_parent;
			$breadcrumbs = array();
			while ( $parent_id ) {
				$page          = get_post( $parent_id );
				$breadcrumbs[] = sprintf( $link, get_permalink( $page->ID ), get_the_title( $page->ID ) );
				$parent_id     = $page->post_parent;
			}
			$breadcrumbs = array_reverse( $breadcrumbs );
			for ( $i = 0; $i < count( $breadcrumbs ); $i ++ ) {
				echo $breadcrumbs[ $i ];
				if ( count( $breadcrumbs ) - 1 != $i ) {
					echo $delimiter;
				}
			}
			if ( 1 == $showcurrent ) {
				echo $delimiter . $before . get_the_title() . $after;
			}
		} elseif ( is_tag() ) {
			echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata( $author );
			echo $before . sprintf( $text['author'], $userdata->display_name ) . $after;
		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}
		if ( get_query_var( 'paged' ) ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
				echo ' (';
			}
			echo __( 'Page', 'simple-classic' ) . ' ' . get_query_var( 'paged' );
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
				echo ')';
			}
		}
		echo '</h2>';
	}
}
/* End of simpleclassic_navigation() */

add_action( 'after_setup_theme', 'simpleclassic_setup' );
add_action( 'widgets_init', 'simpleclassic_register_sidebar' );
add_action( 'wp_enqueue_scripts', 'simpleclassic_script' );
add_filter( 'simpleclassic_navigation', 'simpleclassic_navigation' );
add_filter( 'simpleclassic_content_nav', 'simpleclassic_content_nav' );
