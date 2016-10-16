<table class="wpmmp_input widefat" id="wpmmp_options">

	<tbody>
		
		<?php do_action( 'wpmmp_general_meta_box_start', $settings ); ?>

		<tr id="status">
			
			<td class="label">
				<label>
					<?php _e( 'Status', 'wpmp' ); ?>
				</label>
				<p class="description"><?php _e( 'Show page only to non-admin users or regular visitors', 'wpmmp' ) ?></p>
			</td>
			<td>
				<p><label><input type="radio" value="disabled" name="settings[status]" <?php checked( $settings['status'], 'disabled' ) ?> /><span><?php _e( 'Disabled', 'wpmmp' ) ?></span><label></p>
				<p><label><input type="radio" value="enabled" name="settings[status]" <?php checked( $settings['status'], 'enabled' ) ?> /><span><?php _e( 'Enabled', 'wpmmp' ) ?></span><label></p>
			</td>
			
		</tr>

		<tr id="theme">
			
			<td class="label">
				<label>
					<?php _e( 'Theme', 'wpmmp' ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<ul id="wpmmp-themes">

					<li>
							<img style="height: 208px" src="<?php echo wpmmp_image_url( 'alissa-1.png' ) ?>" />
							<p><input <?php checked( 'alissa', $settings['theme'] ) ?> type="radio" name="settings[theme]" value="alissa" />
				<?php if ( ! defined( 'WPMMP_PRO_VERSION_ENABLED' ) ): ?>
				<a href=""><strong><?php _e( 'Get pro version to unlock template.', 'wpmmp') ?></strong></a>
				<?php endif; ?></p>
					</li>
					
					<li>
							<img src="<?php echo wpmmp_image_url( 'default-2.jpg' ) ?>" />
							<p><input <?php checked( 'default-2', $settings['theme'] ) ?> type="radio" name="settings[theme]" value="default-2" /></p>
					</li>

					<li>
							<img src="<?php echo wpmmp_image_url( 'default-1.jpg' ) ?>" />
							<p><input <?php checked( 'default-1', $settings['theme'] ) ?> type="radio" name="settings[theme]" value="default-1" /></p>
					</li>
					<li>
							<img src="<?php echo wpmmp_image_url( 'default-3.jpg' ) ?>" />
							<p><input <?php checked( 'default-3', $settings['theme'] ) ?> type="radio" name="settings[theme]" value="default-3" /></p>
					</li>
					<li>
							<img src="<?php echo wpmmp_image_url( 'default-4.jpg' ) ?>" />
							<p><input <?php checked( 'default-4', $settings['theme'] ) ?> type="radio" name="settings[theme]" value="default-4" /></p>
					</li>

					<?php foreach ( $themes as $theme ): ?>
					<?php endforeach; ?>
				</ul>
			</td>
			
		</tr>

		<tr id="page-title">
			
			<td class="label">
				<label>
					<?php _e( '', 'wpmmp' ); ?>
				</label>
				<p class="description">Page title</p>
			</td>
			<td>
				<input type="text" name="settings[title]" value="<?php echo $settings['title'] ?>" />
			</td>
			
		</tr>

		<tr id="heading1">
			
			<td class="label">
				<label>
					<?php _e( 'Heading', 'wpmmp' ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<input type="text" name="settings[heading1]" value="<?php echo $settings['heading1'] ?>" />
			</td>
			
		</tr>

		<tr id="heading2">
			
			<td class="label">
				<label>
					<?php _e( 'Sub heading', 'wpmmp' ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<input type="text" name="settings[heading2]" value="<?php echo $settings['heading2'] ?>" />
			</td>
			
		</tr>

		<tr id="g-content">
			
			<td class="label">
				<label>
					<?php _e( 'Content', 'wpmmp' ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<?php wp_editor( $settings['content'], 'gcontent-settings', array( 'textarea_name' => 'settings[content]', 'textarea_rows' => 7 ) ) ?>
			</td> 
			
		</tr>

		<tr id="countdown_timer">
			
			<td class="label">
				<label>
					<?php _e( 'Countdown timer', 'wpmmp' ) ?>
				</label>
				<?php if ( ! defined( 'WPMMP_PRO_VERSION_ENABLED' ) ): ?>
				<p class="description"><?php _e( 'This feature will work with the pro version.', 'wpmmp') ?></p>
				<?php endif; ?>
			</td>

			<td>
				<input type="checkbox" name="settings[countdown_timer]" <?php checked( $settings['countdown_timer'], true ) ?> />
				<p><label><?php _e( 'Set date and time', 'wpmmp' ) ?><input type="datetime-local" name="settings[countdown_time]" value="<?php echo $settings['countdown_time'] ?>" /></label></p>
			</td>
		</tr>

		<tr id="progress_bar">
			
			<td class="label">
				<label>
					<?php _e( 'Progress bar', 'wpmmp' ) ?>
				</label>
			</td>

			<td>
				<input type="checkbox" name="settings[progress_bar]" <?php checked( $settings['progress_bar'], true ) ?> />
				<p>
					How much progress has been made? <input type="number" name="settings[progress_bar_range]" min="0" max="100" value="<?php echo $settings['progress_bar_range'] ?>" /> <strong>%</strong>
				</p>
			</td>
		</tr>


		

		<?php do_action( 'wpmmp_general_meta_box_end', $settings ); ?>

	</tbody>

</table>