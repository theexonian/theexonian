<?php
	class WiziappThemeBeInTouchSettings
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
				$this->option = 'wiziapp_plugin_wiziapp_theme_be_in_touch_settings';
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

		function getIconColor()
		{
			$this->_load();
			return $this->options['icon_color'];
		}

		function setIconColor($color)
		{
			$this->_load();
			$this->options['icon_color'] = $color;
			$this->_save();
		}

		function getPhoneNumber()
		{
			$this->_load();
			return $this->options['phone_number'];
		}

		function setPhoneNumber($value)
		{
			$this->_load();
			$this->options['phone_number'] = $value;
			$this->_save();
		}

		function getAddressLatitude()
		{
			$this->_load();
			return $this->options['address_lat'];
		}

		function setAddressLatitude($value)
		{
			$this->_load();
			$this->options['address_lat'] = $value;
			$this->_save();
		}

		function getAddressLongitude()
		{
			$this->_load();
			return $this->options['address_long'];
		}

		function setAddressLongitude($value)
		{
			$this->_load();
			$this->options['address_long'] = $value;
			$this->_save();
		}

		function getGalleryImageIds()
		{
			$this->_load();
			return $this->options['gallery'];
		}

		function setGalleryImageIds($value)
		{
			$this->_load();
			$this->options['gallery'] = $value;
			$this->_save();
		}

		function getGalleryImages()
		{
			$ids = $this->getGalleryImageIds();
			if (empty($ids))
			{
				return array();
			}
			$images = get_posts( array(
				'post_type'  => 'attachment',
				'include'    => $ids,
				'orderby'    => 'none',
				'nopaging'   => true,
			) );
			$ret = array();
			foreach ( (array) $images as $image )
			{
				$ret[] = $image->guid;
			}

			return $ret;
		}

		function _load()
		{
			if (null === $this->options)
			{
				$this->option = 'wiziapp_plugin_wiziapp_theme_be_in_touch_settings';
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
					'app_header_color' => '#ffffff',
					'app_header_background' => '#111111',
					'app_content_color' => '#4B5A6F',
					'app_content_background' => '#ffffff',
					'icon_color' => '#000000',
					'phone_number' => '',
					'address_lat' => '0',
					'address_long' => '0',
					'gallery' => '',
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
	 * Returns a global instance of WiziappThemeBeInTouchSettings
	 *
	 * @staticvar WiziappThemeBeInTouchSettings $inst Used to store the instance
	 * @return WiziappThemeBeInTouchSettings The settings
	 */

	function &wiziapp_theme_be_in_touch_settings()
	{
		static $inst = null;
		if (!$inst)
		{
			$inst = new WiziappThemeBeInTouchSettings();
		}
		return $inst;
	}
