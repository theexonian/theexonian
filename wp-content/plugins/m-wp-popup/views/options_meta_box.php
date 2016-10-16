<table class="wpp_input widefat" id="wpp_popup_options">

	<tbody>
		
		<?php do_action( 'wpp_options_meta_box_start', $popup_id ); ?>

		<tr id="status">
			
			<td class="label">
				<label>
					<?php _e( 'Enabled', 'wpp' ); ?>
				</label>
				<p class="description"><?php _e( 'If set to Yes popup would appear automatically.', 'wpp' ) ?></p>
			</td>
			<td>
				<input <?php checked( $options['enabled'], true ) ?> type="checkbox" value="yes" id="ibtn-enable" name="options[enabled]" />
			</td>
			
		</tr>

		<tr id="theme">
			
			<td class="label">
				<label>
					<?php _e( 'Theme', 'wpp' ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<select name="options[theme]">
					
					<?php foreach ( $themes as $theme ): ?>
						<option value="<?php echo $theme->id() ?>" <?php selected( $theme->id(), $active_theme ) ?>>
							<?php echo $theme->name() ?>
						</option>
					<?php endforeach; ?>
					
					<?php do_action( 'wpp_html_theme_select' ) ?>
				</select>
			</td>
			
		</tr>

		<tr id="delay_time">
			
			<td class="label">
				<label>
					<?php _e( 'Delay Time', 'wpp' ); ?>
				</label>
				<p class="description"><?php _e( 'Display the popup after the miliseconds you set', 'wpp' ); ?></p>
			</td>
			<td>
				<label>
					<input type="text" value="<?php echo $options['delay_time'] ?>" name="options[delay_time]" placeholder="Enter time in miliseconds" /> ms
				</label>
			</td>
			
		</tr>

		<tr id="mask_color">
			
			<td class="label">
				<label>
					<?php _e( 'Mask Color', 'wpp' ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<label>
					<input type="text" id="mask_color_field" value="<?php echo $options['mask_color'] ?>" name="options[mask_color]" placeholder="Enter the mask color" />
				</label>
				<div id="mask_colorpicker"></div>
			</td>
			
		</tr>

		<tr id="border_color">
			
			<td class="label">
				<label>
					<?php _e( 'Border Color', 'wpp' ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<label>
					<input type="text" id="border_color_field" value="<?php echo $options['border_color'] ?>" name="options[border_color]" placeholder="Enter the border color" />
				</label>
				<div id="border_colorpicker"></div>
			</td>
			
		</tr>

		<tr id="transition">
			
			<td class="label">
				<label>
					<?php _e( 'Transition', 'wpp' ); ?>
				</label>
				<p class="description"><?php _e( 'Set the transition effect', 'wpp' ) ?></p>
			</td>
			<td>
				<select name="options[transition]">
					
					<option value="elastic" <?php selected( 'elastic', $options['transition'] ) ?>>
							<?php _e( 'Elastic', 'wpp' ) ?>
					</option>

					<option value="fade" <?php selected( 'fade', $options['transition'] ) ?>>
							<?php _e( 'Fade', 'wpp' ) ?>
					</option>

					<option value="none" <?php selected( 'none', $options['transition'] ) ?>>
							<?php _e( 'None', 'wpp' ) ?>
					</option>
					
					<?php do_action( 'wpp_html_transition_select' ) ?>
				</select>
			</td>
			
		</tr>

		<?php do_action( 'wpp_options_meta_box_before_rules', $popup_id ); ?>

		<tr id="rules">
			
			<td class="label">
				<label>
					<?php _e( 'Rules', 'wpp' ); ?>
				</label>
				<p class="description"><?php _e( 'Apply rules to your popup', 'wpp' ) ?></p>
			</td>
			<td>
				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['show_on_homepage'], true ) ?> name="options[rules][show_on_homepage]" value="true" /> <?php _e( 'Show on homepage', 'wpp' ) ?>
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['show_only_on_homepage'], true ) ?> name="options[rules][show_only_on_homepage]" value="true" /> <?php _e( 'Show <strong>only</strong> on homepage', 'wpp' ) ?>
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['show_to_logged_in_users'], true ) ?> name="options[rules][show_to_logged_in_users]" value="true" /> <?php _e( 'Show to logged-in users', 'wpp' ) ?>
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['hide_on_mobile_devices'], true ) ?> name="options[rules][hide_on_mobile_devices]" value="true" /> <?php _e( 'Hide on mobile devices', 'wpp' ) ?>
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['show_only_to_search_engine_visitors'], true ) ?> name="options[rules][show_only_to_search_engine_visitors]" value="true" /> <?php _e( 'Show only to search engine visitors', 'wpp' ) ?>
					</label>
				</p>

				<?php if ( defined('WPP_PREMIUM_FUNCTIONALITY') &&  WPP_PREMIUM_FUNCTIONALITY ):
					if ( ! isset( $options['rules']['exit_intent_popup'] ) )
						$options['rules']['exit_intent_popup'] = false;
				?>
				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['exit_intent_popup'], true ) ?> name="options[rules][exit_intent_popup]" value="true" /> 
							<?php _e( 'Exit Intent Popup', 'wpp' ) ?>
					</label>
				</p>
				<?php else: ?>
				<p>
					<label>
							<input type="checkbox" disabled value="true" /> 
							<?php _e( 'Exit Intent Popup', 'wpp' ) ?>
					</label>
					<p class="description"><?php _e( '<a href="http://rocketplugins.com/wordpress-popup-plugin" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
				</p>
				<?php endif; ?>

				<?php if ( defined('WPP_PREMIUM_FUNCTIONALITY') &&  WPP_PREMIUM_FUNCTIONALITY ):
					if ( ! isset( $options['rules']['comment_autofill'] ) )
						$options['rules']['comment_autofill'] = false;
				?>
				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['comment_autofill'], true ) ?> name="options[rules][comment_autofill]" value="true" /> <?php _e( 'Comment author Name/Email autofill', 'wpp' ) ?>
					</label>
				</p>
				<?php else: ?>
				<p>
					<label>
							<input type="checkbox" disabled value="true" /> 
							<?php _e( 'Comment author Name/Email autofill', 'wpp' ) ?>
					</label>
					<p class="description"><?php _e( '<a href="http://rocketplugins.com/wordpress-popup-plugin" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
				</p>
				<?php endif; ?>

				<?php if ( defined('WPP_PREMIUM_FUNCTIONALITY') &&  WPP_PREMIUM_FUNCTIONALITY ):
					if ( ! isset( $options['rules']['exit_popup'] ) )
						$options['rules']['exit_popup'] = false;
				?>
				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['exit_popup'], true ) ?> name="options[rules][exit_popup]" value="true" /> 
							<?php _e( 'Exit Popup', 'wpp' ) ?>
					</label>
				</p>
				<?php else: ?>
				<p>
					<label>
							<input type="checkbox" disabled value="true" /> 
							<?php _e( 'Exit Popup', 'wpp' ) ?>
					</label>
					<p class="description"><?php _e( '<a href="http://rocketplugins.com/wordpress-popup-plugin" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
				</p>
				<?php endif; ?>

				<?php if ( defined('WPP_PREMIUM_FUNCTIONALITY') &&  WPP_PREMIUM_FUNCTIONALITY ): ?>
				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['when_post_end_rule'], true ) ?> name="options[rules][when_post_end_rule]" value="true" /> <?php _e( "Show only when the visitor's <strong>scrollbar</strong> is at the end of the post or page content.", 'wpp' ) ?>
					</label>
				</p>
				<?php else: ?>
				<p>
					<label>
							<input type="checkbox" disabled value="true" /> 
							<?php _e( "Show only when the visitor's <strong>scrollbar</strong> is at the end of the post or page content.", 'wpp' ) ?>
					</label>
					<p class="description"><?php _e( '<a href="http://rocketplugins.com/wordpress-popup-plugin" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
				</p>
				<?php endif; ?>



				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['use_cookies'], true ) ?> name="options[rules][use_cookies]" value="true" /> 
							<?php _e( 'Use Cookies', 'wpp' ) ?>
					</label>
				</p>

				<p>
					<label>
						<input type="text" value="<?php echo $options['rules']['cookie_expiration_time'] ?>" name="options[rules][cookie_expiration_time]" placeholder="Cookie Expiration Time" /> <?php _e( 'Days', 'wpp' ) ?>
					</label>
				</p>

			</td>
			
		</tr>

	
		<?php if ( ! defined( 'WPP_PREMIUM_FUNCTIONALITY' )  ): ?>
		<tr id="rule_post">
			
			<td class="label">
				<label>
					<?php _e( 'Post/Page Rule', POPUP_PLUGIN_PREFIX ); ?>
				</label>
				<p class="description">Leave this field empty to show popup on all posts or pages.</p>
			</td>
			<td>
				<label>
					<input disabled type="text" value=""  placeholder="Enter post ID or multiple ID's with comma separated each value" />
					<p class="description"><?php _e( '<a href="http://rocketplugins.com/wordpress-popup-plugin" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
				</label>
			</td>
			
			</tr>

			<tr id="rule_category">
						
						<td class="label">
							<label>
								<?php _e( 'Category Rule', POPUP_PLUGIN_PREFIX ); ?>
							</label>
							<p class="description">Show popup only for the posts in these categories.</p>
						</td>
						<td>
							<label>
								<input disabled type="text" value=""  placeholder="Enter category ID or multiple ID's with comma separated each value" />
								<p class="description"><?php _e( '<a href="http://rocketplugins.com/wordpress-popup-plugin" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
							</label>
							
						</td>
						
			</tr>

			<tr id="rule_websites">
						
						<td class="label">
							<label>
								<?php _e( 'Website Rule', POPUP_PLUGIN_PREFIX ); ?>
							</label>
							<p class="description">Show popup only to the visitors from these websites.</p>
						</td>
						<td>
							<label>
								<input disabled type="text" value=""  placeholder="Enter valid website URL or multiple URL's with comma separated each value" />
								<p class="description"><?php _e( '<a href="http://rocketplugins.com/wordpress-popup-plugin" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
							</label>
						</td>
						
			</tr>

			<tr id="rule_websites">
						
						<td class="label">
							<label>
								<?php _e( 'Visits Rule', POPUP_PLUGIN_PREFIX ); ?>
							</label>
							<p class="description">Show popup after the specified number of visits by a visitor</p>
						</td>
						<td>
							<label>
								<input disabled type="text" value=""  placeholder="Enter the number of visits" />
								<p class="description"><?php _e( '<a href="http://rocketplugins.com/wordpress-popup-plugin" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
							</label>
						</td>
						
			</tr>
			<?php endif; ?>
		<?php do_action( 'wpp_options_meta_box_end', $popup_id, $options ); ?>



	</tbody>

</table>