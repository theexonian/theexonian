<?php
		$wiziapp_new_child_categories = get_query_var('wiziapp_new_child_categories');
		if ($wiziapp_new_child_categories->haveTerms() && wiziapp_theme_settings()->getPostDisplayCategories() )
		{
?>
		<p class="wiziapp-new-child-terms">
<?php
			_e('Categories', 'wiziapp-smooth-touch');

			while ($wiziapp_new_child_categories->haveTerms())
			{
				$wiziapp_new_child_categories->theTerm();
?>
			<a href="<?php $wiziapp_new_child_categories->theLink(); ?>" data-transition="slide">
				<?php $wiziapp_new_child_categories->theName(); ?>

			</a>
<?php
			}
?>
		</p>
<?php
		}

		$wiziapp_new_child_tags = get_query_var('wiziapp_new_child_tags');
		if ($wiziapp_new_child_tags->haveTerms())
		{
?>
		<p class="wiziapp-new-child-terms">
<?php
			_e('Tags', 'wiziapp-smooth-touch');

			while ($wiziapp_new_child_tags->haveTerms())
			{
				$wiziapp_new_child_tags->theTerm();
?>
				<a href="<?php $wiziapp_new_child_tags->theLink(); ?>" data-transition="slide">
					<?php $wiziapp_new_child_tags->theName(); ?>

				</a>
<?php
			}
?>
		</p>
<?php
		}

	$post_id = $post->ID;
	$reply_to = get_query_var('wiziapp_theme_comment_parent');
	$_GET['replytocom'] = $reply_to;
	$wiziapp_comment_form_fields = array_map('wiziapp_comment_form_fields', array('pre' => '<div class="wiziapp-comment-author">'.PHP_EOL, 'author' => 'author', 'email' => 'email', 'url' => 'url', 'post' => '</div>'));
	$wiziapp_comment_form_args = array(
		'logged_in_as'         => wiziapp_comment_logged_in_as($reply_to, $post_id),
		'comment_notes_after' => '',
		'title_reply'          => '',
		'title_reply_to'       => '',
		'cancel_reply_link'    => ' ',
		'fields'			   => $wiziapp_comment_form_fields,
		'comment_field'        => wiziapp_comment_form_textarea(),
	);
if (wiziapp_theme_settings()->getPostDisplayComments())	{
	ob_start();
	comment_form($wiziapp_comment_form_args, $post_id);
	$wiziapp_new_child_comment_form = ob_get_clean();
	$wiziapp_new_child_comment_form = str_replace('<input name="submit"', '<input data-role="none" name="submit"', $wiziapp_new_child_comment_form);
	echo $wiziapp_new_child_comment_form;
}
?>
		<div class="wiziapp-tabs">
			<div class="wiziapp-tabs-header">
					<a href="<?php
					if (wiziapp_theme_settings()->getPostDisplayComments())	{
				global $post;
				$count = $post->comment_count;
				if ($count > 0 || comments_open())
				{
					$added_query_string = array('wiziapp_display' => 'comments',);
					wiziapp_theme_settings()->prepare_added_query($added_query_string);
					echo add_query_arg($added_query_string, get_permalink());
				}
			}
					?>" data-transition="slide">
						&#32;
					</a>
			</div>
<?php if(wiziapp_theme_settings()->getPostDisplayComments()){ ?>
			<div class="wiziapp-tabs-content">
				<div class="wiziapp-tabs-content-loading"></div>
			</div>
<?php } ?>
		</div>
	</div>

        
<?php
	get_footer();

	function wiziapp_comment_logged_in_as($reply_to, $post_id)
	{
		$link = add_query_arg('wiziapp_display', 'comment', $reply_to?add_query_arg('wiziapp_comment', $reply_to, trailingslashit(get_bloginfo('url'))):get_permalink($post_id));
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		ob_start();
?>
		<div class="wiziapp-comment-header">
			<input type="hidden" name="redirect_to" value="<?php echo esc_attr(wiziapp_theme_settings()->getBackUrl()); ?>" />
			<span><?php echo esc_html(str_replace('%', $user_identity, __('Replying as %', 'wiziapp-smooth-touch'))); ?></span>
			<a href="<?php echo esc_html(wp_logout_url($link)); ?>"><?php _e('Log out?', 'wiziapp-smooth-touch'); ?></a>
		</div>
<?php

		return PHP_EOL.ob_get_clean();
	}

	function wiziapp_comment_form_textarea()
	{
		ob_start();
?>
		<p class="wiziapp-comment-content">
			<textarea data-role="none" name="comment" id="comment" cols="45" rows="8" placeholder="<?php _e('Type your comment here', 'wiziapp-smooth-touch'); ?>" aria-required="true"></textarea>
		</p>
<?php

		return PHP_EOL.PHP_EOL.ob_get_clean();
	}

	function wiziapp_comment_form_fields($field_name)
	{
		$names = array(
			'author' => __('Name', 'wiziapp-smooth-touch'),
			'email' => __('Email', 'wiziapp-smooth-touch'),
			'url' => __('Website', 'wiziapp-smooth-touch'),
		);
		if (!isset($names[$field_name])) {
			return $field_name;
		}
		$commenter = wp_get_current_commenter();
		$required = get_option('require_name_email');
		$placeholder = '';
		if ($required && $field_name !== 'url')
		{
			$placeholder = 'placeholder="'.__('Required', 'wiziapp-smooth-touch').'" aria-required="true"';
		}

		ob_start();
		?>
		<p>
			<input data-role="none" type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_name; ?>" size="30" <?php echo $placeholder ?> value="<?php echo esc_attr($commenter['comment_author'.($field_name === 'author'?'':'_'.$field_name)]); ?>" />
			<label for="<?php echo $field_name; ?>">
				<span><?php echo $names[$field_name]; ?></span>
			</label>
		</p>
		<?php

		return ob_get_clean();
	}
