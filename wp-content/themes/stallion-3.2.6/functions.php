<?php

/**
 * Run-once scripts.
 */
add_action("init","bw_RunOnceScripts");
function bw_RunOnceScripts() {
	// As of 3.0.3: Disable irrelevant roles in WordPress.
	remove_role("super_admin");
	remove_role("author");
	remove_role("subscriber");

	// As of 3.0.3: Rename existing roles.
	global $wp_roles;
	if (!isset($wp_roles)) $wp_roles = new WP_Roles();
	$wp_roles->roles['administrator']['name'] = "Administrator -- maintenance only; do not use";
	$wp_roles->role_names['administrator']    = "Administrator";
	$wp_roles->roles['contributor']['name']   = "Contributor -- needs pre-approval to publish";
	$wp_roles->role_names['contributor']      = "Contributor";
	$wp_roles->roles['editor']['name']        = "Editor -- has ability to manage website";
	$wp_roles->role_names['editor']           = "Editor";
}


/**
 * Add theme editing capabilities to editor role.
 * Add upload capabilities to contributor role.
 */
$roleEditor = get_role('editor');
$roleEditor->add_cap('edit_theme_options');
$roleEditor->add_cap('manage_options');

$roleContributor = get_role('contributor');
$roleContributor->add_cap('upload_files');


/**
 * Remove unnecessary fields on the user profile page.
 */
add_filter('user_contactmethods','bw_RemoveContactMethods');
function bw_RemoveContactMethods($contactmethods) {
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);
	return $contactmethods;
}


/**
 * Hide (it's impossible to remove) the Website field on Add Users page.
 * We also add some useful inline help here.
 */
add_action("admin_head-user-new.php","bw_HideAddUserWebsiteField");
function bw_HideAddUserWebsiteField() { ?>
	<script>
	jQuery(document).ready(function(){
		jQuery('#url').parents('tr').remove();
		jQuery('label[for="user_login"] span').append("<br />(Letters &amp; dashes, no spaces)");
		jQuery('label[for="email"] span').append("<br />(Use an email you'll check)");
		jQuery('#send_password').prop("checked",true);
		jQuery('#send_password').parent().append(" (This is a good idea.)");
		jQuery('#role').parent().append("<br /><br />Don't know which role to select? <a href='https://www.dropbox.com/s/b5x9r78d3wf007c/Creating%20accounts.pdf'>Read the PBJ documentation</a> on roles.");
	});
	</script>
<?php }


/**
 * Remind admin users that they are logged in as an administrator.
 */
add_action( 'admin_notices', 'bw_ShowAdminNotice' );
function bw_ShowAdminNotice() {
	if (current_user_can('activate_plugins')) { ?>
	<div class="updated" style="border-left-color:#1292BA">
	<p style="max-width:700px;font-size:14px"><strong>Just a heads up:</strong> You're currently logged in as an administrator. It is the Project's policy that this account <em>only</em> be used to create other accounts, since it has the potential to seriously break your website.</p>
	<p>Create accounts by visiting <a href="user-new.php">Users &rarr; Add New</a>. You can read <a href='https://www.dropbox.com/s/b5x9r78d3wf007c/Creating%20accounts.pdf'>the Project's guide</a>, if this is your first time.<br />
	Experiencing problems? You should <a href="http://betterjournalism.org/">contact the National team</a>&mdash;we can help, promise.</p>
	</div>
<?php }}


/**
 * Injected code on the Add Post page. (Helper box, styles)
 */
add_action('add_meta_boxes','bw_AddMetaBox');
function bw_AddMetaBox() { add_meta_box("pbj_helpbox","PBJ &mdash; Have any questions?","bw_MetaBoxCallback","post","side","high"); }
function bw_MetaBoxCallback() { ?>
	<ol style="margin-bottom:0"><li><a href="http://betterjournalism.org/i/platform/adding-new-stories/">Read our guide</a> or watch the screencast on posting new articles.</li><li style="margin-bottom:0">Never include images, pullquotes, etc. in the first few paragraphs!</li></ol>
	<style>
	.misc-pub-visibility {
		display: none;
	}
	.misc-pub-curtime {
		padding-top: 0px;
	}
	#category-adder {
		display: none;
	}
	.acf_postbox p.label {
		font-size: 12px;
	}
	.acf_postbox p.label label {
		font-size: 14px;
	}
	.acf_postbox .field input[type="text"] {
		font-size: 15px;
		padding: 6px 10px;
		height: 40px;
	}
	ul.acf-radio-list {
		font-size: 14px;
		line-height: 22px;
	}
	.acf_postbox .field select {
		font-size: 14px;
		padding: 5px;
		height: 40px;
	}
	</style>
<?php }


/**
 * Injected code on the Add Page page. (Notice box)
 */
add_action('add_meta_boxes','bw_AddPageMetaBox');
function bw_AddPageMetaBox() { add_meta_box("pbj_pagehelpbox","PBJ &mdash; Just a reminder","bw_PageMetaBoxCallback","page","side","high"); }
function bw_PageMetaBoxCallback() { ?>
	<div style="font-size:13px;line-height:20px;padding:10px;background:#F8E2E2"><strong style="color:#931515">Just a reminder:</strong> While you are welcome to create your own pages, some pages&mdash;including the "Home" page&mdash;have been pre-configured with templates and other options and are not to be modified.</div>
	<style>
	.misc-pub-visibility {
		display: none;
	}
	#pageparentdiv .inside p:last-child {
		display: none;
	}
	</style>
<?php }

/**
 * Add theme support for post thumbnails and menus.
 */
add_theme_support('post-thumbnails',array('post'));
add_theme_support('menus');
register_nav_menu("header","Header");


/**
 * Modify main navbar functionality to support Bootstrap dropdown menus.
 */
/**
 * Extended Walker class for use with the
 * Twitter Bootstrap toolkit Dropdown menus in Wordpress.
 * Edited to support n-levels submenu.
 * @author johnmegahan https://gist.github.com/1597994, Emanuele 'Tex' Tessore https://gist.github.com/3765640
 * @license CC BY 4.0 https://creativecommons.org/licenses/by/4.0/
 */
class BootstrapNavMenuWalker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth ) {

		$indent = str_repeat( "\t", $depth );
		$submenu = ($depth > 0) ? ' sub-menu' : '';
		$output	   .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";

	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {


		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$li_attributes = '';
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		// managing divider: add divider class to an element to get a divider before it.
		$divider_class_position = array_search('divider', $classes);
		if($divider_class_position !== false){
			$output .= "<li class=\"divider\"></li>\n";
			unset($classes[$divider_class_position]);
		}
		
		$classes[] = ($args->has_children) ? 'dropdown' : '';
		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		$classes[] = 'menu-item-' . $item->ID;
		if($depth && $args->has_children){
			$classes[] = 'dropdown-submenu';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($depth == 0 && $args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		//v($element);
		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];

		//display this element
		if ( is_array( $args[0] ) )
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		else if ( is_object( $args[0] ) )
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'start_el'), $cb_args);

		$id = $element->$id_field;

		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

			foreach( $children_elements[ $id ] as $child ){

				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}

		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'end_el'), $cb_args);
	}
}


/**
 * Helper function:
 * Returns an URL to the thumbnailed and resized image.
 */
function bw_FeaturedImage($postID, $imgwidth, $height, $alignment = "t")
{

	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), 'single-post-thumbnail' );
	$imageUrl = $image[0];

	if ($imgwidth == 920 && $height == 303)
		return $imageUrl;
	else
	{
		$resizedImageUrl = get_bloginfo('stylesheet_directory') . "/timthumb/timthumb.php?w=";
		$resizedImageUrl .= $imgwidth . "&amp;h=" . $height . "&amp;src=" . $imageUrl . "&amp;a=" . $alignment;
		return $resizedImageUrl;
	}
}


/**
 * Helper function:
 * A bit of silly, silly code that simplifies which autocrop alignment option to choose.
 */
function bw_CheckPhotoAlign($givenAlignment = "", $preferredAlignment = "")
{
	if ($givenAlignment)
		return $givenAlignment;

	if ($preferredAlignment)
		return $preferredAlignment;

	return "t";
}


/**
 * Helper function:
 * Gets a category ID based on its name.
 */
function bw_GetIDbyCategoryName($categoryName)
{
	$category = get_term_by('slug',$categoryName,'category');
	return $category->term_id;
}


/**
 * Helper function:
 * Returns a homepage category ticker.
 */
function bw_CategoryTickerExpanded($categoryID, $title, $maxArticles = 6)
{
	$query = new WP_Query("showposts=" . $maxArticles . "&cat=" . $categoryID);
?>
					<div class="category-ticker category-ticker-tall">
						<h3>
							<a href="<?php echo get_category_link($categoryID); ?>"><?php echo $title; ?></a>
						</h3>
						<ul>
<?php while ($query->have_posts()) : $query->the_post();
	$sentenceDesc = substr(strip_tags(get_the_excerpt()),0,120);
	 ?>
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
								<div class="category-ticker-desc"><?php echo $sentenceDesc; ?></div>
							</li>
<?php endwhile; ?>
						</ul>
					</div>
	<?php
}


/**
 * Add the correct CSS classes to next/previous links.
 */
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
function posts_link_attributes() {
	return 'class="btn btn-large"';
}


/**
 * Add thumbnails to the RSS feed.
 */
add_filter('the_content_feed', 'ThumbRSS');
function ThumbRSS($content) {
   global $post;
   if ( has_post_thumbnail( $post->ID ) ){
       $content = '<p><img src="' . bw_FeaturedImage($post->ID,940,303) . '" width="940" height="303"></p>' . $content;
   }
   return $content;
}


/**
 * Replace excerpt length. (Runs at low priority, hence the 999)
 */
function custom_excerpt_length( $length ) {
	return 45;
}
add_filter('excerpt_length','custom_excerpt_length',999);


/**
 * Add "Styles" drop-down
 */ 
add_filter( 'mce_buttons_2', 'tuts_mce_editor_buttons' );
function tuts_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}


/**
 * Add styles/classes to the "Styles" drop-down
 */ 
add_filter('tiny_mce_before_init','bw_tiny_mce_before_init');
function bw_tiny_mce_before_init($settings) {
	// Add custom options to the Styles dropdown
    $style_formats = array(
        array(
            'title' => 'Pull-quote',
            'selector' => 'p',
            'classes' => 'pullquote'
            ),
        array(
        	'title' => 'Full-width',
        	'selector' => 'p',
        	'classes' => 'full-width')
    );
    $settings['style_formats'] = json_encode($style_formats);

    // Remove extra options from the Paragraph/block options
    $settings['block_formats'] = "Paragraph=p;Main heading=h3;Sub-heading=h4";

    return $settings;

}
add_editor_style();


/**
 * Advanced Custom Fields field group.
 */
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_pbj-article',
		'title' => 'PBJ article',
		'fields' => array (
			array (
				'key' => 'field_4ffe43608eed8',
				'label' => 'Article author(s)',
				'name' => 'authors',
				'type' => 'text',
				'instructions' => 'Include both first and last names. Separate with commas for multiple authors, but do not use "and".',
				'required' => 1,
				'default_value' => '',
				'placeholder' => 'Example &rarr; "George Washington, John Adams"',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_4ffe43608e7ca',
				'label' => 'Ultra-short article title',
				'name' => 'title-short',
				'type' => 'text',
				'instructions' => 'For tight spaces only; do not go over THREE SHORT words.',
				'required' => 1,
				'default_value' => '',
				'placeholder' => 'Example &rarr; "Gym renovation" OR "Football wins 3-1"',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => 30,
			),
			array (
				'key' => 'field_520441dec5abf',
				'label' => '(If there is a featured image) Select photo sizing and display options',
				'name' => 'photo_type',
				'type' => 'radio',
				'instructions' => 'These settings will only apply if there is a featured image (upload on right).',
				'required' => 1,
				'choices' => array (
					'vertical' => 'Vertical &mdash; Size the featured photo to PORTRAIT dimensions (400px wide)',
					'horizontal' => 'Horizontal &mdash; Size the featured photo to HORIZONTAL dimensions (525px wide)',
					'wide' => 'Very wide &mdash; Crop and resize the featured photo to VERY WIDE dimensions (920px by 300px)',
					'nophoto' => 'Disable &mdash; Photo will be HIDDEN on the article page but will show on other pages',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_514258b95344f',
				'label' => '(If there is a featured image) Photo caption',
				'name' => 'photo_caption',
				'type' => 'text',
				'instructions' => 'Describe specific people and items, and avoid just the obvious. Try not to exceed 10 words&mdash;lengthy captions might be cut off.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_520441dec5abf',
							'operator' => '!=',
							'value' => 'nophoto',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'Example &rarr; "Thomas Jefferson enjoys a bike ride with Aaron Burr."',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => 100,
			),
			array (
				'key' => 'field_1c3f684bd72d3',
				'label' => '(If there is a featured image) Photo credit',
				'name' => 'photo_credit',
				'type' => 'text',
				'instructions' => 'Optional. Enter photographer name to provide credit. Avoid more than one name.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_520441dec5abf',
							'operator' => '!=',
							'value' => 'nophoto',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'Example &rarr; "James Madison"',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => 50,
			),
			array (
				'key' => 'field_photoalignment',
				'label' => '(If there is a featured image) Photo crop alignment',
				'name' => 'photo_alignment',
				'type' => 'select',
				'instructions' => 'Optional. Photos are cropped to fit certain dimensions; select which side/corner to align.<br />By default, we\'ll try to pick appropriate alignments&mdash;either top or center, depending on placement.',
				'choices' => array (
					'' => 'No preference/use defaults',
					'tl' => '* Top left',
					't' => '* Top center',
					'tr' => '* Top right',
					'l' => '* Middle left',
					'c' => '* Middle center',
					'r' => '* Middle right',
					'bl' => '* Bottom left',
					'b' => '* Bottom center',
					'br' => '* Bottom right',
				),
				'default_value' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => 2,
			),
			array (
				'key' => 'field_4ffe43608f52d',
				'label' => 'Web editor for this article',
				'name' => 'web-editors',
				'type' => 'text',
				'instructions' => 'Optional. Enter name of the web editor uploading this piece. Separate with commas for multiple authors, but do not use "and".',
				'default_value' => '',
				'placeholder' => 'Example &rarr; "Andrew Jackson"',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_4ffe43608f204',
				'label' => 'Article highlights',
				'name' => 'highlights',
				'type' => 'wysiwyg',
				'instructions' => 'Optional. Use a bulleted list (click 6th icon below to activate). Three to four facts, CNN-style, about the piece.<br />Note: If you use article highlights, remember not to include photos, pullquotes, etc. at the beginning of the piece.',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'no',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'custom_fields',
				2 => 'discussion',
				3 => 'comments',
				4 => 'slug',
				5 => 'author',
				6 => 'format',
			),
		),
		'menu_order' => 0,
	));
};


/**
 * OptionTree integration basics.
 */
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
load_template(trailingslashit(get_template_directory()) . 'option-tree/ot-loader.php');
load_template(trailingslashit(get_template_directory()) . 'theme-options.php');


/**
 * Move PBJ Options menu to the root level.
 */
add_filter('ot_theme_options_parent_slug','__return_false');
add_filter('ot_theme_options_page_title','returnPBJOptions');
add_filter('ot_theme_options_menu_title','returnPBJOptions');
function returnPBJOptions() { return "PBJ Options"; }


/**
 * Hide OptionTree branding, and replace with PBJ branding.
 */
add_filter("ot_header_logo_link","__return_false");
function bw_ReplaceOptionTreeBranding() {
	return '<strong>The Project for Better Journalism</strong> &mdash; Have any questions? We can help.';
}
add_filter("ot_header_version_text","bw_ReplaceOptionTreeBranding");


/**
 * Login logo graphics.
 */
add_action('login_enqueue_scripts', 'pbj_login_logo');
function pbj_login_logo() { ?>
	<style type="text/css">
	body.login div#login h1 a {
		background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/resources/loginlogo.png);
		padding-bottom: 30px;
		width: 312px;
		height: 51px;
		margin-left: 8px;
		background-size: auto; -o-background-size: auto; -webkit-background-size: auto; -khtml-background-size: auto; -moz-background-size: auto; -ms-background-size: auto;
	}

<?php // Retrofit for non-PBJ
if (ot_get_option('pbj_disable_full','') == "disable") : ?>
	body.login div#login h1 a {
		background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/resources/loginlogo-custom.png);
	}
<?php endif; ?>

<?php // Retrofit for custom backgrounds
if (ot_get_option('bg_file','')) : ?>
	body {
		background: #FFF url(<?php echo ot_get_option('bg_file',''); ?>) 50% -100px no-repeat !important;
	}
<?php endif; ?>

	</style>
<?php }

function my_login_logo_url() { return get_bloginfo( 'url' ); }
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() { return 'The Project for Better Journalism'; }
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

/**
 * Test to remove hearts
 */
function replace_text($text) {
	$text = str_replace('♥', '', $text);
	return $text;
}
add_filter('the_content', 'replace_text');