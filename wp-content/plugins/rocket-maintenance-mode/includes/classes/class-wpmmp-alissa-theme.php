<?php

class Wpmmp_Alissa_Theme extends Wpmmp_Theme_Handler {

	protected $name = 'Coming Soon landing page';

	protected $description = 'Simple and beautiful coming soon landing page';

	protected $id = 'alissa';

	protected $path = '';

	protected $template_name = 'alissa-coming-soon';

	protected $settings_page = true;

	protected $settings_page_title = 'Coming soon theme';

	protected $settings_page_slug = 'c_soon_theme';

	function init() {

		$this->path =  WPMMP_PLUGIN_VIEW_DIRECTORY . 'themes/alissa-coming-soon/template.php';

	}

}
