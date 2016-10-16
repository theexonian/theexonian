<?php
	if (get_query_var('wiziapp_theme_metro_touch_menu'))
	{
		get_template_part('homescreen', 'menu');
	}
	else
	{
		wiziapp_theme_get_parent_template_part('index');
	}
