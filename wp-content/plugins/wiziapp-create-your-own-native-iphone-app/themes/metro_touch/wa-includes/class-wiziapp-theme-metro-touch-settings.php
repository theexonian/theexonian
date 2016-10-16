<?php
	class WiziappThemeMetroTouchSettings
	{
		var $autocommit = true;
		var $preview = false;
		var $dirty = false;
		var $options = null;
		var $option = null;

		function deleteAll()
		{
			if (null === $this->options)
			{
				$this->option = 'wiziapp_plugin_wiziapp_theme_metro_touch_settings';
			}
			delete_option($this->option);
		}

		function setAutocommit($autocommit = true)
		{
			$this->autocommit = $autocommit;
			if ($autocommit && $this->dirty)
			{
				$this->_save();
			}
		}

		function setPreview($preview = true)
		{
			if ($preview)
			{
				$this->_load();
				$this->preview = $this->options;
			}
			else if ($this->preview !== false)
			{
				$this->options = $this->preview;
				$this->preview = false;
				if ($this->autocommit && $this->dirty)
				{
					$this->_save();
				}
			}
		}

		function getAppHeaderType()
		{
			$this->_load();
			return $this->options['app_header_type'];
		}

		function setAppHeaderType($type)
		{
			$this->_load();
			$this->options['app_header_type'] = $type;
			$this->_save();
		}

		function getAppHeaderTitle()
		{
			$this->_load();
			return $this->options['app_header_title'];
		}

		function setAppHeaderTitle($title)
		{
			$this->_load();
			$this->options['app_header_title'] = $title;
			$this->_save();
		}

		function getAppHeaderImage()
		{
			return $this->options['app_header_image'];
		}

		function setAppHeaderImage($image)
		{
			$this->_load();
			$this->options['app_header_image'] = $image;
			$this->_save();
		}

		function getAppHeaderColor()
		{
			return $this->options['app_header_color'];
		}

		function setAppHeaderColor($color)
		{
			$this->_load();
			$this->options['app_header_color'] = $color;
			$this->_save();
		}

		function getAppHeaderBackground()
		{
			return $this->options['app_header_background'];
		}

		function setAppHeaderBackground($background)
		{
			$this->_load();
			$this->options['app_header_background'] = $background;
			$this->_save();
		}

		function getAppContentColor()
		{
			$this->_load();
			return $this->options['app_content_color'];
		}

		function setAppContentColor($color)
		{
			$this->_load();
			$this->options['app_content_color'] = $color;
			$this->_save();
		}

		function getLatestBackground()
		{
			$this->_load();
			return $this->options['latest_background'];
		}

		function setLatestBackground($background)
		{
			$this->_load();
			$this->options['latest_background'] = $background;
			$this->_save();
		}

		function getAppContentBackground()
		{
			$this->_load();
			return $this->options['app_content_background'];
		}

		function setAppContentBackground($background)
		{
			$this->_load();
			$this->options['app_content_background'] = $background;
			$this->_save();
		}

		function getHomescreenBackground()
		{
			$this->_load();
			return $this->options['homescreen_background'];
		}

		function setHomescreenBackground($background)
		{
			$this->_load();
			$this->options['homescreen_background'] = $background;
			$this->_save();
		}

		function getBrickBackground()
		{
			$this->_load();
			return $this->options['brick_background'];
		}

		function setBrickBackground($background)
		{
			$this->_load();
			$this->options['brick_background'] = $background;
			$this->_save();
		}

		function getBrickTextColor()
		{
			$this->_load();
			return $this->options['brick_text_color'];
		}

		function setBrickTextColor($color)
		{
			$this->_load();
			$this->options['brick_text_color'] = $color;
			$this->_save();
		}

		function getBrickIconColor()
		{
			$this->_load();
			return $this->options['brick_icon_color'];
		}

		function setBrickIconColor($color)
		{
			$this->_load();
			$this->options['brick_icon_color'] = $color;
			$this->_save();
		}

		function getBrickIcon($index)
		{
			$this->_load();
			return isset($this->options['brick_icons'][$index])?$this->options['brick_icons'][$index]:false;
		}

		function setBrickIcon($index, $icon)
		{
			$this->_load();
			if (empty($icon))
			{
				unset($this->options['brick_icons'][$index]);
			}
			else
			{
				$this->options['brick_icons'][$index] = $icon;
			}
			$this->_save();
		}

		function getBackIconColor()
		{
			$this->_load();
			return $this->options['back_icon_color'];
		}

		function setBackIconColor($color)
		{
			$this->_load();
			$this->options['back_icon_color'] = $color;
			$this->_save();
		}

		function _load()
		{
			if (null === $this->options)
			{
				$this->option = 'wiziapp_plugin_wiziapp_theme_metro_touch_settings';
				/*
				 * We merge with the defaults, rather than specifying them,
				 * so we add missing defaults, even if we have partial settings
				 */
				$this->options =
				get_option($this->option, array())+
				array(
					'app_header_type' => 'text',
					'app_header_title' => get_bloginfo('name'),
					'app_header_image' => '',
					'app_header_color' => '#000000',
					'app_header_background' => '#ffffff',
					'app_content_color' => '#4B5A6F',
					'app_content_background' => '#ffffff',
					'latest_background' => '#c9bde8',
					'homescreen_background' => '#ffffff',
					'brick_background' => '#6541bd',
					'brick_text_color' => '#ffffff',
					'brick_icon_color' => '#ffffff',
					'brick_icons' => array(),
					'back_icon_color' => '#000000',
				 );
			}
		}

		function _save()
		{
			if ($this->preview)
			{
				return;
			}
			if (!$this->autocommit)
			{
				$this->dirty = true;
				return;
			}
			add_option($this->option, $this->options);
			update_option($this->option, $this->options);
			$this->dirty = false;
		}
	}

	/**
	 * Returns a global instance of WiziappThemeMetroTouchSettings
	 *
	 * @staticvar WiziappThemeMetroTouchSettings $inst Used to store the instance
	 * @return WiziappThemeMetroTouchSettings The settings
	 */

	function &wiziapp_theme_metro_touch_settings()
	{
		static $inst = null;
		if (!$inst)
		{
			$inst = new WiziappThemeMetroTouchSettings();
		}
		return $inst;
	}
